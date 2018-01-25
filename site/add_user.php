<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Utente.php");

if(isset($_POST["username"])) {
  $conn = new DbManager();

  $username = $_POST["username"];
  $password = $_POST["password"];

  // Controllo se l'utente è già stato inserito. In caso negativo procedo all'inserimento
  if(!$conn->isUserPresent($username)) {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];

    // Provo ad inserire l'utente
    if($conn->addUser(new Utente($username, $password, $nome, $cognome))) {
      sendResponse($userAddedSuccessfull, "Utente aggiunto correttamente", $extra);
    } else {
      sendResponse($sqlError, "Errore durante l'inserimento dell'utente", array());
    }
  } else {
    sendResponse($userAlreadyAdded, "Username gia' presente", array());
  }
  
} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>
