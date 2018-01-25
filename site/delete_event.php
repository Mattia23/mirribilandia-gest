<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Attrazione.php");

if(isset($_POST["id"])) {
  $conn = new DbManager();

  $id = $_POST["id"];
  
    if($conn->deleteEvent($id)) {
      sendResponse($userAddedSuccessfull, "Evento cancellato correttamente", $extra);
    } else {
      sendResponse($sqlError, "Errore durante cancellazione", array());
    }
  
} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>