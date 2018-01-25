<?php

/*
  Restituisce la tabella del database associata ad una data categoria di elemento
*/
function categoryToTable($category) {
  switch ($category) {
    case "cartaCredito": return "carta_credito";
    case "contoBancario": return "conto_bancario";
    case "codiceFiscale": return "codice_fiscale";
    case "credenzialeAccesso": return "credenziale_accesso";
    default: return "";
  }
}

/*
  Converte un array json in una lista di ElementMetadata
*/
function jsonToList($json) {
  $res = array();
  foreach($json as $metadataJson) {
    $res[count($res)] = ElementMetadata::createFromJson($metadataJson);
  }

  return $res;
}

/*
  Converte una lista di ElementMetadata in un array json
*/
function listToJson($list) {
  $json = array();

  foreach($list as $m) {
    $json[count($json)] = $m->generateJson();
  }

  return $json;
}

/*
  Crea un oggetto Element dato un oggetto json.
*/
function createElementFromJson($json) {
  $category = $json["category"];

  switch($category) {
    case "cartaCredito": return CartaCredito::createFromJson($json);
    case "contoBancario": return ContoBancario::createFromJson($json);
    case "credenzialeAccesso": return CredenzialeAccesso::createFromJson($json);
    case "codiceFiscale": return CodiceFiscale::createFromJson($json);
    default: return null;
  }
}

?>
