<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <input type="text" name="szoveg" placeholder="<?php echo $_POST['szoveg'];?>">
        <input type="submit">
    </form>

    <?php
        function kiir($szoveg)
        {
            return "<div>". $szoveg . "</div>";
        }
    
        $elsoBetu = substr($_POST['szoveg'],0,1);
        $tobbi = substr($_POST['szoveg'],1);
        $feladat2 = strtoupper($elsoBetu) . strtolower($tobbi);

        $valtakozo = "";
        for($i = 0; $i < strlen($_POST['szoveg']); $i++)
        {
            if($i % 2 == 0)
            {
                $valtakozo .= strtoupper($_POST['szoveg'][$i]);
            }
            else
            {
                $valtakozo .= strtolower($_POST['szoveg'][$i]);
            }
        }

        //phpinfo(32);
        //echo "<div>".$_POST['szoveg']."</div>";
        //echo kiir(strtoupper($_POST['szoveg']));
        //echo ucfirst($_POST['szoveg']);
        //echo kiir($feladat2);
        echo $valtakozo;
    ?>
</body>
</html>