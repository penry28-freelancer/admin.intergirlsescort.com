<?php

use App\Http\Controllers\FE\v1\AdvertiseController;
use App\Http\Controllers\FE\v1\ClubController;
use App\Http\Controllers\FE\v1\ContactController;
use App\Http\Controllers\FE\v1\CountryGroupController;
use App\Http\Controllers\FE\v1\CreateAccountController;
use App\Http\Controllers\FE\v1\EditAccountController;
use App\Http\Controllers\FE\v1\EscortAgencyController;
use App\Http\Controllers\FE\v1\FaqController;
use App\Http\Controllers\FE\v1\ReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'as' => 'apife.user.'], function () {
    Route::group(['middleware' => ['auth:client-api', 'scopes:client']], function () {
        Route::get('/', [CreateAccountController::class, 'info'])->name('info');
        Route::post('/edit', [EditAccountController::class, 'update'])->name('update');
    });
    Route::post('create-account', [CreateAccountController::class, 'store'])->name('create-account');
    Route::get('approval/{token}', [CreateAccountController::class, 'approve'])->name('approval');
});

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
