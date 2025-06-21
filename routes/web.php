<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/hubungi', [HomeController::class, 'showContactUs']);
Route::post('/hubungi', [HomeController::class, 'kirimPesan'])->name('home.kirimPesan');

Route::get('/p/{slug}', [HomeController::class, 'showPage'])->name('home.showPage');

Route::get('/berita', [HomeController::class, 'listPost'])->name('home.listPost');
Route::get('/berita/{id}-{post}', [HomeController::class, 'showPost'])->name('home.showPost');

Route::get('/tag/{slug}', [HomeController::class, 'showTags'])->name('home.showTags');
Route::get('/topik/{slug}', [HomeController::class, 'showCategories'])->name('home.showCategories');

Route::get('/agenda', [HomeController::class, 'listAgenda'])->name('home.listAgenda');
Route::get('/agenda/{id}/{slug}', [HomeController::class, 'showAgenda'])->name('home.showAgenda');

Route::get('/pengumuman', [HomeController::class, 'listPengumuman'])->name('home.listPengumuman');
Route::get('/pengumuman/{id}/{slug}', [HomeController::class, 'showPengumuman'])->name('home.showPengumuman');

Route::get('/galeri', [HomeController::class, 'listGallery'])->name('home.listGallery');
Route::get('/galeri/{id}', [HomeController::class, 'showGallery'])->name('home.showGallery');

Route::get('/search', [HomeController::class, 'showSearch']);

Auth::routes();
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('post/addTags', [PostController::class, 'addTags'])->name('post.addTags');

    Route::post('quickdraft', [PostController::class, 'quickDraft'])->name('post.quickDraft');

    Route::resource('post', PostController::class);
    Route::resource('kategori', CategoryController::class);
    Route::resource('tag', TagController::class);
    Route::resource('pages', PageController::class);

    Route::get('media/modal', [MediaController::class, 'modalshow'])->name('media.modal');
    Route::get('media/modal-gallery', [MediaController::class, 'modalShowGallery'])->name('media.modal_gallery');
    Route::match(['post', 'patch'], 'media/ajaxstore', [MediaController::class, 'ajaxStore'])->name('media.ajaxstore');
    Route::resource('media', MediaController::class);

    Route::get('pdf/modal', [PdfController::class, 'modalshow'])->name('pdf.modal');
    Route::post('pdf/ajaxstore', [PdfController::class, 'ajaxStore'])->name('pdf.ajaxstore');
    Route::resource('pdf', PdfController::class);

    Route::resource('menu', LayoutController::class);

    Route::post('dmenu/reorder', [MenuController::class, 'reOrder'])->name('dmenu.reorder');
    Route::resource('dmenu', MenuController::class);

    Route::get('agenda/getAgenda', [AgendaController::class, 'getAgenda']);
    Route::resource('agenda', AgendaController::class);

    Route::resource('slider', SliderController::class);
    Route::resource('users', UsersController::class);
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('pesan', PesanController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('iklan', IklanController::class);
    Route::delete('setting/deleted', [SettingController::class, 'deleted'])->name('setting.deleted');
    Route::resource('setting', SettingController::class);
});
Route::get('/panelroom', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/home', 'HomeController@index')->name('home');
