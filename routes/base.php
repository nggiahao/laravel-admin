<?php

Route::group([
    'namespace' => 'Tessa\Admin\Http\Controllers',
    'middleware' => ['web'],
    'prefix'     => 'admin',
],
function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.auth.login');
    Route::post('login', 'Auth\LoginController@login');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.auth.register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');

    Route::group([
        'middleware' => ['auth.admin']
    ], function () {

        Route::post('logout', 'Auth\LoginController@logout')->name('admin.auth.logout');

        Route::get('/', function () {
            return view(admin_view('dashboard'));
        })->name('admin');
    });
});