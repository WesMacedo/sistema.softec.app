<?php

namespace App\Filters;

use App\Models\UsuariosModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $token = session()->get('user_token');

        // Se não existe token na sessão, redireciona para o login
        if (!$token) {
            return redirect()->to(base_url('auth/login'));
        }

        // Carrega o usuário com base no token
        $model = new UsuariosModel();
        $usuario = $model->where('token', $token)->first();

        // Se não encontrou o usuário, remove sessão e redireciona
        if (!$usuario) {
            session()->remove('user_token');
            return redirect()->to(base_url('auth/login'));
        }

        // Salva o usuário na sessão (se ainda não estiver salvo)
        if (!session()->get('user_data')) {
            session()->set('user_data', $usuario);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada a fazer depois
    }
}
