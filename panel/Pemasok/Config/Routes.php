<?php

use Config\Services;

$routes = Services::routes();
$routes->group('pemasok', ['namespace' => 'Panel\Pemasok\Controllers', 'filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'PemasokController::index');
    $routes->post('/', 'PemasokController::store');
    $routes->delete('(:num)', 'PemasokController::delete/$1');
    $routes->put('(:num)', 'PemasokController::update/$1');
});