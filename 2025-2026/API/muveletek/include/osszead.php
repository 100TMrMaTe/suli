<?php
function osszead($szamok) {
     
}

function szamkeres($szamok){
    $vissza = [];

    for($i=0;$i<count($szamok);$i++)
    {
        if(is_numeric($szamok[$i]))
        {
            $vissza[] = $szamok[$i];
        }
    }

    return $vissza;
}
