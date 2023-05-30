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

Route::get('/', function () {
    return redirect(url('auth/login'));
});
Route::prefix('dashboard')->namespace('Dashboard')
    ->middleware(['auth', 'role'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
    });
Route::prefix('auth')
    ->namespace('Auth')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('login');
        })->middleware(['guest']);

        Route::prefix('/login')
            ->middleware(['guest'])
            ->group(function () {
                Route::get('/', 'LoginController@index')->name('login');
                Route::post('/check', 'LoginController@authenticate')->name('authenticate');
                Route::post('/forgot', 'LoginController@forgot')->name('forgot');
            });

        Route::get('/logout', 'LoginController@logout')->name('logout');
    });
Route::prefix('system')
    ->namespace('System')
    ->middleware(['auth', 'role'])
    ->group(function () {
        Route::prefix('/menu')->group(function () {
            Route::get('/', 'MenuController@index')->name('system-menu');
            Route::post('/datatable', 'MenuController@datatable')->name('system-menu-datatable');
            Route::get('/source', 'MenuController@source')->name('system-menu-source');
            Route::get('/mapper', 'MenuController@mapper')->name('system-menu-mapper');
            Route::post('/map', 'MenuController@map')->name('system-menu-map');
            Route::post('/store', 'MenuController@store')->name('system-menu-store');
            Route::delete('/remove', 'MenuController@destroy')->name('system-menu-remove');
            Route::post('/role', 'MenuController@role')->name('system-menu-role');
        });

        Route::prefix('/role')->group(function () {
            Route::get('/', 'RoleController@index')->name('system-role');
            Route::post('/datatable', 'RoleController@datatable')->name('system-role-datatable');
            Route::post('/store', 'RoleController@store')->name('system-role-store');
            Route::delete('/remove', 'RoleController@destroy')->name('system-role-remove');
        });

        Route::prefix('/user')->group(function () {
            Route::get('/', 'UserController@index')->name('system-user');
            Route::post('/datatable', 'UserController@datatable')->name('system-user-datatable');
            Route::post('/store', 'UserController@store')->name('system-user-store');
            Route::delete('/remove', 'UserController@destroy')->name('system-user-remove');
            Route::post('/password', 'UserController@password')->name('system-user-password');
        });

        Route::prefix('/feature')->group(function () {
            Route::get('/', 'FeatureController@index')->name('system-feature');
            Route::get('/source/{role}', 'FeatureController@source')->name('system-feature-source');
            Route::post('/map', 'FeatureController@map')->name('system-feature-map');
        });
    });
