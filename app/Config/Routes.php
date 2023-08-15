<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Home');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
// $routes->get('/', 'Dashboard::index');

$routes->get('/', 'Auth::index');

// $routes->get('/dashboard/(:any)', 'Dashboard::$1');
// $routes->post('/dashboard/(:any)', 'Dashboard::$1');

$routes->get('/auth/(:any)', 'Auth::$1');
$routes->post('/auth/(:any)', 'Auth::$1');

// $routes->get('/kategori/(:any)', 'Kategori::$1');
// $routes->post('/kategori/(:any)', 'Kategori::$1');

// $routes->get('/supplier/(:any)', 'Supplier::$1');
// $routes->post('/supplier/(:any)', 'Supplier::$1');

// $routes->get('/spareparts/(:any)', 'SpareParts::$1');
// $routes->post('/spareparts/(:any)', 'SpareParts::$1');

// $routes->get('/users/(:any)', 'Users::$1');
// $routes->post('/users/(:any)', 'Users::$1');

// $routes->get('/stok/(:any)', 'Stok::$1');
// $routes->post('/stok/(:any)', 'Stok::$1');

// $routes->get('/penjualan/(:any)', 'Penjualan::$1');
// $routes->post('/penjualan/(:any)', 'Penjualan::$1');

// $routes->get('/transaksi/(:any)', 'Transaksi::$1');
// $routes->post('/transaksi/(:any)', 'Transaksi::$1');

// $routes->get('/pembayaran/(:any)', 'Pembayaran::$1');
// $routes->post('/pembayaran/(:any)', 'Pembayaran::$1');

// Contohnya salah satu penggunaan route http://localhost:8081/dashboard/index
$routes->group('dashboard', ['filter' => 'role:1,2,3'], function ($routes) {
    $routes->get('index', 'Dashboard::index');
});

$routes->group('supplier', ['filter' => 'role:1,2'], function ($routes) {
    $routes->get('index', 'Supplier::index');
    $routes->get('createSupplier', 'Supplier::createSupplier'); 
    $routes->get('editSupplier/(:num)', 'Supplier::editSupplier/$1'); // Contoh untuk rute dengan parameter
    $routes->get('view_detailSupplier/(:num)', 'Supplier::view_detailSupplier/$1');
    $routes->get('deleteSupplier/(:num)', 'Supplier::deleteSupplier/$1');
    $routes->post('saveSupplier', 'Supplier::saveSupplier');
    $routes->post('saveEditSupplier', 'Supplier::saveEditSupplier');
});

$routes->group('kategori', ['filter' => 'role:1,2'], function ($routes) {
    $routes->get('index', 'Kategori::index');
    $routes->get('createKategori', 'Kategori::createKategori'); 
    $routes->get('editKategori/(:num)', 'Kategori::editKategori/$1'); 
    $routes->get('view_detailKategori/(:num)', 'Kategori::view_detailKategori/$1');
    $routes->get('deleteKategori/(:num)', 'Kategori::deleteKategori/$1'); 
    $routes->post('saveKategori', 'Kategori::saveKategori');
});

$routes->group('spareparts', ['filter' => 'role:1,2'], function ($routes) {
    $routes->get('index', 'SpareParts::index');
    $routes->get('createSpareParts', 'SpareParts::createSpareParts'); 
    $routes->get('editSpareParts/(:num)', 'SpareParts::editSpareParts/$1'); 
    $routes->get('view_detailSpareParts/(:num)', 'SpareParts::view_detailSpareParts/$1'); 
    $routes->get('deleteSpareParts/(:num)', 'SpareParts::deleteSpareParts/$1');
    $routes->get('download', 'SpareParts::download');
    $routes->post('saveSpareParts', 'SpareParts::saveSpareParts');
});

$routes->group('pembayaran', ['filter' => 'role:1,2,3'], function ($routes) {
    $routes->get('index', 'Pembayaran::index');
    $routes->get('daftar_invoice', 'Pembayaran::invoice'); 
    $routes->get('cetak/(:num)', 'Pembayaran::cetak/$1'); 
    $routes->get('transaction_view/(:num)', 'Pembayaran::transaction_view/$1'); 
    $routes->get('transaction_delete/(:num)', 'Pembayaran::transaction_delete/$1');
    $routes->get('download', 'Pembayaran::download');
    $routes->post('save_transaction', 'Pembayaran::save_transaction');
});

$routes->group('stok', ['filter' => 'role:1,2'], function ($routes) {
    $routes->get('index', 'stok::index');
    $routes->get('indexStokKeluar', 'stok::indexStokKeluar');
    $routes->get('createStokMasuk', 'stok::createStokMasuk'); 
    $routes->get('createStokKeluar', 'stok::createStokKeluar');
    $routes->get('view_detailStokMasuk/(:num)', 'stok::view_detailStokMasuk/$1'); 
    $routes->get('view_detailStokKeluar/(:num)', 'stok::view_detailStokKeluar/$1'); 
    $routes->get('deleteStokMasuk/(:num)', 'stok::deleteStokMasuk/$1');
    $routes->get('deleteStokKeluar/(:num)', 'stok::deleteStokKeluar/$1');
    $routes->post('saveStokMasuk', 'stok::saveStokMasuk');
    $routes->post('saveStokKeluar', 'stok::saveStokKeluar');
});

$routes->group('profile', ['filter' => 'role:1,2,3'], function ($routes) {
    $routes->get('index', 'Users::profile'); // Rute untuk menampilkan halaman
    $routes->post('saveUpdateAccountProfile', 'Users::saveUpdateAccountProfile'); // Rute untuk memproses data POST
});

$routes->group('users', ['filter' => 'role:1'], function ($routes) {
    $routes->get('index', 'Users::index');
    $routes->get('createUsers', 'Users::createUsers');
    $routes->get('editUsers/(:num)', 'Users::editUsers/$1'); // Contoh untuk rute dengan parameter
    $routes->get('view_detailUsers/(:num)', 'Users::view_detailUsers/$1'); // Contoh untuk rute dengan parameter
    $routes->get('deleteUsers/(:num)', 'Users::deleteUsers/$1'); // Contoh untuk rute dengan parameter
    $routes->post('saveAccount', 'Users::saveAccount');
    $routes->post('saveEditAccount', 'Users::saveEditAccount');
});

// API
$routes->resource('api/home', ['controller' => 'Api\Home']);

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
