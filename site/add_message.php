<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/MsgChat.php");

if(isset($_POST["messaggio"])) {
  $conn = new DbManager();

  $username = $_POST["username"];
  $attrazione = $_POST["attrazione"];
  $messaggio = $_POST["messaggio"];
  $orario = $_POST["orario"];
	
  if($conn->addMsgChat(new MsgChat($id,$username, $attrazione, $messaggio, $orario))) {
      sendResponse($msgSentSuccessfull, "Messaggio inviato correttamente", array());
  } else {
      sendResponse($sqlError, "Errore durante l'invio", array());
  }
  
} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>
