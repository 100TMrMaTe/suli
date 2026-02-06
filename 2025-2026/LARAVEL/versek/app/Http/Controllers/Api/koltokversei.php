<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mysqli;
use Illuminate\Support\Facades\DB;
use Soap\Url;

class koltokversei extends Controller
{
    function index(request $request, $id)
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

        $sql = "SELECT 
                        k.id AS kolto_id,
                        k.nev,
                        k.szuletesi_datum,
                        k.szuletesi_hely,
                        k.halalozi_datum,
                        k.halalozi_hely,
                        k.eletrajz,

                        v.id AS vers_id,
                        v.cim AS vers_cim,
                        v.megjelenes_eve,
                        m.megnevezes AS mufaj,

                        GROUP_CONCAT(
                            CONCAT(vs.sorszam, '. ', vs.tartalom)
                            ORDER BY vs.sorszam
                            SEPARATOR '\n\n'
                        ) AS vers_szoveg

                    FROM koltok k
                    LEFT JOIN versek v ON v.kolto_id = k.id
                    LEFT JOIN mufajok m ON m.id = v.mufaj_id
                    LEFT JOIN versszakok vs ON vs.vers_id = v.id

                    WHERE k.id = $id
                    GROUP BY v.id;";

        $result = mysqli_query($conn, $sql);

        $kolto = null;
        $versek = [];

        while ($row = mysqli_fetch_assoc($result)) {
            if (!$kolto) {
                $kolto = [
                    'id' => $row['kolto_id'],
                    'nev' => $row['nev'],
                    'szuletesi_datum' => $row['szuletesi_datum'],
                    'szuletesi_hely' => $row['szuletesi_hely'],
                    'halalozi_datum' => $row['halalozi_datum'],
                    'halalozi_hely' => $row['halalozi_hely'],
                    'eletrajz' => $row['eletrajz']
                ];
            }

            if ($row['vers_id']) {
                $versek[] = [
                    'id' => $row['vers_id'],
                    'cim' => $row['vers_cim'],
                    'megjelenes_eve' => $row['megjelenes_eve'],
                    'mufaj' => $row['mufaj'],
                    'szoveg' => $row['vers_szoveg']
                ];
            }
        }
        mysqli_close($conn);
        return response()->json([
            'kolto' => $kolto,
            'versek' => $versek
        ]);
    }
}
