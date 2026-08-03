<?php

namespace App\Controllers;

use App\Models\UsuariosModel;
use Config\Database;

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
}