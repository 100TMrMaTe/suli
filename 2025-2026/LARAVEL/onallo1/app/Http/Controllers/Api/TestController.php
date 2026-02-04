<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    function index() {
        return response()->json(['message' => 'API is working!', 'status' => 200]);
    }
}
