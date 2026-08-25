<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class Clientes extends AdminController
{
    public function index()
    {
        $model = new ClienteModel();

        // Busca apenas os clientes da loja do usuário logado
        $idEmpresa = $this->usuario['id_empresa'] ?? null;
        $clientes = $model->where('id_empresa', $idEmpresa)->orderBy('id', 'DESC')->findAll();

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

   // --- MÉTODO PARA SALVAR CLIENTE VIA AJAX ---
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

        // Campos que NÃO devem sofrer alteração de maiúsculas/minúsculas
        $camposExcecao = ['email', 'cpf_cnpj', 'whatsapp', 'telefone', 'cep', 'id_cliente', 'id_empresa', 'id_user']; 
        foreach ($dados as $campo => $valor) {
            if (!in_array($campo, $camposExcecao) && is_string($valor)) {  
                $dados[$campo] = ucwords(mb_strtolower(trim($valor), 'UTF-8'));
            }
        }

        // 1. Associa os dados do usuário logado e da empresa
        $dados['id_user']  = $this->usuario['id'] ?? null; 
        $dados['id_empresa']  = $this->usuario['id_empresa'] ?? null; 

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
        if (!empty($cpfCnpjLimpo) && !empty($dados['id_empresa'])) {
            $clienteExistente = $model->where('id_empresa', $dados['id_empresa'])
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
                    'mensagem' => 'Cliente cadastrado com sucesso.',
                    'id_cliente' => $dados['id_cliente']
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

   public function perfil($id_cliente = null)
{
    $model = new \App\Models\ClienteModel();
    $idEmpresa = $this->usuario['id_empresa'] ?? null;

    $cliente = $model->where('id_cliente', $id_cliente)
                    ->where('id_empresa', $idEmpresa)
                    ->first();

    if (!$cliente) {
        return redirect()->to('clientes')->with('erro', 'Cliente não encontrado.');
    }

    // --- Processa as iniciais do nome ---
    $nomeBruto = $cliente['nome_razaosocial'] ?? 'Cliente';
    preg_match_all('/[a-zA-ZáàâãéêíóôõúçÁÀÂÃÉÊÍÓÔÕÚÇ]+/u', $nomeBruto, $matches);
    $palavras = $matches[0] ?? [];

    if (count($palavras) >= 2) {
        $iniciais = mb_strtoupper(mb_substr($palavras[0], 0, 1) . mb_substr($palavras[1], 0, 1));
    } elseif (count($palavras) == 1) {
        $iniciais = mb_strtoupper(mb_substr($palavras[0], 0, 2));
    } else {
        $iniciais = 'CL';
    }
    // ------------------------------------

    // Converte de centavos para reais (ex: 10000 vira 100.00)
    $saldoCliente = isset($cliente['saldo']) ? ($cliente['saldo'] / 100) : 0.00;

    // --- BUSCA AS NOTAS DO CLIENTE NO BANCO ---
    $db = \Config\Database::connect();
    $notas = $db->table('cliente_notas')
                ->select('cliente_notas.*, usuarios.nome as nome_usuario') // Se quiser trazer o nome de quem criou (opcional)
                ->join('usuarios', 'usuarios.id = cliente_notas.id_user', 'left') // Opcional: para exibir quem escreveu
                ->where('cliente_notas.id_cliente', $id_cliente)
                ->orderBy('cliente_notas.created_at', 'DESC') // Ordena pelas mais recentes
                ->get()
                ->getResultArray();
    // ------------------------------------------

    $dados = [
        'cliente'       => $cliente,
        'iniciais'      => $iniciais,
        'saldo_cliente' => $saldoCliente,
        'notas'         => $notas // <-- ENVIANDO AS NOTAS PARA A VIEW
    ];

    return view('clientes/perfil', $dados);
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

    
// --- MÉTODO PARA EXCLUIR CLIENTE VIA AJAX ---
    public function excluir($id_cliente = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'mensagem' => 'Acesso negado.']);
        }

        if (empty($id_cliente)) {
            return $this->response->setJSON([
                'status' => 'error',
                'mensagem' => 'Cliente não identificado.'
            ]);
        }

        $model = new \App\Models\ClienteModel();

        // 1. Pega a empresa da sessão
        $idEmpresa = $this->usuario['id_empresa'] ?? null;

        // 2. Busca o cliente garantindo que pertence à empresa logada
        $cliente = $model->where('id_cliente', $id_cliente)
                         ->where('id_empresa', $idEmpresa)
                         ->first();

        if (!$cliente) {
            return $this->response->setJSON([
                'status' => 'error',
                'mensagem' => 'Cliente não encontrado ou você não tem permissão para excluí-lo.'
            ]);
        }

        try {
            // 3. Deleta utilizando a chave primária real da tabela ('id') que veio no array $cliente
            if ($model->delete($cliente['id'])) {
                return $this->response->setJSON([
                    'status' => 'sucesso',
                    'mensagem' => 'Cliente excluído com sucesso.'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'mensagem' => 'Não foi possível excluir o cliente no banco de dados.'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'mensagem' => 'Erro: ' . $e->getMessage()
            ]);
        }
    }


    

    public function attsaldo()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'mensagem' => 'Acesso negado.']);
    }

    $validacao = \Config\Services::validation();
    $validacao->setRules([
        'id_cliente' => 'required',
        'operacao'   => 'required',
        'valor'      => 'required|integer'
    ]);

    if (!$validacao->withRequest($this->request)->run()) {
        return $this->response->setJSON([
            'status'   => 'error',
            'mensagem' => 'Preencha todos os campos corretamente.'
        ]);
    }

    $idCliente = $this->request->getPost('id_cliente');
    $operacao = $this->request->getPost('operacao');
    $valorCentavos = intval($this->request->getPost('valor')); // Já chega em centavos inteiros

    if ($valorCentavos <= 0) {
        return $this->response->setJSON([
            'status'   => 'error',
            'mensagem' => 'O valor precisa ser maior que zero.'
        ]);
    }

    $model = new \App\Models\ClienteModel();
    $idEmpresa = $this->usuario['id_empresa'] ?? null;

    $cliente = $model->where('id_cliente', $idCliente)
                     ->where('id_empresa', $idEmpresa)
                     ->first();

    if (!$cliente) {
        return $this->response->setJSON([
            'status'   => 'error',
            'mensagem' => 'Cliente não encontrado.'
        ]);
    }

    $saldoAtualCentavos = intval($cliente['saldo'] ?? 0);

    if ($operacao === 'adicionar') {
        $novoSaldoCentavos = $saldoAtualCentavos + $valorCentavos;
    } else {
        $novoSaldoCentavos = $saldoAtualCentavos - $valorCentavos;
        
        if ($novoSaldoCentavos < 0) {
            return $this->response->setJSON([
                'status'   => 'error',
                'mensagem' => 'O saldo não pode ficar negativo.'
            ]);
        }
    }

    try {
        // Salva direto o inteiro em centavos no banco
        if ($model->update($cliente['id'], ['saldo' => $novoSaldoCentavos])) {
            $novoSaldoReais = $novoSaldoCentavos / 100;
            return $this->response->setJSON([
                'status'   => 'sucesso',
                'mensagem' => 'Saldo atualizado com sucesso!',
                'novo_saldo_formatado' => number_format($novoSaldoReais, 2, ',', '.')
            ]);
        } else {
            return $this->response->setJSON([
                'status'   => 'error',
                'mensagem' => 'Erro ao salvar o saldo no banco de dados.'
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
}