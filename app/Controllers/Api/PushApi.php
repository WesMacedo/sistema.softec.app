<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PushModel;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class PushApi extends BaseController
{
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
        $tokenRecebido = $this->request->getHeaderLine('Authorization') ?: $this->request->getVar('api_token');
        $tokenSecreto = '8755';

        if ($tokenRecebido !== 'Bearer ' . $tokenSecreto && $tokenRecebido !== $tokenSecreto) {
            return $this->response->setStatusCode(401)->setJSON([
                'sucesso' => false,
                'mensagem' => 'Acesso não autorizado. Token inválido.'
            ]);
        }

        $usuarioId = $this->request->getVar('usuario_id');
        $titulo    = $this->request->getVar('titulo') ?? 'Softec';
        $corpo     = $this->request->getVar('corpo') ?? 'Você tem uma nova notificação';
        $url       = $this->request->getVar('url') ?? '/';

        if (empty($usuarioId)) {
            return $this->response->setStatusCode(400)->setJSON([
                'sucesso' => false,
                'mensagem' => 'O parâmetro usuario_id é obrigatório.'
            ]);
        }

        $pushModel = new PushModel();

        if (strtolower($usuarioId) === 'todos') {
            $inscricoes = $pushModel->findAll();
        } else {
            if (strpos($usuarioId, ',') !== false) {
                $idsArray = array_map('trim', explode(',', $usuarioId));
                $inscricoes = $pushModel->whereIn('usuario_id', $idsArray)->findAll();
            } else {
                $inscricoes = [$pushModel->where('usuario_id', (int)$usuarioId)->first()];
            }
        }

        $inscricoes = array_filter($inscricoes);

        if (empty($inscricoes)) {
            return $this->response->setStatusCode(404)->setJSON([
                'sucesso' => false,
                'mensagem' => 'Nenhuma inscrição push encontrada.'
            ]);
        }
    
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

        return $this->response->setJSON([
            'sucesso' => true,
            'total_enviados' => $enviados,
            'total_erros' => $erros,
            'mensagem' => 'Processo de envio finalizado com sucesso.'
        ]);
    }
}
 