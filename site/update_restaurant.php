<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Ristorante.php");

if(isset($_POST["name"])) {
  $conn = new DbManager();
  $id = $_POST["id"];
   $name = $_POST["name"];
  $descr = $_POST["descr"];
  $phone = $_POST["phone"];
  if(isset($_POST["img"])){
	  $imgURL = $_POST["img"];
  } else {
	  $path = "img/restaurant/$name.png";
	  $imgURL = "http://ec2-13-58-204-113.us-east-2.compute.amazonaws.com/mirribilandia/$path";
  }
  
  $rest = new Ristorante($id, $name, $descr, $phone, $imgURL, -1);
    if($conn->updateRistorante($rest)) {
      sendResponse($userAddedSuccessfull, "Hotel aggiunto correttamente", $extra);
    } else {
      sendResponse($sqlError, "Errore durante l'inserimento dell'utente", array());
    }
  
} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>