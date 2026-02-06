<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/elsooldal', function () {
    return view('elsooldal');
});
