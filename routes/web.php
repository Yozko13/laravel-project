<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Web\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('cms')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('login', 'cmsLogin')->name('cms.login');
        Route::post('login', 'cmsLoginForm')->name('cms.login-form');
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(AdminHomeController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('cms.dashboard');
        });

        Route::controller(CategoriesController::class)->group(function () {
            Route::get('/categories', 'index')->name('cms.categories.index');
        });
    });
});
