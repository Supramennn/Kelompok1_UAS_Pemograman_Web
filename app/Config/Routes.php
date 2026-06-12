<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::login');

$routes->get('/login', 'Auth::login');
$routes->post('/login/process', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/barang', 'Barang::index');
$routes->get('/barang/create', 'Barang::create');
$routes->post('/barang/store', 'Barang::store');
$routes->get('/barang/edit/(:num)', 'Barang::edit/$1');
$routes->post('/barang/update/(:num)', 'Barang::update/$1');
$routes->get('/barang/delete/(:num)', 'Barang::delete/$1');

$routes->get('/transaksi', 'Transaksi::index');
$routes->post('/transaksi/store', 'Transaksi::store');
$routes->get('/transaksi/nota/(:num)', 'Transaksi::cetakNota/$1');

$routes->get('/laporan', 'Laporan::index');
$routes->get('/laporan/pdf', 'Laporan::cetakPdf');