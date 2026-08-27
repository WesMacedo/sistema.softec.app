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

    protected function clientGuard($id_cliente)
{
    $clienteModel = new \App\Models\ClienteModel();
    $idEmpresa = $this->usuario['id_empresa'] ?? null;

    $query = $clienteModel->where('id_cliente', $id_cliente);
    
    if (!empty($idEmpresa)) {
        $query->where('id_empresa', $idEmpresa);
    }
    
    $cliente = $query->first();

    if (empty($cliente)) {
        if ($this->request->isAJAX()) {
            echo json_encode([
                'status' => 'error',
                'title' => 'Erro',
                'mensagem' => 'Cliente não encontrado ou você não tem permissão para acessá-lo.'
            ]);
            exit;
        }

        redirect()->to('clientes')->with('swal', [
            'icon'  => 'error',
            'title' => 'Erro',
            'text'  => 'Cliente não encontrado ou você não tem permissão para acessá-lo.'
        ])->send();
        exit;
    }

    return $cliente;
}
 
   public function editar($id_cliente = null)
{ 
    helper('form');
    
    // O ClientGuard valida se existe, se pertence à empresa e já retorna os dados
    $data['cliente'] = $this->clientGuard($id_cliente); 

    $data['titulo'] = 'Editar Cliente';
    return view('clientes/editar', $data);
}

public function perfil($id_cliente = null)
{
    // O ClientGuard valida se existe, se pertence à empresa e já retorna os dados
    $cliente = $this->clientGuard($id_cliente);

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
                ->select('cliente_notas.*, usuarios.nome as nome_usuario') 
                ->join('usuarios', 'usuarios.id = cliente_notas.id_user', 'left') 
                ->where('cliente_notas.id_cliente', $id_cliente)
                ->orderBy('cliente_notas.created_at', 'DESC') 
                ->get()
                ->getResultArray();
    // ------------------------------------------

    $dados = [
        'cliente'       => $cliente,
        'iniciais'      => $iniciais,
        'saldo_cliente' => $saldoCliente,
        'notas'         => $notas 
    ];

    return view('clientes/perfil', $dados);
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
                // Tratamento especial para o estado/UF (fica tudo maiúsculo: CE, MA...)
                if ($campo === 'estado' || $campo === 'uf') {
                    $dados[$campo] = mb_strtoupper(trim($valor), 'UTF-8');
                } else {
                    // Demais campos recebem a primeira letra de cada palavra em maiúscula
                    $dados[$campo] = ucwords(mb_strtolower(trim($valor), 'UTF-8'));
                }
            }
        }

        // Garante o estado em maiúsculo caso venha preenchido
        if (isset($dados['estado'])) {
            $dados['estado'] = mb_strtoupper(trim($dados['estado']), 'UTF-8');
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

        // 4. Verifica se já existe um cliente com este CPF/CNPJ para a mesma empresa
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




  public function atualizarCliente($id_cliente = null)
{
    // O ClientGuard valida se o cliente existe e pertence à empresa do usuário logado
    $clienteExistente = $this->clientGuard($id_cliente);

    $dados = $this->request->getPost();
    
    // Campos que NÃO devem sofrer alteração de maiúsculas/minúsculas
    $camposExcecao = ['email', 'cpf_cnpj', 'whatsapp', 'telefone', 'cep', 'id_cliente', 'id_empresa', 'id_user']; 
    
    foreach ($dados as $campo => $valor) {
        if (!in_array($campo, $camposExcecao) && is_string($valor)) {  
            // Tratamento especial para o estado/UF (fica tudo maiúsculo: CE, MA...)
            if ($campo === 'estado' || $campo === 'uf') {
                $dados[$campo] = mb_strtoupper(trim($valor), 'UTF-8');
            } else {
                // Demais campos recebem a primeira letra de cada palavra em maiúscula
                $dados[$campo] = ucwords(mb_strtolower(trim($valor), 'UTF-8'));
            }
        }
    }

    // Se o estado vier isolado ou precisar garantir independentemente do array de exceção:
    if (isset($dados['estado'])) {
        $dados['estado'] = mb_strtoupper(trim($dados['estado']), 'UTF-8');
    }

    // Remove o id_cliente do array de dados para evitar conflito na atualização
    unset($dados['id_cliente']);

    $clienteModel = new \App\Models\ClienteModel();
    $atualizado = $clienteModel->where('id_cliente', $id_cliente)->set($dados)->update();

    if ($this->request->isAJAX()) {
        if ($atualizado !== false) {
            return $this->response->setJSON([
                'status' => 'sucesso', 
                'mensagem' => 'Cliente atualizado com sucesso!',
                'id_cliente' => $id_cliente
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error', 
                'mensagem' => 'Erro ao atualizar os dados do cliente.'
            ]);
        }
    }

    return redirect()->to('clientes')->with('swal', [
        'icon'  => 'success',
        'title' => 'Sucesso!',
        'text'  => 'Cliente atualizado com sucesso!'
    ]);
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

    $idCliente = $this->request->getPost('id_cliente');

    // 🔒 Blinda usando o ClientGuard para ver se o cliente pertence à empresa atual
    $this->clientGuard($idCliente);

    $db = \Config\Database::connect();
    $builder = $db->table('cliente_notas');

    $dadosNota = [
        'id_cliente' => $idCliente,
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

// --- MÉTODO PARA DELETAR A NOTA VIA AJAX ---
public function deletarNota($id_nota = null)
{
    if (!$this->request->isAJAX()) {
        return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'mensagem' => 'Acesso negado.']);
    }

    if (empty($id_nota)) {
        return $this->response->setJSON([
            'status'   => 'error',
            'mensagem' => 'Nota não identificada.'
        ]);
    }

    $db = \Config\Database::connect();
    
    // 1. Busca a nota para descobrir a qual cliente ela pertence
    $nota = $db->table('cliente_notas')
               ->where('id_nota', $id_nota)
               ->get()
               ->getRowArray();

    if (empty($nota)) {
        return $this->response->setJSON([
            'status'   => 'error',
            'mensagem' => 'Nota não encontrada.'
        ]);
    }

    // 🔒 2. Usa o ClientGuard para validar se o cliente da nota pertence à empresa atual
    // Se não pertencer ou não existir, o ClientGuard já bloqueia e retorna o erro formatado via AJAX
    $this->clientGuard($nota['id_cliente']);

    // 3. Se passou pela segurança, executa a exclusão da nota
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

    // 🔒 O ClientGuard valida, protege e já retorna os dados do cliente (ou encerra/retorna erro se inválido)
    $cliente = $this->clientGuard($id_cliente);

    $model = new \App\Models\ClienteModel();

    try {
        // Deleta utilizando a chave primária real da tabela ('id') presente no array $cliente
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

    // 🔒 O ClientGuard valida, protege e já retorna os dados do cliente com segurança
    $cliente = $this->clientGuard($idCliente);

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

    $model = new \App\Models\ClienteModel();

    try {
        // Salva direto o inteiro em centavos no banco usando a chave primária real ('id')
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

}