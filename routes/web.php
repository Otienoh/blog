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

Route::get('/', 'BlogController@index')->name('blog.index');

Auth::routes(['register' => true]);

Route::prefix('blog')->group(function () {
    Route::middleware('Canvas\Http\Middleware\ViewThrottle')->get('/{slug}', 'BlogController@post')->name('blog.post');
    Route::get('/tag/{slug}', 'BlogController@tag')->name('blog.tag');
});
