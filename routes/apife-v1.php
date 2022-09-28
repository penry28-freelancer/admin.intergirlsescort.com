<?php

use App\Http\Controllers\FE\v1\AdvertiseController;
use App\Http\Controllers\FE\v1\ContactController;
use App\Http\Controllers\FE\v1\CountryGroupController;
use App\Http\Controllers\FE\v1\CreateAccountController;
use App\Http\Controllers\FE\v1\EditAccountController;
use App\Http\Controllers\FE\v1\EscortAgencyController;
use App\Http\Controllers\FE\v1\FaqController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'as' => 'apife.user.'], function () {
    Route::group(['middleware' => ['auth:client-api', 'scopes:client']], function () {
        Route::get('/', [CreateAccountController::class, 'info'])->name('info');
        Route::post('/edit', [EditAccountController::class, 'update'])->name('update');
    });
    Route::post('create-account', [CreateAccountController::class, 'store'])->name('create-account');
    Route::get('approval/{token}', [CreateAccountController::class, 'approve'])->name('approval');
});

Route::get('escort-agencies', [EscortAgencyController::class, 'index'])->name('apife.escort-agencies');
// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('apife.faq');

// Form Contact
Route::post('/contact', [ContactController::class, 'store'])->name('apife.contact');

// Form Contact
Route::get('/free-advertising', [AdvertiseController::class, 'index'])->name('free-advertising');

// Country Group
Route::get('/country-groups-sidebar', [CountryGroupController::class, 'getListOnSidebar'])->name('country-groups-on-sidebar');
