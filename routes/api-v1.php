<?php

use Illuminate\Support\Facades\Route;

include('backend/Auth.php');
include('backend/TestApi.php');

Route::group(['middleware' => 'auth:api'], function() {
    // Admin Routes
    Route::group(['prefix' => 'admin', 'as.' => 'admin'], function() {
        // CategoryGroup Routes
        Route::apiResource('user', 'UserController');
        Route::post('user/{user}/update-password', 'UserController@updatePassword')->name('user.updatePassword');
    });

    // Location
    Route::group(['prefix' => 'location', 'as.' => 'location'], function() {
        // Country Group Routes
        Route::apiResource('country-group', 'CountryGroupController');
        // Country Routes
        Route::apiResource('country', 'CountryController');
        Route::get('country/list/all', 'CountryController@getAll');
        // City Routes
        Route::apiResource('city', 'CityController');
        Route::get('city/get-cities-by-country/{id}', 'CityController@getByCountry');
    });

    // Escort
    Route::group(['prefix' => 'escort', 'as.' => 'escort'], function() {
        // Service Routes
        Route::apiResource('service', 'ServiceController');

        // City Routes
        Route::apiResource('tour', 'TourController');

        // Agency Routes
        Route::apiResource('agency', 'AgencyController');
        Route::get('agency/list/all', 'AgencyController@getAll')->name('agency.get.all');

        // Tour Routes
        Route::apiResource('tour', 'TourController');

        // Club Routes
        Route::apiResource('club', 'ClubController');
    });

    // Utilities
    Route::group(['prefix' => 'utility', 'as.' => 'utility'], function() {
        // Faq Routes
        Route::apiResource('faq', 'FaqController');

        // Page Content Routes
        Route::apiResource('page-content', 'PageContentController');

        // Advertise Routes
        Route::apiResource('advertise', 'AdvertiseController');
    });

    // Support
    Route::group(['prefix' => 'support', 'as.' => 'support'], function() {
        // Escort Review Routes
        Route::apiResource('escort-review', 'EscortReviewController');
        Route::patch('escort-review/{id}/toggle-verify', 'EscortReviewController@toggleVerify')->name('escort-review.toggle-verify');

        // Agency Review Routes
        Route::apiResource('agency-review', 'AgencyReviewController');
        Route::patch('agency-review/{id}/toggle-verify', 'AgencyReviewController@toggleVerify')->name('agency-review.toggle-verify');

        // Contact Routes
        Route::apiResource('contact', 'ContactController');
        Route::patch('contact/{id}/toggle-read', 'ContactController@toggleReadAt')->name('contact.toggle-read');

        // Contact Routes
        Route::apiResource('affilate', 'AffilateController');
    });

    // Support
    Route::group(['prefix' => 'user', 'as.' => 'user'], function() {
        // Agency Routes
        Route::apiResource('agency', 'AgencyController');

        // Club Routes
        Route::apiResource('club', 'ClubController');

        // Member Routes
        Route::apiResource('member', 'MemberController');

        // Escort Routes
        Route::apiResource('escort', 'EscortController');
    });
});
