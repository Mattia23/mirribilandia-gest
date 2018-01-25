<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Ristorante.php");
require("model/Attrazione.php");

if(isset($_POST["name"])) {
  $conn = new DbManager();

  $name = $_POST["name"];
  $descr = $_POST["descr"];
  $phone = $_POST["phone"];
  $path = "img/restaurant/$name.png";
  $imgURL = "http://ec2-13-58-204-113.us-east-2.compute.amazonaws.com/mirribilandia/$path";
  $rest = new Ristorante(0, $name, $descr, $phone, $imgURL, -1);
  var_dump($rest);
    if($conn->addRistorante($rest)) {
      sendResponse($userAddedSuccessfull, "Utente aggiunto correttamente", $extra);
    } else {
      sendResponse($sqlError, "Errore durante l'inserimento dell'utente", array());
    }
  
} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>