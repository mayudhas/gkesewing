<?php

use Config\Services;

$routes = Services::routes();
$routes->group('produk', ['namespace' => 'Panel\Produk\Controllers', 'filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'ProdukController::index');
    $routes->post('/', 'ProdukController::store');
    $routes->delete('(:num)', 'ProdukController::delete/$1');
    $routes->put('(:num)', 'ProdukController::update/$1');
});