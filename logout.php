<?php
  require_once('includes/load.php');

  //Grabamos en Bitacora
  $user_id = (int)$_SESSION['user_id'];
  $evento = "Abandono el Sistema";
  bitacora($user_id, $evento);

  if(!$session->logout()) {
  	redirect("index.php");
  }
?>
