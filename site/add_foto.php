<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Foto.php");

if(isset($_POST["utente"])) {
  $conn = new DbManager();

  $utente = $_POST["utente"];
  $attrazione = $_POST["attraz"];
  $id = $utente.$attrazione;
  $path = "img/users/$id.png";
  $imgURL = "http://ec2-13-58-204-113.us-east-2.compute.amazonaws.com/mirribilandia/$path";
  $foto = new Foto(0, 0, $utente, $imgURL, $attrazione);
  var_dump($foto);
    if($conn->addFoto($foto)) {
      sendResponse($userAddedSuccessfull, "Foto aggiunta correttamente", $extra);
    } else {
      sendResponse($sqlError, "Errore durante l'inserimento dell'utente", array());
    }
  
} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>