<?php
include_once "../fugvenyek.php";

if (isset($_GET["path"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    $apiParts = explode("/", $_GET["path"]);
    d($apiParts);
} else {


?>

    <h3>API help</h3>

<?php

} ?>