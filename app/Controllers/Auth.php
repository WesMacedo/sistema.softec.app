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

    public function redefinir()
    {
        // Se o usuário já estiver logado, redireciona direto para o painel
        if (session()->get('user_token')) {
            return redirect()->to(base_url('dash'));
        }

        return view('auth/redefinir');
    }

    public function enviarOtp()
    {
        $model = new UsuariosModel();
        $email = trim($this->request->getPost('email'));

        $usuario = $model->where('email', $email)->first();

        if (!$usuario) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Este e-mail não está cadastrado no sistema.'
            ]);
        }

        // Gera um código OTP de 6 dígitos numéricos
        $otp = rand(100000, 999999);
        // Define a validade para daqui a 15 minutos
        $otpValidade = date('Y-m-d H:i:s', time() + (15 * 60));

        // Salva no banco
        $model->update($usuario['id'], [
            'otp'          => $otp,
            'otp_validade' => $otpValidade
        ]);

        // TODO: Aqui você integraria o envio real do e-mail (ex: CodeIgniter Email)
        // Para testes, você pode retornar o $otp no JSON se quiser visualizar na tela.

        return $this->response->setJSON([
            'success' => true,
            'email'   => $email,
            'message' => 'Código de verificação enviado com sucesso!'
        ]);
    }

    public function validarOtp()
    {
        $model = new UsuariosModel();
        $email = trim($this->request->getPost('email'));
        $otp   = trim($this->request->getPost('otp'));

        $usuario = $model->where('email', $email)->first();

        if (!$usuario) {
            return $this->response->setJSON(['success' => false, 'message' => 'Usuário não encontrado.']);
        }

        // Verifica se o OTP bate e se não expirou
        if ($usuario['otp'] !== $otp) {
            return $this->response->setJSON(['success' => false, 'message' => 'Código OTP incorreto.']);
        }

        if (strtotime($usuario['otp_validade']) < time()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Este código expirou. Solicite um novo.']);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Código validado com sucesso!'
        ]);
    }

    public function atualizarSenha()
    {
        $model         = new UsuariosModel();
        $email         = trim($this->request->getPost('email'));
        $otp           = trim($this->request->getPost('otp'));
        $senha         = $this->request->getPost('senha');
        $confirmaSenha = $this->request->getPost('confirma_senha');

        if (empty($senha) || $senha !== $confirmaSenha) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'As senhas informadas não coincidem ou estão vazias.'
            ]);
        }

        $usuario = $model->where('email', $email)->where('otp', $otp)->first();

        if (!$usuario) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Requisição inválida.'
            ]);
        }

        // Atualiza a senha, limpa o OTP para não ser reutilizado e salva
        $model->update($usuario['id'], [
            'senha'        => password_hash($senha, PASSWORD_DEFAULT),
            'otp'          => null,
            'otp_validade' => null
        ]);

        session()->setFlashdata('msg', 'Senha redefinida com sucesso! Faça login com sua nova senha.');

        return $this->response->setJSON([
            'success'  => true,
            'redirect' => base_url('auth/login')
        ]);
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
            session()->setFlashdata('msg', 'Cadastro realizado com sucesso! Faça login para continuar.');

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
        $salvarConta = $this->request->getPost('salvar_conta'); // Verifica se marcou o checkbox

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
            $token = $model->gerarToken();
            $rememberToken = null;

            // Se marcou "Salvar conta", gera um token persistente seguro
            if ($salvarConta) {
                $rememberToken = bin2hex(random_bytes(32));
            }

            // Login OK — zera tentativas, bloqueio, salva o token de sessão e o remember_token se aplicável
            $model->update($usuario['id'], [
                'tentativas_login' => 0,
                'bloqueado_ate'    => null,
                'token'            => $token,
                'remember_token'   => $rememberToken
            ]);

            session()->set([
                'user_token' => $token,
            ]);
            session()->regenerate();

            return $this->response->setJSON([
                'success'      => true,
                'redirect'     => base_url('dash'),
                'usuario_info' => [
                    'id'             => $usuario['id'],
                    'nome'           => $usuario['nome'],
                    'email'          => $usuario['email'],
                    'remember_token' => $rememberToken
                ]
            ]);
        }

        // Falha no login — incrementa tentativa
        $tentativas++;
        $bloqueado_ate = null;

        if ($tentativas >= 5) {
            $bloqueado_ate = date('Y-m-d H:i:s', time() + (5 * 60)); // 5 minutos
        }

        $result = $model->atualizarTentativas($usuario['id'], $tentativas, $bloqueado_ate);

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

    public function loginRapido()
    {
        $json = $this->request->getJSON(true);
        $email = $json['email'] ?? null;
        $rememberToken = $json['remember_token'] ?? null;

        if (empty($email) || empty($rememberToken)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Dados de autenticação rápida inválidos.']);
        }

        $model = new UsuariosModel();
        $usuario = $model->where('email', $email)->where('remember_token', $rememberToken)->first();

        if (!$usuario) {
            return $this->response->setJSON(['success' => false, 'message' => 'Sessão salva expirada ou inválida. Faça login com a senha.']);
        }

        // Gera novo token de sessão e atualiza no banco
        $token = $model->gerarToken();
        $model->update($usuario['id'], ['token' => $token]);

        session()->set([
            'user_token' => $token,
        ]);
        session()->regenerate();

        return $this->response->setJSON([
            'success'  => true,
            'redirect' => base_url('dash')
        ]);
    }

    public function logout()
    {
        session()->remove('user_token');
        session()->destroy();
        return redirect()->to(base_url('auth/login'))->with('msg', 'Você saiu da conta.');
    }
}