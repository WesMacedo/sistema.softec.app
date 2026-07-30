<?php

namespace App\Controllers;

use App\Models\SellersModel;

class Sellers extends BaseController
{
    public function index()
    {
        $usuario = session()->get('user_data');

        // Carrega os dados do ranking
        $model = new SellersModel();
        $ranking = $model->orderBy('position', 'asc')->findAll();

        return view('sellers/sellers', [
            'usuario' => $usuario,
            'ranking' => $ranking
        ]);
    }
}
