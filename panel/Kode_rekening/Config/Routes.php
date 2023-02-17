<?php

use Config\Services;

$routes = Services::routes();
$routes->group('kode-rekening', ['namespace' => 'Panel\Kode_rekening\Controllers', 'filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'KodeRekeningController::index');
    $routes->post('/', 'KodeRekeningController::store');
    $routes->delete('(:num)', 'KodeRekeningController::delete/$1');
    $routes->put('(:num)', 'KodeRekeningController::update/$1');
});