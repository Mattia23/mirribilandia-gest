<?php

class Distanza {

  private static $JSON_ATTRAZIONE= "attrazione";
  private static $JSON_RISTORANTE = "ristorante";
	private static $JSON_DISTANZA = "distanza";

  function __construct($attrazione, $distanza, $ristorante) {
    $this->attrazione = $attrazione;
    $this->distanza = $distanza;
    $this->ristorante = $ristorante;
  }

  function createFromJson($json) {
	  $attrazione = $json[Distanza::$JSON_ATTRAZIONE];
    $distanza = $json[Distanza::$JSON_DISTANZA];
    $ristorante = $json[Distanza::$JSON_RISTORANTE];

    return new Distanza($attrazione, $distanza, $ristorante);
  }

  function generateJson() {
    
    return array(
	  Distanza::$JSON_ATTRAZIONE => $this->attrazione,
      Distanza::$JSON_DISTANZA => $this->distanza,
      Distanza::$JSON_RISTORANTE => $this->ristorante
    );
  }
}

?>