<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

 <?php echo display_msg($msg); ?>
 <h3><span id="TituloModulo">Modulo Desactivado....</span></h3>

<?php include_once('layouts/footer.php'); ?>

