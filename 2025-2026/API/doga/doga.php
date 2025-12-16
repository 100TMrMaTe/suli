<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cukraszda";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
header("Content-Type: application/json; charset=UTF-8");
mysqli_set_charset($conn, "utf8mb4");

$apiParts = explode("/", $_GET["path"]);

if ($apiParts[0] == "feladat") {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        switch ($apiParts[1]) {
            case "1":
                $query = "SELECT COUNT(id) AS `Hiányzó kalória érték` FROM termek WHERE kaloria IS NULL;";
                $results = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($results)) {
                    $megoldas["info"] = "success";
                    $megoldas["feladat1"] = $row['Hiányzó kalória érték'];
                }
                echo json_encode($megoldas, JSON_UNESCAPED_UNICODE);
                break;

            case "2":
                $query = "SELECT nev, mennyiseg FROM termek INNER JOIN kiszereles ON termek.kiszerelesId = kiszereles.id WHERE mennyiseg LIKE '%g';";
                $results = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($results)) {
                    $megoldas["info"] = "success";
                    $megoldas["feladat2"][] = array(
                        "nev" => $row['nev'],
                        "mennyiseg" => $row['mennyiseg']
                    );
                }
                echo json_encode($megoldas, JSON_UNESCAPED_UNICODE);
                break;

            case "4":
                $query = "SELECT allergen.nev, COUNT(*) AS 'termék szám' FROM allergen INNER JOIN allergeninfo ON allergeninfo.allergenId = allergen.id GROUP BY allergen.nev ORDER BY 2 DESC;";
                $results = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($results)) {
                    $megoldas["info"] = "success";
                    $megoldas["feladat4"][] = array(
                        "allergen" => $row['nev'],
                        "termek_szam" => $row['termék szám']
                    );
                }
                echo json_encode($megoldas);
                break;

            case "5":
                $query = "SELECT termek.nev, termek.ar FROM termek WHERE termek.laktozmentes AND termek.tejmentes AND termek.tojasmentes AND termek.id NOT IN ( SELECT allergeninfo.termekId FROM allergeninfo);";
                $results = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($results)) {
                    $megoldas["info"] = "success";
                    $megoldas["feladat5"][] = array(
                        "nev" => $row['nev'],
                        "ar" => $row['ar']
                    );
                }
                echo json_encode($megoldas);
                break;

            case "6":
                $query = "SELECT CONCAT(termek.nev, ' torta') AS `torta neve`, (termek.ar-100)*12 AS `fizetendő ár` FROM termek WHERE termek.nev LIKE 'paleo %';";
                $results = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($results)) {
                    $megoldas["info"] = "success";
                    $megoldas["feladat6"][] = array(
                        "torta_neve" => $row['torta neve'],
                        "fizetendo_ar" => $row['fizetendő ár']
                    );
                }
                echo json_encode($megoldas);
                break;

            default:
                echo "Hiba";
                break;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        $input = json_decode(file_get_contents('php://input'), true);
        $input["ujar"] = 1000;
        $input["termekId"] = 2;

        switch ($apiParts[1]) {
            case "3":
                $query = "UPDATE termek SET ar = ".$input["ujar"]." WHERE id = ".$input["termekId"].";";
                $results = mysqli_query($conn, $query);

                if ($results) {
                    $megoldas["info"] = "success";
                    echo json_encode($megoldas);
                }
                break;

            default:
                echo "Hiba";
                break;
        }
    }
}

mysqli_close($conn);
