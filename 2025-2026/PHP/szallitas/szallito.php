<?php
    function tav($szalaghossza,$indulashelye,$erkezeshelye)
    {
        if($erkezeshelye > $indulashelye)
        {
            return $erkezeshelye - $indulashelye;
        }
        else
        {
            return ($szalaghossza-$indulashelye)+$erkezeshelye;
        }
    }
    
    function feladat2()
    {
        echo <<<'HTML'
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Szállítós feladat</title>
        </head>
        <body>
            <form method="get">
                <label for="szallitasId">Adja meg melyik adatsorra kíváncsi! </label>
                <input type="number" id="szallitasId" name="szallitasId">
                <input type="submit" value="Küldés">
            </form>
        </body>
        </html>
        HTML;
    }
    function feladat3()
    {
        echo <<<'HTML'
            <form method="get">
                <label for="szallitasId">Adja meg a kívánt időpontot!</label>
                <input type="number" id="idoId" name="idoId">
                <input type="submit" value="Küldés">
            </form>

        HTML;
    }
    
    include("fugvenyek.php");
    $fajl = fopen("szallit.txt","r");
    $adatok = [];
    $sor = fgets($fajl);
    $darabok = explode(" ",$sor);
    $szalagHossz = $darabok[0];
    $sebesseg = $darabok[1];
    while(!feof($fajl))
    {
        $sor = fgets($fajl);
        if($sor != "")
        {
            $darabok = explode(" ",$sor);
            //d($darabok);
            $adatok[] = $darabok;
        }
    }
    fclose($fajl);
    //d($adatok);
    echo feladat2();
    $indexek2 = [];
    if(isset($_GET))
    {
        if(isset($_GET["szallitasId"]))
        {
            if($_GET["szallitasId"] != "")
            {
                $szId = $_GET["szallitasId"]-1;
            }
            else
            {
                $szId = -1;
            }
            
            if($szId >= 0 && $szId <= count($adatok))
            {
                //d($adatok);
                echo '<div>
                        Honnan: <strong>'.$adatok[$szId][1].'</strong>
                        Hova: <strong>'.$adatok[$szId][2].'</strong>
                    </div>';
            }
            else
            {
                echo "A számozás 1-essel kezdődik és 33-mal végződik. Az álltala megadott ".($szId+1)." ID nem létezik. / Üres adatot adott meg!";
            }
        }
        if(isset($_GET["idoId"]))
        {
            if($_GET["idoId"] != "")
            {
                $idopont = $_GET["idoId"];
            }
            else {
                $idopont = 0;
            }
            foreach($adatok as $index =>$elem)
            {
                if($idopont >= $elem[0] && tav($szalagHossz,$elem[1],$elem[2])*$sebesseg+$elem[0]>$idopont)
                {
                    $indexek2[] = $index+1;
                }
            }
        }
    }
    $szallitasiHosszok = [];
    foreach($adatok as $elem)
    {
        $szallitasiHosszok[] = tav($szalagHossz,$elem[1],$elem[2]);
    }
    $legHosszabb = max($szallitasiHosszok);
    echo "A legnagyobb távolság: ".$legHosszabb."<br>";
    $indexek = [];
    foreach($adatok as $index => $elem)
    {
        if($legHosszabb == tav($szalagHossz,$elem[1],$elem[2]))
        {
            $indexek[] = ($index+1);
        }
    }
    echo "A maximális távolságok sorszáma: ";
    echo implode(", ",$indexek);
    //d($szallitasiHosszok);
    $osszSuly = 0;
    foreach($adatok as $elem)
    {
        if($elem[1] > $elem[2])
        {
            $osszSuly += $elem[3];
        }
    }
    echo "<br> A kezdőpont előtt elhaladó rekeszek össztömege: ".$osszSuly;
    echo feladat3();
    if(isset($_GET["idoId"]))
    {
        if(sizeof($indexek2) == 0)
        {
            echo "Üres ez a cutsz";
        }
        else
        {
            echo "Valami random indexek: ";
            echo implode(", ",$indexek2);
       }
    }
    $faljAdatok = [];
    for($i=0; $i < sizeof($adatok); $i++)
    {
        if(!isset($faljAdatok[$adatok[$i][1]]))
        {
            $faljAdatok[$adatok[$i][1]] = 0;
        }
         $faljAdatok[$adatok[$i][1]] += $adatok[$i][3];
    }
    //d($faljAdatok);
    $tomegFajl = fopen("tomeg.txt","w");
    foreach($faljAdatok as $index => $elem)
    {
        fwrite($tomegFajl,$index." ".$elem."\n");
    }
    fclose($tomegFajl);

?>