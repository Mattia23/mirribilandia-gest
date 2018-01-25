<?php

class Utente {

  private static $JSON_USERNAME = "username";
  private static $JSON_PASSWORD = "password";
  private static $JSON_NOME = "nome";
  private static $JSON_COGNOME = "cognome";

  function __construct($id, $password, $nome, $cognome) {
      $this->id = $id;
      $this->password = $password;
      $this->nome = $nome;
      $this->cognome = $cognome;
  }

  function createFromJson($json) {
    $username = $json[Utente::$JSON_USERNAME];
    $password = $json[Utente::$JSON_PASSWORD];
    $nome = $json[Utente::$JSON_NOME];
    $cognome = $json[Utente::$JSON_COGNOME];

    $element = createElementFromJson($elementJson);

    return new Utente($username, $password, $nome, $cognome);
  }

  function generateJson() {
    return array(
      Utente::$JSON_USERNAME => $this->id,
      Utente::$JSON_PASSWORD => $this->password,
      Utente::$JSON_NOME => $this->nome,
      Utente::$JSON_COGNOME => $this->cognome
    );
  }
}

?>