<?php
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
    if($apiParts[0] == "todo")
    {
        if($_SERVER['REQUEST_METHOD'] == "GET")
        {
            $query = "SELECT id, szoveg, datum, vege FROM todo";
            $results = mysqli_query($conn, $query);
            $jsonTomb = [];

            while ($row = mysqli_fetch_assoc($results))
            {
                $jsonTomb[] = $row;
            }
            $json=json_encode($jsonTomb);
            //d($json);
            echo $json;
        }
        elseif($_SERVER['REQUEST_METHOD'] == "POST")
        {
            phpinfo(32);
        }
    // d($_SERVER['REQUEST_METHOD']);
    //phpinfo(32);
    }
} else {




?>
    <h3>API help</h3>
<?php } ?>