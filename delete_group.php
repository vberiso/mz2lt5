<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  //Validar si esta en relacion
  $using_id= count_by_id_relation('group', (int)$_GET['id']);
  if($using_id['total'] > 0) {
     $session->msg("w","El Grupo NO puede ser eliminado esa en uso!");
     redirect('group.php');
  }    
  $delete_id = delete_by_id('user_groups',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Grupo eliminado");
          //Grabamos en Bitacora
          $user_id = (int)$_SESSION['user_id'];
          $evento = "Elimino grupo de usuario id=".(int)$_GET['id'];
          bitacora($user_id, $evento);         
      redirect('group.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('group.php');
  }
  
?>
