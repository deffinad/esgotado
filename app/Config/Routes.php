<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth Routes
$routes->get('/signin', 'Auth::index');
$routes->post('/signin/process', 'Auth::signinProcess');
$routes->get('/signup', 'Auth::signupView');
$routes->post('/signup/process', 'Auth::signupProcess');
$routes->get('/signout', 'Auth::logout');

// $routes->get('/', 'Home::index', ['filter' => 'authGuard']);
$routes->get('/', 'Home::index', ['filter' => 'authGuard']);
$routes->get('/dashboard/detail/(:any)', 'Home::detailDashboardView/$1', ['filter' => 'authGuard']);
$routes->get('/production/inbound', 'Production::inboundView', ['filter' => 'authGuard']);
$routes->get('/production/inbound/add', 'Production::addInboundView', ['filter' => 'authGuard']);
$routes->post('/production/inbound/add/process', 'Production::addInboundProcess', ['filter' => 'authGuard']);
$routes->get('/production/inbound/edit/(:any)', 'Production::editInboundView/$1', ['filter' => 'authGuard']);
$routes->add('/production/inbound/edit/process/(:any)', 'Production::editInboundProcess/$1', ['filter' => 'authGuard']);
$routes->add('/production/inbound/delete/(:any)', 'Production::deleteInboundProcess/$1', ['filter' => 'authGuard']);

$routes->get('/production/outbound', 'Production::outboundView', ['filter' => 'authGuard']);
$routes->get('/production/outbound/add', 'Production::addOutboundView', ['filter' => 'authGuard']);
$routes->post('/production/outbound/add/process', 'Production::addOutboundProcess', ['filter' => 'authGuard']);
$routes->get('/production/outbound/edit/(:any)', 'Production::editOutboundView/$1', ['filter' => 'authGuard']);
$routes->add('/production/outbound/edit/process/(:any)', 'Production::editOutboundProcess/$1', ['filter' => 'authGuard']);
$routes->add('/production/outbound/delete/(:any)', 'Production::deleteOutboundProcess/$1', ['filter' => 'authGuard']);

$routes->get('/production/inventory', 'Production::inventoryView', ['filter' => 'authGuard']);
$routes->get('/production/inventory/add', 'Production::addInventoryView', ['filter' => 'authGuard']);
$routes->post('/production/inventory/add/process', 'Production::addInventoryProcess', ['filter' => 'authGuard']);
$routes->get('/production/inventory/edit/(:any)', 'Production::editInventoryView/$1', ['filter' => 'authGuard']);
$routes->add('/production/inventory/edit/process/(:any)', 'Production::editInventoryProcess/$1', ['filter' => 'authGuard']);
$routes->add('/production/inventory/delete/(:any)', 'Production::deleteInventoryProcess/$1', ['filter' => 'authGuard']);

$routes->get('/production/history', 'Production::historyView', ['filter' => 'authGuard']);

$routes->get('/log-activity', 'Production::logActivityView', ['filter' => 'authGuard']);
