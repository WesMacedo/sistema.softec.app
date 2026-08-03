<?php

namespace App\Controllers;

use App\Models\UsuariosModel;
use Config\Database;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class Push extends BaseController
{
    public function salvarInscricao()
    {
        // 1. Validação de segurança via user_token da sessão
        $token = session()->get('user_token');
        if (!$token) {
            return $this->response->setJSON(['success' => false, 'message' => 'Não autorizado']);
        }

        $usuariosModel = new UsuariosModel();
        $usuario = $usuariosModel->getUsuarioPorToken($token);

        if (!$usuario) {
            return $this->response->setJSON(['success' => false, 'message' => 'Usuário inválido']);
        }

        // 2. Recebe os dados de push do JavaScript
        $subscription = $this->request->getJSON(true);
        if (!isset($subscription['endpoint'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Inscrição inválida']);
        }

        $endpoint = $subscription['endpoint'];
        $p256dh   = $subscription['keys']['p256dh'] ?? '';
        $auth     = $subscription['keys']['auth'] ?? '';

        // 3. Salva ou atualiza no banco vinculado ao ID do usuário
        $db = Database::connect();
        $builder = $db->table('push_subscriptions');

        $existente = $builder->where('usuario_id', $usuario['id'])->get()->getRow();

        if ($existente) {
            $builder->where('usuario_id', $usuario['id'])->update([
                'endpoint' => $endpoint,
                'p256dh'   => $p256dh,
                'auth'     => $auth,
                'criado_em'=> date('Y-m-d H:i:s')
            ]);
        } else {
            $builder->insert([
                'usuario_id' => $usuario['id'],
                'endpoint'   => $endpoint,
                'p256dh'   => $p256dh,
                'auth'     => $auth
            ]);
        }

        return $this->response->setJSON(['success' => true]);
    }

    public function enviarTeste()
    {
        // Valida o usuário logado pelo token da sessão
        $token = session()->get('user_token');
        if (!$token) {
            return 'Faça login no sistema primeiro.';
        }

        $usuariosModel = new UsuariosModel();
        $usuario = $usuariosModel->getUsuarioPorToken($token);

        // Busca a inscrição push do usuário no banco
        $db = Database::connect();
        $inscricao = $db->table('push_subscriptions')
                        ->where('usuario_id', $usuario['id'])
                        ->get()
                        ->getRowArray();

        if (!$inscricao) {
            return 'Nenhuma inscrição push encontrada. Clique em ativar notificações primeiro!';
        }

        // Configuração das Chaves VAPID
        $auth = [
            'VAPID' => [
                'subject'    => 'mailto:evoluteccrateus@gmail.com',
                'publicKey'  => 'BCyPg8VlqtHZOsIEmvhwLAIt9uU4rfF409XbwTLO0IChduRuVaecg-8Rt92lUSAkSdCJYqKtSLh4DPMI3ZogT2k',
                'privateKey' => '7aZyZtWCSYzM3xJVBDZL3zqEF7bynFIAF9dkI1nyF1U',
            ],
        ];

        $webPush = new WebPush($auth);

        $subscription = Subscription::create([
            'endpoint' => $inscricao['endpoint'],
            'keys'     => [
                'p256dh' => $inscricao['p256dh'],
                'auth'   => $inscricao['auth']
            ]
        ]);

        $payload = json_encode([
            'titulo' => 'Olá, ' . $usuario['nome'] . '!',
            'corpo'  => 'Teste de notificação push realizado com sucesso!'
        ]);

        $report = $webPush->sendOneNotification($subscription, $payload);

        if ($report->isSuccess()) {
            return 'Sucesso! Notificação enviada para o seu navegador.';
        } else {
            return 'Erro ao enviar: ' . $report->getReason();
        }
    }
}