<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Auth extends BaseController
{
    public function login()
    {
        // Se o usuário já estiver logado, redireciona direto para o painel
        if (session()->get('user_token')) {
            return redirect()->to(base_url('dash'));
        }

        return view('auth/login');
    }

    public function cadastro()
    {
        // Se o usuário já estiver logado, redireciona direto para o painel
        if (session()->get('user_token')) {
            return redirect()->to(base_url('dash'));
        }

        return view('auth/cadastro');
    }

   public function registrar()
    {
        $model = new UsuariosModel();

        $email = trim($this->request->getPost('email'));
        $senha = $this->request->getPost('senha');
        $confirmaSenha = $this->request->getPost('confirma_senha');

        // 1. Validação de senha no backend
        if (empty($senha) || $senha !== $confirmaSenha) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'As senhas informadas não coincidem.'
            ]);
        }

        // 2. Verificação se o e-mail já existe no banco de dados
        $usuarioExistente = $model->where('email', $email)->first();
        if ($usuarioExistente) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Este e-mail já está cadastrado no sistema.'
            ]);
        }

        // 3. Montagem dos dados
        $data = [
            'nome_empresa'     => $this->request->getPost('nome_empresa'),
            'nome'             => $this->request->getPost('nome'),
            'email'            => $email,
            'whatsapp'         => $this->request->getPost('whatsapp'),
            'senha'            => password_hash($senha, PASSWORD_DEFAULT),
            'tentativas_login' => 0,
            'bloqueado_ate'    => null,
            'token'            => null
        ];

        // 4. Inserção
        if ($model->insert($data)) {
            // Cria a mensagem flash para a página de login
            session()->setFlashdata('msg', 'Cadastro realizado com sucesso! Faça login para continuar.');

            // Retorna JSON indicando sucesso e a URL para onde o JS deve ir
            return $this->response->setJSON([
                'success'  => true,
                'redirect' => base_url('auth/login')
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erro ao salvar o cadastro no banco de dados.'
        ]);
    }

    public function autenticar()
    {
        $model = new UsuariosModel();

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        // Consulta o usuário
        $usuario = $model->where('email', $email)->first();

        if (!$usuario) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'O email informado não está cadastrado no sistema.'
            ]);
        }

        // Verifica tentativas anteriores
        $tentativas = (int) $usuario['tentativas_login'];
        $bloqueado_ate = strtotime($usuario['bloqueado_ate']);

        // Se bloqueado, verifica se o tempo já passou
        if ($bloqueado_ate && time() < $bloqueado_ate) {
            $restante = $bloqueado_ate - time();
            $minutos = floor($restante / 60);
            $segundos = $restante % 60;

            if ($minutos < 1) {
                $segundoTexto = ($segundos == 1) ? 'segundo' : 'segundos';
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Muitas tentativas falhas. Tente novamente em ' . $segundos . ' ' . $segundoTexto . '.'
                ]);
            } else {
                $minutoTexto = ($minutos == 1) ? 'minuto' : 'minutos';
                $segundoTexto = ($segundos == 1) ? 'segundo' : 'segundos';
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Muitas tentativas falhas. Tente novamente em ' . $minutos . ' ' . $minutoTexto . ' e ' . $segundos . ' ' . $segundoTexto . '.'
                ]);
            }
        }

        // Se o usuário e senha são válidos
        if (password_verify($senha, $usuario['senha'])) {
            // Gera um token único
            $token = $model->gerarToken();

            // Login OK — zera tentativas, bloqueio e salva o token
            $model->atualizarTentativas($usuario['id'], 0, null, $token);

            // Regenera a sessão com o token
            session()->set([
                'user_token' => $token,  // Usamos o token no lugar do ID ou e-mail
            ]);
            session()->regenerate();

            return $this->response->setJSON([
                'success' => true,
                'redirect' => base_url('dash')  // ajuste conforme sua rota de sucesso
            ]);
        }

        // Falha no login — incrementa tentativa
        $tentativas++;
        $bloqueado_ate = null;

        // Se chegou a 5 tentativas, bloqueia por 5 minutos
        if ($tentativas >= 5) {
            $bloqueado_ate = date('Y-m-d H:i:s', time() + (5 * 60)); // 5 minutos
        }

        // Atualiza o banco com as novas tentativas e bloqueio (usando ID do usuário)
        $result = $model->atualizarTentativas($usuario['id'], $tentativas, $bloqueado_ate);

        // Verificar se a atualização foi bem-sucedida
        if (!$result) { 
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Erro ao processar sua solicitação. Tente novamente mais tarde.'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Senha incorreta. Tentativa ' . $tentativas . ' de 5.'
        ]);
    }

    public function logout()
    {
        // Remove o token da sessão e destrói
        session()->remove('user_token');
        session()->destroy();
        return redirect()->to(base_url('auth/login'))->with('msg', 'Você saiu da conta.');
    }
}