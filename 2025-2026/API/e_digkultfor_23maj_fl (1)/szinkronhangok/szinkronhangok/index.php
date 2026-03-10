<?php 
    include_once("includes/config.php");
    include_once("includes/database.php");
    

    $navbar = [
        0=>["url"=>"?page=ember","text"=>"Ember"],
        1=>["url"=>"?page=studio","text"=>"Stúdió"],
        2=>["url"=>"?page=film","text"=>"Film"],
        3=>["url"=>"?page=szinkron","text"=>"Szinkron"],

    ]; 

   $page = $_GET["page"] ?? "";
   $tartalom="";
   //echo "*********************";
   switch($page){
     case "ember":
        $oldalData=[
                "cim" => "Emberek",
                "page" => "ember",
                "tabla" => "ember"
            ];
            include_once("includes/egyszeruAdatbazis.php");;
            break;
    case "studio":
            $oldalData=[
                "cim"=>"Stúdió",
                "page"=>"studio",
                "tabla"=>"studio"
            ];
            include_once("includes/studio.php");
            break;
    case "film":
       $oldalData=[
                "cim"=>"Film",
                "page"=>"film",
                "tabla"=>"film"
            ];
            include_once("includes/film.php");
            break;
    case "szinkron":
        $oldalData=[
                "cim"=>"Szinkron",
                "page"=>"szinkron",
                "tabla"=>"szinkron"
            ];
            include_once("includes/szinkron.php");
            break;
            
    
    default: break;
   }


    include_once("includes/sablon.php");
?>