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
Route::get('/tambahkunjungannew', 'BukutamuController@NewKunjungan')->name('kunjungan.new');
Route::get('/tambahkunjunganbaru', 'BukutamuController@NewKunjungan')->name('kunjungan.baru');
Route::get('/tambahkunjunganlama', 'BukutamuController@KunjunganLama')->name('kunjungan.lama');
Route::get('/scanqrcode', 'BukutamuController@ScanQrcode')->name('kunjungan.scan');
Route::get('/detil/pengunjung/{idtamu}', 'BukutamuController@DetilTamu')->name('tamu.detil');
Route::get('/edit/{id}', 'BukutamuController@editdata')->name('edit');
Route::get('/cekid/{jenis_identitas}/{nomor_identitas}', 'BukutamuController@cekID')->name('cekid');
//api getdatakunjungan
Route::get('/getdatakunjungan/{id}', 'BukutamuController@getDataKunjungan')->name('getdatakunjungan');
//api get data tamu
Route::get('/master/getdatatamu/{id}', 'MasterController@CariPengunjung')->name('pengunjung.cari');

Route::post('/simpanlama', 'BukutamuController@SimpanLama')->name('simpan.lama');
Route::get('/lama', 'BukutamuController@lama')->name('lama');
Route::get('/spi', 'BukutamuController@CLSpi')->name('spi');
Route::get('/spi23', 'BukutamuController@CLSpi23')->name('spi23');
Route::get('/skd', 'BukutamuController@ListSkd')->name('skd');
Route::get('/feedback', 'FeedbackController@list')->name('feedback.list');
Route::post('/feedback/simpan', 'FeedbackController@Simpan')->name('feedback.simpan');
Route::get('/laporan/newpengunjung', 'LaporanController@NewLaporan')->name('laporan.newpengunjung');
Route::group(['middleware' => ['auth']], function () {
    Route::post('/hapuskunjungan', 'BukutamuController@hapus')->name('hapus.kunjungan');
    Route::get('/master/pengunjung', 'MasterController@ListPengunjung')->name('pengunjung.list');
    //api list pengunjung per 30 user
    Route::get('/list/pengunjung', 'MasterController@PageListPengujung')->name('pengunjung.page');
    Route::get('/list/pengunjungsync', 'MasterController@PengunjungSync')->name('listpengunjung.sync');
    Route::post('/master/simpan/pengunjung', 'MasterController@SimpanPengunjung')->name('pengunjung.simpan');
    Route::get('/master/synckunjungan', 'MasterController@ListSyncKunjungan')->name('master.synckunjungan');
    Route::get('/master/pengunjungsync', 'MasterController@SyncKodePengunjung')->name('pengunjung.kode');
    Route::post('/hapuspengunjung', 'MasterController@HapusPengunjung')->name('pengunjung.hapus');
    Route::get('/laporan/pengunjung', 'LaporanController@list')->name('laporan.pengunjung');
    Route::post('/ubahkunjungan', 'BukutamuController@UbahKunjungan')->name('ubah.kunjungan');
    Route::post('/lama/updatekunjungan', 'BukutamuController@UpdateKunjungan')->name('update.kunjungan');
    Route::post('/lama/ubahjeniskunjungan', 'BukutamuController@UbahJenisKunjungan')->name('ubah.jeniskunjungan');
    Route::get('/master/photosync', 'MasterController@SyncPhoto')->name('photo.sync');
    Route::get('/master/layanansync/', 'MasterController@SyncLayananManfaat')->name('layanan.sync');
    Route::get('/master/genlayanansync/{tahun}', 'MasterController@GenSyncLayananManfaat')->name('genlayanan.sync');
    //member
    Route::get('/member/list', 'MemberController@ListMember')->name('member.list');
    Route::get('/member/pagelist', 'MemberController@PageListMember')->name('member.page');
    Route::post('/member/hapus', 'MemberController@HapusMember')->name('member.hapus');
    Route::post('/member/simpan', 'MemberController@SimpanMember')->name('member.simpan');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
