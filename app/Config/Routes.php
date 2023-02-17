<?php

namespace Config;

$routes = Services::routes();

if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
//$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('HomeController');
//$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->addRedirect('/', '/authentication');

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
if (file_exists(ROOTPATH . 'panel')) {
    $modulesPath = ROOTPATH . 'panel/';
    $modules = scandir($modulesPath);
    foreach ($modules as $module) {
        if ($module === '.' || $module === '..')
            continue;
        if (is_dir($modulesPath) . '/' . $module) {
            $routesPath = $modulesPath . $module . '/Config/Routes.php';
            if (file_exists($routesPath)) {
                require($routesPath);
            } else {
                continue;
            }
        }
    }
}