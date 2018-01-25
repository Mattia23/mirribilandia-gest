<?php

class Admin {

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
    $username = $json[Admin::$JSON_USERNAME];
    $password = $json[Admin::$JSON_PASSWORD];
    $nome = $json[Admin::$JSON_NOME];
    $cognome = $json[Admin::$JSON_COGNOME];

    $element = createElementFromJson($elementJson);

    return new Admin($username, $password, $nome, $cognome);
  }

  function generateJson() {
    return array(
      Admin::$JSON_USERNAME => $this->id,
      Admin::$JSON_PASSWORD => $this->password,
      Admin::$JSON_NOME => $this->nome,
      Admin::$JSON_COGNOME => $this->cognome
    );
  }
}

?>