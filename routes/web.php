<?php

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
 * Async routes
 */
Route::group(['prefix' => 'async', 'as' => 'async.'], function () {
    Route::get('projects', 'App\Http\Controllers\ProjectController@index')->name('projects.index');
});

/**
 * Default app route
 */
Route::any('{all}', fn () => view('page'))->where(['all' => '.*']);
