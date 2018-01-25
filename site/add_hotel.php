<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Hotel.php");

if(isset($_POST["name"])) {
  $conn = new DbManager();

  $name = $_POST["name"];
  $descr = $_POST["descr"];
  $tel = $_POST["tel"];
  $dist = $_POST["dist"];
  $path = "img/hotel/$name.png";
  $imgURL = "http://ec2-13-58-204-113.us-east-2.compute.amazonaws.com/mirribilandia/$path";
  $hotel = new Hotel(0, $dist, $name, $descr, $tel, $imgURL);
    if($conn->addHotel($hotel)) {
      sendResponse($userAddedSuccessfull, "Hotel aggiunto correttamente", $extra);
    } else {
      sendResponse($sqlError, "Errore durante l'inserimento dell'utente", array());
    }
  
} else {
  sendResponse($badRequest, "Nessun dato ricevuto per eseguire le operazioni richieste", array());
}

?>