<?php

class Ristorante {

  private static $JSON_ID = "id";
  private static $JSON_NOME = "nome";
  private static $JSON_DESCRIZIONE = "descrizione";
  private static $JSON_TEL = "tel";
  private static $JSON_IMMAGINE = "immagine";
  private static $JSON_DISTANZA = "distanza";

  function __construct($id, $nome, $descrizione, $tel, $immagine, $distanza) {
    $this->id = $id;
    $this->nome = $nome;
    $this->descrizione = $descrizione;
	$this->tel = $tel;
	$this->immagine = $immagine;
	$this->distanza = $distanza;
  }

  function createFromJson($json) {
	  $id = $json[Ristorante::$JSON_ID];
    $nome = $json[Ristorante::$JSON_NOME];
    $descrizione	= $json[Ristorante::$JSON_DESCRIZIONE];
	$tel	= $json[Ristorante::$JSON_TEL];
	$immagine = $json[Ristorante::$JSON_IMMAGINE];
	$distanza = $json[Ristorante::$JSON_DISTANZA];

    return new Ristorante($id, $nome, $descrizione, $tel, $immagine, $distanza);
  }

  function generateJson() {
    
    return array(
	  Ristorante::$JSON_ID => $this->id,
      Ristorante::$JSON_NOME => $this->nome,
      Ristorante::$JSON_DESCRIZIONE => $this->descrizione,
	  Ristorante::$JSON_TEL => $this->tel,
	  Ristorante::$JSON_IMMAGINE => $this->immagine,
	  Ristorante::$JSON_DISTANZA => $this->distanza
    );
  }
}

?>