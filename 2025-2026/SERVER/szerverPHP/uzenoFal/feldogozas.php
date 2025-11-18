<?php
if(isset($_POST))
{
    echo "<strong>A feladó neve:</strong> ".$_POST["nev"]."<br>";
    echo "<strong>A feladó email címe:</strong> ".$_POST["email"]."<br>";
    echo "<strong>A feladott üzenet:</strong> ".$_POST["uzenet"]."<br>";
    echo "<strong>A küldés dátuma: </strong>".date("l jS \of F Y h:i:s A")."<br>";
    $fajl = "kuldottAdatok.txt";
    if(file_exists($fajl))
    {
        $fajl = fopen("kuldottAdatok.txt", "a"); 
        fwrite($fajl, $_POST["nev"]."\n");
        fwrite($fajl, $_POST["email"]."\n");
        fwrite($fajl, $_POST["uzenet"]."\n");
        fwrite($fajl, date("l jS \of F Y h:i:s A")."\n");
        fwrite($fajl, "--------------------------"."\n");
        fclose($fajl);
    }
    else
    {
        $fajl = fopen("kuldottAdatok.txt", "w"); 
        fwrite($fajl, $_POST["nev"]."\n");
        fwrite($fajl, $_POST["email"]."\n");
        fwrite($fajl, $_POST["uzenet"]."\n");
        fwrite($fajl, date("l jS \of F Y h:i:s A")."\n");
        fwrite($fajl, "--------------------------"."\n");
        fclose($fajl);
    }
}
?>