<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
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
        Route::get('login',  'cmsLogin')->name('cms.login');
        Route::post('login', 'cmsLoginForm')->name('cms.login-form');
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(AdminHomeController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('cms.dashboard');
        });

        Route::controller(CategoryController::class)->prefix('categories')->group(function () {
            Route::get('/',                   'index')->name('cms.categories.index');
            Route::get('/create',             'create')->name('cms.categories.create');
            Route::post('/store',             'store')->name('cms.categories.store');
            Route::get('/{category}/edit',    'edit')->name('cms.categories.edit');
            Route::post('/{category}/update', 'update')->name('cms.categories.update');
        });

        Route::controller(ColorController::class)->prefix('colors')->group(function () {
            Route::get('/',                'index')->name('cms.colors.index');
            Route::get('/create',          'create')->name('cms.colors.create');
            Route::post('/store',          'store')->name('cms.colors.store');
            Route::get('/{color}/edit',    'edit')->name('cms.colors.edit');
            Route::post('/{color}/update', 'update')->name('cms.colors.update');
        });
    });
});
