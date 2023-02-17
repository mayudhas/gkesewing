<?php

use Config\Services;

$routes = Services::routes();
$routes->group('bku', ['filter' => 'auth'], static function ($routes) {
    $routes->group('buku-jurnal', ['namespace' => 'Panel\Bku\Controllers'], static function ($routes) {
        $routes->get('/', 'BukuJurnalController::index');
        $routes->post('/', 'BukuJurnalController::store');
        $routes->get('detail', 'BukuJurnalController::detail');
        $routes->post('detail', 'BukuJurnalController::storeDetailTemp');
        $routes->delete('(:num)', 'BukuJurnalController::delete/$1');
    });
});