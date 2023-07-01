<?php

use Config\Services;

$routes = Services::routes();
$routes->group('laporan', ['namespace' => 'Panel\Laporan\Controllers', 'filter' => 'auth'], static function ($routes) {
    $routes->group('buku-besar', static function ($routes) {
        $routes->get('/', 'BukuBesarController::index');
    });
});