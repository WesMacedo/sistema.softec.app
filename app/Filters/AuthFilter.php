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
        $isLoggedIn = false;

        // Verifica se tem token e se o usuário realmente existe no banco
        if ($token) {
            $model = new UsuariosModel();
            $usuario = $model->where('token', $token)->first();

            if ($usuario) {
                $isLoggedIn = true;
                // Salva os dados na sessão se ainda não existirem
                if (!session()->get('user_data')) {
                    session()->set('user_data', $usuario);
                }
            } else {
                // Token inválido/expirado, limpa a sessão
                session()->remove('user_token');
                session()->remove('user_data');
            }
        }

        // Cenário 1: A rota exige que o usuário ESTEJA logado (argumento 'auth')
        if (in_array('auth', $arguments ?? [])) {
            if (!$isLoggedIn) {
                return redirect()->to(base_url('auth/login'));
            }
        }

        // Cenário 2: A rota exige que o usuário NÃO esteja logado / seja visitante (argumento 'guest')
        if (in_array('guest', $arguments ?? [])) {
            if ($isLoggedIn) {
                return redirect()->to(base_url('dash'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nada a fazer depois
    }
}