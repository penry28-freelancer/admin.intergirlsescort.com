<?php

use App\Models\User;

Route::get('test-get-user', function() {
    return User::all();
});