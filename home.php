<?php 
  $page_title = 'Inicio';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
 
?>
<?php include_once('layouts/header.php'); ?>

 <?php echo display_msg($msg); ?>
 <h3><span id="TituloModulo">Gestión de Fondos</span></h3>

<div class="top-grids text-center">
      <div class="container">
        <div class="col-md-3">
          <a href="p_buscar.php"> 
          <div class="top-grid">
            <span class="t-icon2"> </span>
            <h3>Buscar</h3>
             <p>Localizar viviendas.</p>
          </div>
        </a>
        </div>      
</div>

<?php include_once('layouts/footer.php'); ?>

