<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Ristorante.php");
require("model/util.php");

if(isset($_POST["attrazione"])) {
  $attrazione = $_POST["attrazione"];
  $conn = new DbManager();
  $metadata = $conn->getRistorantibyAttraction($attrazione);
  
   // Creo il json da inviare e lo inserisco nel json di risposta
   $json = listToJson($metadata);
   $extra = array(
     "data" => $json
   );
   sendResponse($metadataPacket, "", $extra);

$conn->close();
} else {
  sendResponse($badRequest, "Nessun dato ricevuto, impossibile eseguire le operazioni richieste");
}

?>
