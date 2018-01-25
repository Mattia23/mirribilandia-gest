<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Evento.php");

if(isset($_POST["name"])) {
  $conn = new DbManager();

  $name = $_POST["name"];
  $descr = $_POST["descr"];
  $attr = $_POST["attr"];
  $date = $_POST["date"];
  $event = new Evento(0, $date, $name, $descr, $attr);
    if($conn->addEvento($event)) {
      sendResponse($userAddedSuccessfull, "Utente aggiunto correttamente", $extra);
    } else {
      sendResponse($sqlError, "Errore durante l'inserimento dell'utente", array());
    }
  
} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>