<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\VisiMisiController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\PrivacyPoliceController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::group(['as' => 'home.', 'prefix' => 'home'], function () {
    Route::get('/quick-win', [HomeController::class, 'quick_win'])->name('quick-wins.index');
    Route::get('/dimensi', [HomeController::class, 'dimensi'])->name('dimensi.index');
    Route::get('/regulasi', [HomeController::class, 'regulasi'])->name('regulasis.index');
    Route::get('/document', [HomeController::class, 'document'])->name('documents.index');
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('visi-misis.index');
    Route::get('/peta-administrasi', [HomeController::class, 'maps'])->name('maps.index');
    Route::get('/{layanan}/layanan', [HomeController::class, 'detail_layanan'])->name('layanans.index');
    Route::get('/news', [BeritaController::class, 'index'])->name('news.index');
    Route::get('/news/{slug}/detail', [BeritaController::class, 'detail_berita'])->name('news.detail');
    Route::post('/news/add-view', [BeritaController::class, 'addView'])->name('news.add-view');
    Route::get('/privacy-police', [PrivacyPoliceController::class, 'index'])->name('privacys.index');
    Route::feeds();
});
require __DIR__ . '/auth.php';
