<?php
include_once "../PHP/fugvenyek.php";

$myfile = fopen("beosztas.txt", "r") or die("Unable to open file!");
// Output one character until end-of-file
$szamolas = 0;
$tomb = [];
while (!feof($myfile)) {
    $sor = trim(fgets($myfile));
    $szamolas++;
    $tomb[] = $sor;
    if ($szamolas % 4 == 0) {
        $adatok[] = [
            "nev" => $tomb[0],
            "tantargy" => $tomb[1],
            "osztaly"  => $tomb[2],
            "oraszam"  => $tomb[3]
        ];
        $tomb = [];
    }
}
fclose($myfile);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    if ($data["feladat"] == "2") {

        $megoldas = count($adatok);
        $json = json_encode($megoldas);
        echo $json;

    } else if ($data["feladat"] == "3") {

        $megoldas = array_sum(array_column($adatok, "oraszam"));
        $json = json_encode($megoldas);
        echo $json;

    } else if ($data["feladat"] == "4") {

        $megoldas =0;
        foreach($adatok as $x)
        {
            if($x["nev"] == $data["beker"])
            {
                $megoldas += $x["oraszam"];
            }
        }
        
        $json = json_encode($megoldas);
        echo $json;
    }
}
