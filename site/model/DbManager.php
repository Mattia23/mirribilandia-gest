<?php

class DbManager {

  private $servername = "localhost";
  private $serverUsername = "root";
  private $serverPassword = "ViroliRicci12";
  private $dbname = "mirribilandia";
  private $conn;

  function __construct() {
    $this->initConnection();
  }

  private function initConnection() {
    $this->conn = new mysqli($this->servername, $this->serverUsername, $this->serverPassword, $this->dbname);

    if($this->conn->connect_error) {
  	  sendResponse($connectionError, $this->conn->connect_error);
    }
  }

  function close() {
	  $this->conn->close();
  }

  function getAI($tabella){
	  $sql = "SELECT  `AUTO_INCREMENT` 
	FROM INFORMATION_SCHEMA.TABLES
	WHERE TABLE_SCHEMA =  'mirribilandia'
	AND TABLE_NAME ='$tabella'";
	$res = $this->conn->query($sql);
	if($res->num_rows > 0) {
        $row = $res->fetch_assoc();
		return $row["AUTO_INCREMENT"];
  	  } else {
        return null;
      }
  }
  
  /* Resituisce un oggetto di tipo Utente dato l'id e la password.
     Viene richiesta la password poichè tra le informazioni dell'utente è presente la chiave di crittografia dei propri dati,
     un'informazione sensibile che non può essere diffusa
  */
  function getUser($username, $password) {
	  $sql = "SELECT * FROM utente WHERE id='$username'";
      $res = $this->conn->query($sql);
      if(!$res) {
        sendResponse($sqlError, $this->conn->error);
      }

      if($res->num_rows > 0) {
          $row = $res->fetch_assoc();
		  if($row["password"] === $password){
            $id = $row["id"];
            $password = $row["password"];
            $nome = $row["nome"];
            $cognome = $row["cognome"];

            return new Utente($id, $password, $nome, $cognome);
		  }
          return null;
  	  } else {
        return null;
      }
  }


  /*
    Restituisce true se esiste una coppia id-password nel database.
  */
  function checkCredentials($username, $password) {
    $utente = $this->getUser($username, $password);
    return $utente != null;
  }

  // Aggiunge un nuovo utente al database. Resituisce false se l'utente è già presente o si è verificato un errore
  function addUser($user) {
    $id = $user->id;
    $password = $user->password;
    $nome = $user->nome;
    $cognome = $user->cognome;

    $sql = "INSERT INTO utente (id,password,nome,cognome)
      VALUES ('$id','$password','$nome','$cognome');";

    return $this->conn->query($sql);
  }

  // Restituisce true se l'utente con il dato id è presente nel database, false altrimenti
  function isUserPresent($username) {
    $sql = "SELECT * FROM utente WHERE id='$username'";
    $res = $this->conn->query($sql);
    return $res != false && $res->num_rows > 0;
  }

/**************************************ADMIN***************************************************/
/* Resituisce un oggetto di tipo Utente dato l'id e la password.
     Viene richiesta la password poichè tra le informazioni dell'utente è presente la chiave di crittografia dei propri dati,
     un'informazione sensibile che non può essere diffusa
  */
  function getAdmin($username, $password) {
	  $sql = "SELECT * FROM admin WHERE id='$username'";
      $res = $this->conn->query($sql);
      if(!$res) {
        sendResponse($sqlError, $this->conn->error);
      }

      if($res->num_rows > 0) {
          $row = $res->fetch_assoc();
		  if($row["password"] === $password){
            $id = $row["id"];
            $password = $row["password"];
            $nome = $row["nome"];
            $cognome = $row["cognome"];

            return new Admin($id, $password, $nome, $cognome);
		  }
          return null;
  	  } else {
        return null;
      }
  }


  /*
    Restituisce true se esiste una coppia id-password nel database.
  */
  function checkAdminCredentials($username, $password) {
    $utente = $this->getAdmin($username, $password);
    return $utente != null;
  }

  // Aggiunge un nuovo utente al database. Resituisce false se l'utente è già presente o si è verificato un errore
  function addAdmin($user) {
    $id = $user->id;
    $password = $user->password;
    $nome = $user->nome;
    $cognome = $user->cognome;

    $sql = "INSERT INTO admin (id,password,nome,cognome)
      VALUES ('$id','$password','$nome','$cognome');";

    return $this->conn->query($sql);
  }

  // Restituisce true se l'utente con il dato id è presente nel database, false altrimenti
  function isAdminPresent($username) {
    $sql = "SELECT * FROM admin WHERE id='$username'";
    $res = $this->conn->query($sql);
    return $res != false && $res->num_rows > 0;
  }

  /************************************ ADD **************************************************/

  function addAttrazione($attrazione) {
	  $nome = $attrazione->nome;
	  $descrizione = $attrazione->descrizione;
	  $eta_min = $attrazione->eta_min;
	  $alt_min = $attrazione->alt_min;
	  $tempo_attesa = $attrazione->tempo_attesa;
	  $anno_costruzione = $attrazione->anno_costruzione;
	  $beacon = $attrazione->beacon;
	  $immagine = $attrazione->immagine;
	  $sql = "INSERT INTO attrazione(nome, descrizione, eta_min, alt_min, tempo_attesa,
	  anno_costruzione, beacon, immagine)
	  VALUES('$nome', '$descrizione', '$eta_min', '$alt_min', '$tempo_attesa','$anno_costruzione','$beacon','$immagine'); ";
	  $id = $this->getAI('attrazione');
		$r = $this->getRistoranti();
		$sql = $sql."INSERT INTO distanza_rist_attr(attrazione, ristorante, distanza) VALUES ";
		$first = true;
		foreach($r as $rist){
			$dist = rand(5, 230) * 5;
			if($first){
				$first = false;
				$sql = $sql."('$id', '$rist->id', '$dist')";
			}
			else $sql = $sql.", ('$id', '$rist->id', '$dist')";
		}
    return $this->conn->multi_query($sql);
  }

  function addEvento($evento) {
	  $nome = $evento->nome;
	  $descrizione = $evento->descrizione;
	  $attrazione = $evento->attrazione;
	  $data = $evento->data;
	  $sql = "INSERT INTO evento(nome, descrizione, attrazione, data)
	  VALUES('$nome', '$descrizione', '$attrazione', '$data')";

    return $this->conn->query($sql);
  }

  function addFoto($foto) {
	  $utente = $foto->utente;
	  $attrazione = $foto->attrazione;
	  $immagine = $foto->immagine;
	  $data = $evento->data;
	  $sql = "INSERT INTO foto(utente, attrazione, immagine)
	  VALUES('$utente', '$attrazione', '$immagine')";

    return $this->conn->query($sql);
  }

  function addHotel($hotel) {
	  $nome = $hotel->nome;
	  $descrizione = $hotel->descrizione;
	  $distanza = $hotel->distanza;
	  $tel = $hotel->tel;
	  $immagine = $hotel->immagine;
	  $sql = "INSERT INTO hotel(nome, descrizione, distanza, tel, immagine)
	  VALUES('$nome', '$descrizione', '$distanza', '$tel', '$immagine')";

    return $this->conn->query($sql);
  }

  function addRistorante($ristorante) {
	  $nome = $ristorante->nome;
	  $descrizione = $ristorante->descrizione;
	  $tel = $ristorante->tel;
	  $immagine = $ristorante->immagine;
	  $sql = "INSERT INTO ristorante(nome, descrizione, tel, immagine)
	  VALUES('$nome', '$descrizione', '$tel', '$immagine');";
	$id = $this->getAI('ristorante');
		$a = $this->getAttrazioni();
		$sql = $sql."INSERT INTO distanza_rist_attr(attrazione, ristorante, distanza) VALUES ";
		$first = true;
		foreach($a as $attr){
			$dist = rand(5, 230) * 5;
			if($first){
				$first = false;
				$sql = $sql."('$attr->id', '$id', '$dist')";
			}
			else $sql = $sql.", ('$attr->id', '$id', '$dist')";
		}
    return $this->conn->multi_query($sql);
  }

  function addMsgChat($msgChat) {
    $username = $msgChat->username;
    $attrazione = $msgChat->attrazione;
    $messaggio = $msgChat->messaggio;

    $sql = "INSERT INTO chat (id,username,id_attrazione,messaggio,orario)
      VALUES ('','$username','$attrazione','$messaggio',DEFAULT);";

    return $this->conn->query($sql);
  }

  /************************************* UPDATE ***********************************************/

  function updateAttrazione($attrazione) {
    $id = $attrazione->id;
    $nome = $attrazione->nome;
	$descrizione = $attrazione->descrizione;
	$eta_min = $attrazione->eta_min;
	$alt_min = $attrazione->alt_min;
	$tempo_attesa = $attrazione->tempo_attesa;
	$anno_costruzione = $attrazione->anno_costruzione;
	$beacon = $attrazione->beacon;
	$immagine = $attrazione->immagine;
    $sql = "UPDATE attrazione SET nome='$nome',descrizione='$descrizione',eta_min='$eta_min',alt_min='$alt_min',tempo_attesa='$tempo_attesa',
	anno_costruzione='$anno_costruzione',beacon='$beacon',immagine='$immagine'
          WHERE id='$id'";

    return $this->conn->query($sql);
  }

  function updateEvento($evento) {
    $id = $evento->id;
    $nome = $evento->nome;
	$descrizione = $evento->descrizione;
	$attrazione = $evento->attrazione;
	$data = $evento->data;
    $sql = "UPDATE evento SET nome='$nome',descrizione='$descrizione',attrazione='$attrazione',data='$data'
          WHERE id='$id'";

    return $this->conn->query($sql);
  }

  function updateHotel($hotel) {
	$id = $hotel->id;
    $nome = $hotel->nome;
	$descrizione = $hotel->descrizione;
	$distanza = $hotel->distanza;
	$tel = $hotel->tel;
	$immagine = $hotel->immagine;
    $sql = "UPDATE hotel SET nome='$nome',descrizione='$descrizione',distanza='$distanza',tel='$tel', immagine='$immagine'
          WHERE id='$id'";

    return $this->conn->query($sql);
  }

  function updateRistorante($ristorante) {
	$id = $ristorante->id;
    $nome = $ristorante->nome;
	$descrizione = $ristorante->descrizione;
	$tel = $ristorante->tel;
	$immagine = $ristorante->immagine;
    $sql = "UPDATE ristorante SET nome='$nome',descrizione='$descrizione',tel='$tel', immagine='$immagine'
          WHERE id='$id'";

    return $this->conn->query($sql);
  }

  /************************************ REMOVE ***********************************************/
  function removeElementMetadata($metadata, $userId) {
    $sql = "DELETE FROM element_metadata WHERE element_metadata_id='$metadata->id' AND user_id='$userId'";
    return $this->conn->query($sql);
  }

  function delete($id, $tabella){

	   $sql = "DELETE FROM ".$tabella." WHERE id=".$id;
  //return $sql;
     return $this->conn->query($sql);
  }


  /************************************* GET **************************************************/
  function getEvents(){
	  $eventsArray = array();
	  $sql = "SELECT * FROM evento";
	  $res = $this->conn->query($sql);

	if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$nome = $row["nome"];
			$descrizione = $row["descrizione"];
			$attrazione = $row["attrazione"];
			$data = $row["data"];
			$event = new Evento($id, $data, $nome, $descrizione, $attrazione);
			if($event != null) {
				$eventsArray[count($eventsArray)] = $event;
			}


	  }
	  return $eventsArray;
	}
  }
  
  function getEventById($id){
	  $eventsArray = array();
	  $sql = "SELECT * FROM evento where id=".$id;
	  $res = $this->conn->query($sql);

	if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$nome = $row["nome"];
			$descrizione = $row["descrizione"];
			$attrazione = $row["attrazione"];
			$data = $row["data"];
			return new Evento($id, $data, $nome, $descrizione, $attrazione);
	  }
	  return null;
	}
  }

  function getUsers(){
	  $usersArray = array();
	  $sql = "SELECT id, nome, cognome FROM utente";
	  $res = $this->conn->query($sql);

	if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$username = $row["id"];
			$nome = $row["nome"];
			$cognome = $row["cognome"];
			$user = new Utente($username, 0, $nome, $cognome);
			if($user != null) {
				$usersArray[count($usersArray)] = $user;
			}


	  }
	  return $usersArray;
	}
  }

  function getAttrazioni(){
	  $attrazioni = array();
	  $sql = "SELECT * FROM attrazione";
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$nome = $row["nome"];
			$descrizione = $row["descrizione"];
			$eta_min = $row["eta_min"];
			$alt_min = $row["alt_min"];
			$tempo_attesa = $row["tempo_attesa"];
			$anno_costruzione = $row["anno_costruzione"];
			$beacon = $row["beacon"];
			$immagine = $row["immagine"];
			$attrazione = new Attrazione($id, $descrizione, $nome, $alt_min, $eta_min, $anno_costruzione, $tempo_attesa, $beacon, $immagine);
			if($attrazione != null) {
				$attrazioni[count($attrazioni)] = $attrazione;
			}
		}
	  }
	  return $attrazioni;
  }
  
  function getAttrById($id){
	  $sql = "SELECT * FROM attrazione where id=".$id;
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$nome = $row["nome"];
			$descrizione = $row["descrizione"];
			$eta_min = $row["eta_min"];
			$alt_min = $row["alt_min"];
			$tempo_attesa = $row["tempo_attesa"];
			$anno_costruzione = $row["anno_costruzione"];
			$beacon = $row["beacon"];
			$immagine = $row["immagine"];
			return new Attrazione($id, $descrizione, $nome, $alt_min, $eta_min, $anno_costruzione, $tempo_attesa, $beacon, $immagine);
		}
	  }
	  return null;
  }

  function getAttrazioniNameList(){
    $attrazioni = array();
    $sql = "SELECT nome FROM attrazione";
    $res = $this->conn->query($sql);

    if($res && $res->num_rows > 0) {
    while($row = $res->fetch_assoc()) {
      $nome = $row["nome"];
      $attrazioni[count($attrazioni)] = $nome;
    }
    }
    return $attrazioni;
  }

  function getRistoranti(){
	  $ristoranti = array();
	  $sql = "SELECT * FROM ristorante";
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$nome = $row["nome"];
			$descrizione = $row["descrizione"];
			$tel = $row["tel"];
			$immagine = $row["immagine"];
			$ristorante = new Ristorante($id, $nome, $descrizione, $tel, $immagine, -1);
			if($ristorante != null) {
				$ristoranti[count($ristoranti)] = $ristorante;
			}
		}
	  }
	  return $ristoranti;
  }
  
  function getRestaurantById($id){
	  $sql = "SELECT * FROM ristorante where id=".$id;
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$nome = $row["nome"];
			$descrizione = $row["descrizione"];
			$tel = $row["tel"];
			$immagine = $row["immagine"];
			return new Ristorante($id, $nome, $descrizione, $tel, $immagine, -1);
		}
	  }
	  return null;
  }

  function getRistorantibyAttraction($attrazione){
		$ristoranti = array();
		$sql = "SELECT r.id, r.nome, r.descrizione, r.tel, r.immagine, dra.distanza FROM ristorante r, attrazione a, distanza_rist_attr dra WHERE a.id = '$attrazione' AND a.id = dra.attrazione AND r.id = dra.ristorante ORDER BY 6";
		$res = $this->conn->query($sql);

		if($res && $res->num_rows > 0) {
			while($row = $res->fetch_assoc()) {
				$id = $row["id"];
				$nome = $row["nome"];
				$descrizione = $row["descrizione"];
				$tel = $row["tel"];
				$immagine = $row["immagine"];
				$distanza = $row["distanza"];
				$ristorante = new Ristorante($id, $nome, $descrizione, $tel, $immagine, $distanza);
				if($ristorante != null) {
					$ristoranti[count($ristoranti)] = $ristorante;
				}
			}
		}
		return $ristoranti;
  }

  function getHotel(){
	  $hotels = array();
	  $sql = "SELECT * FROM hotel ORDER BY distanza DESC";
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$nome = $row["nome"];
			$descrizione = $row["descrizione"];
			$tel = $row["tel"];
			$distanza = $row["distanza"];
			$immagine = $row["immagine"];
			$hotel = new Hotel($id, $distanza, $nome, $descrizione, $tel, $immagine);
			if($hotel != null) {
				$hotels[count($hotels)] = $hotel;
			}
		}
	  }
	  return $hotels;
  }
  
  function getHotelById($id){
	  $hotels = array();
	  $sql = "SELECT * FROM hotel where id=".$id;
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$nome = $row["nome"];
			$descrizione = $row["descrizione"];
			$tel = $row["tel"];
			$distanza = $row["distanza"];
			$immagine = $row["immagine"];
			return new Hotel($id, $distanza, $nome, $descrizione, $tel, $immagine);
		}
	  }
	  return null;
  }

  function getFoto($utente){
	  $foto = array();
	  $sql = "SELECT foto.id, foto.data, foto.attrazione, foto.immagine, foto.utente, attrazione.nome FROM foto, attrazione WHERE foto.utente = '$utente' AND foto.attrazione = attrazione.id";
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$utente = $row["utente"];
			$attrazione = $row["attrazione"];
			$data = $row["data"];
			$immagine = $row["immagine"];
			$f = new Foto($id, $data, $utente, $immagine, $attrazione);
			if($f != null) {
				$foto[count($foto)] = $f;
			}
		}
	  }
	  return $foto;
  }

  function getAllFoto(){
	  $foto = array();
	  $sql = "SELECT * FROM foto";
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$utente = $row["utente"];
			$attrazione = $row["attrazione"];
			$data = $row["data"];
			$immagine = $row["immagine"];
			$f = new Foto($id, $data, $utente, $immagine, $attrazione);
			if($f != null) {
				$foto[count($foto)] = $f;
			}
		}
	  }
	  return $foto;
  }

  function getMessagesForAttraction(){
	  $mex = array();
	  $sql = "SELECT attrazione.id, COUNT( chat.id_attrazione ) AS  'number'
    FROM attrazione LEFT JOIN chat ON attrazione.id = chat.id_attrazione GROUP BY attrazione.id";
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
  		while($row = $res->fetch_assoc()) {
        $num = $row["number"];
  			$ArrNum[count($ArrNum)] = $num;
  		}
	  }
	  return $ArrNum;
  }

  function getPhotosForAttraction(){
	  $mex = array();
	  $sql = "SELECT attrazione.id, COUNT( foto.attrazione ) AS  'number'
    FROM attrazione LEFT JOIN foto ON attrazione.id = foto.attrazione GROUP BY attrazione.id";
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
  		while($row = $res->fetch_assoc()) {
        $num = $row["number"];
  			$ArrNum[count($ArrNum)] = $num;
  		}
	  }
	  return $ArrNum;
  }

  function getNumberRecord($type){
    $sql = "SELECT COUNT(id) FROM ".$type;
	  $res = $this->conn->query($sql);
    $row = $res->fetch_assoc();
	  return $row["COUNT(id)"];
  }

  function getWaitTime(){
    $sql = "SELECT ROUND(AVG(tempo_attesa)) AS  'tempo' FROM attrazione";
	  $res = $this->conn->query($sql);
    $row = $res->fetch_assoc();
	  return $row["tempo"];
  }

  function getDistanza($attrazione){
	  $distanze = array();
	  $sql = "SELECT * FROM distanza_rist_attr WHERE attrazione = "+$attrazione;
	  $res = $this->conn->query($sql);

	  if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$attrazione = $row["attrazione"];
			$ristorante = $row["ristorante"];
			$distanza = $row["distanza"];
			$d = new Distanza($attrazione, $distanza, $ristorante);
			if($d != null) {
				$distanze[count($distanze)] = $d;
			}
		}
	  }
	  return $distanze;
  }

  function getLastMessages($username, $attrazione, $lastMessageId){
	  $messages = array();
	  if($lastMessageId < 1) {
              $sql = "SELECT * FROM chat WHERE id_attrazione = '+$attrazione+' AND date(orario)=date(CURRENT_TIMESTAMP) LIMIT 10";
	  } else {
              $sql = "SELECT * FROM chat WHERE id > '+$lastMessageId+' AND id_attrazione = '+$attrazione+' AND date(orario)=date(CURRENT_TIMESTAMP) LIMIT 10";
	  }

          $res = $this->conn->query($sql);


	  if($res && $res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			$id = $row["id"];
			$username = $row["username"];
			$messaggio = $row["messaggio"];
			$attrazione = $row["id_attrazione"];
                        $orario = $row["orario"];
			$msg_chat = new MsgChat($id, $username, $attrazione, $messaggio, $orario);
			if($attrazione != null) {
				$messages[count($messages)] = $msg_chat;

			}
		}
	  }

	  return $messages;
  }


}



?>
