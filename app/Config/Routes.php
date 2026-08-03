<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */ 

// --- Rota de Notificações Push ---
$routes->post('push/salvar-inscricao', 'Push::salvarInscricao');

// (Aqui continuam as suas outras rotas existentes, como login, dash, etc.)