<?php
  require_once('includes/load.php');  
  page_require_level(1);

?>
<?php
  
  $update_id = update_by_id('proveedores',(int)$_GET['id']);
  if($update_id){
      $session->msg("s","Cambio estatus!");
          //Grabamos en Bitacora
          $user_id = (int)$_SESSION['user_id'];
          $evento = "Cambio estatus del proveedor";
          bitacora($user_id, $evento);         
      redirect('proveedores.php');
  } else {
      $session->msg("d","Cambio de estatus falló!");
      redirect('proveedores.php');
  }
  
?>
