<?php

use Config\Services;

$routes = Services::routes();
$routes->group('authentication', ['namespace' => 'Panel\Authentication\Controllers'], static function ($routes) {
    $routes->get('/', 'AuthController::index');
    $routes->post('/', 'AuthController::validation');
    $routes->get('/logout', 'AuthController::logout');
});

