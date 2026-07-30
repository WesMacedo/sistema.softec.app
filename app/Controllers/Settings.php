<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use App\Models\FakeSellerModel; // IMPORTANTE: mesmo arquivo, mesmas namespace

class Settings extends BaseController
{
    public function index()
    {
        $usuario = session()->get('user_data');

        // Instancia o model de config
        $settingsModel = new SettingsModel();
        $config = $settingsModel->first();

        // Instancia o model fake seller (mesmo arquivo, mesma namespace)
        $fakeSellerModel = new FakeSellerModel();
        $fakeSellers = $fakeSellerModel->findAll();

        return view('settings/settings', [
            'usuario' => $usuario,
            'config' => $config,
            'fakeSellers' => $fakeSellers,
        ]);
    }

    public function saveSettings()
    {
        $model = new SettingsModel();

        $config = $model->first();
        $id = $config['id'] ?? 1;

        $data = [
            'inicio_corrida'   => $this->request->getPost('inicio_corrida'),
            'termino_corrida'  => $this->request->getPost('termino_corrida'),
            'email'            => $this->request->getPost('email'),
            'instagram'        => $this->request->getPost('instagram'),
            'whatsapp'         => $this->request->getPost('whatsapp'),
            'status'           => $this->request->getPost('status'),
            'botao_gateway'    => $this->request->getPost('botao_gateway'),
            'botao_plataforma' => $this->request->getPost('botao_plataforma'),
        ];

        $model->update($id, $data);
        return $this->response->setJSON(['success' => true, 'message' => 'Configurações salvas com sucesso!']);
    }
}
