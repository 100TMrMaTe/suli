<?php
    session_start();
    if(isset($_GET["gomb"]))
    {
        if($_GET["gomb"] != "eredmeny")
        {
            if(!isset($_SESSION["jeloltek"]))
            {
                $_SESSION["jeloltek"] = [];
            }
            if(array_key_exists($_GET["gomb"],$_SESSION["jeloltek"]))
            {
                $_SESSION["jeloltek"][$_GET["gomb"]]++;
            }
            else
            {
                $_SESSION["jeloltek"][$_GET["gomb"]] = 1;
            }
        }
        else
        {
              
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <input type="submit" value="Kádár" name="gomb" value="kadar">
        <input type="submit" value="Lajos" name="gomb" value="lajos">
        <input type="submit" value="Béla" name="gomb" value="bela">
    </form>
    <ul>

    </ul>
</body>
</html>