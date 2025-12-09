<?php
include_once "../../PHP/fugvenyek.php";
//phpinfo();
/*
        osszeadas
            url: osszead
            method: POST
        kivonas
            url: kivonas
            method: POST
        szorzas
            url: szorzas
            method: POST
        osztas
            url: osztas
            method: POST
    */
$apiParts = explode("/", $_GET["path"]);
// d($apiParts);
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    switch($apiParts[0])
    {
        case "osszead": break;
        case "kivonas": break;
        case "szorzas": break;
        case "osztas": break;
        default: "valami hiba";
    }
} 
else {
    echo "Nem GET kérést kaptunk";
}

