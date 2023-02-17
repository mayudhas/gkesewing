<?php

use Config\Services;

$routes = Services::routes();
$routes->group('karyawan', ['namespace' => 'Panel\Karyawan\Controllers', 'filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'KaryawanController::index');
    $routes->post('/', 'KaryawanController::store');
    $routes->delete('(:num)', 'KaryawanController::delete/$1');
    $routes->put('(:num)', 'KaryawanController::update/$1');
});