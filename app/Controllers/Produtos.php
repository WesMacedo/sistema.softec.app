<?php

namespace App\Controllers;

use App\Models\ProdutosModel;

class produtos extends AdminController
{
    public function index()
    {
       
        return view('produtos/produtos', [
            'usuario'  => $this->usuario
        ]);
    }
}