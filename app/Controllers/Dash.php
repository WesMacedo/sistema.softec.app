<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Dash extends BaseController
{
    public function index()
    {
        // 1. Pega apenas o token da sessão por segurança
        $token = session()->get('user_token');

        if (!$token) {
            return redirect()->to(base_url('auth/login'));
        }

        $usuariosModel = new UsuariosModel();

        // 2. Busca os dados do usuário no banco em tempo real usando o token
        $usuario = $usuariosModel->getUsuarioPorToken($token);

        if (!$usuario) {
            // Se o token não existir ou for inválido, limpa a sessão e redireciona
            session()->destroy();
            return redirect()->to(base_url('auth/login'));
        }

        // 3. Envia os dados buscados para a view do painel
        return view('dash/dash', [
            'usuario' => $usuario
        ]);
    }
}