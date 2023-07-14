<?php

use Config\Services;

$routes = Services::routes();
$routes->group('pembatalan', ['filter' => 'auth'], static function ($routes) {
    $routes->group('penjualan', ['namespace' => 'Panel\Pembatalan\Controllers'], static function ($routes) {
        $routes->get('/', 'PenjualanController::index');
        $routes->post('cancel', 'PenjualanController::cancel');
    });
});