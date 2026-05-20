<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "urhajo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET["path"])) {
    $apiparts = explode("/", $_GET["path"]);
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if ($apiparts[0] == "table") {
            $vissza = [];

            $stmt = $conn->prepare("select * from urhajos limit 10");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $vissza[] = [
                        "id" => $row["id"],
                        "nev" => $row["nev"],
                        "orszag" => $row["orszag"],
                        "nem" => $row["nem"],
                        "szulev" => $row["szulev"],
                        "urido" => $row["urido"],
                    ];
                }
                echo json_encode($vissza);
            } else {
                echo json_encode("valami szar");
            }
            $stmt->close();
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        if ($apiparts[0] == "delete") {
            $data = json_decode(file_get_contents("php://input"), true);

            $stmt = $conn->prepare("DELETE from urhajos where id = ?");
            $stmt->bind_param("i", $data["id"]);
            if ($stmt->execute()) {
                echo json_encode(["status" => "ok"]);
            } else {
                echo json_encode(["status" => "shit"]);
            }
            $stmt->close();
        }
    }
}

mysqli_close($conn);
?>
