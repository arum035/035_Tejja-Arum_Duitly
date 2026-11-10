
<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Routes untuk autentikasi
$routes->get('/register', 'Auth::register');
$routes->post('/register/proses', 'Auth::prosesRegister');

$routes->get('/login', 'Auth::login');
$routes->post('/login/proses', 'Auth::prosesLogin');

$routes->post('/logout', 'Auth::logout');


// Routes Duitly yang membutuhkan login
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/profil', 'Profil::index');
    $routes->post('/profil/update', 'Profil::update');
    $routes->post('/profil/password', 'Profil::updatePassword');
    // Routes Pengeluaran
    $routes->get('/pengeluaran', 'Pengeluaran::index');
    $routes->get('/pengeluaran/daftar', 'Pengeluaran::daftar');
    $routes->get('/pengeluaran/create', 'Pengeluaran::create');
    $routes->post('/pengeluaran/store', 'Pengeluaran::store');

    $routes->get('/pengeluaran/edit/(:num)', 'Pengeluaran::edit/$1');
    $routes->post('/pengeluaran/update/(:num)', 'Pengeluaran::update/$1');

   $routes->post('/pengeluaran/delete/(:num)', 'Pengeluaran::delete/$1');

    // Routes Anggaran
    $routes->get('/anggaran', 'Anggaran::index');
    $routes->post('/anggaran/simpan', 'Anggaran::simpan');

});
