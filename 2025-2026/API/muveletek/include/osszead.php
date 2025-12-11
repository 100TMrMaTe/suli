<?php
include_once("szamkeres.php");
function osszead($szamok){
    // osszead/1/2/3/4/qwe/12
    // ["osszead","1","2","3","4","qwe","12"]
    // ami kell: [1,2,3,4,12]
    $csakSzamok = szamKeres($szamok);
    return array_sum($csakSzamok);
}
?>