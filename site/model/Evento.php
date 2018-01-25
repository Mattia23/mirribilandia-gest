<?php

class Evento {

  private static $JSON_ID = "id";
  private static $JSON_NOME = "nome";
	private static $JSON_DATA = "data";
	private static $JSON_DESCRIZIONE = "descrizione";
	private static $JSON_ATTRAZIONE = "attrazione";

  function __construct($id, $data, $nome, $descrizione, $attrazione) {
    $this->id = $id;
    $this->data = $data;
    $this->nome = $nome;
    $this->descrizione = $descrizione;
	$this->attrazione = $attrazione;
  }

  function createFromJson($json) {
	  $id = $json[Evento::$JSON_ID];
    $data = $json[Evento::$JSON_DATA];
    $nome = $json[Evento::$JSON_NOME];
    $descrizione	= $json[Evento::$JSON_DESCRIZIONE];
	$attrazione	= $json[Evento::$JSON_ATTRAZIONE];

    return new Evento($id, $data, $nome, $descrizione, $attrazione);
  }

  function generateJson() {
    
    return array(
	  Evento::$JSON_ID => $this->id,
      Evento::$JSON_DATA => $this->data,
      Evento::$JSON_NOME => $this->nome,
      Evento::$JSON_DESCRIZIONE => $this->descrizione,
	  Evento::$JSON_ATTRAZIONE => $this->attrazione
    );
  }
}

?>