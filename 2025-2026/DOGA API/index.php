<?php
include_once "../PHP/fugvenyek.php";

$myfile = fopen("tancrend.txt", "r") or die("Unable to open file!");
// Output one character until end-of-file
$szamolas = 0;
$tomb = [];
while (!feof($myfile)) {
    $sor = trim(fgets($myfile));
    $szamolas++;
    $tomb[] = $sor;
    if ($szamolas % 3 == 0) {
        $adatok[] = [
            "tanc" => $tomb[0],
            "lany" => $tomb[1],
            "fiu"  => $tomb[2],
        ];
        $tomb = [];
    }
}
fclose($myfile);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    if ($data["feladat"] == "2") {
        $megoldas[] = [
            $adatok[0]["tanc"],
            $adatok[count($adatok) - 1]["tanc"],
        ];

        $json = json_encode($megoldas);
        echo $json;
    } elseif ($data["feladat"] == "3") {

        $megoldas = 0;
        foreach ($adatok as $x) {
            if ($x["tanc"] == $data["tanc"]) {
                $megoldas++;
            }
        }

        $json = json_encode($megoldas);
        echo $json;
    } elseif ($data["feladat"] == "4") {

        $megoldas = [];
        foreach ($adatok as $x) {
            if ($x["lany"] == $data["ember"] || $x["fiu"] == $data["ember"]) {
                $megoldas[] = $x["tanc"];
            }
        }

        $json = json_encode($megoldas);
        echo $json;
    } elseif ($data["feladat"] == "5") {

        $megoldas = [];
        foreach ($adatok as $x) {
            if ($x["lany"] == $data["ember"] && $x["tanc"] == $data["tanc"]) {
                $megoldas[] = $x["fiu"];
            } elseif ($x["fiu"] == $data["ember"] && $x["tanc"] == $data["tanc"]) {
                $megoldas[] = $x["lany"];
            }
        }

        $json = json_encode($megoldas);
        echo $json;
    } elseif ($data["feladat"] == "6") {
        $fiukdb = [];
        $lanyokdb = [];

        foreach ($adatok as $x) {
            if (!isset($fiukdb[$x["fiu"]])) {
                $fiukdb[$x["fiu"]] = 0;
            }
            $fiukdb[$x["fiu"]]++;

            // Lányok gyakorisága
            if (!isset($lanyokdb[$x["lany"]])) {
                $lanyokdb[$x["lany"]] = 0;
            }
            $lanyokdb[$x["lany"]]++;
        }

        $maxfiu = max($fiukdb);
        $maxlany = max($lanyokdb);

        $legtobbszorfiuk = array_keys($fiukdb, $maxfiu);
        $legtobbszorlanyok = array_keys($lanyokdb, $maxlany);

        $megoldas = [
            "fiuk" => $legtobbszorfiuk,
            "fiukszam" => $maxfiu,
            "lanyok" => $legtobbszorlanyok,
            "lanyokszam" => $maxlany
        ];

        $json = json_encode($megoldas);
        echo $json;
    } elseif ($data["feladat"] == "7") {
        $tanc = [];

        foreach ($adatok as $x) {
            if (!isset($tanc[$x["tanc"]])) {
                $tanc[$x["tanc"]] = 0;
            }
            $tanc[$x["tanc"]]++;
        }
        $maxtanc = max($tanc);
        $legtobbtanc = array_keys($tanc, $maxtanc);


        foreach ($adatok as $x) {
            if ($x["tanc"] == $legtobbtanc[0]) {
                $megoldas[] = [
                    "tanc" => $x["tanc"],
                    "fiu" => $x["fiu"],
                    "lany" => $x["lany"]
                ];
            }
        }

        //https://www.geeksforgeeks.org/php/how-to-sort-multi-dimensional-array-by-key-value-in-php/
        $megoldas[] = array_multisort(array_column($megoldas, 'lany'), SORT_ASC, $megoldas);

        $json = json_encode($megoldas);
        echo $json;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {

    $json = file_get_contents("php://input");
    $data = json_decode($json, true);


    $fiuk = [];
    $lanyok = [];

    foreach ($adatok as $x) {
        if (!in_array($x["lany"], $lanyok)) {
            $lanyok[] = $x["lany"];
        }
        if (!in_array($x["fiu"], $fiuk)) {
            $fiuk[] = $x["fiu"];
        }
    }

    $megoldas = [
        "lanyok" => $lanyok,
        "fiuk" => $fiuk
    ];

    $json = json_encode($megoldas);
    echo $json;
}
