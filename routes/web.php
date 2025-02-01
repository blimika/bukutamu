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
Route::get('/', 'NewBukutamuController@NewDepan')->name('newdepan');
Route::get('/depan', 'BukutamuController@depan')->name('depan');
Route::get('/daftar', 'BukutamuController@Daftar')->name('daftar');
Route::get('/permintaan/data', 'BukutamuController@PermintaanData')->name('permintaan.data');
Route::get('/display/antrian', 'BukutamuController@DisplayAntrian')->name('display.antrian');
Route::post('/simpandaftar', 'BukutamuController@MemberDaftar')->name('member.daftar');
Route::post('/lupapasswd', 'BukutamuController@LupaPasswd')->name('member.lupapasswd');
Route::get('/member/aktivasi/{user}/{kode}', 'BukutamuController@MemberAktivasi')->name('member.aktivasi');
Route::get('/member/mail/{user}/{kode}/{email}', 'BukutamuController@MailAktivasi')->name('member.mailaktivasi');
Route::get('/cth1', function () {
     //kirim mail
     $body = new \stdClass();
     $body->nama_lengkap = 'I Putu Dyatmika';
     $body->username = 'mika';
     $body->email = 'mika@bpsntb.id';
     $body->telepon = '0871272818213';
     $body->email_kodever = 'NjJJMN99121';
     $body->tanggal_buat = \Carbon\Carbon::parse(NOW())->isoFormat('dddd, D MMMM Y H:mm:ss');
     $body->link_aktivasi = route('member.aktivasi',[$body->username,$body->email_kodever]);

    return new App\Mail\DaftarMember($body);
});
Route::get('/cth2', function () {
    //kirim mail
    $body = new \stdClass();
    $body->nama_lengkap = 'I Putu Dyatmika';
    $body->username = 'mika';
    $body->email = 'mika@bpsntb.id';
    $body->telepon = '0871272818213';
    $body->email_kodever = 'NjJJMN99121';
    $body->tanggal_minta = \Carbon\Carbon::parse(NOW())->isoFormat('dddd, D MMMM Y H:mm:ss');
    $body->passwd_baru = 'TestPass1';

    $body->link_aktivasi = route('member.aktivasi',[$body->username,$body->email_kodever]);
    return new App\Mail\ResetPasswd($body);
});
Route::get('/cth3', function () {
    //kirim mail
    $body = new \stdClass();
    $body->nama_lengkap = 'I Putu Dyatmika';
    $body->username = 'mika';
    $body->email = 'mika@bpsntb.id';
    $body->telepon = '0871272818213';
    $body->email_kodever = 'NjJJMN99121';
    $body->tanggal_minta = \Carbon\Carbon::parse(NOW())->isoFormat('dddd, D MMMM Y H:mm:ss');
    $body->passwd_baru = 'TestPass1';

    $body->link_aktivasi = route('member.aktivasi',[$body->username,$body->email_kodever]);

   return new App\Mail\EmailVerifikasi($body);
});
Route::get('/cth4', function () {
    //contoh mail dikirim
    $body = new \stdClass();
    $body->nama_lengkap = 'I Putu Dyatmika';
    $body->email = 'mika@bpsntb.id';
    $body->telepon = '0871272818213';
    $body->tanggal = \Carbon\Carbon::parse(NOW())->isoFormat('dddd, D MMMM Y H:mm:ss');
    $body->layanan_utama = 'Perpustakaan';
    $body->nomor_antrian = 'PS-001';

   return new App\Mail\KirimAntrian($body);
});
//newbukutamu
Route::get('/listdata', 'NewBukutamuController@DataKunjungan')->name('listdata');
Route::get('/webapi', 'NewBukutamuController@NewWebApi')->name('webapi');
Route::get('/cekhp/{nomor_hp}', 'NewBukutamuController@CekHP')->name('cekhp');
Route::get('/newkunjungan', 'NewBukutamuController@Kunjungan')->name('newkunjungan');
Route::get('/kunjungan/pagelist', 'NewBukutamuController@PageListKunjungan')->name('kunjungan.pagelist');
Route::post('/feedbacksave', 'NewBukutamuController@FeedbackSave')->name('feedbacksave');
Route::post('/newsimpan', 'NewBukutamuController@NewSimpan')->name('newsimpan');
Route::get('/newdisplay', 'NewBukutamuController@DisplayAntrian')->name('newdisplay');
Route::get('/newdepan', 'NewBukutamuController@NewDepan')->name('newdepan');
//batas
Route::post('/simpan', 'BukutamuController@simpan')->name('simpan');
Route::get('/tambahkunjungannew', 'BukutamuController@NewKunjungan')->name('kunjungan.new');
Route::get('/kunjungan/baru', 'BukutamuController@NewKunjungan')->name('kunjungan.baru');
Route::get('/kunjungan/lama', 'BukutamuController@KunjunganLama')->name('kunjungan.lama');
Route::get('/kunjungan/konfirmasi', 'BukutamuController@KonfirmasiKunjungan')->name('kunjungan.konfirmasi');
Route::get('/scanqrcode', 'BukutamuController@ScanQrcode')->name('kunjungan.scan');
Route::get('/detil/pengunjung/{qrcode}', 'BukutamuController@DetilTamu')->name('tamu.detil');
Route::get('/edit/{id}', 'BukutamuController@editdata')->name('edit');
//api json tanpa middleware
Route::get('/getdatakunjungan/{id}', 'BukutamuController@getDataKunjungan')->name('getdatakunjungan');
Route::get('/master/getdatatamu/{qrcode}', 'MasterController@CariPengunjung')->name('pengunjung.cari');
Route::get('/cekid/{jenis_identitas}/{nomor_identitas}', 'BukutamuController@cekID')->name('cekid');
Route::get('/master/getdatatamu/{qrcode}', 'MasterController@CariPengunjung')->name('pengunjung.cari');
//api get data tamu
#Route::get('/master/getdatatamu/{id}', 'MasterController@CariPengunjung')->name('pengunjung.cari');
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
    Route::post('/master/update/pengunjung', 'MasterController@UpdatePengunjung')->name('pengunjung.update');
    //nambah flag jenis kunjungan ditambahkan field flag_edit_tamu = 0 belum sync, 1 sudah sync
    Route::get('/master/synckunjungan', 'MasterController@ListSyncKunjungan')->name('master.synckunjungan');
    Route::get('/master/pengunjungsynckode', 'MasterController@SyncKodePengunjung')->name('pengunjung.kode');
    Route::post('/hapuspengunjung', 'MasterController@HapusPengunjung')->name('pengunjung.hapus');
    Route::get('/laporan/pengunjung', 'LaporanController@list')->name('laporan.pengunjung');
    Route::post('/ubahkunjungan', 'BukutamuController@UbahKunjungan')->name('ubah.kunjungan');
    Route::post('/lama/updatekunjungan', 'BukutamuController@UpdateKunjungan')->name('update.kunjungan');
    Route::post('/lama/ubahjeniskunjungan', 'BukutamuController@UbahJenisKunjungan')->name('ubah.jeniskunjungan');
    Route::get('/master/photosync', 'MasterController@SyncPhoto')->name('photo.sync');
    Route::get('/master/layanansync', 'MasterController@SyncLayananManfaat')->name('layanan.sync');
    Route::get('/master/genlayanansync/{tahun}', 'MasterController@GenSyncLayananManfaat')->name('genlayanan.sync');
    Route::get('/master/akses', 'MasterController@AksesLayanan')->name('layanan.akses');
    Route::post('/master/simpanakses', 'MasterController@SimpanAksesLayanan')->name('layanan.simpanakses');
    Route::get('/master/listakses', 'MasterController@PageListAkses')->name('layanan.listakses');
    Route::post('/master/hapusakses', 'MasterController@HapusAkses')->name('layanan.hapusakses');
    Route::post('/master/updateakses', 'MasterController@UpdateAkses')->name('layanan.updateakses');
    Route::post('/master/ubahflagakses', 'MasterController@FlagAkses')->name('layanan.ubahflagakses');
    //member
    Route::get('/member/list', 'MemberController@ListMember')->name('member.list');
    Route::get('/member/pagelist', 'MemberController@PageListMember')->name('member.page');
    Route::post('/member/hapus', 'MemberController@HapusMember')->name('member.hapus');
    Route::post('/member/simpan', 'MemberController@SimpanMember')->name('member.simpan');
    Route::post('/member/ubahflag', 'MemberController@UbahFlagMember')->name('member.ubahflag');
    Route::post('/member/updatedata', 'MemberController@UpdateMemberData')->name('member.updatedata');
    Route::get('/member/getdata/{id}', 'MemberController@CariMember')->name('member.cari');
    Route::post('/member/mailverifikasi', 'MemberController@VerifikasiEmail')->name('member.mailverifikasi');
    //kunjungan terjadwal
    Route::get('/kunjungan/terjadwal', 'BukutamuController@KunjunganTerjadwal')->name('kunjungan.terjadwal');
    Route::post('/kunjungan/terjadwal/simpan', 'BukutamuController@SimpanTerjadwal')->name('simpan.terjadwal');
    //profil user
    Route::get('/member/profil', 'MemberController@Profil')->name('member.profil');
    Route::post('/member/gantipasswd', 'MemberController@GantiPasswd')->name('member.gantipasswd');
    Route::post('/member/admgantipasswd', 'MemberController@AdmGantiPasswd')->name('member.admgantipasswd');
    Route::post('/member/updateprofil', 'MemberController@UpdateProfil')->name('member.updateprofil');
    Route::post('/member/kaitkan', 'MemberController@KaitkanMember')->name('member.kaitkan');
    Route::post('/member/putuskan', 'MemberController@PutuskanMember')->name('member.putuskan');
    Route::post('/member/putuskanakunmember', 'MemberController@PutuskanAkunMember')->name('member.putuskanakun');
    Route::post('/member/updatebiodata', 'MemberController@UpdateBiodata')->name('member.updatebiodata');
    //master tanggal
    Route::get('/master/tanggal', 'TanggalController@MasterTanggal')->name('master.tanggal');
    Route::get('/master/gettanggal/{id}', 'TanggalController@CariTanggal')->name('cari.tanggal');
    Route::get('/master/listtanggal', 'TanggalController@PageListTanggal')->name('master.listtanggal');
    Route::post('/master/gen/tanggal', 'TanggalController@GenerateTanggal')->name('master.gentanggal');
    Route::post('/master/updatetgl', 'TanggalController@UpdateTanggal')->name('master.updatetgl');
    Route::post('/master/updatejadwal', 'TanggalController@UpdateJadwal')->name('master.updatejadwal');
    Route::get('/master/cektgl/{tgl}', 'TanggalController@CekTanggal')->name('cek.tanggal');
    Route::get('/master/format/jadwal', 'TanggalController@FormatJadwal')->name('tanggal.formatjadwal');
    Route::post('/master/import/jadwal', 'TanggalController@ImportJadwalPetugas')->name('master.importjadwal');
    //tamu PageListTamuTerjadwal
    Route::get('/tamu/list', 'BukutamuController@ListTamu')->name('tamu.list');
    Route::get('/tamu/pagelist', 'BukutamuController@PageListTamu')->name('tamu.pagelist');
    Route::get('/tamu/terjadwal', 'BukutamuController@ListTamuTerjadwal')->name('tamu.terjadwal');
    Route::get('/tamu/pagelistterjadwal', 'BukutamuController@PageListTamuTerjadwal')->name('tamu.pagelistterjadwal');
    Route::post('/tamu/mulailayanan', 'BukutamuController@MulaiLayanan')->name('tamu.mulailayanan');
    Route::post('/tamu/akhirlayanan', 'BukutamuController@AkhirLayanan')->name('tamu.akhirlayanan');
    Route::post('/tamu/sinkron/layananutama', 'BukutamuController@SyncLayananUtama')->name('tamu.synclayananutama');
    //Tamu Antrian
    Route::get('/tamu/antrian', 'BukutamuController@AntrianTamu')->name('tamu.antrian');
    Route::get('/tamu/print/antrian/{id}', 'BukutamuController@PrintNomorAntrian')->name('tamu.printantrian');
    Route::get('/tamu/list/antrian', 'BukutamuController@AntrianListTamu')->name('tamu.antrianlist');
    Route::post('/tamu/kirim/nomor/antrian', 'BukutamuController@KirimNomorAntrian')->name('tamu.kirimnomorantrian');
    //PST Layanan, Manfaat dan Fasilitas
    Route::get('/pst/layanan', 'BukutamuController@PstLayanan')->name('pst.layanan');
    Route::post('/pst/sinkron/layanan', 'BukutamuController@SinkronPstLayanan')->name('pst.sinkronlayanan');
    //master Database baru
    //code baru
    Route::get('/master/database', 'NewBukutamuController@Database')->name('master.database');
    Route::get('/master/sinkron/database', 'NewBukutamuController@Sinkron')->name('database.sinkron');
    Route::get('/pengunjung/newlist', 'NewBukutamuController@DataPengunjung')->name('pengunjung.newlist');
    Route::get('/pengunjung/pagelist', 'NewBukutamuController@PengunjungPageList')->name('pengunjung.pagelist');
    //hapus kunjungan
    Route::post('/kunjungan/hapus', 'NewBukutamuController@HapusKunjungan')->name('kunjungan.hapus');
    Route::post('/kunjungan/flagantrian', 'NewBukutamuController@FlagAntrianUpdate')->name('flagantrian.update');
    Route::post('/kunjungan/mulai', 'NewBukutamuController@MulaiLayanan')->name('kunjungan.mulai');
    Route::post('/kunjungan/akhir', 'NewBukutamuController@AkhirLayanan')->name('kunjungan.akhir');
    Route::post('/tindaklanjut/save', 'NewBukutamuController@TindakLanjutSave')->name('tindaklanjut.save');
    Route::post('/tujuanbaru/save', 'NewBukutamuController@TujuanBaruSave')->name('tujuanbaru.save');
    Route::post('/jeniskunjungansave', 'NewBukutamuController@JenisKunjunganSave')->name('jeniskunjungan.save');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
