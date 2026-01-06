<?php
include_once 'szamkeres.php';
if (isset($_GET['path'])) {
    $apiParts = explode("/", $_GET["path"]);
    switch ($apiParts[0]) {
        case 'fakt':
            $szam = szamKeres($apiParts);
            $megoldas["eredmeny"] = 1;
            if (count($szam) == 0 || count($szam) > 1) {
                $megoldas = "nem jol adtad meg a szamot";
            } else {
                for ($i = 1; $i <= $szam[0]; $i++) {
                    $megoldas["eredmeny"] *= $i;
                }
            }
            echo json_encode($megoldas);
            break;
        case 'szorzat':
            $szamok = szamKeres($apiParts);
            $megoldas["eredmeny"] = 1;

            if (count($szamok) == 0) {
                $megoldas["eredmeny"] = "nem jol adtad meg a szamokat";
            } else {
                foreach ($szamok as $szam) {
                    $megoldas["eredmeny"] *= $szam;
                }
            }
            echo json_encode($megoldas);
            break;
        case 'haromszog':
            $szamok = szamKeres($apiParts);
            if (count($szamok) != 3 || $szamok[0] <= 0 || $szamok[1] <= 0 || $szamok[2] <= 0) {
                $megoldas["eredmeny"] = "nem jol adtad meg a szamokat";
                break;
            }
            $a = $szamok[0];
            $b = $szamok[1];
            $c = $szamok[2];

            if ($a + $b <= $c || $a + $c <= $b || $b + $c <= $a) {
                $megoldas["eredmeny"] = "hibas haromszog";
            } else {
                $s = ($a + $b + $c) / 2;
                $megoldas["eredmeny"] = sqrt($s * ($s - $a) * ($s - $b) * ($s - $c));
            }
            echo json_encode($megoldas);
            break;
        case 'random':
            $szamok = szamKeres($apiParts);
            if (count($szamok) == 0) {
                $megoldas["eredmeny"] = "nem jol adtad meg a szamokat";
                break;
            } else if (count($szamok) == 1) {
                $megoldas["eredmeny"] = rand(0, $szamok[0]);
                echo json_encode($megoldas);
                break;
            } else if (count($szamok) == 2) {
                $megoldas["eredmeny"] = rand($szamok[0], $szamok[1]);
                echo json_encode($megoldas);
                break;
            } else if (count($szamok) > 2) {
                $min = $szamok[0];
                $max = $szamok[1];
                $step = $szamok[2];

                $lepesek = range($min, $max, $step);

                $megoldas["eredmeny"] = $lepesek[array_rand($lepesek)];
                echo json_encode($megoldas);
                break;
            }
            break;
        case 'lorem':
            $szamok = szamKeres($apiParts);
            $szoveg = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rutrum placerat neque. Morbi eu consectetur sapien, sit amet egestas turpis. Vestibulum volutpat gravida tincidunt. Aliquam erat volutpat. Quisque sollicitudin mi nec tortor egestas blandit. Praesent cursus nec magna tincidunt gravida. Nullam vulputate venenatis auctor.Nam auctor sollicitudin risus, sit amet commodo nisl tristique et. Vestibulum ornare metus ac justo imperdiet pulvinar. Praesent a diam enim. Pellentesque gravida velit at turpis placerat consequat. Nam auctor semper pellentesque. Nunc luctus, purus ultrices imperdiet rhoncus, metus orci elementum dolor, eu facilisis arcu est non felis. Mauris vulputate purus vitae est condimentum, at tincidunt sem egestas. Donec aliquet nisi quis nulla rutrum viverra. Pellentesque sit amet eros sollicitudin, rhoncus augue suscipit, aliquet arcu. Quisque non velit massa. Pellentesque eget lorem placerat nibh sollicitudin tincidunt. Nullam blandit erat mauris, at ultrices arcu volutpat eget. In et augue lobortis, tempus diam eu, fringilla tortor.";
            $mondatok = explode(".", $szoveg);
            $index = $szamok[0];
            $megoldas["eredmeny"] = "";
            if (count($szamok) == 0 || count($szamok) > 1 || $index < 1 || $index > count($mondatok)) {
                $megoldas["eredmeny"] = "nem jol adtad meg a szamot";
                break;
            }
            
            for ($i = 0; $i < $index; $i++) {
                $megoldas["eredmeny"] .= trim($mondatok[$i]) . ". ";
            }

            echo json_encode($megoldas);
            break;
    }
}
