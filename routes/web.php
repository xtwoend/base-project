<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Setting\DesignController;
use App\Http\Controllers\Setting\NavigationController;

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

Auth::routes(['register' => false, 'reset' => false]);
Route::group([
    'middleware' => 'auth'
], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group([
        'prefix' => 'setting',
        'as'     => 'setting.'
    ], function(){
        Route::get('/design', [DesignController::class, 'index'])->name('design');
        Route::post('/design/upload', [DesignController::class, 'upload'])->name('design.upload');
        Route::get('/design/{id}/workbench', [DesignController::class, 'workbench'])->name('design.workbench');

        Route::get('/navigation', [NavigationController::class,'index'])->name('navigation');
        Route::get('/navigation/create', [NavigationController::class,'create'])->name('navigation.create');
        Route::post('/navigation', [NavigationController::class,'store'])->name('navigation.store');
        Route::get('/navigation/{id}', [NavigationController::class,'edit'])->name('navigation.edit');
        Route::put('/navigation/{id}', [NavigationController::class,'update'])->name('navigation.update');
        Route::delete('/navigation/{id}', [NavigationController::class,'destroy'])->name('navigation.destroy');
    });
});
