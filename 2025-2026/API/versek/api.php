<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "magyar_irodalom";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$apiParts = explode("/", $_GET["path"]);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($apiParts[0] == "versek") {
        if (isset($apiParts[1]) && is_numeric($apiParts[1])) {
            $database = intval($apiParts[1]);

            $query = "SELECT v.id AS vers_id, v.cim, v.megjelenes_eve, k.nev AS kolto_nev, m.megnevezes AS mufaj, GROUP_CONCAT(vs.tartalom ORDER BY vs.sorszam SEPARATOR '\n') AS versszakok FROM versek v JOIN koltok k ON v.kolto_id = k.id LEFT JOIN mufajok m ON v.mufaj_id = m.id LEFT JOIN versszakok vs ON vs.vers_id = v.id GROUP BY v.id ORDER BY RAND() LIMIT $database";
        } else {

            $query = "SELECT  v.id AS vers_id, v.cim, v.megjelenes_eve, k.nev AS kolto_nev, m.megnevezes AS mufaj, GROUP_CONCAT(vs.tartalom ORDER BY vs.sorszam SEPARATOR '\n') AS versszakok FROM versek v JOIN koltok k ON v.kolto_id = k.id LEFT JOIN mufajok m ON v.mufaj_id = m.id LEFT JOIN versszakok vs ON vs.vers_id = v.id GROUP BY v.id ORDER BY RAND() LIMIT 1";
        }
    } elseif ($apiParts[0] == "vers" && isset($apiParts[1]) && is_numeric($apiParts[1])) {
        $id = intval($apiParts[1]);

        $query = "SELECT versek.*, koltok.* FROM versek JOIN koltok ON versek.kolto_id = koltok.id WHERE versek.id = $id";


        $query = "SELECT  v.id AS vers_id, v.cim, v.megjelenes_eve, k.nev AS kolto_nev, m.megnevezes AS mufaj, GROUP_CONCAT(vs.tartalom ORDER BY vs.sorszam SEPARATOR '\n') AS versszakok FROM versek v JOIN koltok k ON v.kolto_id = k.id LEFT JOIN mufajok m ON v.mufaj_id = m.id LEFT JOIN versszakok vs ON vs.vers_id = v.id WHERE v.id = $id GROUP BY v.id";
    } elseif ($apiParts[0] == "kolto") {
        if (isset($apiParts[1]) && is_numeric($apiParts[1])) {
            $id = intval($apiParts[1]);

            $query = "SELECT koltok.*, GROUP_CONCAT(versek.cim SEPARATOR ', ') AS versek_cimei FROM koltok LEFT JOIN versek ON koltok.id = versek.kolto_id WHERE koltok.id = $id GROUP BY koltok.id";
        } else {
            $query = "SELECT * FROM koltok";
        }
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Not Found"]);
        exit();
    }

    $result = mysqli_query($conn, $query);
    $data = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    echo json_encode($data);
}
mysqli_close($conn);
