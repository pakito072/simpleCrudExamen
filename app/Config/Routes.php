<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('home/create', 'Home::create');
$routes->post('home/update/(:num)', 'Home::update/$1');
$routes->post('home/disable/(:num)', 'Home::disable/$1');
$routes->post('home/restore/(:num)', 'Home::restore/$1');
$routes->get('home/edit/(:num)', 'Home::edit/$1');
$routes->get('home/export', 'Home::export');
