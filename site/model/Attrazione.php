<?php

class Attrazione {

  private static $JSON_ID = "id";
  private static $JSON_NOME = "nome";
	private static $JSON_DESCRIZIONE = "descrizione";
	private static $JSON_ETA_MIN = "eta_min";
	private static $JSON_ALT_MIN = "alt_min";
	private static $JSON_TEMPO_ATTESA = "tempo_attesa";
	private static $JSON_ANNO_COSTRUZIONE = "anno_costruzione";
  private static $JSON_BEACON = "beacon";
  private static $JSON_IMMAGINE = "immagine";

  function __construct($id, $descrizione, $nome, $alt_min, $eta_min, $anno_costruzione, $tempo_attesa, $beacon, $immagine) {
    $this->id = $id;
    $this->descrizione = $descrizione;
    $this->nome = $nome;
    $this->alt_min = $alt_min;
    $this->eta_min = $eta_min;
    $this->tempo_attesa = $tempo_attesa;
    $this->beacon = $beacon;
    $this->anno_costruzione = $anno_costruzione;
    $this->immagine = $immagine;
  }

  function createFromJson($json) {
	  $id = $json[Attrazione::$JSON_ID];
    $descrizione = $json[Attrazione::$JSON_DESCRIZIONE];
    $nome = $json[Attrazione::$JSON_NOME];
    $eta_min	= $json[Attrazione::$JSON_ETA_MIN];
    $anno_costruzione = $json[Attrazione::$JSON_ANNO_COSTRUZIONE];
    $alt_min = $json[Attrazione::$JSON_ALT_MIN];
    $tempo_attesa = $json[Attrazione::$JSON_TEMPO_ATTESA];
    $beacon = $json[Attrazione::$JSON_BEACON];
	$immagine = $json[Attrazione::$JSON_IMMAGINE];

    return new Attrazione($id, $descrizione, $nome, $alt_min, $eta_min, $anno_costruzione, $tempo_attesa, $beacon, $immagine);
  }

  function generateJson() {
    
    return array(
	  Attrazione::$JSON_ID => $this->id,
      Attrazione::$JSON_DESCRIZIONE => $this->descrizione,
      Attrazione::$JSON_NOME => $this->nome,
      Attrazione::$JSON_ALT_MIN => $this->alt_min,
      Attrazione::$JSON_ETA_MIN => $this->eta_min,
      Attrazione::$JSON_TEMPO_ATTESA => $this->tempo_attesa,
      Attrazione::$JSON_BEACON => $this->beacon,
      Attrazione::$JSON_ANNO_COSTRUZIONE => $this->anno_costruzione,
	  Attrazione::$JSON_IMMAGINE => $this->immagine
    );
  }
}

?>
