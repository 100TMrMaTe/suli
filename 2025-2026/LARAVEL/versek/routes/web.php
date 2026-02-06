<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/elsooldal', function () {
    return view('elsooldal');
});

Route::get('/koltok', function () {
    return view('koltok');
});

Route::get('/koltokversei/{id}', function ($id) {
    return view('koltokversei', ['id' => $id]);
});

Route::get('/koltokeszit', function () {
    return view('koltokeszit');
});