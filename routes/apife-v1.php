<?php


use App\Http\Controllers\FE\v1\CreateAccountController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'as' => 'apife.user.'], function () {
    Route::post('create-account', [CreateAccountController::class, 'store'])->name('create-account');
    Route::get('approval/{token}', [CreateAccountController::class, 'approve'])->name('approval');
});
