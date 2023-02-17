<?php

use Config\Services;

$routes = Services::routes();
$routes->group('rekening', ['namespace' => 'Panel\Rekening\Controllers', 'filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'RekeningController::index');
    $routes->get('load-rekening-pos', 'RekeningController::loadAccountPost');
});