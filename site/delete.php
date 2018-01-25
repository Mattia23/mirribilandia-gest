<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Attrazione.php");

if(isset($_POST["id"])) {
  $conn = new DbManager();

  $id = $_POST["id"];
  $tabella = $_POST["tabella"];

    if($conn->delete($id, $tabella)) {
      sendResponse($userAddedSuccessfull, "Successo", $extra);
    } else {
      sendResponse($sqlError, "Errore durante cancellazione", array());
    }

} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>
