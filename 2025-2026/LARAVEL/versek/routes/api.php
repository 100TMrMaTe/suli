<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Api\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\koltok;

Route::get('/test', [TestController::class, 'index']);

Route::get('/koltok', [\App\Http\Controllers\Api\koltok::class, 'index']);

route::post('/koltokversei/{id}', [\App\Http\Controllers\Api\koltokversei::class, 'index']);

route::post('/koltokeszit', [\App\Http\Controllers\Api\koltokeszit::class, 'index']);