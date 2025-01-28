<?php

use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {

    // Grouping Authentication API Features
    include __DIR__.'/features/authentication.php';
});
