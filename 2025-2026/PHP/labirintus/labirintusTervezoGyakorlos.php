<?php
    session_start();
    function d($elem)
    {
        echo "<pre>";
        echo var_dump($elem);
        echo "</pre>";
    }

    function tablaKeszit()
    {
        global $config;
        $vissza = "";
        $vissza .= "<table>";
        for($sor=0;$sor < $config["sor"];$sor++)
        {
            $vissza .= "<tr>";
            for($cella=0;$cella < $config["oszlop"];$cella++)
            {
                $gombSzin = "";
                if(isset($_SESSION["labirintus"][$sor][$cella]) && $_SESSION["labirintus"][$sor][$cella])
                {
                    $gombSzin= " fal";
                }
                $vissza .= '<td><input class="'.$gombSzin.'" type="submit" value="" name="gomb-'.$sor."-".$cella.'"></td>';
            }
            $vissza .= "</tr>";
        }
        $vissza .= "</table>";
        return $vissza;
    }



    $config["oszlop"]=10;
    $config["sor"]=10;

    if(isset($_GET))
    {
        if(!isset($_SESSION["mentettSzam"]))
        {
            $_SESSION["mentettSzam"] = 1;
        }
        $t = array_keys($_GET);
        foreach($t as $index)
        {
            if(str_starts_with($index,"gomb-"))
            {
                $darabok = explode("-",$index);
                if(sizeof($darabok) == 3)
                {
                    if(isset($_SESSION["labirintus"][$darabok[1]][$darabok[2]]) && $_SESSION["labirintus"][$darabok[1]][$darabok[2]])
                    {
                        $_SESSION["labirintus"][$darabok[1]][$darabok[2]] = false;
                    }
                    else{
                        $_SESSION["labirintus"][$darabok[1]][$darabok[2]]=true;
                    }
                    
                }
            }
        }
        
        if(isset($_GET["save"]))
            {
                if(!isset($_SESSION["lista"]))
                {
                    $_SESSION["lista"] = [];
                }
                $_SESSION["mentettLabirintusok"][$_GET["save"]] = $_SESSION["labirintus"];
                if(isset($_SESSION["mentettSzam"]))
                {
                    $_SESSION["lista"][] = '<li><button type="submit" name="betolt" value="'.$_SESSION["mentettSzam"].'">'.$_SESSION["mentettSzam"].'. mentett labirintus</button></li>';
                }
                    

                $_SESSION["mentettSzam"] = ($_SESSION["mentettSzam"] ?? 0) + 1; //Ha a $_SESSION["mentettSzam"] még nincs beállítva, akkor 0-t vesz alapul, és hozzáad 1-et. 👌
            }
        //d($_SESSION["mentettLabirintusok"]);
        if(isset($_GET["betolt"]))
        {
            if(array_key_exists($_GET["betolt"], $_SESSION["mentettLabirintusok"]))
            {
                $_SESSION["labirintus"] = $_SESSION["mentettLabirintusok"][$_GET["betolt"]];
            }
        }
        //Törlés
        if(isset($_GET["new"]) && $_GET["new"] == 1)
        {
            $_SESSION["labirintus"] = [];
        }
        
    }
    //d($_SESSION["lista"]);
    //d($_SESSION["mentettLabirintusok"][$_GET["save"]]);
    $tablaKesz = tablaKeszit();
    //echo $_SESSION["mentettSzam"];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labirint</title>
    <style>
        table,td{
            border:1px solid black;
        }
        td{
            width: 25px;
            height: 25px;
        }
        td input[type=submit]
        {
            height: 100%;
            width: 100%;
        }
        input.fal
        {
            background-color: red;
        }
    </style>
</head>
<body>
    <h1>Labirintus szerkesztő</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <?php echo $tablaKesz;?>
        <button type="submit" name="save" value="<?php if(isset($_SESSION["mentettSzam"])) echo $_SESSION["mentettSzam"] ?>">Mentés</button>        
        <button type="submit" name="new" value="1">Új labirintus</button>        
        <h2>Mentett labirintusok</h2>
        <ul>
            <?php if(isset($_SESSION["lista"])) foreach($_SESSION["lista"] as $elem){echo $elem;}; ?>
        </ul>
    </form>
</body>
</html>