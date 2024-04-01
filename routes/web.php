<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;
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

/**
 * Auth routes
 */
Route::post('auth/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('auth/logout', [LogoutController::class, 'logout'])->name('auth.logout');

/**
 * Async routes
 */
Route::group(['prefix' => 'async', 'as' => 'async.'], function () {
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::patch('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('technologies', [TechnologyController::class, 'index'])->name('technologies.index');
});

/**
 * Default app route
 */
Route::any('{all}', fn () => view('page'))->where(['all' => '.*']);
