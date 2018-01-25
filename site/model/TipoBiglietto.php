<?php

class TipoBiglietto {

  private static $JSON_ID = "id";
  private static $JSON_TIPO = "tipo";
	private static $JSON_PREZZO = "prezzo";
	private static $JSON_SALTAFILA = "saltafila";

  function __construct($id, $tipo, $prezzo, $saltafila) {
    $this->id = $id;
    $this->tipo = $tipo;
    $this->prezzo = $prezzo;
	$this->saltafila = $saltafila;
  }

  function createFromJson($json) {
	  $id = $json[TipoBiglietto::$JSON_ID];
    $tipo = $json[TipoBiglietto::$JSON_TIPO];
    $prezzo	= $json[TipoBiglietto::$JSON_PREZZO];
	$saltafila	= $json[TipoBiglietto::$JSON_SALTAFILA];

    return new TipoBiglietto($id, $tipo, $prezzo, $saltafila);
  }

  function generateJson() {
    
    return array(
	  TipoBiglietto::$JSON_ID => $this->id,
      TipoBiglietto::$JSON_TIPO => $this->tipo,
      TipoBiglietto::$JSON_PREZZO => $this->prezzo,
	  TipoBiglietto::$JSON_SALTAFILA => $this->saltafila
    );
  }
}

?>