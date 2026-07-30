<?php

namespace App\Controllers;

class Dash extends BaseController
{
    public function index()
    {
        // Recupera os dados do usuário direto da sessão
        $usuario = session()->get('user_data');

        return view('dash/dash', [
            'usuario' => $usuario
        ]);
    }
}
