<?php


if(isset($_POST))
{
  $postId = $_POST['id'] ?? '';
  $postCim = $_POST['cim'] ?? '';
  $postSzinhazId = $_POST['szinhaz_id'] ?? '';
  $postMufajId = $_POST['mufaj_id'] ?? '';
  $postNyelvId = $_POST['nyelv_id'] ?? '';
  $postDatumId = $_POST['datum'] ?? '';

 
  $postSend = $_POST['save'] ?? 'default';
  $postNew = $_POST['new'] ?? 'default';
  if($postSend==""){
    adatUpdate($postId,$postCim,$postSzinhazId,$postMufajId,$postNyelvId,$postDatumId); 
    
  }
  elseif($postNew==""){
    adatInsert($postCim,$postSzinhazId,$postMufajId,$postNyelvId,$postDatumId);

    
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
 
    $formAdat=["id"=>"","cim"=>"","szinhazid"=>"","mufaj_id"=>"","nyelv_id"=>"","datum"=>""];
    if(isset($_GET["action"]) && $_GET["action"] == "edit"){
      $formAdat = formAdat($_GET["id"]);
    }


    return '
    <form method="post" action="?page='.$oldalData['page'].'">
  <div class="container">
    <input type="hidden" name="id" id="id" value="'.$formAdat['id'].'">
    <div class="row">



                   <div class="col-12">Cím:</div>
                     <div class="col-12"><input type="text" name="cim" id="cim" class="form-control" value="'.$formAdat["cim"].'"></div>


                                 <div class="col-12">Színház:</div>
              <div class="col-12">
              ' . adatSelect("szinhaz",$formAdat['szinhazid']) . '
              </div>

                                               <div class="col-12">Műfaj:</div>
              <div class="col-12">
              ' . adatSelect("mufaj",$formAdat['mufaj_id']) . '
              </div>

                                               <div class="col-12">Nyelv:</div>
              <div class="col-12">
              ' . adatSelect("nyelv",$formAdat['nyelv_id']) . '
              </div>

                                               <div class="col-12">Színház:</div>
              <div class="col-12">
              ' . adatSelect("szinhaz",$formAdat['szinhazid']) . '
              </div>

                  <div class="col-12">Dátum:</div>
                     <div class="col-12"><input type="date" name="datum" id="datum" class="form-control" value="'.$formAdat["datum"].'"></div>

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
                  <div class=\"col-7\">$egyAdat[cim]</div>
                  <div class=\"col-3\">$egyAdat[mufaj]</div>
                  <div class=\"col-2\">$egyAdat[nyelv]</div>
                  <div class=\"col-7\">$egyAdat[szinhaz]</div>
                  <div class=\"col-3\">$egyAdat[datum]</div>

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
    $sql="SELECT eloadas.*, szinhaz.nev AS szinhaz, mufaj.nev AS mufaj, nyelv.nev AS nyelv
    FROM eloadas
                          JOIN szinhaz on szinhazid=szinhaz.id
                          JOIN mufaj on mufaj_id=mufaj.id
                          JOIN nyelv on nyelv_id=nyelv.id
                          
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


    
    $sql="SELECT * from eloadas WHERE id=?";

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
  

   function adatInsert($cim,$szinhazid,$mufaj_id,$nyelv_id,$datum){
    GLOBAL $conn; 

    $sql="INSERT INTO eloadas (cim,szinhazid,mufaj_id,nyelv_id,datum) values (?,?,?,?,?)";
    if($stmt = $conn->prepare($sql)) {

      $stmt ->bind_param("siiis",$cim,$szinhazid,$mufaj_id,$nyelv_id,$datum);
      $stmt->execute();  
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt ->close();
  }
  
  function adatUpdate($id,$cim,$szinhazid,$mufaj_id,$nyelv_id,$datum)
  {
    
    GLOBAL $conn; 

    $sql="UPDATE eloadas SET cim=?, szinhazid=?, mufaj_id=?,nyelv_id=?,datum=? WHERE id=?";
    if($stmt = $conn->prepare($sql)) {

      $stmt ->bind_param("siiisi",$cim,$szinhazid,$mufaj_id,$nyelv_id,$datum,$id);
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


