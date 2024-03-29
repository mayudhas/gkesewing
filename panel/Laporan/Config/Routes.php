<?php

use Config\Services;

$routes = Services::routes();
$routes->group('laporan', ['namespace' => 'Panel\Laporan\Controllers', 'filter' => 'auth'], static function ($routes) {
    $routes->group('buku-besar', static function ($routes) {
        $routes->get('/', 'BukuBesarController::index');
    });
    $routes->group('jurnal', static function ($routes) {
        $routes->get('/', 'JurnalController::index');
    });
    $routes->group('laba-rugi', static function ($routes) {
        $routes->get('/', 'LabaRugiController::index');
    });
});