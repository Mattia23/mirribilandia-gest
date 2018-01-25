<?php

class Biglietto {

  private static $JSON_ID = "id";
  private static $JSON_UTENTE = "utente";
	private static $JSON_DATA = "data";
	private static $JSON_TIPO = "tipo";

  function __construct($id, $data, $utente, $tipo) {
    $this->id = $id;
    $this->data = $data;
    $this->utente = $utente;
    $this->tipo = $tipo;
  }

  function createFromJson($json) {
	  $id = $json[Biglietto::$JSON_ID];
    $data = $json[Biglietto::$JSON_DATA];
    $utente = $json[Biglietto::$JSON_UTENTE];
    $tipo	= $json[Biglietto::$JSON_TIPO];

    return new Biglietto($id, $data, $utente, $tipo);
  }

  function generateJson() {
    
    return array(
	  Biglietto::$JSON_ID => $this->id,
      Biglietto::$JSON_DATA => $this->data,
      Biglietto::$JSON_UTENTE => $this->utente,
      Biglietto::$JSON_TIPO => $this->tipo
    );
  }
}

?>