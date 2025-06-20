<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// API ROUTES - manual load dari api.php
if (file_exists(base_path('routes/api.php'))) {
    Route::prefix('api')->group(base_path('routes/api.php'));
}
