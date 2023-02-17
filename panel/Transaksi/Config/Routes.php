<?php

use Config\Services;

$routes = Services::routes();
$routes->group('transaksi', ['filter' => 'auth'], static function ($routes) {
    $routes->group('penjualan', ['namespace' => 'Panel\Transaksi\Controllers'], static function ($routes) {
        $routes->get('/', 'PenjualanController::index');
        $routes->post('/', 'PenjualanController::store');
        $routes->get('detail', 'PenjualanController::detail');
        $routes->post('temp', 'PenjualanController::temporaryStore');
        $routes->delete('temp/(:num)', 'PenjualanController::temporaryDelete/$1');
        $routes->get('load-detail-temporary', 'PenjualanController::loadDetailTemporary');
        $routes->get('load-penjualan-no-ledger', 'PenjualanController::loadPenjualanNoLedger');
    });
    $routes->group('pengeluaran', ['namespace' => 'Panel\Transaksi\Controllers'], static function ($routes) {
        $routes->get('/', 'PengeluaranController::index');
        $routes->get('load-pengeluaran-no-ledger', 'PengeluaranController::loadPengeluaranNoLedger');
        $routes->post('/', 'PengeluaranController::store');
        $routes->delete('(:num)', 'PengeluaranController::delete/$1');
    });
});