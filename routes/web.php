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

Route::get('/',             'Guest\HomeController@index')->name('guest.home');
Route::get('/test',         'Guest\HomeController@test');
Route::get('/phpinfo',      'Guest\HomeController@phpinfo');
// Route::get('/curl',         'Guest\HomeController@curl')->name('curl');
// Route::get('/tentang-kami', 'Guest\HomeController@tentangkami')->name('guest.tentang');
// Route::get('/hubungi-kami', 'Guest\HomeController@hubungikami')->name('guest.hubungi');
Route::get('/home',         'Guest\HomeController@checkrole')->name('guest.checkrole');

//EMAIL
Route::get('/mail/tes',                         'MailController@test')->name('mail');
Route::get('/mail/verify-email',                'MailController@verifyRegistration')->name('email.verification');
Route::get('/mail/verify-resend/{username}',    'MailController@resendVerification')->name('email.verification.resend');

Route::get('/dummy/simulasi/peserta',        'DummyController@dummySimulasiPeserta')->name('dummy.simulasi.peserta');

/*--------------------------------------------------------------------------
AUTH
-------------------------------------------------------------------------*/
Route::get('/login',        'Auth\LoginController@loginForm')->name('auth.login');
Route::post('/login',       'Auth\LoginController@login')->name('auth.login.post');
Route::post('/loginWithGoogle', 'Auth\LoginController@loginWithGoogle')->name('auth.login.with.google');
Route::get('/login-admin',  'Auth\LoginController@loginAdminForm')->name('auth.login.admin');
Route::post('/login-admin', 'Auth\LoginController@loginAdmin')->name('auth.login.admin.post');
Route::get('/logout',       'Auth\LoginController@logout')->name('auth.logout');
Route::get('/register',     'Auth\RegisterController@registerForm')->name('auth.register');
Route::post('/register',    'Auth\RegisterController@register')->name('auth.register.post');

/*--------------------------------------------------------------------------
ANALISIS UTBK
-------------------------------------------------------------------------*/
Route::group(['prefix' => 'utbk'], function(){
    Route::get('/',                 'Guest\UTBKController@index')->name('guest.utbk');
    Route::get('/input',            'Guest\UTBKController@input')->name('guest.utbk.input');
    Route::post('/input',           'Guest\UTBKController@inputPost')->name('guest.utbk.input.post');
});


/*--------------------------------------------------------------------------
RESET PASSWORD
-------------------------------------------------------------------------*/
Route::get('password/reset',        'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.forgot');
Route::post('password/email',       'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.email');
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('auth.password.reset.form');
Route::post('password/reset',       'Auth\ResetPasswordController@reset')->name('auth.password.reset.save');


/*--------------------------------------------------------------------------
SUPER ADMIN
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'superadmin', 'prefix' => 'superadmin'], function(){
    Route::get('/', 'SuperAdmin\HomeController@index')->name('superadmin');

    Route::group(['prefix' => 'user'], function(){
        Route::get('/',                 'SuperAdmin\UserController@index')->name('superadmin.user');
        Route::get('/export',           'SuperAdmin\UserController@export')->name('superadmin.user.export');
        Route::post('/tambah',          'SuperAdmin\UserController@tambahPost')->name('superadmin.user.tambah.post');
        Route::post('/ubah/{idUser}',   'SuperAdmin\UserController@ubahPost')->name('superadmin.user.ubah.post');
        Route::get('/get/{idUser}',     'SuperAdmin\UserController@getUser')->name('superadmin.user.get');
        Route::get('/hapus/{idUser}',   'SuperAdmin\UserController@hapus')->name('superadmin.user.hapus');
    });

});


/*--------------------------------------------------------------------------
ALL ADMIN
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'alladmin', 'prefix' => 'admin'], function(){
    Route::group(['prefix' => 'profil'], function(){
        Route::get('/edit',             'Admin\ProfilController@edit')->name('alladmin.profil.edit');
        Route::post('/edit-profil',     'Admin\ProfilController@editProfil')->name('alladmin.profil.edit.profil');
        Route::post('/edit-email',      'Admin\ProfilController@editEmail')->name('alladmin.profil.edit.email');
        Route::post('/edit-username',   'Admin\ProfilController@editUsername')->name('alladmin.profil.edit.username');
        Route::post('/edit-password',   'Admin\ProfilController@editPassword')->name('alladmin.profil.edit.password');
        Route::get('/photo',            'Admin\ProfilController@photo')->name('alladmin.profil.photo');
        Route::post('/photo',           'Admin\ProfilController@uploadPhoto')->name('alladmin.profil.photo.post');
    });
});


/*--------------------------------------------------------------------------
ADMIN GENERAL
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
    Route::get('/', 'Admin\HomeController@index')->name('admin');

    Route::group(['prefix' => 'grupchat'], function(){
        Route::get('/',                 'Admin\GrupChatController@index')->name('admin.grupchat');
        Route::get('/view/{id}',        'Admin\GrupChatController@viewGrup')->name('admin.grupchat.view');
        Route::get('/tambah',           'Admin\GrupChatController@formTambah')->name('admin.grupchat.tambah');
        Route::post('/tambah',          'Admin\GrupChatController@prosesTambah')->name('admin.grupchat.tambah.post');
        Route::get('/edit/{id}',        'Admin\GrupChatController@formEdit')->name('admin.grupchat.edit');
        Route::post('/edit/{id}',       'Admin\GrupChatController@prosesEdit')->name('admin.grupchat.edit.post');
        Route::get('/delete/{id}',      'Admin\GrupChatController@delete')->name('admin.grupchat.delete');
        Route::get('/member/kick/{id}', 'Admin\GrupChatController@kick')->name('admin.grupchat.member.kick');
    });

    Route::group(['prefix' => 'informasi'], function(){
        Route::get('/',             'Admin\InformasiController@index')->name('admin.informasi');
        Route::get('/form/{id?}',   'Admin\InformasiController@formInformasi')->name('admin.informasi.form');
        Route::post('/form/{id?}',  'Admin\InformasiController@saveInformasi')->name('admin.informasi.save');
        Route::get('/delete/{id}',  'Admin\InformasiController@delete')->name('admin.informasi.delete');
    });

    Route::group(['prefix' => 'passinggrade'], function(){
        Route::get('/',                                 'Admin\PassingGradeController@index')->name('admin.passgrade');
        Route::get('/downloadformat',                   'Admin\PassingGradeController@downloadFormat')->name('admin.passgrade.download.format');
        Route::get('/publish/{id?}',                    'Admin\PassingGradeController@publish')->name('admin.passgrade.publish');
        Route::get('/buat-passgrade',                   'Admin\PassingGradeController@createPassgrade')->name('admin.passgrade.create');
        Route::get('/formuniv/{id?}',                   'Admin\PassingGradeController@formUniv')->name('admin.passgrade.form.univ');
        Route::post('/saveuniv/{id?}',                  'Admin\PassingGradeController@saveUniv')->name('admin.passgrade.save.univ');
        Route::get('/openuniv/{id}',                    'Admin\PassingGradeController@openUniv')->name('admin.passgrade.open.univ');
        Route::get('/deluniv/{id}',                     'Admin\PassingGradeController@deleteUniv')->name('admin.passgrade.delete.univ');
        Route::get('/openuniv/{id}/deljur/{idJur}',     'Admin\PassingGradeController@deleteJurusan')->name('admin.passgrade.delete.jurusan');
        Route::get('/openuniv/{id}/formjur/{idJur?}',   'Admin\PassingGradeController@formJurusan')->name('admin.passgrade.form.jurusan');
        Route::post('/openuniv/{id}/savejur/{idJur?}',  'Admin\PassingGradeController@saveJurusan')->name('admin.passgrade.save.jurusan');
        Route::prefix('tiket')->group(function () {
            Route::get('/',                             'Admin\PassingGradeController@tiket')->name('admin.passgrade.tiket');
            Route::get('/detail/{idCetak?}',            'Admin\PassingGradeController@tiketDetail')->name('admin.passgrade.tiket.detail');
            Route::post('/tambah',                      'Admin\PassingGradeController@generateTiket')->name('admin.passgrade.tiket.tambah');
            Route::get('/delete/{idCetak}',             'Admin\PassingGradeController@deleteCetakTiket')->name('admin.passgrade.tiket.delete');
            Route::get('/print/{idCetak}',              'Admin\PassingGradeController@printTiket')->name('admin.passgrade.tiket.print');
        });
    });

    Route::group(['prefix' => 'sekolah'], function(){
        Route::get('/',             'Admin\SekolahController@index')->name('admin.sekolah');
        Route::get('/unchecked',    'Admin\SekolahController@unchecked')->name('admin.sekolah.unchecked');
        Route::get('/tambah',       'Admin\SekolahController@tambahForm')->name('admin.sekolah.tambah');
        Route::post('/tambah',      'Admin\SekolahController@tambahPost')->name('admin.sekolah.tambah.post');
        Route::get('/{id}/siswa',   'Admin\SekolahController@siswa')->name('admin.sekolah.siswa');
        Route::get('/{id}/delete',  'Admin\SekolahController@delete')->name('admin.sekolah.delete');
        Route::get('/{id}/edit',    'Admin\SekolahController@editForm')->name('admin.sekolah.edit');
        Route::post('/{id}/edit',   'Admin\SekolahController@editPost')->name('admin.sekolah.edit.post');
    });

    Route::group(['prefix' => 'member'], function(){
        Route::get('/',                 'Admin\MemberController@index')->name('admin.member');
        Route::get('/provinsi/{id?}',   'Admin\MemberController@provinsi')->name('admin.member.provinsi');
        Route::get('/generate',         'Admin\MemberController@generate')->name('admin.member.generate');
        Route::group(['prefix' => '{id}'], function(){
            Route::get('/edit',             'Admin\MemberController@pesertaEdit')->name('admin.member.edit');
            Route::get('/delete',           'Admin\MemberController@pesertaDelete')->name('admin.member.delete');
            Route::post('/edit-profil',     'Admin\ProfilController@editProfil')->name('admin.member.edit.profil');
            Route::post('/edit-email',      'Admin\ProfilController@editEmail')->name('admin.member.edit.email');
            Route::post('/edit-username',   'Admin\ProfilController@editUsername')->name('admin.member.edit.username');
            Route::post('/edit-password',   'Admin\ProfilController@editPassword')->name('admin.member.edit.password');
        });
    });

    Route::group(['prefix' => 'saldo'], function(){
        Route::get('/',                     'Admin\SaldoController@index')->name('admin.saldo');
        Route::get('/topup',                'Admin\SaldoController@riwayatTopup')->name('admin.saldo.topup');
        Route::get('/topup/approve/{id}',   'Admin\SaldoController@topupApprove')->name('admin.saldo.topup.approve');
        Route::get('/topup/delete/{id}',    'Admin\SaldoController@topupDelete')->name('admin.saldo.topup.delete');
    });

    Route::group(['prefix' => 'saldo'], function(){
        Route::get('/',                 'Admin\SaldoController@index')->name('admin.saldo');
    });

    Route::group(['prefix' => 'setting'], function(){
        Route::get('/',                         'Admin\SettingController@pembayaran')->name('admin.setting');
        Route::get('/pembayarans/{id?}',        'Admin\SettingController@pembayaran')->name('admin.setting.metode.pembayaran');
        Route::get('/pembayaran/form/{id?}',    'Admin\SettingController@formPembayaran')->name('admin.setting.metode.pembayaran.form');
        Route::post('/pembayaran/form/{id?}',   'Admin\SettingController@actionPembayaran')->name('admin.setting.metode.pembayaran.action');
        Route::get('/pembayaran/delete/{id}',   'Admin\SettingController@hapusPembayaran')->name('admin.setting.metode.pembayaran.delete');
    });

});


/*--------------------------------------------------------------------------
ADMIN UJIAN
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'adminujian', 'prefix' => 'adminujian'], function(){
    Route::get('/', 'AdminUjian\HomeController@index')->name('adminujian');

    Route::group(['prefix' => 'ujian'], function(){
        Route::get('/',             'AdminUjian\UjianController@index')->name('admin.ujian.soal');
        Route::get('/unpublish',    'AdminUjian\UjianController@unpublish')->name('admin.ujian.soal.unpublish');
        Route::get('/tambah',       'AdminUjian\UjianController@formTambahUjian')->name('admin.ujian.soal.tambah');
        Route::post('/tambah',      'AdminUjian\UjianController@prosesTambahUjian')->name('admin.ujian.soal.tambah.post');
        Route::group(['prefix' => '{id}'], function(){
            Route::get('/',                         'AdminUjian\UjianController@kelolaSoal')->name('admin.ujian.soal.kelola');
            Route::get('/delete',                   'AdminUjian\UjianController@deleteUjian')->name('admin.ujian.soal.delete');
            Route::get('/setting',                  'AdminUjian\UjianController@setting')->name('admin.ujian.soal.setting');
            Route::post('/edit',                    'AdminUjian\UjianController@prosesEditUjian')->name('admin.ujian.soal.edit.post');
            Route::get('/up',                       'AdminUjian\UjianController@upUjian')->name('admin.ujian.soal.up');
            Route::get('/history/{idAttempt?}',     'AdminUjian\UjianController@history')->name('admin.ujian.soal.history');
            Route::get('/peserta',                  'AdminUjian\UjianController@peserta')->name('admin.ujian.soal.peserta');
            Route::get('/publish',                  'AdminUjian\UjianController@publish')->name('admin.ujian.soal.publish');
            Route::get('/view',                     'AdminUjian\UjianController@view')->name('admin.ujian.soal.view');
            Route::get('/reqsoal',                  'AdminUjian\UjianController@reqSoal')->name('admin.ujian.soal.req.soal');
            Route::get('/formperaturan',            'AdminUjian\UjianController@formPeraturan')->name('admin.ujian.form.peraturan');
            Route::post('/formperaturan',           'AdminUjian\UjianController@savePeraturan')->name('admin.ujian.save.peraturan');
            Route::get('/formsoal/{idSoal?}',       'AdminUjian\UjianController@formSoal')->name('admin.ujian.soal.form.soal');
            Route::post('/tambahsoal/{idSoal?}',    'AdminUjian\UjianController@prosesFormSoal')->name('admin.ujian.soal.form.soal.post');
            Route::post('/importsoal',              'AdminUjian\UjianController@prosesImportSoal')->name('admin.ujian.soal.import.soal.post');
            Route::get('/deletesoal/{idSoal}',      'AdminUjian\UjianController@deleteSoal')->name('admin.ujian.soal.delete.soal');
            Route::get('/lihatsoal/{idSoal}',       'AdminUjian\UjianController@viewSoal')->name('admin.ujian.soal.lihat.soal');
            Route::get('/analitiksoal',             'AdminUjian\UjianController@analitikSoal')->name('admin.ujian.soal.analitik');
            Route::get('/analisissoal',             'AdminUjian\UjianController@analisisSoal')->name('admin.ujian.soal.analisis');
            Route::get('/kriteriasoal',             'AdminUjian\UjianController@kriteriaSoal')->name('admin.ujian.soal.kriteria');
            Route::get('/formkelompoksoal/{idKelompokSoal?}',    'AdminUjian\UjianController@formKelompokSoal')->name('admin.ujian.soal.form.kelompok.soal.get');
            Route::post('/formkelompoksoal/{idKelompokSoal?}',   'AdminUjian\UjianController@prosesKelompokSoal')->name('admin.ujian.soal.form.kelompok.soal.post');
            Route::get('/deletekelompoksoal/{idKelompokSoal?}',  'AdminUjian\UjianController@deleteKelompokSoal')->name('admin.ujian.soal.delete.kelompok.soal');
        });
    });
});

/*--------------------------------------------------------------------------
ADMIN SIMULASI
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'adminsimulasi', 'prefix' => 'adminsimulasi'], function(){
    Route::get('/', 'AdminSimulasi\HomeController@index')->name('adminsimulasi');
    Route::group(['prefix' => 'simulasi'], function(){
        Route::get('/',             'AdminSimulasi\SimulasiController@index')->name('adminsimulasi.simulasi');
        Route::get('/tambah',       'AdminSimulasi\SimulasiController@tambahForm')->name('adminsimulasi.simulasi.tambah');
        Route::post('/tambah',      'AdminSimulasi\SimulasiController@tambahPost')->name('adminsimulasi.simulasi.tambah.post');
        Route::post('/edit/{id}',   'AdminSimulasi\SimulasiController@editPost')->name('adminsimulasi.simulasi.edit.post');
        Route::group(['prefix' => 'kelola/{id}'], function(){
            Route::get('/',                             'AdminSimulasi\SimulasiController@kelola')->name('adminsimulasi.simulasi.kelola');
            Route::get('/publish',                      'AdminSimulasi\SimulasiController@publish')->name('adminsimulasi.simulasi.kelola.publish');
            Route::get('/closereg',                     'AdminSimulasi\SimulasiController@closeReg')->name('adminsimulasi.simulasi.kelola.closereg');
            Route::get('/peserta',                      'AdminSimulasi\SimulasiController@peserta')->name('adminsimulasi.simulasi.kelola.peserta');
            Route::group(['prefix' => 'peserta/{idPeserta}'], function(){
                Route::get('/edit',                         'AdminSimulasi\SimulasiController@pesertaEdit')->name('adminsimulasi.simulasi.kelola.peserta.edit');
                Route::get('/delete',                       'AdminSimulasi\SimulasiController@pesertaDelete')->name('adminsimulasi.simulasi.kelola.peserta.delete');
                Route::post('/edit-profil',                 'AdminSimulasi\ProfilController@editProfil')->name('adminsimulasi.simulasi.kelola.peserta.edit.profil');
                Route::post('/edit-email',                  'AdminSimulasi\ProfilController@editEmail')->name('adminsimulasi.simulasi.kelola.peserta.edit.email');
                Route::post('/edit-username',               'AdminSimulasi\ProfilController@editUsername')->name('adminsimulasi.simulasi.kelola.peserta.edit.username');
                Route::post('/edit-password',               'AdminSimulasi\ProfilController@editPassword')->name('adminsimulasi.simulasi.kelola.peserta.edit.password');
            });
            Route::get('/peserta/{idPeserta}/swicth',   'AdminSimulasi\SimulasiController@pesertaSwicthOnlineOffline')->name('adminsimulasi.simulasi.kelola.peserta.switch');
            Route::get('/kartuujian/{idPeserta}',       'AdminSimulasi\SimulasiController@kartuUjian')->name('adminsimulasi.simulasi.kelola.peserta.kartuujian');
            Route::get('/delete',                       'AdminSimulasi\SimulasiController@deleteSimulasi')->name('adminsimulasi.simulasi.kelola.delete');
            Route::get('/kuncijawaban',                 'AdminSimulasi\SimulasiController@kunciJawaban')->name('adminsimulasi.simulasi.kelola.kunci.jawaban');
            Route::get('/reqkuncijawaban/{idMapel}',    'AdminSimulasi\SimulasiController@reqKunciJawaban')->name('adminsimulasi.simulasi.kelola.req.kunci.jawaban');
            Route::post('/kuncijawaban',                'AdminSimulasi\SimulasiController@saveKunciJawaban')->name('adminsimulasi.simulasi.kelola.kunci.jawaban.post');
            Route::post('/simpanlinksoal/{idMapel}',     'AdminSimulasi\SimulasiController@simpanLinkSoal')->name('adminsimulasi.simulasi.kelola.link.soal.post');
            Route::post('/tautsoal',                    'AdminSimulasi\SimulasiController@tautSoal')->name('adminsimulasi.simulasi.kelola.taut.soal');
            
            // pengawas
            Route::get('/pengawas',                     'AdminSimulasi\SimulasiController@pengawas')->name('adminsimulasi.simulasi.kelola.pengawas');
            Route::get('/pengawas/f/{idPengawas?}',     'AdminSimulasi\SimulasiController@pengawasForm')->name('adminsimulasi.simulasi.kelola.pengawas.form');
            Route::post('/pengawas/f/{idPengawas?}',    'AdminSimulasi\SimulasiController@pengawasPost')->name('adminsimulasi.simulasi.kelola.pengawas.post');
            Route::post('/pengawas/addaccount',         'AdminSimulasi\SimulasiController@pengawasAddAccount')->name('adminsimulasi.simulasi.kelola.pengawas.post.account');
            Route::get('/pengawas/hapus/{idPengawas}',  'AdminSimulasi\SimulasiController@pengawasHapus')->name('adminsimulasi.simulasi.kelola.pengawas.hapus');
            
            // agenda
            Route::get('/agenda/f/{idAgenda?}',         'AdminSimulasi\SimulasiController@agendaForm')->name('adminsimulasi.simulasi.kelola.agenda.form');
            Route::post('/agenda/post/{idAgenda?}',     'AdminSimulasi\SimulasiController@agendaPost')->name('adminsimulasi.simulasi.kelola.agenda.post');
            Route::get('/agenda/delete/{idAgenda?}',    'AdminSimulasi\SimulasiController@agendaDelete')->name('adminsimulasi.simulasi.kelola.agenda.delete');
            
            // jadwal
            Route::get('/jadwal/f/{idJadwal?}',         'AdminSimulasi\SimulasiController@jadwalForm')->name('adminsimulasi.simulasi.kelola.jadwal.form');
            Route::post('/jadwal/post/{idJadwal?}',     'AdminSimulasi\SimulasiController@jadwalPost')->name('adminsimulasi.simulasi.kelola.jadwal.post');
            Route::get('/jadwal/delete/{idJadwal?}',    'AdminSimulasi\SimulasiController@jadwalDelete')->name('adminsimulasi.simulasi.kelola.jadwal.delete');
            Route::get('/jadwal/{idJadwal?}',           'AdminSimulasi\SimulasiController@jadwal')->name('adminsimulasi.simulasi.kelola.jadwal');
            
            // peserta online
            Route::get('/aturpesertaonline',            'AdminSimulasi\SimulasiController@aturPesertaOnline')->name('adminsimulasi.simulasi.kelola.peserta.online.form');
            Route::post('/aturpesertaonline',           'AdminSimulasi\SimulasiController@aturPesertaOnlinePost')->name('adminsimulasi.simulasi.kelola.peserta.online.post');
            
            // push nilai
            Route::get('/pushnilai/{idJadwal?}',        'AdminSimulasi\SimulasiController@pushNilai')->name('adminsimulasi.simulasi.kelola.push.nilai');
            
            // ruang
            Route::get('/ruang/f/{idRuang?}',           'AdminSimulasi\SimulasiController@ruangForm')->name('adminsimulasi.simulasi.kelola.ruang.form');
            Route::post('/ruang/post/{idRuang?}',       'AdminSimulasi\SimulasiController@ruangPost')->name('adminsimulasi.simulasi.kelola.ruang.post');
            Route::get('/ruang/delete/{idRuang?}',      'AdminSimulasi\SimulasiController@ruangDelete')->name('adminsimulasi.simulasi.kelola.ruang.delete');
            Route::get('/ruang/borang/{idRuang?}',      'AdminSimulasi\SimulasiController@ruangBorang')->name('adminsimulasi.simulasi.kelola.ruang.borang');
            Route::get('/ruang/absen/{idRuang?}',       'AdminSimulasi\SimulasiController@ruangAbsen')->name('adminsimulasi.simulasi.kelola.ruang.absen');
            Route::get('/ruang/{idRuang?}',             'AdminSimulasi\SimulasiController@ruang')->name('adminsimulasi.simulasi.kelola.ruang');
            
            // hasil
            Route::get('/hasilsementara',               'AdminSimulasi\SimulasiController@hasilSementara')->name('adminsimulasi.simulasi.kelola.hasil.sementara');
            Route::get('/hasilsementara/d/{idPeserta}', 'AdminSimulasi\SimulasiController@hasilSementaraDelete')->name('adminsimulasi.simulasi.kelola.hasil.sementara.delete');
            Route::get('/lihatjawaban/{idPeserta}',     'AdminSimulasi\SimulasiController@lihatJawaban')->name('adminsimulasi.simulasi.kelola.lihat.jawaban');
            Route::post('/deletejawaban',               'AdminSimulasi\SimulasiController@deleteJawaban')->name('adminsimulasi.simulasi.kelola.delete.jawaban');
            Route::get('/pindahruang',                  'AdminSimulasi\SimulasiController@pindahRuang')->name('adminsimulasi.simulasi.kelola.pindah.ruang');
            Route::get('/koreksi',                      'AdminSimulasi\SimulasiController@koreksi')->name('adminsimulasi.simulasi.kelola.koreksi');
            Route::get('/generateattempt',              'AdminSimulasi\SimulasiController@generateAttempt');
            Route::post('/koreksi',                     'AdminSimulasi\SimulasiController@koreksiPost')->name('adminsimulasi.simulasi.kelola.koreksi.post');
            
            // kriteria soal
            Route::get('/kriteriasoal',                 'AdminSimulasi\SimulasiController@kriteriaSoal')->name('adminsimulasi.simulasi.kelola.kriteria.soal');
            Route::get('/kriteriasoalgenerate',         'AdminSimulasi\SimulasiController@kriteriaSoalgenerate')->name('adminsimulasi.simulasi.kelola.generate.kriteria.soal');
            Route::get('/kriteriasoalfill',             'AdminSimulasi\SimulasiController@kriteriaSoalFill')->name('adminsimulasi.simulasi.kelola.fill.kriteria.soal');
            
            // hitung nilai akhir
            Route::get('/hitungnilaiakhir',             'AdminSimulasi\SimulasiController@hitungNilaiAkhir')->name('adminsimulasi.simulasi.kelola.hitung.nilai.akhir');
            Route::get('/hitungnilaiakhir/{idPeserta}', 'AdminSimulasi\SimulasiController@hitungNilaiAkhirPeserta')->name('adminsimulasi.simulasi.kelola.hitung.nilai.akhir.proses');
            Route::get('/generatePeringkat',            'AdminSimulasi\SimulasiController@generatePeringkat')->name('adminsimulasi.simulasi.kelola.generate.peringkat');
            Route::get('/generatePeringkat/{idPeserta}','AdminSimulasi\SimulasiController@generatePeringkatPeserta')->name('adminsimulasi.simulasi.kelola.generate.peringkat.proses');
            Route::get('/borangrekomendasi',            'AdminSimulasi\SimulasiController@borangRekomendasi')->name('adminsimulasi.simulasi.kelola.borang.rekomendasi');
            
            // download
            Route::group(['prefix' => 'download'], function(){
                Route::get('/peserta',      'AdminSimulasi\SimulasiController@downloadPeserta')->name('adminsimulasi.simulasi.kelola.download.peserta');
                Route::get('/borang',       'AdminSimulasi\SimulasiController@downloadBorang')->name('adminsimulasi.simulasi.kelola.download.borang');
                Route::get('/hasilAkhir',   'AdminSimulasi\SimulasiController@downloadHasilAkhir')->name('adminsimulasi.simulasi.kelola.download.hasil.akhir');
            });
            
            // tiket
            Route::prefix('tiket')->group(function () {
                Route::get('/',                         'AdminSimulasi\SimulasiController@tiket')->name('adminsimulasi.simulasi.kelola.tiket');
                Route::get('/detail/{idCetak?}',        'AdminSimulasi\SimulasiController@tiketDetail')->name('adminsimulasi.simulasi.kelola.tiket.detail');
                Route::post('/tambah',                  'AdminSimulasi\SimulasiController@generateTiket')->name('adminsimulasi.simulasi.kelola.tiket.tambah');
                Route::get('/delete/{idCetak}',         'AdminSimulasi\SimulasiController@deleteCetakTiket')->name('adminsimulasi.simulasi.kelola.tiket.delete');
                Route::get('/print/{idCetak}',          'AdminSimulasi\SimulasiController@printTiket')->name('adminsimulasi.simulasi.kelola.tiket.print');
                Route::get('/hapuspeserta/{idTiket}',   'AdminSimulasi\SimulasiController@hapusPeserta')->name('adminsimulasi.simulasi.kelola.tiket.hapus.peserta');
            });
            
            // grubchat
            Route::group(['prefix' => 'grupchat'], function(){
                Route::get('/',                     'AdminSimulasi\SimulasiController@grupChat')->name('adminsimulasi.simulasi.kelola.grupchat');
                Route::get('/view/{idGrup}',        'AdminSimulasi\SimulasiController@grupChatView')->name('adminsimulasi.simulasi.kelola.grupchat.view');
                Route::get('/tambah',               'AdminSimulasi\SimulasiController@grupChatTambah')->name('adminsimulasi.simulasi.kelola.grupchat.tambah');
                Route::post('/tambah',              'AdminSimulasi\SimulasiController@grupChatTambahPost')->name('adminsimulasi.simulasi.kelola.grupchat.tambah.post');
                Route::get('/edit/{idGrup}',        'AdminSimulasi\SimulasiController@grupChatEdit')->name('adminsimulasi.simulasi.kelola.grupchat.edit');
                Route::post('/edit/{idGrup}',       'AdminSimulasi\SimulasiController@grupChatEditPost')->name('adminsimulasi.simulasi.kelola.grupchat.edit.post');
                Route::get('/delete/{idGrup}',      'AdminSimulasi\SimulasiController@grupChatDelete')->name('adminsimulasi.simulasi.kelola.grupchat.delete');
                Route::get('/member/kick/{idMember}',   'AdminSimulasi\SimulasiController@grupChatKick')->name('adminsimulasi.simulasi.kelola.grupchat.member.kick');
            });

            // scan
            Route::get('/scan',         'AdminSimulasi\SimulasiController@scanView')->name('adminsimulasi.simulasi.kelola.scan');
            Route::post('/scan',        'AdminSimulasi\SimulasiController@scanPreview')->name('adminsimulasi.simulasi.kelola.scan.post');
            Route::post('/scanprocess', 'AdminSimulasi\SimulasiController@scanProcess')->name('adminsimulasi.simulasi.kelola.scan.process');
        });
    });
});


/*--------------------------------------------------------------------------
PENGAWAS
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'pengawas', 'prefix' => 'pengawas'], function(){
    Route::get('/', 'Pengawas\HomeController@index')->name('pengawas');
    Route::group(['prefix' => 'simulasi'], function(){
        Route::get('/',             'Pengawas\SimulasiController@index')->name('pengawas.simulasi');
        Route::group(['prefix' => 'kelola/{id}'], function(){
            Route::get('/',                         'Pengawas\SimulasiController@kelola')->name('pengawas.simulasi.kelola');
            Route::get('/peserta',                  'Pengawas\SimulasiController@peserta')->name('pengawas.simulasi.kelola.peserta');
            Route::get('/koreksi',                  'Pengawas\SimulasiController@koreksi')->name('pengawas.simulasi.kelola.koreksi');
            Route::post('/koreksi',                 'Pengawas\SimulasiController@koreksiPost')->name('pengawas.simulasi.kelola.koreksi.post');
            Route::get('/lihathasilsementara',      'Pengawas\SimulasiController@lihatHasilSementara')->name('pengawas.simulasi.kelola.lihat.hasil.sementara');
        });
    });
});


/*--------------------------------------------------------------------------
MEMBER
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'member'], function(){
    //Route::get('/', 'Member\HomeController@index')->name('member');

    Route::group(['prefix' => 'profil'], function(){
        Route::get('/edit',             'Member\ProfilController@edit')->name('member.profil.edit');
        Route::post('/edit-tiket',      'Member\ProfilController@editTiket')->name('member.profil.edit.tiket');
        Route::post('/edit-profil',     'Member\ProfilController@editProfil')->name('member.profil.edit.profil');
        Route::post('/edit-email',      'Member\ProfilController@editEmail')->name('member.profil.edit.email');
        Route::post('/edit-username',   'Member\ProfilController@editUsername')->name('member.profil.edit.username');
        Route::post('/edit-password',   'Member\ProfilController@editPassword')->name('member.profil.edit.password');
        Route::post('/edit-sekolah',    'Member\ProfilController@editSekolah')->name('member.profil.edit.sekolah');
        Route::get('/photo',            'Member\ProfilController@photo')->name('member.profil.photo');
        Route::post('/photo',           'Member\ProfilController@uploadPhoto')->name('member.profil.photo.post');
    });
    
    // Route::group(['prefix' => 'grup-chat'], function(){
    //     Route::get('/',             'Member\GrupChatController@index')->name('member.grupchat');
    //     Route::get('/join/wa',      'Member\GrupChatController@joinWa')->name('member.grupchat.join.wa');
    //     Route::get('/join/line',    'Member\GrupChatController@joinLine')->name('member.grupchat.join.line');
    // });
    
    Route::group(['prefix' => 'jungle'], function(){
        Route::get('/',             'Member\JungleController@index')->name('member.jungle');
    });

    Route::group(['prefix' => 'pendampingan'], function(){
        Route::get('/',             'Member\PendampinganController@index')->name('member.pendampingan');
    });

    Route::group(['prefix' => 'informasi'], function(){
        Route::get('/',             'Member\InformasiController@index')->name('member.informasi');
        Route::get('/p/{id}',       'Member\InformasiController@view')->name('member.informasi.view');
    });
    
    Route::group(['prefix' => 'saldo'], function(){
        Route::get('/',                 'Member\SaldoController@index')->name('member.saldo');
        Route::post('/topup',           'Member\SaldoController@topup')->name('member.saldo.topup');
        Route::get('/petunjuk/{id}',   'Member\SaldoController@petunjukBayar')->name('member.saldo.petunjuk.bayar');
    });
    
    Route::group(['prefix' => 'passinggrade'], function(){
        Route::get('/',             'Member\InformasiController@passGrade')->name('member.passgrade');
        Route::post('/beli/{id}',   'Member\InformasiController@beliPassGrade')->name('member.passgrade.beli');
    });
    
    Route::group(['prefix' => 'ujian'], function(){
        Route::get('/',                     'Member\UjianController@index')->name('member.ujian.soal');
        Route::get('/sbmptn/passgrade/{id}','Member\UjianController@sbmptnPassGrade')->name('member.ujian.soal.sbmptn.passgrade');
        Route::post('/sbmptn/passgrade/{id}','Member\UjianController@sbmptnPassGradePost')->name('member.ujian.soal.sbmptn.passgrade.post');
        Route::get('/preattempt/{idSoal}',  'Member\UjianController@preAttempt')->name('member.ujian.soal.preattempt');
        Route::get('/attempt/{idSoal}',     'Member\UjianController@attempt')->name('member.ujian.soal.attempt');
        Route::get('/listsoal',             'Member\UjianController@listSoal')->name('member.ujian.soal.list');
        Route::get('/soalsudahdibeli',      'Member\UjianController@listSoalDibeli')->name('member.ujian.soal.list.dibeli');
        Route::get('/belisoal/{id}',        'Member\UjianController@beliSoal')->name('member.ujian.soal.beli');
        Route::get('/opensoal/{idAttempt}', 'Member\UjianController@openSoal')->name('member.ujian.soal.open');
        Route::get('/finish/{idAttempt}',   'Member\UjianController@finish')->name('member.ujian.soal.finish');
        Route::get('/history/{idAttempt?}', 'Member\UjianController@history')->name('member.ujian.history');
    });
    
    Route::group(['prefix' => 'attempt'], function(){
        Route::get('/reqsoal/{idUjian}',    'Member\AttemptController@reqSoal')->name('member.ujian.attempt.request.soal');
        Route::post('/sendjawaban',         'Member\AttemptController@sendJawaban')->name('member.ujian.attempt.sendJawaban');
        Route::post('/nextgroupsoal',       'Member\AttemptController@nextGroupSoal')->name('member.ujian.attempt.next.group');
    });
    
    Route::group(['prefix' => 'simulasi'], function(){
        Route::get('/',                 'Member\SimulasiController@index')->name('member.simulasi');
        Route::get('/sudahdibeli',      'Member\SimulasiController@listSimulasiDibeli')->name('member.simulasi.dibeli');
        Route::group(['prefix' => '{id}'], function(){
            Route::get('/register',             'Member\SimulasiController@register')->name('member.simulasi.register');
            Route::post('/register',            'Member\SimulasiController@registerPost')->name('member.simulasi.register.post');
            Route::get('/passgrade',            'Member\SimulasiController@passGrade')->name('member.simulasi.passgrade');
            Route::post('/passgrade',           'Member\SimulasiController@passGradePost')->name('member.simulasi.passgrade.post');
            Route::get('/o',                    'Member\SimulasiController@open')->name('member.simulasi.open');
            Route::get('/joingrupchat',         'Member\SimulasiController@joinGrupChat')->name('member.simulasi.join.grup.chat');
            Route::get('/kartuujian',           'Member\SimulasiController@kartuUjian')->name('member.simulasi.kartuujian');
            Route::post('/aturjadwal',          'Member\SimulasiController@aturJadwal')->name('member.simulasi.aturjadwal');
            Route::get('/attempt/{idUjian}',    'Member\SimulasiController@attempt')->name('member.simulasi.ujian.attempt');
            Route::get('/history/{idAttempt?}', 'Member\SimulasiController@history')->name('member.simulasi.history');
            Route::get('/openujian/{idAttempt}','Member\SimulasiController@openUjian')->name('member.simulasi.ujian.open');
            Route::get('/finish/{idAttempt}',   'Member\SimulasiController@finish')->name('member.simulasi.ujian.finish');
            Route::get('/lihathasil',           'Member\SimulasiController@lihatHasil')->name('member.simulasi.lihat.hasil');
        });
    });
    
});

/*--------------------------------------------------------------------------
USER
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'user', 'prefix' => 'user'], function(){
    Route::get('/', 'User\HomeController@index')->name('user');
    
    Route::group(['prefix' => 'passinggrade'], function(){
        Route::get('/',     'User\InformasiController@passGrade')->name('user.passgrade');
    });
    
    Route::group(['prefix' => 'profil'], function(){
        Route::get('/edit',             'User\ProfilController@edit')->name('user.profil.edit');
        Route::post('/edit-tiket',      'User\ProfilController@editTiket')->name('user.profil.edit.tiket');
        Route::post('/edit-profil',     'User\ProfilController@editProfil')->name('user.profil.edit.profil');
        Route::post('/edit-email',      'User\ProfilController@editEmail')->name('user.profil.edit.email');
        Route::post('/edit-username',   'User\ProfilController@editUsername')->name('user.profil.edit.username');
        Route::post('/edit-password',   'User\ProfilController@editPassword')->name('user.profil.edit.password');
        Route::post('/edit-sekolah',    'User\ProfilController@editSekolah')->name('user.profil.edit.sekolah');
        Route::get('/photo',            'User\ProfilController@photo')->name('user.profil.photo');
        Route::post('/photo',           'User\ProfilController@uploadPhoto')->name('user.profil.photo.post');
    });
    
    Route::group(['prefix' => 'simulasi'], function(){
        Route::get('/',                 'User\SimulasiController@index')->name('user.simulasi');
        Route::group(['prefix' => '{id}'], function(){
            Route::get('/register',             'User\SimulasiController@register')->name('user.simulasi.register');
            Route::post('/register',            'User\SimulasiController@registerPost')->name('user.simulasi.register.post');
            Route::get('/passgrade',            'User\SimulasiController@passGrade')->name('user.simulasi.passgrade');
            Route::post('/passgrade',           'User\SimulasiController@passGradePost')->name('user.simulasi.passgrade.post');
            Route::get('/o',                    'User\SimulasiController@open')->name('user.simulasi.open');
            Route::get('/joingrupchat',         'User\SimulasiController@joinGrupChat')->name('user.simulasi.join.grup.chat');
            Route::get('/kartuujian',           'User\SimulasiController@kartuUjian')->name('user.simulasi.kartuujian');
            Route::post('/aturjadwal',          'User\SimulasiController@aturJadwal')->name('user.simulasi.aturjadwal');
            Route::get('/attempt/{idUjian}',    'User\SimulasiController@attempt')->name('user.simulasi.ujian.attempt');
            Route::get('/openujian/{idAttempt}','User\SimulasiController@openUjian')->name('user.simulasi.ujian.open');
            Route::get('/finish/{idAttempt}',   'User\SimulasiController@finish')->name('user.simulasi.ujian.finish');
            Route::get('/lihathasil',           'User\SimulasiController@lihatHasil')->name('user.simulasi.lihat.hasil');
        });
    });
    
    Route::group(['prefix' => 'attempt'], function(){
        Route::get('/reqsoal/{idUjian}',    'User\AttemptController@reqSoal')->name('user.ujian.attempt.request.soal');
        Route::post('/sendjawaban',         'User\AttemptController@sendJawaban')->name('user.ujian.attempt.sendJawaban');
    });

});

//AJAX

Route::group(['prefix' => 'ajax'], function(){
    Route::group(['prefix' => 'pustaka'], function(){
        Route::get('/create-ujian',  'AJAXController@createUjian')->name('ajax.pustaka.create.ujian');
    });
    Route::get('/universitas/{id?}',        'AJAXController@universitas')->name('ajax.universitas');
    Route::get('/provinsi/{idProvinsi?}',   'AJAXController@provinsi')->name('ajax.lokasi.provinsi');
    Route::get('/kabupaten/{idKabupaten?}', 'AJAXController@kabupaten')->name('ajax.lokasi.kabupaten');
    Route::get('/kecamatan/{idKecamatan?}', 'AJAXController@kecamatan')->name('ajax.lokasi.kecamatan');
    Route::get('/kelurahan/{idKelurahan?}', 'AJAXController@kelurahan')->name('ajax.lokasi.kelurahan');
    Route::get('/sekolah',                  'AJAXController@sekolah')->name('ajax.sekolah');
    Route::get('/kelas',                    'AJAXController@kelas')->name('ajax.kelas');
});
