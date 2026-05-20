<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nyiltnap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET["path"])) {
    $apiparts = explode("/", $_GET["path"]);
    if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        if ($apiparts[0] == "elso") {
            $stmt = $conn->prepare("Delete from diakok where id = ?");
            $stmt->bind_param("i", $apiparts[1]);
            if ($stmt->execute()) {
                echo json_encode(["vissza"=> "ok"]);
                http_response_code(200);
            }

            $stmt->close();
        }
    }
}



$conn->close();
