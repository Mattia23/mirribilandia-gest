<?php

class Foto {

  private static $JSON_ID = "id";
  private static $JSON_UTENTE = "utente";
	private static $JSON_DATA = "data";
	private static $JSON_IMMAGINE = "immagine";
	private static $JSON_ATTRAZIONE = "attrazione";

  function __construct($id, $data, $utente, $immagine, $attrazione) {
    $this->id = $id;
    $this->data = $data;
    $this->utente = $utente;
    $this->immagine = $immagine;
	$this->attrazione = $attrazione;
  }

  function createFromJson($json) {
	  $id = $json[Foto::$JSON_ID];
    $data = $json[Foto::$JSON_DATA];
    $utente = $json[Foto::$JSON_UTENTE];
    $immagine	= $json[Foto::$JSON_IMMAGINE];
	$attrazione	= $json[Foto::$JSON_ATTRAZIONE];

    return new Foto($id, $data, $utente, $immagine, $attrazione);
  }

  function generateJson() {
    
    return array(
	  Foto::$JSON_ID => $this->id,
      Foto::$JSON_DATA => $this->data,
      Foto::$JSON_UTENTE => $this->utente,
      Foto::$JSON_IMMAGINE => $this->immagine,
	  Foto::$JSON_ATTRAZIONE => $this->attrazione
    );
  }
}

?>