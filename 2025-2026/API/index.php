<?php
mysqli_report(MYSQLI_REPORT_OFF);
include_once "../PHP/fugvenyek.php";

if (isset($_GET["path"])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "todolista";
    //CREATE TABLE todolsita.todo (id INT NOT NULL , szoveg VARCHAR(255) NOT NULL , datum DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , vege DATETIME NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB;
    $conn = mysqli_connect($servername, $username, $password, $db);
    $apiParts = explode("/", $_GET["path"]);


    //d($apiParts);

    if ($apiParts[0] == "todo/") {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $query = "SELECT id, szoveg, datum, vege FROM todo";
            $results = mysqli_query($conn, $query);
            $jsonTomb = [];

            while ($row = mysqli_fetch_assoc($results)) {
                $jsonTomb[] = $row;
            }
            $json = json_encode($jsonTomb);
            //d($json);
            echo $json;
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $input = json_decode(file_get_contents('php://input'), true);
            if (isset($input["memberid"])) {
                $query = "INSERT INTO TODO (szoveg, datum) VALUES ('"
                    . mysqli_real_escape_string($conn, $input["feladat"])
                    . "', NOW())";

                $jsonTomb = [];
                if (mysqli_query($conn, $query)) {
                    $jsonTomb["status"] = "success";
                } else {
                    $jsonTomb["status"] = "error";
                    $jsonTomb["errormassage"] = mysqli_error($conn);
                }


                echo json_encode($jsonTomb);
            }
            //phpinfo(32);
        } else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
            phpinfo(32);
            /*$input = json_decode(file_get_contents('php://input'), true);
            if (isset($input["memberid"])) {
                $query = "INSERT INTO TODO (szoveg, datum) VALUES ('"
                    . mysqli_real_escape_string($conn, $input["feladat"])
                    . "', NOW())";

                $jsonTomb = [];
                if (mysqli_query($conn, $query)) {
                    $jsonTomb["status"] = "success";
                } else {
                    $jsonTomb["status"] = "error";
                    $jsonTomb["errormassage"] = mysqli_error($conn);
                }


                echo json_encode($jsonTomb);
            }
            //phpinfo(32);*/
        }
        // d($_SERVER['REQUEST_METHOD']);
        //phpinfo(32);
    }
} else {




?>
    <h3>API help</h3>
<?php } ?>