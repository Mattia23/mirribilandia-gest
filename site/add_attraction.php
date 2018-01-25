<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Attrazione.php");
require("model/Ristorante.php");
if(isset($_POST["name"])) {
  $conn = new DbManager();

  $name = $_POST["name"];
  $descr = $_POST["descr"];
  $alt_min = $_POST["alt"];
  $eta_min = $_POST["eta"];
  $anno_costruzione = $_POST["anno"];
  $tempo_attesa = $_POST["tempo"];
  $beacon = $_POST["beacon"];
  $path = "img/attraction/$name.png";
  $imgURL = "http://ec2-13-58-204-113.us-east-2.compute.amazonaws.com/mirribilandia/$path";
  $attr = new Attrazione(0, $descr, $name, $alt_min, $eta_min, $anno_costruzione, $tempo_attesa, $beacon, $imgURL);
    if($conn->addAttrazione($attr)) {
      sendResponse($userAddedSuccessfull, "Utente aggiunto correttamente", $extra);
    } else {
      sendResponse($sqlError, "Errore durante l'inserimento dell'utente", array());
    }

} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>
