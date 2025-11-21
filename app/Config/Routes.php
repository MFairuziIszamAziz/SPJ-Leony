<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('user', ['filter' => 'csrf'], static function($routes) {
    $routes->get('/',          'User::index');          // list user
    $routes->get('create',     'User::create');         // form tambah
    $routes->post('store',     'User::store');          // simpan baru
    $routes->get('edit/(:num)','User::edit/$1');        // form edit
    $routes->post('update/(:num)','User::update/$1');   // simpan edit
    $routes->post('delete/(:num)','User::delete/$1');   // hapus
});

// SPJ untuk STAFF
$routes->get('spj/create', 'Spj::create');
$routes->post('spj/store', 'Spj::store');
$routes->get('spj/list', 'Spj::list');

// SPJ untuk ADMIN / VERIFIKATOR
$routes->group('spj-admin', static function ($routes) {
    $routes->get('/', 'SpjAdmin::index');              // list semua SPJ
    $routes->get('edit/(:num)', 'SpjAdmin::edit/$1');  // form verifikasi
    $routes->post('update/(:num)', 'SpjAdmin::update/$1'); // simpan status
});

$routes->get('/pimpinan', 'Pimpinan::index');

$routes->get('/', 'Home::index');
