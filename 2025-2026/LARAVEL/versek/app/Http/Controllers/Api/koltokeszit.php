<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mysqli;
use Illuminate\Support\Facades\DB;

class koltokeszit extends Controller
{
    function index(request $request)
    {
        $nev = $request->input('nev');
        $szuldate = $request->input('szuldate');
        $szulhely = $request->input('szulhely');
        $meghalthely = $request->input('meghalthely');
        $meghaltdate = $request->input('meghaltdate');
        $eletrajz = $request->input('eletrajz');

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "magyar_irodalom";


        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);


        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO `koltok`(`nev`, `szuletesi_datum`, `szuletesi_hely`, `halalozi_datum`, `halalozi_hely`, `eletrajz`)
            VALUES ('$nev','$szuldate','$szulhely','$meghalthely','$meghaltdate','$eletrajz')";

        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "ok"]);
        } else {
            echo json_encode(["status" => "error"]);
        }
    }
}
