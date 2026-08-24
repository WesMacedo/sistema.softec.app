<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class AdminController extends BaseController
{
    protected $usuario;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Garante que o fluxo padrão do CodeIgniter aconteça
        parent::initController($request, $response, $logger);

        // Pega os dados do usuário salvos pelo AuthFilter
        $this->usuario = session()->get('user_data');

        // Segurança caso a sessão expire
        if (!$this->usuario) {
            return redirect()->to(base_url('auth/login'))->send();
        }
    }
}