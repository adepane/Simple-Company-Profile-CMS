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

Route::get('/', 'HomeController@index');

Route::get('/hubungi', 'HomeController@showContactUs');
Route::post('/hubungi', 'HomeController@kirimPesan')->name('home.kirimPesan');

Route::get('/p/{slug}', 'HomeController@showPage')->name('home.showPage');

Route::get('/berita', 'HomeController@listPost')->name('home.listPost');
Route::get('/berita/{id}-{post}', 'HomeController@showPost')->name('home.showPost');

Route::get('/tag/{slug}', 'HomeController@showTags')->name('home.showTags');
Route::get('/topik/{slug}', 'HomeController@showCategories')->name('home.showCategories');

Route::get('/agenda', 'HomeController@listAgenda')->name('home.listAgenda');
Route::get('/agenda/{id}/{slug}', 'HomeController@showAgenda')->name('home.showAgenda');

Route::get('/pengumuman', 'HomeController@listPengumuman')->name('home.listPengumuman');
Route::get('/pengumuman/{id}/{slug}', 'HomeController@showPengumuman')->name('home.showPengumuman');

Route::get('/galeri', 'HomeController@listGallery')->name('home.listGallery');
Route::get('/galeri/{id}', 'HomeController@showGallery')->name('home.showGallery');

Route::get('/search', 'HomeController@showSearch');

Auth::routes();
Route::group(['prefix' => 'panelroom'], function () {
    Route::get('/','DashboardController@index');
    Route::post('berita/addTags', 'BeritaController@addTags')->name('berita.addTags');

    Route::post('quickdraft', 'BeritaController@quickDraft')->name('berita.quickDraft');
    
    Route::resource('berita', 'BeritaController');
    Route::resource('kategori', 'KategoriController');
    Route::resource('tag', 'TagController');
    Route::resource('halaman', 'HalamanController');
    
    Route::get('media/modal', 'MediaController@modalshow')->name('media.modal');
    Route::get('media/modal-gallery', 'MediaController@modalShowGallery')->name('media.modal_gallery');
    Route::match(['post', 'patch'], 'media/ajaxstore', 'MediaController@ajaxStore')->name('media.ajaxstore');
    Route::resource('media', 'MediaController');
    
    Route::get('pdf/modal', 'PdfController@modalshow')->name('pdf.modal');
    Route::post('pdf/ajaxstore', 'PdfController@ajaxStore')->name('pdf.ajaxstore');
    Route::resource('pdf', 'PdfController');

    Route::resource('menu', 'LayoutController');

    Route::post('dmenu/reorder', 'MenuController@reOrder')->name('dmenu.reorder');
    Route::resource('dmenu', 'MenuController');

    Route::get('agenda/getAgenda', 'AgendaController@getAgenda');
    Route::resource('agenda', 'AgendaController');

    Route::resource('slider', 'SliderController');
    Route::resource('users', 'UsersController');
    Route::resource('pengumuman', 'PengumumanController');
    Route::resource('pesan', 'PesanController');
    Route::resource('gallery', 'GalleryController');
    Route::resource('iklan', 'IklanController');
    Route::delete('setting/deleted', 'SettingController@deleted')->name('setting.deleted');
    Route::resource('setting', 'SettingController');
});
Route::get('/panelroom', 'DashboardController@index')->name('dashboard');

// Route::get('/home', 'HomeController@index')->name('home');

