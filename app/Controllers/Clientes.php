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

        // 2. Gera um ID único alfanumérico (Ex: H44HF83G874) com garantia de que jamais se repete
        do {
            $codigoUnico = strtoupper(substr(bin2hex(random_bytes(6)), 0, 11));
            $existe = $model->where('id_cliente', $codigoUnico)->first();
        } while ($existe);

        $dados['id_cliente'] = $codigoUnico;

        // 3. Define automaticamente se é PF ou PJ com base no tamanho do CPF/CNPJ
        $cpfCnpjLimpo = preg_replace('/\D/', '', $dados['cpf_cnpj'] ?? '');
        if (!empty($cpfCnpjLimpo)) {
            $dados['tipo'] = (strlen($cpfCnpjLimpo) <= 11) ? 'PF' : 'PJ';
        } else {
            $dados['tipo'] = null; 
        }

        // 4. Verifica se já existe um cliente com este CPF/CNPJ para a mesma loja
        if (!empty($cpfCnpjLimpo) && !empty($dados['id_loja'])) {
            $clienteExistente = $model->where('id_loja', $dados['id_loja'])
                                    ->where('cpf_cnpj', $dados['cpf_cnpj']) 
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

    // --- MÉTODO PARA ADICIONAR NOTA DO CLIENTE ---
    public function salvarNota()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'mensagem' => 'Acesso negado.']);
        }

        $validacao = \Config\Services::validation();
        $validacao->setRules([
            'id_cliente' => 'required',
            'nota'       => 'required|min_length[2]'
        ]);

        if (!$validacao->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status'   => 'error',
                'mensagem' => 'O campo de nota não pode estar vazio.'
            ]);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('cliente_notas');

        $dadosNota = [
            'id_cliente' => $this->request->getPost('id_cliente'),
            'id_user'    => $this->usuario['id'] ?? null, // ID do funcionário logado
            'nota'       => $this->request->getPost('nota')
        ];

        try {
            if ($builder->insert($dadosNota)) {
                return $this->response->setJSON([
                    'status'   => 'sucesso',
                    'mensagem' => 'Nota adicionada com sucesso!'
                ]);
            } else {
                return $this->response->setJSON([
                    'status'   => 'error',
                    'mensagem' => 'Erro ao salvar a nota no banco de dados.'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status'   => 'error',
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

    public function perfil($id = null)
    {
        $model = new ClienteModel();
        $idLoja = $this->usuario['id_loja'] ?? null;

        $cliente = $model->where('id_cliente', $id)
                         ->where('id_loja', $idLoja)
                         ->first();

        if (!$cliente) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Cliente não encontrado.");
        }

        // Busca as notas do cliente ordenadas da mais recente para a mais antiga
        $db = \Config\Database::connect();
        $notas = $db->table('cliente_notas')
                    ->select('cliente_notas.*, usuarios.nome as nome_usuario') // Se tiver a tabela de usuários com campo 'nome'
                    ->join('usuarios', 'usuarios.id = cliente_notas.id_user', 'left')
                    ->where('cliente_notas.id_cliente', $id)
                    ->orderBy('cliente_notas.id_nota', 'DESC')
                    ->get()
                    ->getResultArray();

        return view('clientes/perfil', [
            'usuario' => $this->usuario,
            'cliente' => $cliente,
            'notas'   => $notas
        ]);
    }

    // Método para deletar a nota via AJAX
    public function deletarNota($id_nota = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'mensagem' => 'Acesso negado.']);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('cliente_notas');

        if ($builder->where('id_nota', $id_nota)->delete()) {
            return $this->response->setJSON([
                'status'   => 'sucesso',
                'mensagem' => 'Nota excluída com sucesso!'
            ]);
        }

        return $this->response->setJSON([
            'status'   => 'error',
            'mensagem' => 'Erro ao excluir a nota.'
        ]);
    }
}