<?php

class Hotel {

  private static $JSON_ID = "id";
  private static $JSON_NOME = "nome";
  private static $JSON_DISTANZA = "distanza";
  private static $JSON_DESCRIZIONE = "descrizione";
  private static $JSON_TEL = "tel";
  private static $JSON_IMMAGINE = "immagine";

  function __construct($id, $distanza, $nome, $descrizione, $tel, $immagine) {
    $this->id = $id;
    $this->distanza = $distanza;
    $this->nome = $nome;
    $this->descrizione = $descrizione;
	$this->tel = $tel;
	$this->immagine = $immagine;
  }

  function createFromJson($json) {
	  $id = $json[Hotel::$JSON_ID];
    $distanza = $json[Hotel::$JSON_DISTANZA];
    $nome = $json[Hotel::$JSON_NOME];
    $descrizione	= $json[Hotel::$JSON_DESCRIZIONE];
	$tel	= $json[Hotel::$JSON_TEL];
	$immagine = $json[Hotel::$JSON_IMMAGINE];

    return new Hotel($id, $distanza, $nome, $descrizione, $tel, $immagine);
  }

  function generateJson() {
    
    return array(
	  Hotel::$JSON_ID => $this->id,
      Hotel::$JSON_DISTANZA => $this->distanza,
      Hotel::$JSON_NOME => $this->nome,
      Hotel::$JSON_DESCRIZIONE => $this->descrizione,
      Hotel::$JSON_TEL => $this->tel,
      Hotel::$JSON_IMMAGINE => $this->immagine
    );
  }
}

?>