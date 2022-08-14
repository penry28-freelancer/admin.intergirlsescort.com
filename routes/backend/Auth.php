<?php

\Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
    \Route::post('login', 'Auth\AuthController@login')->name('login');
    \Route::post('forgot-password', 'Auth\AuthController@forgotPassword')->name('forgotPassword');
    \Route::patch('reset-password', 'Auth\AuthController@resetPassword')->name('resetPassword');
    \Route::get('user', 'Auth\AuthController@getUserAuth')->name('auth.user');
    \Route::post('logout', 'Auth\AuthController@logout')->name('auth.logout');
});
