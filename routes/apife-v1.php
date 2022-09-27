<?php


use App\Http\Controllers\FE\v1\AdvertiseController;
use App\Http\Controllers\FE\v1\ContactController;
use App\Http\Controllers\FE\v1\CreateAccountController;
use App\Http\Controllers\FE\v1\EditAccountController;
use App\Http\Controllers\FE\v1\FaqController;
use Illuminate\Support\Facades\Route;

// User
Route::group(['prefix' => 'user', 'as' => 'apife.user.'], function () {
    Route::group(['middleware' => ['auth:client-api', 'scopes:client']], function () {
        Route::get('/', [CreateAccountController::class, 'info'])->name('info');
        Route::post('/edit', [EditAccountController::class, 'update'])->name('update');
    });
    Route::post('create-account', [CreateAccountController::class, 'store'])->name('create-account');
    Route::get('approval/{token}', [CreateAccountController::class, 'approve'])->name('approval');
    Route::post('remind-password', [CreateAccountController::class, 'remindPassword'])->name('remind-password');
    Route::post('set-password', [CreateAccountController::class, 'setPassword'])->name('set-password');
});

// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('apife.faq');

// Form Contact
Route::post('/contact', [ContactController::class, 'store'])->name('apife.contact');

// Form Contact
Route::get('/free-advertising', [AdvertiseController::class, 'index'])->name('free-advertising');
