<?php
include_once "include/db.php";
include_once "../../PHP/fugvenyek.php";

$apiParts = explode("/", isset($_GET["path"]) ? $_GET["path"] : "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);
    //d($data);
    echo password_hash($data["password"],PASSWORD_DEFAULT);
}
