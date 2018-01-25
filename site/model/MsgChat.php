<?php

class MsgChat {
  private static $JSON_ID = "id";
  private static $JSON_USERNAME = "username";
  private static $JSON_ATTRAZIONE = "attrazione";
  private static $JSON_MESSAGGIO = "messaggio";
  private static $JSON_ORARIO = "orario";

  function __construct($id, $username, $attrazione, $messaggio, $orario) {
      $this->id = $id;
      $this->username = $username;
      $this->attrazione = $attrazione;
      $this->messaggio = $messaggio;
      $this->orario = $orario;
  }

  function createFromJson($json) {
    $id = $json[MsgChat::$JSON_ID];
    $username = $json[MsgChat::$JSON_USERNAME];
    $attrazione = $json[MsgChat::$JSON_ATTRAZIONE];
    $messaggio = $json[MsgChat::$JSON_MESSAGGIO];
    $orario = $json[MsgChat::$JSON_ORARIO];

    $element = createElementFromJson($elementJson);

    return new MsgChat($id, $username, $attrazione, $messaggio, $orario);
  }

  function generateJson() {
    return array(
      MsgChat::$JSON_ID => $this->id,
      MsgChat::$JSON_USERNAME => $this->username,
      MsgChat::$JSON_ATTRAZIONE => $this->attrazione,
      MsgChat::$JSON_MESSAGGIO => $this->messaggio,
      MsgChat::$JSON_ORARIO => $this->orario
    );
  }
}

?>
