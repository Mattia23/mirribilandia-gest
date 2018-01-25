<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Utente.php");

if(isset($_POST["username"])) {
  $dbConnection = new DbManager();
  $username = $_POST["username"];
  $password = $_POST["password"];
  
  $utente = $dbConnection->getUser($username,$password);

  if($utente != null) {
    $extra = array(
      "hash_key" => $utente->hash_key,
      "utente" => $utente->generateJson()
    );
    sendResponse($loginSuccess, "login effettuato con successo", $extra);
  } else {
    sendResponse($loginFailed, "Username e/o password errati", array());
  }
  
} else {
  sendResponse($badRequest, "Nessun dato ricevuto", array());
}

?>