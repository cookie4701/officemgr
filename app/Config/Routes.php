<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('', [ 'filter' => 'authcheck'], function($routes) {
  // add all routes that need to be protected here
  $routes->get('/dashboard', 'Dashboard::index');
} );

$routes->group('', [ 'filter' => ['moduleaccess', 'authcheck'] ], function($routes) {

  $routes->get('/masterdata', 'Masterdata::index');
  $routes->post('/masterdata/store', 'Masterdata::store');
  $routes->get('/masterdata/(:num)', 'Masterdata::edit/$1');
  $routes->post('/masterdata/(:num)', 'Masterdata::update/$1');
  $routes->get('/masterdata/ajax/(:num)', 'Masterdata::ajax_ent_data/$1');

  $routes->get('/invoice/pdf/(:num)', 'InvoiceController::pdf/$1');
  $routes->get('/invoice/create', 'InvoiceController::create');
  $routes->post('/invoice/store', 'InvoiceController::store');
  $routes->get('/invoice/(:num)', 'InvoiceController::edit/$1');
  $routes->post('/invoice/(:num)', 'InvoiceController::update/$1');
  $routes->get('/invoice',        'InvoiceController::index');

  $routes->get('/postregister', 'DocumentRegistryController::index');
  $routes->get('/postregister/docs', 'DocumentRegistryController::rows');
  $routes->get('/postregister/doctypes', 'DocumentRegistryController::doctypes');
  $routes->get('/postregister/responsibles', 'DocumentRegistryController::responsibles');
  $routes->get('/postregister/create', 'DocumentRegistryController::create');
  $routes->post('/postregister', 'DocumentRegistryController::store');
  $routes->post('/postregister/(:num)', 'DocumentRegistryController::update/$1');
  $routes->get('/postregister/(:num)', 'DocumentRegistryController::edit/$1');
  $routes->get('/postregister/download_pdf/(:num)', 'DocumentRegistryController::get_file/$1');
  $routes->get('/postregister/workarea', 'DocumentRegistryController::get_workareas');
  $routes->post('/postregister/workarea', 'DocumentRegistryController::store_workarea');

  $routes->get('/requests', 'RequestsController::index');
  $routes->get('/requests/create', 'RequestsController::create');
  $routes->get('/requests/(:num)', 'RequestsController::edit/$1');
  $routes->post('/requests/(:num)', 'RequestsController::update/$1');
  $routes->post('/requests', 'RequestsController::store');
  $routes->get('requests/process', 'RequestsController::process_requests_index');
  $routes->post('requests/process', 'RequestsController::process_requests_update/');

  $routes->get('/admin', 'AdminController::index');
  $routes->post('/admin/modules', 'AdminController::modules');

  $routes->get('/requestsconfig', 'RequestsConfigController::index');
  $routes->post('/requestsconfig', 'RequestsConfigController::responsibilities');

});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
