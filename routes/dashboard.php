<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('locale/{locale}', 'LocaleController@update')->name('locale')->where('locale', '(ar|en)');

Route::resource('users', 'UserController');

Route::prefix('settings')
    ->name('settings.')
    ->group(
        function () {
            Route::get('/', 'SettingsController@index')->name('index');
            Route::put('update', 'SettingsController@update')->name('update');
        }
    );
