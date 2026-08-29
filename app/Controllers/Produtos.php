<?php

namespace App\Controllers;

use App\Models\ProdutosModel;

class Produtos extends AdminController
{
    public function index()
    {
        $model = new ProdutosModel();

        $idEmpresa = $this->usuario['id_empresa'] ?? null;
        $produtos = $model->where('id_empresa', $idEmpresa)->orderBy('id', 'DESC')->findAll();

        return view('produtos/produtos', [
            'usuario'  => $this->usuario,
            'produtos' => $produtos
        ]);
    }

    public function cadastrar()
    {
        helper('form');
        return view('produtos/cadastrar', [
            'usuario' => $this->usuario,
            'titulo'  => 'Cadastrar Produto'
        ]);
    }

    protected function produtoGuard($idProduto)
    {
        $produtosModel = new ProdutosModel();
        $idEmpresa = $this->usuario['id_empresa'] ?? null;

        // Busca utilizando a coluna id_produto
        $query = $produtosModel->where('id_produto', $idProduto);
        
        if (!empty($idEmpresa)) {
            $query->where('id_empresa', $idEmpresa);
        }
        
        $produto = $query->first();

        if (empty($produto)) {
            if ($this->request->isAJAX()) {
                echo json_encode([
                    'status' => 'error',
                    'title' => 'Erro',
                    'mensagem' => 'Produto não encontrado ou você não tem permissão para acessá-lo.'
                ]);
                exit;
            }

            redirect()->to('produtos')->with('swal', [
                'icon'  => 'error',
                'title' => 'Erro',
                'text'  => 'Produto não encontrado ou você não tem permissão para acessá-lo.'
            ])->send();
            exit;
        }

        return $produto;
    }

    public function editar($idProduto = null)
    { 
        helper('form');
        
        $data['produto'] = $this->produtoGuard($idProduto); 
        $data['usuario'] = $this->usuario;
        $data['titulo'] = 'Editar Produto';
        
        return view('produtos/editar', $data);
    }

    public function visualizar($idProduto = null)
    {
        $produto = $this->produtoGuard($idProduto);

        $nomeBruto = $produto['produto'] ?? 'Produto';
        preg_match_all('/[a-zA-ZáàâãéêíóôõúçÁÀÂÃÉÊÍÓÔÕÚÇ]+/u', $nomeBruto, $matches);
        $palavras = $matches[0] ?? [];

        if (count($palavras) >= 2) {
            $iniciais = mb_strtoupper(mb_substr($palavras[0], 0, 1) . mb_substr($palavras[1], 0, 1));
        } elseif (count($palavras) == 1) {
            $iniciais = mb_strtoupper(mb_substr($palavras[0], 0, 2));
        } else {
            $iniciais = 'PR';
        }

        $dados = [
            'usuario'  => $this->usuario,
            'produto'  => $produto,
            'iniciais' => $iniciais,
            'titulo'   => 'Visualizar Produto'
        ];

        return view('produtos/visualizar', $dados);
    }

    // --- MÉTODO PARA SALVAR PRODUTO VIA AJAX ---
    public function salvar()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'mensagem' => 'Acesso negado.']);
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'produto'      => 'required|min_length[2]',
            'valor_varejo' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status'   => 'error',
                'mensagem' => 'Preencha os campos obrigatórios corretamente (Nome do Produto e Valor de Varejo).'
            ]);
        }

        $model = new ProdutosModel();
        $dados = $this->request->getPost();

        $camposExcecao = ['id_produto', 'id_empresa', 'id_user', 'estoque', 'garantia', 'valor_custo', 'valor_atacado', 'valor_varejo', 'valor_desconto', 'ativo', 'catalogo', 'atacado', 'tipo_desconto', 'desconto'];
        
        foreach ($dados as $campo => $valor) {
            if (!in_array($campo, $camposExcecao) && is_string($valor)) {  
                $dados[$campo] = ucwords(mb_strtolower(trim($valor), 'UTF-8'));
            }
        }

        // Geração automática do id_produto se estiver vazio
        if (empty($dados['id_produto'])) {
            do {
                $idGerado = 'PRD-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
                $existeId = $model->where('id_produto', $idGerado)->first();
            } while ($existeId);

            $dados['id_produto'] = $idGerado;
        } else {
            $dados['id_produto'] = mb_strtoupper(trim($dados['id_produto']), 'UTF-8');
            
            $idExistente = $model->where('id_produto', $dados['id_produto'])->first();
            if ($idExistente) {
                return $this->response->setJSON([
                    'status'   => 'error',
                    'mensagem' => 'O ID/SKU informado já está em uso por outro produto.'
                ]);
            }
        }

        $dados['id_user']    = $this->usuario['id'] ?? null; 
        $dados['id_empresa'] = $this->usuario['id_empresa'] ?? null; 

        try {
            if ($model->insert($dados)) {
                return $this->response->setJSON([
                    'status'     => 'sucesso',
                    'mensagem'   => 'Produto cadastrado com sucesso.',
                    'id_interno' => $model->getInsertID(),
                    'id_produto' => $dados['id_produto']
                ]);
            } else {
                return $this->response->setJSON([
                    'status'   => 'error',
                    'mensagem' => 'Erro ao salvar o produto no banco de dados.'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status'   => 'error',
                'mensagem' => 'Erro: ' . $e->getMessage()
            ]);
        }
    }

    // --- MÉTODO PARA ATUALIZAR PRODUTO VIA AJAX ---
    public function atualizarProduto($idProduto = null)
    {
        $produtoExistente = $this->produtoGuard($idProduto);

        $dados = $this->request->getPost();
        
        $camposExcecao = ['id_produto', 'id_empresa', 'id_user', 'estoque', 'garantia', 'valor_custo', 'valor_atacado', 'valor_varejo', 'valor_desconto', 'ativo', 'catalogo', 'atacado', 'tipo_desconto', 'desconto'];
        
        foreach ($dados as $campo => $valor) {
            if (!in_array($campo, $camposExcecao) && is_string($valor)) {  
                $dados[$campo] = ucwords(mb_strtolower(trim($valor), 'UTF-8'));
            }
        }

        if (!empty($dados['id_produto'])) {
            $dados['id_produto'] = mb_strtoupper(trim($dados['id_produto']), 'UTF-8');
        }

        $dados['alterado_por'] = $this->usuario['id'] ?? null;

        $model = new ProdutosModel();
        // Atualiza usando o ID numérico primário interno do registro
        $atualizado = $model->update($produtoExistente['id'], $dados);

        if ($this->request->isAJAX()) {
            if ($atualizado !== false) {
                return $this->response->setJSON([
                    'status'     => 'sucesso', 
                    'mensagem'   => 'Produto atualizado com sucesso!',
                    'id_produto' => $dados['id_produto'] ?? $idProduto
                ]);
            } else {
                return $this->response->setJSON([
                    'status'   => 'error', 
                    'mensagem' => 'Erro ao atualizar os dados do produto.'
                ]);
            }
        }

        return redirect()->to('produtos')->with('swal', [
            'icon'  => 'success',
            'title' => 'Sucesso!',
            'text'  => 'Produto atualizado com sucesso!'
        ]);
    }

    // --- MÉTODO PARA EXCLUIR PRODUTO VIA AJAX ---
    public function excluir($idProduto = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'mensagem' => 'Acesso negado.']);
        }

        if (empty($idProduto)) {
            return $this->response->setJSON([
                'status'   => 'error',
                'mensagem' => 'Identificador do produto não informado.'
            ]);
        }

        $produto = $this->produtoGuard($idProduto);
        $model = new ProdutosModel();

        try {
            if ($model->delete($produto['id'])) {
                return $this->response->setJSON([
                    'status'   => 'sucesso',
                    'mensagem' => 'Produto excluído com sucesso.'
                ]);
            } else {
                return $this->response->setJSON([
                    'status'   => 'error',
                    'mensagem' => 'Não foi possível excluir o produto no banco de dados.'
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