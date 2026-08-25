<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */ 

// 1. Rota Raiz (/) - Redireciona dependendo se está logado ou não
$routes->get('/', function() {
    if (session()->get('user_token')) {
        return redirect()->to(base_url('dash'));
    }
    return redirect()->to(base_url('auth/login'));
});

// 2. Rotas de Autenticação (Públicas - bloqueadas se já estiver logado via 'auth:guest')
$routes->get('auth/login', 'Auth::login', ['filter' => 'auth:guest']);
$routes->get('auth/cadastro', 'Auth::cadastro', ['filter' => 'auth:guest']);
$routes->post('auth/registrar', 'Auth::registrar', ['filter' => 'auth:guest']);
$routes->post('auth/autenticar', 'Auth::autenticar', ['filter' => 'auth:guest']);

// 3. Logout
$routes->get('auth/logout', 'Auth::logout');

// 4. Rotas Protegidas (Exigem login via 'auth:auth')
$routes->get('dash', 'Dash::index', ['filter' => 'auth:auth']); 


// 5. Rotas de Push (Mantenha conforme a sua lógica de segurança atual)
$routes->post('push/salvar-inscricao', 'Push::salvarInscricao');
$routes->post('push/enviar', 'Api\PushApi::enviar');