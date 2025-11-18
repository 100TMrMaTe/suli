<?php
    session_start();

    if(!isset($_SESSION["szo1"]))
    {
        $_SESSION["szo1"] = [];
    }
    
    if(!isset($_SESSION["szo2"]))
    {
        $_SESSION["szo2"] = [];
    }

    if(isset($_GET["szo1"]))
    {
        $_SESSION["szo1"][] = $_GET["szo1"];
    }
    if(isset($_GET["szo2"]))
    {
        $_SESSION["szo2"][] = $_GET["szo2"];
    }
    
    $lista1="";
    for($i = 0; $i< sizeof($_SESSION["szo1"]);$i++)
    {
        $lista1 .= '<li class="">'.$_SESSION["szo1"][$i].'</li>';
    }
    $lista2="";
        for($i = 0; $i< sizeof($_SESSION["szo2"]);$i++)
        {
            $lista2 .= '<li class="">'.$_SESSION["szo2"][$i].'</li>';
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Első oldal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 container">
                <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="row">
                        <div class="col-2">
                            <label class="form-label" for="szo1">Szó lista 1:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" name="szo1" id="szo1">
                        </div>
                        <div class="col-2">
                            <input type="submit" value="Beküld">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-6 container">
                <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="row">
                        <div class="col-2">
                            <label class="form-label" for="szo2">Szó lista 2:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" name="szo2" id="szo2">
                        </div>
                        <div class="col-2">
                            <input type="submit" value="Beküld">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <ol><?php echo $lista1; ?></ol>
            </div>
            <div class="col-12 col-lg-6">
                <ul><?php echo $lista2; ?></ul>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>