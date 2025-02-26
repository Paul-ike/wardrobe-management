<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "<h1>Test Page - If you see this, Blade has issues</h1>";
});
