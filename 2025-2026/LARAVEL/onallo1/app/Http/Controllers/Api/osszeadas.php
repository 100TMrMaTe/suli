<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class osszeadas extends Controller
{
    function index(Request $request) {
        return response()->json(['elso' => $request->elso, 'masodik' => $request->masodik, 'osszeg' => $request->elso + $request->masodik, 'status' => 200]);
    }
}
