<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */ 

// --- Rota de Notificações Push ---
$routes->post('push/salvar-inscricao', 'Push::salvarInscricao');

// Rota para o disparo externo de push sem login
$routes->post('api/push/enviar', 'Api\PushApi::enviar');