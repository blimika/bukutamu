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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'BukutamuController@depan')->name('depan');
Route::post('/simpan', 'BukutamuController@simpan')->name('simpan');
Route::get('/edit/{id}', 'BukutamuController@editdata')->name('edit');
Route::get('/cekid/{jenis_identitas}/{nomor_identitas}', 'BukutamuController@cekID')->name('cekid');
Route::get('/getdatakunjungan/{id}', 'BukutamuController@getDataKunjungan')->name('getdatakunjungan');

Route::post('/hapuskunjungan', 'BukutamuController@hapus')->name('hapus.kunjungan');
Route::post('/simpanlama', 'BukutamuController@SimpanLama')->name('simpan.lama');
Route::get('/lama', 'BukutamuController@lama')->name('lama');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');