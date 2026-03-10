<?php


if(isset($_POST))
{
  $postId = $_POST['id'] ?? '';
  $postNev = $_POST['nev'] ?? '';
  $postSzekhelyId = $_POST['szekhely_id'] ?? '';

 
  $postSend = $_POST['save'] ?? 'default';
  $postNew = $_POST['new'] ?? 'default';
  if($postSend==""){
    adatUpdate($postId,$postNev,$postSzekhelyId);
    
  }
  elseif($postNew==""){
    adatInsert($postNev,$postSzekhelyId);
    
  }

}

if(isset($_GET['action']) && $_GET['action']=="delete"){
  adatDelete($_GET['id']);
}

$tartalom="";

$tartalom = szerkezet();

  function cim($cim){
    global $oldalData;
     return "<h2>$cim</h2>";
  }
  function szerkezet(){
        global $oldalData;
    return 
    "<div class=\"container\">
        <div class=\"row\">".cim($oldalData["cim"])."</div>
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
   
 
  function adatForm(){
    global $oldalData;
 
    $formAdat=["id"=>"","eloadas"=>"","eloadasid"=>"","nev"=>"","ertek"=>"","szekhely_id"=>""];
    if(isset($_GET["action"]) && $_GET["action"] == "edit"){
      $formAdat = formAdat($_GET["id"]);
    }


    return '
    <form method="post" action="?page='.$oldalData['page'].'">
  <div class="container">
    <input type="hidden" name="id" id="id" value="'.$formAdat['id'].'">
    <div class="row">

            <div class="col-12">Székhely:</div>
              <div class="col-12">
              ' . adatSelect("szekhely",$formAdat['szekhely_id']) . '
              </div>


                   <div class="col-12">Név:</div>
                     <div class="col-12"><input type="text" name="nev" id="nev" class="form-control" value="'.$formAdat["nev"].'"></div>

    </div>

     
    
    <div class="row">
  '.($formAdat['id'] != "" 
      ? '<div class="col-12"><button type="submit" class="mt-4 btn btn-primary" name="save">Mentés</button></div>' 
      : ''
  ).'
  <div class="col-12"><button type="submit" class="mt-4 btn btn-primary" name="new">Mentés újként</button></div>
</div>


  </div>

</form>';
  }
  
  
  function adatSelect($tabla, $id, $mezo="nev"){
    $telepulesek= listaAdat($tabla, $mezo);
    $vissza='<select name="'.$tabla.'_id" class="form-select">';
    
  
    foreach($telepulesek as $egyTelepules)
      {

      $vissza .= '<option value="'.$egyTelepules['id'].'" '.($egyTelepules['id']==$id?'selected':'').'>'.$egyTelepules[$mezo].'</option>';

      }
     
    $vissza.='</select>';

    return $vissza;
  }
  function listaAdat($tabla, $mezo){
    GLOBAL $conn; 

    if($tabla=="eloadas"){
      $sql="SELECT eloadas.id, CONCAT(eloadas.cim, ' - ', szinhaz.nev) AS $mezo FROM eloadas
      JOIN szinhaz on eloadas.szinhazid=szinhaz.id
      ORDER BY eloadas.cim";
    }
    else{
          $sql="SELECT * from $tabla ORDER BY $mezo";
    }
   

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
                  <div class=\"col-7\">$egyAdat[nev] ($egyAdat[szekHely])</div>

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
    $sql="SELECT szinhaz.*, szekhely.nev AS szekHely
    FROM szinhaz
                          JOIN szekhely on szekhely_id=szekhely.id
                         ORDER BY szinhaz.nev;";
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


    
    $sql="SELECT * from szinhaz WHERE id=?";

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
  
   function adatInsert($nev,$szekhely_id){
    GLOBAL $conn; 

    $sql="INSERT INTO szinhaz (nev,szekhely_id) values (?,?)";
    if($stmt = $conn->prepare($sql)) {

      $stmt ->bind_param("si",$nev,$szekhely_id);
      $stmt->execute();  
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt ->close();
  }
  
  function adatUpdate($id,$nev,$szekhely_id)
  {
    
    GLOBAL $conn; 

    $sql="UPDATE szinhaz SET nev=?, szekhely_id=? WHERE id=?";
    if($stmt = $conn->prepare($sql)) {

      $stmt ->bind_param("sii",$nev,$szekhely_id,$id);
      $stmt->execute();  
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt ->close();
  }

  function adatDelete($id)
  {
    GLOBAL $conn; 

    $sql="DELETE FROM szinhaz WHERE id=?";
    if($stmt = $conn->prepare($sql)) {

      $stmt ->bind_param("i",$id);
      $stmt->execute();  
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt ->close();
  }
?>


