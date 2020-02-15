<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

// Halaman User
Route::get('/home', 'UserController@index')->name('home');
Route::get('/', 'UserController@index');
Route::get('/k/{kategori}', 'UserController@view_kategori');
Route::get('/{page}', 'UserController@diskon');
Route::get('/u/blog', 'UserController@blog');
Route::get('/u/blog/{id}', 'UserController@read_blog');
Route::get('/cart/{id}', 'UserController@list_cart');
Route::get('/cart/riwayat/{id}', 'KeranjangController@list_cart_riwayat');
Route::get('/u/profile', 'UserController@profile');
Route::get('/{id}/detail', 'UserController@detail_barang');
Route::get('/get/notifikasi_user', 'UserController@notifikasi_user');
Route::post('/notifikasi/baca', 'UserController@baca')->name('notifikasi.baca');
Route::post('/notifikasi/hapus', 'UserController@hapus_notif')->name('notifikasi.hapus');

// Halaman Admin
Route::get('/toko_onlen/adm/admin/', 'AdminController@halut');
Route::get('/toko_onlen/adm/admin/data/user', 'AdminController@data_user');
Route::get('/toko_onlen/adm/admin/data/barang', 'AdminController@data_barang');
Route::get('/toko_onlen/adm/admin/data/pesanan', 'AdminController@data_pesanan');
Route::get('/toko_onlen/adm/admin/data/feedback', 'AdminController@data_feedback');
Route::get('/toko_onlen/adm/admin/blog', 'AdminController@data_blog');
Route::get('/get/metode_pembayaran', 'AdminController@metode_pembayaran');
Route::get('/get/kategori', 'AdminController@kategori');
Route::get('/get/notifikasi_admin', 'AdminController@notifikasi_admin');
Route::get('/toko_onlen/adm/admin/metode_pembayaran', 'AdminController@data_metode_pembayaran');
Route::get('/toko_onlen/adm/admin/kategori', 'AdminController@data_kategori');

// Fungsi
Route::post('/keranjang', 'UserController@store')->name('keranjang.add_cart');
Route::post('/keranjang/edit', 'UserController@edit_keranjang')->name('keranjang.edit_cart');
Route::post('/keranjang/hapus', 'UserController@hapus_keranjang')->name('keranjang.hapus_cart');
Route::post('/keranjang/hapus_all', 'UserController@hapus_all_keranjang')->name('keranjang.hapus_all_cart');
Route::post('/keranjang/hapus_all_riwayat', 'KeranjangController@hapus_all_riwayat')->name('keranjang.hapus_all_riwayat');

Route::post('/checkout', 'UserController@checkout_all')->name('checkout.all');
Route::post('/checkout/single', 'KeranjangController@checkout_single')->name('checkout.single');
Route::post('/batal', 'KeranjangController@batal_pesan')->name('pesan.batal');
Route::post('/user/edit_profile', 'UserController@edit_profile')->name('edit.profile');
Route::post('/krisar', 'UserController@krisar')->name('kritik.saran');

Route::post('/tambah', 'AdminController@tambah_barang')->name('tambah.barang');
Route::post('/edit_barang', 'AdminController@edit_barang')->name('edit.barang');
Route::post('/hapus_barang', 'AdminController@hapus_barang')->name('hapus.barang');

Route::post('/tambah/blog', 'AdminController@tambah_blog')->name('tambah.blog');
Route::post('/hapus_blog/{id}', 'AdminController@hapus_blog')->name('hapus_blog.id');
Route::post('/edit/blog', 'AdminController@edit_blog')->name('edit.blog');

Route::post('/status_pembelian/{status}', 'AdminController@status_pembelian')->name('status_pembelian.status');
Route::post('/status_all/{status}', 'AdminController@status_all')->name('status_all.status');

Route::post('/metode_pembayaran/nonaktifkan', 'AdminController@nonaktifkan')->name('metode_pembayaran.nonaktifkan');
Route::post('/metode_pembayaran/aktifkan', 'AdminController@aktifkan')->name('metode_pembayaran.aktifkan');

Route::post('/kategori/nonaktifkan', 'AdminController@nonaktifkan_kategori')->name('kategori.nonaktifkan');
Route::post('/kategori/aktifkan', 'AdminController@aktifkan_kategori')->name('kategori.aktifkan');
Route::post('/kategori/tambah', 'AdminController@tambah_kategori')->name('kategori.tambah');
Route::post('/kategori/hapus', 'AdminController@hapus_kategori')->name('kategori.hapus');