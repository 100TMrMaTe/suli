<?php
include_once "include/db.php";
include_once "../../PHP/fugvenyek.php";

$apiParts = explode("/", isset($_GET["path"]) ? $_GET["path"] : "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);
    //d($data);
    if($apiParts[0] == "login")
    {
        $query = "SELECT id,password FROM users WHERE username ='".mysqli_real_escape_string($conn,$data["nev"])."'";
        $result = mysqli_query($conn, $query);
        $users = [];
        while($row = mysqli_fetch_assoc($result))
        {
            $users[] = $row;
        }

        if(sizeof($users)==1 && password_verify($data["password"],$users[0]["password"]))
        {
            //echo "jo";
            $token = bin2hex(random_bytes(32));
            $expires = date("Y-m-d H:i:s", strtotime("+30 minutes"));
            //d($token);
            //d($expires);

            $query = "INSERT INTO TOKEN (user_id,token,date) VALUES('".mysqli_real_escape_string($conn,$users[0]["id"])."','$token','$expires')";

        }
        else{
            echo "rossz";
        }
    }
}

mysqli_close($conn);
