<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */ 

$routes->post('push/salvar-inscricao', 'Push::salvarInscricao');
$routes->post('push/enviar', 'Api\PushApi::enviar');