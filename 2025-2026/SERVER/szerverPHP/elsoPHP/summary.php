<?php
    session_start();
    if(isset($_SESSION))
    {
        echo $_SESSION["nev"];
        echo $_SESSION["email"];
        echo $_SESSION["telefon"];
        echo $_SESSION["cim"];
        echo $_SESSION["jelszo"];
    }
    if(isset($_POST["logout"]))
    {
        session_destroy();
        echo "A session törölve lett";
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
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" value="Kiléplés" name="logout">
    </form>
</body>
</html>