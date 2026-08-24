<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class Clientes extends AdminController
{
    public function index()
    {
        $model = new ClienteModel();

        // Busca apenas os clientes da loja do usuário logado
        $idLoja = $this->usuario['id_loja'] ?? null;
        $clientes = $model->where('id_loja', $idLoja)->orderBy('id', 'DESC')->findAll();

        return view('clientes/clientes', [
            'usuario'  => $this->usuario,
            'clientes' => $clientes
        ]);
    }

    public function cadastrar()
    {
        return view('clientes/cadastrar', [
            'usuario' => $this->usuario
        ]);
    }

    // --- MÉTODO PARA SALVAR VIA AJAX ---
    public function salvar()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'mensagem' => 'Acesso negado.']);
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nome_razaosocial' => 'required|min_length[3]',
            'whatsapp'         => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'mensagem' => 'Preencha os campos obrigatórios corretamente (Nome e WhatsApp).'
            ]);
        }

        $model = new \App\Models\ClienteModel();
        $dados = $this->request->getPost();

        // 1. Associa os dados do usuário logado e da loja
        $dados['id_user']  = $this->usuario['id'] ?? null; 
        $dados['id_loja']  = $this->usuario['id_loja'] ?? null; 

        // 2. Define automaticamente se é PF ou PJ com base no tamanho do CPF/CNPJ
        $cpfCnpjLimpo = preg_replace('/\D/', '', $dados['cpf_cnpj'] ?? '');
        if (!empty($cpfCnpjLimpo)) {
            $dados['tipo'] = (strlen($cpfCnpjLimpo) <= 11) ? 'PF' : 'PJ';
        } else {
            $dados['tipo'] = null; 
        }

        // 3. Verifica se já existe um cliente com este CPF/CNPJ para a mesma loja
        if (!empty($cpfCnpjLimpo) && !empty($dados['id_loja'])) {
            $clienteExistente = $model->where('id_loja', $dados['id_loja'])
                                    ->where('cpf_cnpj', $dados['cpf_cnpj']) // Ajuste para $cpfCnpjLimpo se você salvar sem máscara
                                    ->first();

            if ($clienteExistente) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'mensagem' => 'Não foi possível realizar o cadastro, o CPF/CNPJ informado já está registrado no sistema.'
                ]);
            }
        }

        try {
            if ($model->insert($dados)) {
                return $this->response->setJSON([
                    'status' => 'sucesso',
                    'mensagem' => 'Cliente cadastrado com sucesso.'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'mensagem' => 'Erro ao salvar no banco de dados.'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'mensagem' => 'Erro: ' . $e->getMessage()
            ]);
        }
    }


    public function editar()
    {
        return view('clientes/editar', [
            'usuario' => $this->usuario
        ]);
    } 

    public function perfil()
    {
        return view('clientes/perfil', [
            'usuario' => $this->usuario
        ]);
    }
}