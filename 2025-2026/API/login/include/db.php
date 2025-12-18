<?php
include_once "config.php";
$conn = mysqli_connect($config["db"]["host"], $config["db"]["user"], $config["db"]["password"], $config["db"]["db_name"]) or die(mysqli_connect_error());



mysqli_close($conn);
