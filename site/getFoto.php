<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Utente.php");
require("model/Foto.php");
require("model/util.php");

if(isset($_POST["username"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $conn = new DbManager();

  // Controllo che l'username e la password appartengano ad un utente
  if($conn->checkCredentials($username, $password)) {
    $metadata = $conn->getFoto($username);

    // Creo il json da inviare e lo inserisco nel json di risposta
    $json = listToJson($metadata);
    $extra = array(
      "data" => $json
    );
    sendResponse($metadataPacket, "", $extra);
  } else {
    sendResponse($loginFailed, "Username e/o password errati");
  }

  $conn->close();
} else {
  sendResponse($badRequest, "Nessun dato ricevuto, impossibile eseguire le operazioni richieste");
}

?>
