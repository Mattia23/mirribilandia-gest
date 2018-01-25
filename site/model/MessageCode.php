<?php

$loginSuccess = 0;
$userAddedSuccessfull = 1;
$metadataPacket = 2;
$synchronizationSuccessfull = 3;
$msgSentSuccessfull = 4;
$msgReceivedSuccessfull = 5;
$connectionError = -1;
$loginFailed = -2;
$sqlError = -3;
$genericError = -4;
$userAlreadyAdded = -5;
$badRequest = -6;

function sendResponse($code, $message, $extra) {
  $response = array(
    "code" => $code,
    "message" => $message,
    "extra" => $extra
  );
  echo json_encode($response);
}


?>
