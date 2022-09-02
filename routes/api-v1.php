<?php

include('backend/Auth.php');
include('backend/TestApi.php');

\Route::group(['middleware' => 'auth:api'], function() {
    // Admin Routes
    \Route::group(['prefix' => 'admin', 'as.' => 'admin'], function() {
        // CategoryGroup Routes
        \Route::apiResource('user', 'UserController');
        \Route::post('user/{user}/update-password', 'UserController@updatePassword')->name('user.updatePassword');
    });

    // Location
    \Route::group(['prefix' => 'location', 'as.' => 'location'], function() {
        // Country Group Routes
        \Route::apiResource('country-group', 'CountryGroupController');
        // Country Routes
        \Route::apiResource('country', 'CountryController');
        // City Routes
        \Route::apiResource('city', 'CityController');
    });

    // Escort
    \Route::group(['prefix' => 'escort', 'as.' => 'escort'], function() {
        // Service Routes
        \Route::apiResource('service', 'ServiceController');
    });

    // Utilities
    \Route::group(['prefix' => 'utility', 'as.' => 'utility'], function() {
        // Faq Routes
        \Route::apiResource('faq', 'FaqController');
    });

    // Support
    \Route::group(['prefix' => 'support', 'as.' => 'support'], function() {
        // Review Routes
        \Route::apiResource('review', 'ReviewController');
    });
});
