<?php

use Config\Services;

$routes = Services::routes();
$routes->group('dashboard', ['namespace' => 'Panel\Dashboard\Controllers', 'filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->get('get-income-outcome', 'DashboardController::getIncomeOutcome');
});