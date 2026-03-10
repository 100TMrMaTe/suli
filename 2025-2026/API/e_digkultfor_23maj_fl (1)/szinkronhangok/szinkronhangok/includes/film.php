<?php


if(isset($_POST))
{
$postId = $_POST['id'] ?? '';
$postCim = $_POST['cim'] ?? '';
$postEredeti = $_POST['eredeti'] ?? '';
$postEv = $_POST['ev'] ?? '';
$postRendezo = $_POST['rendezo_id'] ?? '';
$postMagyar = $_POST['magyarszoveg_id'] ?? '';
$postSzinkron = $_POST['szinkronrendezo_id'] ?? '';
 
  $postSend = $_POST['save'] ?? 'default';
  $postNew = $_POST['new'] ?? 'default';
  if($postSend==""){
    adatUpdate($postId,$postCim,$postEredeti,$postEv,$postRendezo,$postMagyar,$postSzinkron);
    
  }
  elseif($postNew==""){
    adatInsert($postCim,$postEredeti,$postEv,$postRendezo,$postMagyar,$postSzinkron);
    
  }

}

if(isset($_GET['action']) && $_GET['action']=="delete"){
  adatDelete($_GET['id']);
}

$tartalom="";

$tartalom = szerkezet();

  function cim($cim){
     return "<h2>$cim</h2>";
  }
  function szerkezet(){
    return 
    "<div class=\"container\">
        <div class=\"row\">".cim("Diakok")."</div>
        <div class=\"row\">
            <div class=\"col-6\">
                ".adatForm()."
            </div>
            <div class=\"col-6\">
                ".adatLista()."
            </div>
        </div>
    </div>
    ";
  }
   function oraListaAdat(){
    GLOBAL $conn; 


    //$sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)";
    $sql="SELECT orak.*, tanar.nev as tanar_nev,
            terem.nev as terem_nev ,
            csoport.nev as csoport_nev ,
            targy.nev as targy_nev ,
            COUNT(kapcsolo.diakid) as diak_darab
    from orak 
            join tanar on orak.tanar_id=tanar.id
            join terem on orak.terem_id=terem.id
            join csoport on orak.csoport_id=csoport.id
            join targy on orak.targy_id=targy.id
            join kapcsolo on orak.id=kapcsolo.oraid
        GROUP BY orak.id
        ORDER BY datum,orasorszam";
    $vissza=[];
    if($stmt = $conn->prepare($sql)) {

      //$stmt ->bind_param("i",$szam);
      //$szam = 1;
      $stmt->execute();
      $result= $stmt->get_result();
      
      while($row = $result->fetch_assoc()) {
       $vissza[] = $row;
      }
      //var_dump($vissza);
      
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt ->close();

    return $vissza;
  }
 
function adatForm(){

global $oldalData;

$formAdat = [
"id"=>"",
"cim"=>"",
"eredeti"=>"",
"ev"=>"",
"rendezo_id"=>"",
"magyarszoveg_id"=>"",
"szinkronrendezo_id"=>""
];

if(isset($_GET["action"]) && $_GET["action"]=="edit"){
$formAdat=formAdat($_GET["id"]);
}

return '
<form method="post" action="?page='.$oldalData['page'].'">

<input type="hidden" name="id" value="'.$formAdat['id'].'">

<div class="mb-2">Cím</div>
<input type="text" name="cim" class="form-control" value="'.$formAdat['cim'].'">

<div class="mb-2">Eredeti cím</div>
<input type="text" name="eredeti" class="form-control" value="'.$formAdat['eredeti'].'">

<div class="mb-2">Év</div>
<input type="number" name="ev" class="form-control" value="'.$formAdat['ev'].'">

<div class="mb-2">Rendező</div>
'.adatSelect("ember","rendezo_id",$formAdat['rendezo_id']).'

<div class="mb-2">Magyar szöveg</div>
'.adatSelect("ember","magyarszoveg_id",$formAdat['magyarszoveg_id']).'

<div class="mb-2">Szinkronrendező</div>
'.adatSelect("ember","szinkronrendezo_id",$formAdat['szinkronrendezo_id']).'

 <div class="row">
                '.($formAdat['id']!="" ? 
                        '<div class="col-6 text-center"><button type="submit" class="btn btn-primary" name="save">Mentés</button></div>'
                        :'').'
                <div class="col-6 text-center"><button type="submit" class="btn btn-primary" name="new">Mentés újként</button></div>
            </div>

</form>
';
}
  
  
function adatSelect($tabla, $name, $id, $mezo="nev"){
$adatok = listaAdat($tabla, $mezo);

$vissza='<select name="'.$name.'" class="form-select">';

foreach($adatok as $egy){
$vissza .= '<option value="'.$egy['id'].'" '.($egy['id']==$id?'selected':'').'>'.$egy[$mezo].'</option>';
}

$vissza.='</select>';

return $vissza;
}
 function listaAdat($tabla, $mezo="nev"){
GLOBAL $conn; 

$sql="SELECT * FROM $tabla ORDER BY $mezo";

$vissza=[];

if($stmt = $conn->prepare($sql)) {

$stmt->execute();
$result= $stmt->get_result();

while($row = $result->fetch_assoc()) {
$vissza[] = $row;
}

}
else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt ->close();

return $vissza;
}
  
  function adatLista(){

  GLOBAL $oldalData;
  $adatListaAdat = adatListaAdat();
  $aktualisId=$_GET["id"] ?? "";


  $vissza="";
  foreach($adatListaAdat as $egyAdat){
    
    if($aktualisId==$egyAdat['id'])
    {
      $elemClass=" active";
      $linkColor=' text-white';
    }
    else
    {
      $elemClass="";
      $linkColor='';
    }

    $vissza.="<li class=\"list-group-item$elemClass\">
                <div class=\"row\">
                  <div class=\"col-10\"><b>Magyar cím:</b> $egyAdat[cim]</div>
                  <div class=\"col-2\">$egyAdat[ev]</div>
                  <div class=\"col-12\"><b>Eredeti cím:</b> $egyAdat[eredeti]</div>
                  <div class=\"col-12\"><b>Rendező:</b> $egyAdat[rendezo]</div>
                  <div class=\"col-12\"><b>Magyar szöveg írója:</b> $egyAdat[magyarszoveg]</div>
                  <div class=\"col-10\"><b>Szinkronrendező:</b>  $egyAdat[szinkronrendezo]</div>
             
                  <div class=\"col-2\">
                    <a href=\"?page=".$oldalData["page"]."&action=edit&id=$egyAdat[id]\" class=\"$linkColor\"><i class=\"bi bi-pencil\"></i></a>
                    <a href=\"?page=".$oldalData["page"]."&action=delete&id=$egyAdat[id]\" class=\"$linkColor\"><i class=\"bi bi-trash\"></i></a>
                  </div>
                </div>
              </li>";
  }


    return '<ul class="list-group">
    '.$vissza.'
</ul>
';
  }
   
  function adatListaAdat(){
    GLOBAL $conn; 


    //$sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)";
    $sql="SELECT film.id,
film.cim,
film.eredeti,
film.ev,
r.nev as rendezo,
m.nev as magyarszoveg,
sz.nev as szinkronrendezo

FROM film

LEFT JOIN ember r ON film.rendezo_id=r.id
LEFT JOIN ember m ON film.magyarszoveg_id=m.id
LEFT JOIN ember sz ON film.szinkronrendezo_id=sz.id

ORDER BY film.cim";
    $vissza=[];
    if($stmt = $conn->prepare($sql)) {

      //$stmt ->bind_param("i",$szam);
      //$szam = 1;
      $stmt->execute();
      $result= $stmt->get_result();
      
      while($row = $result->fetch_assoc()) {
       $vissza[] = $row;
      }
      //var_dump($vissza);
      
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt ->close();

    return $vissza;
  }
  function formAdat($id){
    GLOBAL $conn; 


    
    $sql="SELECT * from film WHERE id=?";

    $vissza=[];
    if($stmt = $conn->prepare($sql)) {

      $stmt ->bind_param("i",$id);
      $stmt->execute();
      $result= $stmt->get_result();
      
      while($row = $result->fetch_assoc()) {
       $vissza[] = $row;
      }
    
      
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt ->close();

    return $vissza[0];
  }
  
   function adatInsert($cim,$eredeti,$ev,$rendezo_id,$magyarszoveg_id,$szinkronrendezo_id){
    GLOBAL $conn; 

   $sql="INSERT INTO film 
(cim,eredeti,ev,rendezo_id,magyarszoveg_id,szinkronrendezo_id) 
VALUES (?,?,?,?,?,?)";
    if($stmt = $conn->prepare($sql)) {

      $stmt ->bind_param("ssiiii",$cim,$eredeti,$ev,$rendezo_id,$magyarszoveg_id,$szinkronrendezo_id);
$stmt->execute();

    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt ->close();
  }
  
function adatUpdate($id,$cim,$eredeti,$ev,$rendezo_id,$magyarszoveg_id,$szinkronrendezo_id)
{
GLOBAL $conn; 

$sql="UPDATE film 
SET cim=?, eredeti=?, ev=?, rendezo_id=?, magyarszoveg_id=?, szinkronrendezo_id=?
WHERE id=?";

if($stmt = $conn->prepare($sql)) {

$stmt->bind_param(
"ssiiiii",
$cim,
$eredeti,
$ev,
$rendezo_id,
$magyarszoveg_id,
$szinkronrendezo_id,
$id
);

$stmt->execute();

}
else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
}

  function adatDelete($id)
  {
    GLOBAL $conn; 

    $sql="DELETE FROM film WHERE id=?";
    if($stmt = $conn->prepare($sql)){

$stmt ->bind_param("i",$id);
$stmt->execute();
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt ->close();
  }
?>


