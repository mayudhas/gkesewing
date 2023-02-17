<?php

use Config\Services;

$routes = Services::routes();
$routes->group('pelanggan', ['namespace' => 'Panel\Pelanggan\Controllers', 'filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'PelangganController::index');
    $routes->get('load-pelanggan', 'PelangganController::loadPelanggan');
    $routes->post('/', 'PelangganController::store');
    $routes->delete('(:num)', 'PelangganController::delete/$1');
    $routes->put('(:num)', 'PelangganController::update/$1');
});