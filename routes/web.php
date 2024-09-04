<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

// Route cho trang soạn thảo
Route::get('/soanthao', function () {
    return view('CDN');
});

// Route để upload hình ảnh
Route::post('/upload-image', [ArticleController::class, 'uploadImage'])->name('upload-image');

// Route cho header (để test)
Route::get('/header', function () {
    return view('header');
});

// Route để lưu bài báo
Route::post('/save-article', [ArticleController::class, 'store'])->name('save-article');

// Route để hiển thị danh sách bài báo và chi tiết bài báo
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tìm kiếm
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Kiểm tra record nào có dữ liệu vượt quá 10.000
Route::get('/check-content-length', [ArticleController::class, 'checkContentLength']);

// Route cho admin
Route::prefix('admin')->group(function () {
    Route::get('/articles', [AdminController::class, 'index'])->name('admin.articles.index');
    Route::get('/articles/{id}/edit', [AdminController::class, 'edit'])->name('admin.articles.edit');
    Route::put('/articles/{id}', [AdminController::class, 'update'])->name('admin.articles.update');
    Route::delete('/articles/{id}', [AdminController::class, 'destroy'])->name('admin.articles.destroy');
});

// Route cho đăng nhập bằng Google
Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

// Route cho đăng nhập, đăng ký và đăng xuất
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
