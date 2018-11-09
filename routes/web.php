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





//Route::post('/mail_start{$user}', 'OrderController@ship')->name('mail_start');

Route::get('/', function () {
    return view('welcome');
});
// SUPERADMIN
// 
// 
// ZARZĄDZANIE KLIENTAMI
Route::get('/klienci', 'KlientController@klient_list')->name('klienci');
Route::get('/klient_edit/{user_id}', 'KlientController@klient_edit')->name('klient_edit');
Route::post('/klient_save', 'KlientController@klient_save')->name('klient_save');
Route::post('/klient_add', 'KlientController@klient_create')->name('klient_add');
Route::get('/klient_create', function () { return view('admin.klient_create'); })->middleware('auth');

Route::get('/delete/{user_id}', function ($user_id) { return view('admin.delete',['user_id'=>$user_id]); })->name('delete');
Route::post('/delete_user', 'KlientController@delete_user')->name('delete_user')->middleware('auth');

Route::get('/supsend/{user_id}', function ($user_id) { return view('admin.supsend',['user_id'=>$user_id]); })->name('supsend');
Route::post('/supsend_user', 'KlientController@supsend_user')->name('supsend_user');
Route::get('/up_supsend/{user_id}', function ($user_id) { return view('admin.up_supsend',['user_id'=>$user_id]); })->name('up_supsend');
Route::post('/up_supsend_user', 'KlientController@up_supsend')->name('up_supsend_user');
Route::get('/nowe_haslo/{user_id}', 'KlientController@nowe_haslo')->name('nowe_haslo');
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('/szukaj_klienta', 'DodatkiController@szukaj_klienta')->name('szukaj_klienta');
Route::get('/szukaj_nazwa/{nazwa}', 'DodatkiController@szukaj_nazwa')->name('szukaj_nazwa');

//  PANEL KLIENTA  VUE.js
Route::get('/klient_poczta', 'PocztaController@klient_poczta')->name('klient_poczta');
//Route::get('/klient_vue_poczta', 'KlientvueController@klient_vue_poczta')->name('klient_vue_poczta');



// DODAWANIE KOLEJNYCH FIRM 

//Route::get('/dodaj_firme_form/{klient}', function ($klient) { return view('admin.dodaj_firme',['user_id'=>$klient]); })->name('dodaj_firme_form');
Route::get('/dodaj_firme/{klient}', 'FirmyController@dodaj_firme')->name('dodaj_firme');
Route::post('/save_firme', 'FirmyController@save_firme')->name('save_firme');
Route::post('/save_firme_edit', 'FirmyController@save_firme_edit')->name('save_firme_edit');
Route::get('/zawies_firme/{klient}', 'FirmyController@zawies_firme')->name('zawies_firme');
Route::get('/aktywuj_firme/{klient}', 'FirmyController@aktywuj_firme')->name('aktywuj_firme');
Route::get('/usun_firme/{klient}', 'FirmyController@usun_firme')->name('usun_firme');
Route::get('/edit_firme/{klient}', 'FirmyController@edit_firme')->name('edit_firme');

//  ZARZĄDZNIE ADMINISTRATORAMI1
Route::get('/admini', 'AdminController@admin_list')->name('admini');
Route::post('/admin_add', 'AdminController@admin_create')->name('admin_add');
Route::post('/admin_save', 'AdminController@admin_save')->name('admin_save');
Route::get('/admin_create', function () { return view('admin.admin_create'); });
Route::post('/admin_save', 'AdminController@admin_save')->name('admin_save');
Route::get('/admin_edit/{user_id}', 'AdminController@admin_edit')->name('admin_edit');
Route::get('/logi', 'AdminController@logi_edyt')->name('logi');

//  DODAWANIE /USOWANIE DOKUMENTÓw 


Route::get('/add_poczta_widok/{klient}', 'PocztaController@add_poczta_widok')->name('add_poczta_widok');
//Route::get('add_poczta/{klient}', function ($klient) {return view('pages.upload',['klient'=>$klient]); })->name('add_poczta');
Route::post('/zobacz_poczta/{klient}', 'PocztaController@zobacz_poczta')->name('zobacz_poczta');
Route::get('/delete_list/{list}', 'PocztaController@delete_list')->name('usunlist');
Route::get('/podglad_list/{list}', 'PocztaController@podglad_list')->name('podglad_list');
Route::get('/wyslij_nowapoczta/{klient_id}', 'PocztaController@wyslij_nowapoczta')->name('wyslij_nowapoczta');
Route::get('/klient_poczta/{klient_id}{nr_strony}', 'PocztaController@klient_poczta')->name('klient_poczta');
Route::get('/nowa_poczta/{klient_id}', 'PocztaController@nowa_poczta')->name('nowa_poczta');
Route::get('/poczta_wyslana', 'PocztaController@poczta_wyslana')->name('poczta_wyslana');



//  kod odbioru

Route::get('/kod_poczta', function () { return view('klient.kod_odbioru'); })->name('kod_poczta');
Route::get('/kod_odbioru/{klient_id}', 'PocztaController@kod_odbioru')->name('kod_odbioru');
Route::get('/ponowienie_kod_odbioru/{klient_id}', 'PocztaController@ponowienie_kod_odbioru')->name('ponowienie_kod_odbioru');
Route::get('/klient_odbior/{klient_id}', 'AdminController@klient_odbior')->name('klient_odbior');
Route::get('/potwierdzenie_odbior/{id}/{klient_id}', 'AdminController@potwierdzenie_odbior')->name('potwierdzenie_odbior');
Route::get('/kody_lista', 'AdminController@kody_lista')->name('kody_lista');

// dodawanie dokumentów 

Route::get('/addfoto/{user}', ['as' => 'upload', 'uses' => 'ImageController@getUpload']);
Route::post('/upload/{klient}', ['as' => 'upload-post', 'uses' =>'ImageController@postUpload']);
Route::post('/upload/delete', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);

// pomoc
Route::get('kontakt_panel', function () { return view('klient.pomoc_panel'); })->name('kontakt_panel');
Route::post('kontakt_klient', 'DodatkiController@kontakt')->name('kontakt_klient');

// CMS
Route::get('cms_lista', 'CmsController@lista')->name('cms_lista');
Route::get('add_post', function () { return view('cms.add_post'); })->name('add_post');
Route::post('post_save', 'CmsController@post_save')->name('post_save');
Route::get('post_edit/{id}', 'CmsController@post_edit')->name('post_edit');
Route::get('post_delete/{id}', 'CmsController@post_delete')->name('post_delete');

//  KOPIA ZAPASOWA
Route::get('backup_file', 'ZipArchiveController@backup_file')->name('backup_file');


Auth::routes();
Route::get('/login', 'HomeController@index')->name('login');

