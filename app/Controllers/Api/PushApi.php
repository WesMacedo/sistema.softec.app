<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PushModel;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class PushApi extends BaseController
{
    // Credenciais VAPID
    private function getWebPushConfig()
    {
        return [
            'VAPID' => [
                'subject'    => 'mailto:evoluteccrateus@gmail.com',
                'publicKey'  => 'BCyPg8VlqtHZOsIEmvhwLAIt9uU4rfF409XbwTLO0IChduRuVaecg-8Rt92lUSAkSdCJYqKtSLh4DPMI3ZogT2k',
                'privateKey' => '7aZyZtWCSYzM3xJVBDZL3zqEF7bynFIAF9dkI1nyF1U',
            ],
        ];
    }

    public function enviar()
    {
        // 1. Segurança Básica (Token de API secreto)
        // O sistema externo precisa enviar um cabeçalho 'Authorization' ou um campo 'api_token'
        $tokenRecebido = $this->request->getHeaderLine('Authorization') ?: $this->request->getVar('api_token');
        $tokenSecreto = 'SEU_TOKEN_SECRETO_EXTERNO_AQUI'; // Troque por uma senha/token forte

        if ($tokenRecebido !== 'Bearer ' . $tokenSecreto && $tokenRecebido !== $tokenSecreto) {
            return $this->response->setStatusCode(401)->setJSON([
                'sucesso' => false,
                'mensagem' => 'Acesso não autorizado. Token inválido.'
            ]);
        }

        // 2. Coletando os dados enviados via requisição POST
        $usuarioId = $this->request->getVar('usuario_id'); // Pode ser um ID ou 'todos'
        $titulo    = $this->request->getVar('titulo') ?? 'Softec';
        $corpo     = $this->request->getVar('corpo') ?? 'Você tem uma nova notificação';
        $url       = $this->request->getVar('url') ?? '/';

        if (empty($usuarioId)) {
            return $this->response->setStatusCode(400)->setJSON([
                'sucesso' => false,
                'mensagem' => 'O parâmetro usuario_id é obrigatório (use um ID específico ou "todos").'
            ]);
        }

        $pushModel = new PushModel();

        // 3. Busca as inscrições no banco com base no destinatário informado
        if (strtolower($usuarioId) === 'todos') {
            $inscricoes = $pushModel->findAll();
        } else {
            // Suporta múltiplos IDs separados por vírgula (ex: "1,5,8") ou ID único (ex: "12")
            if (strpos($usuarioId, ',') !== false) {
                $idsArray = array_map('trim', explode(',', $usuarioId));
                $inscricoes = $pushModel->whereIn('usuario_id', $idsArray)->findAll();
            } else {
                $inscricoes = [$pushModel->where('usuario_id', (int)$usuarioId)->first()];
            }
        }

        // Filtra nulos caso algum ID não tenha inscrição válida
        $inscricoes = array_filter($inscricoes);

        if (empty($inscricoes)) {
            return $this->response->setStatusCode(404)->setJSON([
                'sucesso' => false,
                'mensagem' => 'Nenhuma inscrição push encontrada para o(s) usuário(s) informado(s).'
            ]);
        }

        // 4. Disparando as notificações via WebPush
        $webPush = new WebPush($this->getWebPushConfig());
        $payload = json_encode([
            'titulo' => $titulo,
            'corpo'  => $corpo,
            'url'    => $url
        ]);

        foreach ($inscricoes as $inscricao) {
            $subscription = Subscription::create([
                'endpoint' => $inscricao['endpoint'],
                'keys'     => [
                    'p256dh' => $inscricao['p256dh'],
                    'auth'   => $inscricao['auth']
                ]
            ]);

            $webPush->queueNotification($subscription, $payload);
        }

        $enviados = 0;
        $erros = 0;

        foreach ($webPush->flush() as $report) {
            if ($report->isSuccess()) {
                $enviados++;
            } else {
                $erros++;
            }
        }

        // 5. Retorna a resposta em JSON para quem chamou a API
        return $this->response->setJSON([
            'sucesso' => true,
            'total_enviados' => $enviados,
            'total_erros' => $erros,
            'mensagem' => 'Processo de envio finalizado com sucesso.'
        ]);
    }
}