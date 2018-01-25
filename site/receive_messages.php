<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/MsgChat.php");
require("model/util.php");

if(isset($_POST["username"])) {
  $conn = new DbManager();
  $username = $_POST["username"];
  $attrazione = $_POST["attrazione"];
  $lastMessageId = $_POST["last_message"];

  $metadata = $conn->getLastMessages($username, $attrazione,$lastMessageId);

  // Creo il json da inviare e lo inserisco nel json di risposta
  $json = listToJson($metadata);
  $extra = array(
    "data" => $json
  );
  sendResponse($msgReceivedSuccessfull, "", $extra);


	$conn->close();
} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>