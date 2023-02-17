<?php

use Config\Services;

$routes = Services::routes();
$routes->group('pengguna', ['namespace' => 'Panel\User\Controllers', 'filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->post('/', 'UserController::store');
    $routes->delete('(:num)', 'UserController::delete/$1');
    $routes->put('(:num)', 'UserController::update/$1');
});