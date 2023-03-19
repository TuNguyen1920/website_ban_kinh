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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::get('errors-403', function() {
    return view('errors.403');
});


Route::group(['namespace' => 'Page'], function() {

    Route::group(['namespace' => 'Auth'], function() {
        Route::get('/user/account', 'LoginController@login')->name('page.user.account');
        Route::post('/account/login', 'LoginController@postLogin')->name('account.login');
        Route::post('/register/account', 'RegisterController@postRegister')->name('account.register');
        Route::get('/logout', 'LoginController@logout')->name('page.user.logout');
        Route::get('/forgot/password', 'ForgotPasswordController@forgotPassword')->name('page.user.forgot.password');
    });

    Route::get('/', 'HomeController@index')->name('page.home');

});

