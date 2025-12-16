<?php


phpinfo(32);

$apiParts = explode("/", $_GET["path"]);

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    switch ($apiParts[0]) {
        case "osszead":
            include_once "include/osszead.php";
            osszead($apiParts);
            echo osszead($apiParts);
            break;
        case "kivon":
            break;
        case "szoroz":
            break;
        case "oszt":
            break;
        default:
            echo "Hiba: Érvénytelen művelet! (" . $apiParts[0] . ")";
            break;
    }

} else {
    echo "Hibe, nem GET";
}



?>