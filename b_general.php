d<?php
  require_once('includes/load.php');  
  page_require_level(1);

  $op_catalogo = (int)$_GET['op'];
  //Obtener Parametro entrada  
  switch ((int)$_GET['op']) {
    case 1:
       $tabla_catalogo='estados';
       break;
   case 2:
       $tabla_catalogo='tipo_pagos';
       break;
   case 3:
       $tabla_catalogo='tipo_movimiento';
       break;    
   case 4:
       $tabla_catalogo='tipo_residente';
       break;      
   case 5:
       $tabla_catalogo='tipo_servicio';
       break;                    
 }  
?>
<?php
  
  $update_id = update_by_id($tabla_catalogo,(int)$_GET['id']);
  if($update_id){
      $session->msg("s","Cambio estatus!");
      //Grabamos en Bitacora
      $user_id = (int)$_SESSION['user_id'];
      $evento = "Cambio de estatus " .$tabla_catalogo;
      bitacora($user_id, $evento);         
      redirect('general.php?op='.$op_catalogo);
  } else {
      $session->msg("d","Cambio de estatus Falló!");
      redirect('general.php=?op='.$op_catalogo);
  }
  
?>
