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

/*Route::get('/', function () {
    return view('depan');
});
*/

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::get('/', 'BukutamuController@depan')->name('depan');
Route::post('/simpan', 'BukutamuController@simpan')->name('simpan');
Route::get('/tambahkunjunganbaru', 'BukutamuController@KunjunganBaru')->name('kunjungan.baru');
Route::get('/tambahkunjunganlama', 'BukutamuController@KunjunganLama')->name('kunjungan.lama');
Route::get('/scanqrcode', 'BukutamuController@ScanQrcode')->name('kunjungan.scan');
Route::get('/edit/{id}', 'BukutamuController@editdata')->name('edit');
Route::get('/cekid/{jenis_identitas}/{nomor_identitas}', 'BukutamuController@cekID')->name('cekid');
Route::get('/getdatakunjungan/{id}', 'BukutamuController@getDataKunjungan')->name('getdatakunjungan');


Route::post('/simpanlama', 'BukutamuController@SimpanLama')->name('simpan.lama');
Route::get('/lama', 'BukutamuController@lama')->name('lama');
Route::get('/spi', 'BukutamuController@CLSpi')->name('spi');
Route::get('/skd', 'BukutamuController@ListSkd')->name('skd');
Route::get('/feedback', 'FeedbackController@list')->name('feedback.list');
Route::post('/feedback/simpan', 'FeedbackController@Simpan')->name('feedback.simpan');
Route::group(['middleware' => ['auth']], function () {
    Route::post('/hapuskunjungan', 'BukutamuController@hapus')->name('hapus.kunjungan');
    Route::get('/master/pengunjung', 'MasterController@ListPengunjung')->name('pengunjung.list');
    Route::get('/master/pengunjungsync', 'MasterController@SyncKodePengunjung')->name('pengunjung.kode');
    Route::post('/hapuspengunjung', 'MasterController@HapusPengunjung')->name('pengunjung.hapus');
    Route::get('/laporan/pengunjung', 'LaporanController@list')->name('laporan.pengunjung');
    Route::post('/ubahkunjungan', 'BukutamuController@UbahKunjungan')->name('ubah.kunjungan');
});
Route::get('/master/getdatatamu/{id}', 'MasterController@CariPengunjung')->name('pengunjung.cari');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
