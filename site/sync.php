<?php

header("Access-Control-Allow-Origin: *");

require("model/DbManager.php");
require("model/MessageCode.php");
require("model/Utente.php");
require("model/ElementMetadata.php");
require("model/Element.php");
require("model/CartaCredito.php");
require("model/CredenzialeAccesso.php");
require("model/CodiceFiscale.php");
require("model/ContoBancario.php");
require("model/util.php");

if(isset($_POST["username"]) && isset($_POST["data"])) {
  $userId = $_POST["username"];
  $password = $_POST["password"];

  $conn = new DbManager();

  // Controllo le credenziali
  if($conn->checkCredentials($userId, $password)) {

    // Ottengo l'array di metadata inviato dall'utente
    $userData = json_decode($_POST["data"], true);
    $extra = $userData;
    $userData = jsonToList($userData);

    // Aggiorno i dati del database
    foreach($userData as $metadata) {
      $state = $metadata->state;
      $element = $metadata->element;

      switch($state) {
        case "REMOVED" :
          $conn->removeElement($metadata->element, $userId);
          $conn->removeElementMetadata($metadata, $userId);
          break;

        case "ADDED" :
          $metadata->state = "SYNCHRONIZED";
          $conn->addElement($metadata->element, $userId);
          $conn->addElementMetadata($metadata, $userId);
          break;

        case "MODIFIED":
          $metadata->state = "SYNCHRONIZED";
          $conn->updateElement($metadata->element, $userId);
          $conn->updateElementMetadata($metadata, $userId);
          break;

        default: break;
      }
    }
    $conn->close();
    sendResponse($synchronizationSuccessfull, "Sincronizzazione effettuata con successo", $extra);

  } else {
    sendResponse($loginFailed, "Username e/o password errati", array());
  }
} else {
  sendResponse($badRequest, "Credenziali non immesse", array());
}

?>
