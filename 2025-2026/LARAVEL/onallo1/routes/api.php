<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Api\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/test', [TestController::class, 'index']);

Route::post('/osszeadas', [\App\Http\Controllers\Api\osszeadas::class, 'index']);
?>