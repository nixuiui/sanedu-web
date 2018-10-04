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
// Route::get('/curl',         'Guest\HomeController@curl')->name('curl');
Route::get('/tentang-kami', 'Guest\HomeController@tentangkami')->name('guest.tentang');
Route::get('/hubungi-kami', 'Guest\HomeController@hubungikami')->name('guest.hubungi');
Route::get('/home',         'Guest\HomeController@checkrole')->name('guest.checkrole');

//EMAIL
Route::get('/mail/tes',                         'MailController@test')->name('mail');
Route::get('/mail/verify-email',                'MailController@verifyRegistration')->name('email.verification');
Route::get('/mail/verify-resend/{username}',    'MailController@resendVerification')->name('email.verification.resend');


/*--------------------------------------------------------------------------
AUTH
-------------------------------------------------------------------------*/
Route::get('/login',        'Auth\LoginController@loginForm')->name('auth.login');
Route::post('/login',       'Auth\LoginController@login')->name('auth.login.post');
Route::get('/login-admin',  'Auth\LoginController@loginAdminForm')->name('auth.login.admin');
Route::post('/login-admin', 'Auth\LoginController@loginAdmin')->name('auth.login.admin.post');
Route::get('/logout',       'Auth\LoginController@logout')->name('auth.logout');
Route::get('/register',     'Auth\RegisterController@registerForm')->name('auth.register');
Route::post('/register',    'Auth\RegisterController@register')->name('auth.register.post');


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
        Route::get('/formuniv/{id?}',                   'Admin\PassingGradeController@formUniv')->name('admin.passgrade.form.univ');
        Route::post('/saveuniv/{id?}',                  'Admin\PassingGradeController@saveUniv')->name('admin.passgrade.save.univ');
        Route::get('/openuniv/{id}',                    'Admin\PassingGradeController@openUniv')->name('admin.passgrade.open.univ');
        Route::get('/deluniv/{id}',                     'Admin\PassingGradeController@deleteUniv')->name('admin.passgrade.delete.univ');
        Route::get('/openuniv/{id}/deljur/{idJur}',     'Admin\PassingGradeController@deleteJurusan')->name('admin.passgrade.delete.jurusan');
        Route::get('/openuniv/{id}/formjur/{idJur?}',   'Admin\PassingGradeController@formJurusan')->name('admin.passgrade.form.jurusan');
        Route::post('/openuniv/{id}/savejur/{idJur?}',  'Admin\PassingGradeController@saveJurusan')->name('admin.passgrade.save.jurusan');
    });

});


/*--------------------------------------------------------------------------
ADMIN UJIAN
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'adminujian', 'prefix' => 'adminujian'], function(){
    Route::get('/', 'AdminUjian\HomeController@index')->name('adminujian');

    Route::group(['prefix' => 'ujian'], function(){
        Route::get('/',                     'AdminUjian\UjianController@index')->name('admin.ujian.soal');
        Route::get('/soal/tambah',          'AdminUjian\UjianController@formTambahUjian')->name('admin.ujian.soal.tambah');
        Route::post('/soal/tambah',         'AdminUjian\UjianController@prosesTambahUjian')->name('admin.ujian.soal.tambah.post');
        Route::post('/soal/edit/{id}',      'AdminUjian\UjianController@prosesEditUjian')->name('admin.ujian.soal.edit.post');
        Route::get('/soal/up/{id}',         'AdminUjian\UjianController@upUjian')->name('admin.ujian.soal.up');
        Route::get('/soal/delete/{id}',     'AdminUjian\UjianController@deleteUjian')->name('admin.ujian.soal.delete');
        Route::get('/soal/pembeli/{id}',    'AdminUjian\UjianController@pembeli')->name('admin.ujian.soal.pembeli');
        Route::get('/soal/history/{id}/{idAttempt?}',   'AdminUjian\UjianController@history')->name('admin.ujian.soal.history');
        Route::group(['prefix' => 'soal/kelola'], function(){
            Route::get('/{id}',                         'AdminUjian\UjianController@kelolaSoal')->name('admin.ujian.soal.kelola');
            Route::get('/{id}/publish',                 'AdminUjian\UjianController@publish')->name('admin.ujian.soal.publish');
            Route::get('/{id}/formperaturan',           'AdminUjian\UjianController@formPeraturan')->name('admin.ujian.form.peraturan');
            Route::post('/{id}/formperaturan',          'AdminUjian\UjianController@savePeraturan')->name('admin.ujian.save.peraturan');
            Route::get('/{id}/formsoal/{idSoal?}',      'AdminUjian\UjianController@formSoal')->name('admin.ujian.soal.form.soal');
            Route::post('/{id}/tambahsoal/{idSoal?}',   'AdminUjian\UjianController@prosesTambahSoal')->name('admin.ujian.soal.form.soal.post');
            Route::get('/{id}/deletesoal/{idSoal}',     'AdminUjian\UjianController@deleteSoal')->name('admin.ujian.soal.delete.soal');
            Route::get('/{id}/lihatsoal/{idSoal}',      'AdminUjian\UjianController@viewSoal')->name('admin.ujian.soal.lihat.soal');
        });
    });
});


/*--------------------------------------------------------------------------
ADMIN TIKET
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'admintiket', 'prefix' => 'admintiket'], function(){
    Route::get('/', 'AdminTiket\HomeController@index')->name('admintiket');

    Route::group(['prefix' => 'user/{id}'], function(){
        Route::post('/edit-profil',     'AdminTiket\ProfilController@editProfil')->name('admintiket.user.edit.profil');
        Route::post('/edit-email',      'AdminTiket\ProfilController@editEmail')->name('admintiket.user.edit.email');
        Route::post('/edit-username',   'AdminTiket\ProfilController@editUsername')->name('admintiket.user.edit.username');
        Route::post('/edit-password',   'AdminTiket\ProfilController@editPassword')->name('admintiket.user.edit.password');
    });

    Route::prefix('tiket-member')->group(function () {
        Route::get('/',                         'AdminTiket\TiketController@index')->name('admintiket.tiket.member');
        Route::post('/tambah',                  'AdminTiket\TiketController@generateTiket')->name('admintiket.tiket.member.tambah');
        Route::post('/importcsv',               'AdminTiket\TiketController@import')->name('admintiket.tiket.member.importcsv');
        Route::get('/delete/{id}',              'AdminTiket\TiketController@delete')->name('admintiket.tiket.member.delete');
        Route::get('/print/{id}',               'AdminTiket\TiketController@printTiket')->name('admintiket.tiket.member.print');
        Route::get('/data-member',              'AdminTiket\TiketController@dataMember')->name('admintiket.tiket.member.data');
        Route::get('/data-member/{id}/edit',    'AdminTiket\TiketController@dataMemberEdit')->name('admintiket.tiket.member.data.edit');
        Route::get('/download',                 'AdminTiket\TiketController@download')->name('admintiket.tiket.member.download');
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
        Route::get('/kelola/{id}',  'AdminSimulasi\SimulasiController@kelola')->name('adminsimulasi.simulasi.kelola');
        Route::group(['prefix' => 'kelola/{id}'], function(){
            Route::get('/',                         'AdminSimulasi\SimulasiController@kelola')->name('adminsimulasi.simulasi.kelola');
            Route::get('/publish',                  'AdminSimulasi\SimulasiController@publish')->name('adminsimulasi.simulasi.kelola.publish');
            Route::get('/peserta',                  'AdminSimulasi\SimulasiController@peserta')->name('adminsimulasi.simulasi.kelola.peserta');
            Route::get('/delete',                   'AdminSimulasi\SimulasiController@deleteSimulasi')->name('adminsimulasi.simulasi.kelola.delete');
            Route::get('/agenda/form/{idAgenda?}',  'AdminSimulasi\SimulasiController@agendaForm')->name('adminsimulasi.simulasi.kelola.agenda.form');
            Route::post('/agenda/post/{idAgenda?}', 'AdminSimulasi\SimulasiController@agendaPost')->name('adminsimulasi.simulasi.kelola.agenda.post');
            Route::get('/agenda/delete/{idAgenda?}','AdminSimulasi\SimulasiController@agendaDelete')->name('adminsimulasi.simulasi.kelola.agenda.delete');
            Route::get('/ruang/form/{idAgenda?}',   'AdminSimulasi\SimulasiController@ruangForm')->name('adminsimulasi.simulasi.kelola.ruang.form');
            Route::post('/ruang/post/{idAgenda?}',  'AdminSimulasi\SimulasiController@ruangPost')->name('adminsimulasi.simulasi.kelola.ruang.post');
            Route::get('/ruang/delete/{idAgenda?}', 'AdminSimulasi\SimulasiController@ruangDelete')->name('adminsimulasi.simulasi.kelola.ruang.delete');
        });
    });
});


/*--------------------------------------------------------------------------
MEMBER
-------------------------------------------------------------------------*/
Route::group(['middleware' => 'member', 'prefix' => 'member'], function(){
    Route::get('/', 'Member\HomeController@index')->name('member');

    Route::group(['prefix' => 'profil'], function(){
        Route::get('/edit',             'Member\ProfilController@edit')->name('member.profil.edit');
        Route::post('/edit-tiket',      'Member\ProfilController@editTiket')->name('member.profil.edit.tiket');
        Route::post('/edit-profil',     'Member\ProfilController@editProfil')->name('member.profil.edit.profil');
        Route::post('/edit-email',      'Member\ProfilController@editEmail')->name('member.profil.edit.email');
        Route::post('/edit-username',   'Member\ProfilController@editUsername')->name('member.profil.edit.username');
        Route::post('/edit-password',   'Member\ProfilController@editPassword')->name('member.profil.edit.password');
        Route::get('/photo',            'Member\ProfilController@photo')->name('member.profil.photo');
        Route::post('/photo',           'Member\ProfilController@uploadPhoto')->name('member.profil.photo.post');
    });

    Route::group(['prefix' => 'grup-chat'], function(){
        Route::get('/',             'Member\GrupChatController@index')->name('member.grupchat');
        Route::get('/join/wa',      'Member\GrupChatController@joinWa')->name('member.grupchat.join.wa');
        Route::get('/join/line',    'Member\GrupChatController@joinLine')->name('member.grupchat.join.line');
    });

    Route::group(['prefix' => 'informasi'], function(){
        Route::get('/',             'Member\InformasiController@index')->name('member.informasi');
        Route::get('/p/{id}',       'Member\InformasiController@view')->name('member.informasi.view');
    });

    Route::group(['prefix' => 'passinggrade'], function(){
        Route::get('/',             'Member\InformasiController@passGrade')->name('member.passgrade');
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
    });

    Route::group(['prefix' => 'simulasi'], function(){
        Route::get('/',                 'Member\SimulasiController@index')->name('member.simulasi');
        Route::get('/register/{id}',    'Member\SimulasiController@register')->name('member.simulasi.register');
        Route::post('/register/{id}',   'Member\SimulasiController@registerPost')->name('member.simulasi.register.post');
        Route::get('/o/{id}',           'Member\SimulasiController@open')->name('member.simulasi.open');
    });

});


//AJAX

Route::group(['prefix' => 'ajax'], function(){
    Route::group(['prefix' => 'pustaka'], function(){
        Route::get('/create-ujian',  'AJAXController@createUjian')->name('ajax.pustaka.create.ujian');
    });
    Route::get('/universitas/{id?}',  'AJAXController@universitas')->name('ajax.universitas');
});
