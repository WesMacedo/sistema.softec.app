<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */ 

// 1. Rota raiz direciona para o login do Auth (que já valida se está logado e manda pra dash)
$routes->get('/', 'Auth::login');

// 2. Rotas de Autenticação
$routes->get('auth/login', 'Auth::login');
$routes->get('auth/cadastro', 'Auth::cadastro');
$routes->post('auth/autenticar', 'Auth::autenticar');
$routes->post('auth/registrar', 'Auth::registrar');
$routes->get('auth/logout', 'Auth::logout');

// 3. Suas rotas de Push existentes
$routes->post('push/salvar-inscricao', 'Push::salvarInscricao');
$routes->post('push/enviar', 'Api\PushApi::enviar');