<?php

namespace App\Controllers;
 
class Dash extends AdminController
{
    public function index()
    {  
        return view('dash/dash', [
            'usuario' => $this->usuario
        ]);
    }
}