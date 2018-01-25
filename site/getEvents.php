<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Evento.php");
require("model/util.php");


$conn = new DbManager();

  $metadata = $conn->getEvents();

  // Creo il json da inviare e lo inserisco nel json di risposta
  $json = listToJson($metadata);
  $extra = array(
    "data" => $json
  );
  sendResponse($metadataPacket, "", $extra);


$conn->close();


?>