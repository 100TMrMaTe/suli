<?php

if(isset($_POST))
{
  $postSzinkid = $_POST['szinkid'] ?? '';
  $postFilmId  = $_POST['film_id'] ?? '';
  $postSzerep  = $_POST['szerep'] ?? '';
  $postSzinesz = $_POST['szinesz_id'] ?? '';
  $postHang    = $_POST['hang_id'] ?? '';

  $postSend = $_POST['save'] ?? 'default';
  $postNew  = $_POST['new'] ?? 'default';

  if($postSend == ""){
    adatUpdate($postSzinkid, $postFilmId, $postSzerep, $postSzinesz, $postHang);
  }
  elseif($postNew == ""){
    adatInsert($postFilmId, $postSzerep, $postSzinesz, $postHang);
  }
}

if(isset($_GET['action']) && $_GET['action'] == "delete"){
  adatDelete($_GET['id']);
}

$tartalom = szerkezet();

function cim($cim){
  return "<h2>$cim</h2>";
}

function szerkezet(){
  return
  "<div class=\"container\">
      <div class=\"row\">".cim("Szinkronhangok")."</div>
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

  $formAdat = [
    "szinkid"    => "",
    "film_id"    => "",
    "szerep"     => "",
    "szinesz_id" => "",
    "hang_id"    => ""
  ];

  if(isset($_GET["action"]) && $_GET["action"] == "edit"){
    $formAdat = formAdat($_GET["id"]);
  }

  return '
<form method="post" action="?page='.$oldalData['page'].'">

  <input type="hidden" name="szinkid" value="'.$formAdat['szinkid'].'">

  <div class="mb-2">Film</div>
  '.filmSelect("film_id", $formAdat['film_id']).'

  <div class="mb-2">Szerep</div>
  <input type="text" name="szerep" class="form-control" value="'.$formAdat['szerep'].'">

  <div class="mb-2">Színész</div>
'.adatSelect("ember", "szinesz_id", $formAdat['szinesz_id'], "teljes_nev").'

<div class="mb-2">Magyar hang</div>
'.adatSelect("ember", "hang_id", $formAdat['hang_id'], "teljes_nev").'

  <div class="row mt-3">
    '.($formAdat['szinkid'] != "" ?
        '<div class="col-6 text-center"><button type="submit" class="btn btn-primary" name="save">Mentés</button></div>'
        : '').'
    <div class="col-6 text-center"><button type="submit" class="btn btn-primary" name="new">Mentés újként</button></div>
  </div>

</form>
';
}

function filmSelect($name, $selectedId){
  GLOBAL $conn;

  $sql = "SELECT id, cim FROM film ORDER BY cim";
  $vissza = '<select name="'.$name.'" class="form-select">';

  if($stmt = $conn->prepare($sql)){
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
      $selected = ($row['id'] == $selectedId) ? 'selected' : '';
      $vissza .= '<option value="'.$row['id'].'" '.$selected.'>'.$row['cim'].'</option>';
    }
    $stmt->close();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $vissza .= '</select>';
  return $vissza;
}

function adatSelect($tabla, $name, $id, $mezo = "nev"){
  $adatok = listaAdat($tabla, $mezo);

  $vissza = '<select name="'.$name.'" class="form-select">';
  $vissza .= '<option value="">-- válassz --</option>';

  foreach($adatok as $egy){
    $vissza .= '<option value="'.$egy['id'].'" '.($egy['id'] == $id ? 'selected' : '').'>'.$egy[$mezo].'</option>';
  }

  $vissza .= '</select>';
  return $vissza;
}

function listaAdat($tabla, $mezo = "nev"){
  GLOBAL $conn;

  $sql = "SELECT * FROM $tabla ORDER BY $mezo";
  $vissza = [];

  if($stmt = $conn->prepare($sql)){
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
      $vissza[] = $row;
    }
    $stmt->close();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  return $vissza;
}

function adatLista(){
  GLOBAL $oldalData;

  $adatListaAdat = adatListaAdat();
  $aktualisId = $_GET["id"] ?? "";

  $vissza = "";
  foreach($adatListaAdat as $egyAdat){

    if($aktualisId == $egyAdat['szinkid']){
      $elemClass  = " active";
      $linkColor  = ' text-white';
    } else {
      $elemClass  = "";
      $linkColor  = '';
    }

    $vissza .= "<li class=\"list-group-item$elemClass\">
                  <div class=\"row\">
                    <div class=\"col-10\"><b>Film:</b> $egyAdat[film_cim]</div>
                    <div class=\"col-2\"></div>
                    <div class=\"col-12\"><b>Szerep:</b> $egyAdat[szerep]</div>
                    <div class=\"col-12\"><b>Színész:</b> $egyAdat[szinesz]</div>
                    <div class=\"col-10\"><b>Magyar hang:</b> $egyAdat[hang]</div>
                    <div class=\"col-2\">
                      <a href=\"?page=".$oldalData["page"]."&action=edit&id=$egyAdat[szinkid]\" class=\"$linkColor\"><i class=\"bi bi-pencil\"></i></a>
                      <a href=\"?page=".$oldalData["page"]."&action=delete&id=$egyAdat[szinkid]\" class=\"$linkColor\"><i class=\"bi bi-trash\"></i></a>
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

  $sql = "SELECT
    szinkron.szinkid,
    szinkron.id AS film_id,
    szinkron.szerep,
    film.cim AS film_cim,
    sz.nev AS szinesz,
    h.nev AS hang
  FROM szinkron
  LEFT JOIN film ON szinkron.id = film.id
  LEFT JOIN ember sz ON szinkron.szinesz_id = sz.id
  LEFT JOIN ember h  ON szinkron.hang_id    = h.id
  ORDER BY film.cim, szinkron.szerep";

  $vissza = [];

  if($stmt = $conn->prepare($sql)){
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
      $vissza[] = $row;
    }
    $stmt->close();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  return $vissza;
}

function formAdat($id){
  GLOBAL $conn;

  $sql = "SELECT * FROM szinkron WHERE szinkid = ?";
  $vissza = [];

  if($stmt = $conn->prepare($sql)){
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
      $vissza[] = $row;
    }
    $stmt->close();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  return $vissza[0];
}

function adatInsert($film_id, $szerep, $szinesz_id, $hang_id){
  GLOBAL $conn;

  $sql = "INSERT INTO szinkron (id, szerep, szinesz_id, hang_id) VALUES (?, ?, ?, ?)";

  if($stmt = $conn->prepare($sql)){
    $stmt->bind_param("isii", $film_id, $szerep, $szinesz_id, $hang_id);
    $stmt->execute();
    $stmt->close();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

function adatUpdate($szinkid, $film_id, $szerep, $szinesz_id, $hang_id){
  GLOBAL $conn;

  $sql = "UPDATE szinkron SET id = ?, szerep = ?, szinesz_id = ?, hang_id = ? WHERE szinkid = ?";

  if($stmt = $conn->prepare($sql)){
    $stmt->bind_param("isiii", $film_id, $szerep, $szinesz_id, $hang_id, $szinkid);
    $stmt->execute();
    $stmt->close();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

function adatDelete($id){
  GLOBAL $conn;

  $sql = "DELETE FROM szinkron WHERE szinkid = ?";

  if($stmt = $conn->prepare($sql)){
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>