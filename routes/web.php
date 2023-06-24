<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
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

Route::prefix('cms')->as('cms.')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('login',  'cmsLogin')->name('login');
        Route::post('login', 'cmsLoginForm')->name('login-form');
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(AdminHomeController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
        });

        Route::controller(CategoryController::class)->prefix('categories')->as('categories.')->group(function () {
            Route::get('/',                   'index')->name('index');
            Route::get('/create',             'create')->name('create');
            Route::post('/store',             'store')->name('store');
            Route::get('/{category}/edit',    'edit')->name('edit');
            Route::post('/{category}/update', 'update')->name('update');
        });

        Route::controller(ColorController::class)->prefix('colors')->as('colors.')->group(function () {
            Route::get('/',                'index')->name('index');
            Route::get('/create',          'create')->name('create');
            Route::post('/store',          'store')->name('store');
            Route::get('/{color}/edit',    'edit')->name('edit');
            Route::post('/{color}/update', 'update')->name('update');
        });

        Route::controller(ProductController::class)->prefix('products')->as('products.')->group(function () {
            Route::get('/',                  'index')->name('index');
            Route::get('/create',            'create')->name('create');
            Route::post('/store',            'store')->name('store');
            Route::get('/{product}/edit',    'edit')->name('edit');
            Route::post('/{product}/update', 'update')->name('update');
        });
    });
});
