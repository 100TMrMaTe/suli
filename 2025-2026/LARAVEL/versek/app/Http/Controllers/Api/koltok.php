<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mysqli;
use Illuminate\Support\Facades\DB;

class koltok extends Controller
{
    function index()
    {
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

        $sql = "SELECT id, nev FROM koltok";
        $result = mysqli_query($conn, $sql);

        $koltok = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $koltok[] = [
                "id" => $row["id"],
                "nev" => $row["nev"]
            ];
        }
        return response()->json($koltok);
        mysqli_close($conn);
    }
}
