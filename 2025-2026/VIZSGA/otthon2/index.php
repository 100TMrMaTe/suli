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

    if ($apiparts[0] == "feladat1") {
        $data = json_decode(file_get_contents("php://input"), true);

        // 1. Előkészítés - ? helyőrző az értéknek
        $stmt = $conn->prepare("SELECT nev FROM diakok WHERE telepules = ?");

        // 2. Paraméter kötése - "s" = string típus
        $stmt->bind_param("s", $data["telepules"]);

        // 3. Végrehajtás
        $stmt->execute();

        // 4. Eredmény lekérése
        $result = $stmt->get_result();

        $nevek = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nevek[] = $row["nev"];
            }
            echo json_encode(["nevek" => $nevek]);
        } else {
            echo json_encode("errol a telepulesrol nem jott senki.");
        }

        // 5. Lezárás
        $stmt->close();
    } elseif ($apiparts[0] == "feladat2") {
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("select datum,terem,orasorszam from orak where targy = ? order by datum,orasorszam");

        $stmt->bind_param("s", $data["tantargy"]);
        $stmt->execute();
        $result = $stmt->get_result();

        $vissza = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $vissza[] = [
                    "datum" => $row["datum"],
                    "terem" => $row["terem"],
                    "orasorszam" => $row["orasorszam"],
                ];
            }
            echo json_encode($vissza);
        } else {
            echo json_encode("nincs ilyen tantargy.");
        }

        $stmt->close();
    } elseif ($apiparts[0] == "feladat3") {
        $data = json_decode(file_get_contents("php://input"), true);

        $stmt = $conn->prepare("select csoport,targy,datum from orak where (targy = ? or targy = ?) order by targy");

        $stmt->bind_param("ss", $data["bet1"], $data["bet2"]);
        $stmt->execute();
        $result = $stmt->get_result();

        $vissza = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $vissza[] = [
                    "csoport" => $row["csoport"],
                    "targy" => $row["targy"],
                    "datum" => $row["datum"],
                ];
            }
            echo json_encode($vissza);
        } else {
            echo json_encode("nincsenek ilyen tantargyak");
        }
        $stmt->close();
    } elseif ($apiparts[0] == "feladat4") {
        $data = json_decode(file_get_contents("php://input"), true);

        $stmt = $conn->prepare("select count(*) from diakok where telepules = ?");
        $stmt->bind_param("s", $data["telepules"]);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo json_encode(["valasz" => $result->fetch_assoc()]);
        } else {
            echo json_encode(["valasz" => "inen sehanyan nem jonnek."]);
        }
        $stmt->close();
    } elseif ($apiparts[0] == "feladat5") {
        $stmt = $conn->prepare("select distinct targy from orak");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $vissza = [];
            while ($row = $result->fetch_assoc()) {
                $vissza[] = $row["targy"];
            }
            echo json_encode($vissza);
        } else {
            json_encode("ennyi volt");
        }
        $stmt->close();
    }
}

mysqli_close($conn);
