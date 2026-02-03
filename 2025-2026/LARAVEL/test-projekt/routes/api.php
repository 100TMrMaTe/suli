<?php

use App\Http\Controllers\Api\TestController;
use Illuminate\Support\Facades\Route;

route::get('/test', [TestController::class, 'index']);