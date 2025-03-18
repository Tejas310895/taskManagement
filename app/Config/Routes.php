<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->resource('TaskController');

$routes->get('tasks','TaskController::index',['filter' => 'jwt']);
$routes->get('tasks/(:num)','TaskController::index/$id');
$routes->post('tasks','TaskController::create');
$routes->put('tasks/(:num)','TaskController::update/$1');
$routes->delete('tasks/(:num)','TaskController::delete/$1');

// app/Config/Routes.php
$routes->post('auth/jwt', '\App\Controllers\Auth\LoginController::jwtLogin');

service('auth')->routes($routes);
