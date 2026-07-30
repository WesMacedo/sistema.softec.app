<?php

namespace App\Controllers;

use App\Models\PremiosModel;

class Premios extends BaseController
{
    public function index()
    {
        $usuario = session()->get('user_data');
 
        $model = new PremiosModel();
        $premios = $model->orderBy('id', 'asc')->findAll();

        return view('premios/premios', [
            'usuario' => $usuario,
            'premios' => $premios
        ]);
    }

    public function editar($id = null)
    {
        $usuario = session()->get('user_data');

        if ($id === null) {
              
return redirect()->to(base_url('premios'))->with('error', 'ID inválido.'); 
        }

        $model = new PremiosModel();
        $premio = $model->find($id);

        if (!$premio) {
return redirect()->to(base_url('premios'))->with('error', 'Prêmio não encontrado.'); 
        }

        return view('premios/editar', [
            'usuario' => $usuario,
            'premio' => $premio
        ]);
    }

    public function atualizar()
{
    $id = $this->request->getPost('id');
    $descricao = $this->request->getPost('descricao');

    $model = new \App\Models\PremiosModel();

    // Verifica se existe o prêmio
    $premio = $model->find($id);
    if (!$premio) {
        
return redirect()->to(base_url('premios'))->with('error', 'Prêmio não encontrado.'); 
    }

    $dadosAtualizados = [
        'descricao' => $descricao
    ];

    // Verifica se foi enviada uma nova imagem
    $imagem = $this->request->getFile('img');
    if ($imagem && $imagem->isValid() && !$imagem->hasMoved()) {
    $novoNome = $imagem->getRandomName(); 
    $imagem->move('uploads/premios/', $novoNome); 
    $dadosAtualizados['img'] = base_url('uploads/premios/' . $novoNome);
}


    $model->update($id, $dadosAtualizados);
return redirect()->to(base_url('premios'))->with('success', 'Os dados do prêmio foram atualizados.');

}
}
