<?php

use App\Http\Controllers\FE\v1\AccountSettingController;
use App\Http\Controllers\FE\v1\AdvertiseController;
use App\Http\Controllers\FE\v1\BlacklistController;
use App\Http\Controllers\FE\v1\BoyTransEscortController;
use App\Http\Controllers\FE\v1\ClubController;
use App\Http\Controllers\FE\v1\ContactController;
use App\Http\Controllers\FE\v1\CountryGroupController;
use App\Http\Controllers\FE\v1\CreateAccountController;
use App\Http\Controllers\FE\v1\CreateEscortController;
use App\Http\Controllers\FE\v1\EditAccountController;
use App\Http\Controllers\FE\v1\EscortAgencyController;
use App\Http\Controllers\FE\v1\EscortController;
use App\Http\Controllers\FE\v1\FaqController;
use App\Http\Controllers\FE\v1\GirlEscortController;
use App\Http\Controllers\FE\v1\PornstarEscortController;
use App\Http\Controllers\FE\v1\ReviewEscortController;
use App\Http\Controllers\FE\v1\SearchEscortController;
use App\Http\Controllers\FE\v1\TourEscortController;
use App\Http\Controllers\FE\v1\UpdateEscortController;
use App\Http\Controllers\FE\v1\VideoEscortController;
use App\Http\Controllers\FE\v1\VIPEscortController;
use App\Http\Controllers\FE\v1\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/vip-escorts', [VIPEscortController::class, 'index'])->name('apife.vip-escorts');
Route::get('/girl-escorts', [GirlEscortController::class, 'index'])->name('apife.girl-escorts');
Route::get('/porn-escorts', [PornstarEscortController::class, 'index'])->name('apife.pornstars-escorts');
Route::get('/boytrans-escorts', [BoyTransEscortController::class, 'index'])->name('apife.boytrans-escorts');
Route::get('/tour-escorts', [TourEscortController::class, 'index'])->name('apife.tour-escorts');
Route::get('/review-escorts', [ReviewEscortController::class, 'index'])->name('apife.review-escorts');
Route::get('/video-escorts', [VideoEscortController::class, 'index'])->name('apife.video-escorts');

Route::group(['prefix' => 'black-list'], function() {
    Route::get('escort', [BlacklistController::class, 'escort'])->name('apife.blacklist.escorts');
    Route::get('agency', [BlacklistController::class, 'agency'])->name('apife.blacklist.agency');
    Route::get('client', [BlacklistController::class, 'client'])->name('apife.blacklist.client');
});

Route::get('/escort/search', [SearchEscortController::class, 'search'])->name('apife.search');

Route::group(['prefix' => 'user', 'as' => 'apife.user.'], function () {
    Route::group(['middleware' => ['auth:client-api', 'scopes:client']], function () {
        Route::get('/', [CreateAccountController::class, 'info'])->name('info');
        Route::post('/edit', [EditAccountController::class, 'update'])->name('update');
        Route::post('/account-setting', [AccountSettingController::class, 'update'])->name('account-setting');
        Route::post('edit', [EditAccountController::class, 'update'])->name('update');
        Route::post('account-setting', [AccountSettingController::class, 'update'])->name('account-setting');

        Route::group(['prefix' => 'create-escort', 'as' => 'create-escort.'], function () {
            Route::post('about', [CreateEscortController::class, 'about'])->name('about');
            Route::post('rates', [CreateEscortController::class, 'rates'])->name('rates');
            Route::post('gallery', [CreateEscortController::class, 'gallery'])->name('gallery');
            Route::post('services', [CreateEscortController::class, 'services'])->name('services');
            Route::post('working', [CreateEscortController::class, 'working'])->name('working');
        });

        Route::group(['prefix' => 'update-escort', 'as' => 'update-escort.'], function () {
            Route::put('/{id}/about', [UpdateEscortController::class, 'about'])->name('about');
            Route::put('/{id}/rates', [UpdateEscortController::class, 'rates'])->name('rates');
            Route::post('/{id}/gallery', [UpdateEscortController::class, 'gallery'])->name('gallery');
            Route::put('/{id}/services', [UpdateEscortController::class, 'services'])->name('services');
            Route::put('/{id}/working', [UpdateEscortController::class, 'working'])->name('working');
        });
        Route::get('logout', [CreateAccountController::class, 'logout'])->name('logout-account');
    });

    Route::post('create-account', [CreateAccountController::class, 'store'])->name('create-account');
    Route::post('login', [CreateAccountController::class, 'login'])->name('login-account');
    Route::post('approval', [CreateAccountController::class, 'approve'])->name('approval');
    Route::post('remind-password', [CreateAccountController::class, 'remindPassword'])->name('remind-password');
    Route::post('set-password', [CreateAccountController::class, 'setPassword'])->name('set-password');
});

Route::get('/escort/{id}', [EscortController::class, 'show'])->name('escort-detail');

Route::group(['prefix' => 'escort-agencies', 'as' => 'apife.escort-agencies.'], function () {
    Route::get('/', [EscortAgencyController::class, 'index'])->name('index');
    Route::get('/{agency}', [EscortAgencyController::class, 'show'])->name('show');
});

// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('apife.faq');

// Form Contact
Route::post('/contact', [ContactController::class, 'store'])->name('apife.contact');

// Advertising
// Escort
Route::post('/escort/edit/{id}', 'EscortController@updateAbout')->name('escort.update.about');
// Form Contact
Route::get('/free-advertising', [AdvertiseController::class, 'index'])->name('free-advertising');

// Country Group
Route::get('/country-groups-sidebar', [CountryGroupController::class, 'getListOnSidebar'])->name('country-groups-on-sidebar');

// Club
Route::get('/clubs', [ClubController::class, 'index'])->name('clubs.index');
Route::get('/clubs/{id}', [ClubController::class, 'show'])->where('id',  '[0-9]+')->name('clubs.show');

// Report
Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');

// Country
Route::get('country/list/all', 'CountryController@getAll');

// City
Route::get('city/get-cities-by-country/{id}', 'CityController@getByCountry');
