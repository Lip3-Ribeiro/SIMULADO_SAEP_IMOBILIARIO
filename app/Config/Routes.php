<?php
//Rotas Públicas
// Rotas Login
$routes->get('/', 'LoginController::index');
$routes->get('login', 'LoginController::index');
$routes->post('login/autenticar', 'LoginController::autenticar');
$routes->get('logout', 'LoginController::logout');

//Rotas Protegidas
$routes->group('', ['filter' => 'auth'], function($routes){
    // Rota Inicio
    $routes->get('inicio', 'InicioController::index');

    // Rotas PROPRIETARIO
    $routes->match(['get', 'post'], 'PROPRIETARIO',  'ProprietarioController::index');
    $routes->get('PROPRIETARIO/novo',                'ProprietarioController::novo');
    $routes->post('PROPRIETARIO/inserir',            'ProprietarioController::inserir');
    $routes->get('PROPRIETARIO/editar/(:num)',       'ProprietarioController::editar/$1');
    $routes->post('PROPRIETARIO/atualizar/(:num)',   'ProprietarioController::atualizar/$1');
    $routes->get('PROPRIETARIO/excluir/(:num)',      'ProprietarioController::excluir/$1');

    // Rotas IMOVEL
    $routes->match(['get', 'post'], 'IMOVEL',  'ImovelController::index');
    $routes->get('IMOVEL/novo',                'ImovelController::novo');
    $routes->post('IMOVEL/inserir',            'ImovelController::inserir');
    $routes->get('IMOVEL/editar/(:num)',       'ImovelController::editar/$1');
    $routes->post('IMOVEL/atualizar/(:num)',   'ImovelController::atualizar/$1');
    $routes->get('IMOVEL/excluir/(:num)',      'ImovelController::excluir/$1');

    // Rotas Agendamento
    $routes->match(['get', 'post'], 'agendamento',     'AgendamentoController::index');
    $routes->get('agendamento/novo',                   'AgendamentoController::novo');
    $routes->post('agendamento/inserir',               'AgendamentoController::inserir');
    $routes->get('agendamento/editar/(:num)',          'AgendamentoController::editar/$1');
    $routes->post('agendamento/atualizar/(:num)',      'AgendamentoController::atualizar/$1');
    $routes->get('agendamento/excluir/(:num)',         'AgendamentoController::excluir/$1');
});