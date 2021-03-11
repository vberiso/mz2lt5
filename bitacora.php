<?php
  $page_title = 'Bitacora del Sistema';
  require_once('includes/load.php');
  
   page_require_level(4);

  $all_bitacora = find_all_bitacora('bitacora');
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="content-heading">   
   Bitacora
   <small>Administración del Sistema</small>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Registro de Eventos</span>
       </strong>         
      </div>
       <div class="panel-body">
        <div class="table-responsive">
            <table id="datatable1" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="text-center" style="width: 50px;">#</th>
                  <th>Usuario</th>
                  <th>Evento / Actividad</th>
                  <th class="text-center" style="width: 15%;">Fecha/Hora</th>              
                </tr>
              </thead>
              <tbody>
              <?php foreach($all_bitacora as $a_bitacora): ?>
                <tr>
                 <td class="text-center"><?php echo count_id();?></td>
                 <td><?php echo remove_junk(ucwords($a_bitacora['id_user']))?></td>
                 <td>
                   <?php echo remove_junk(ucwords($a_bitacora['evento']))?>
                 </td>
                 <td class="text-center">
                   <?php echo remove_junk(ucwords($a_bitacora['fechahora']))?>
                 </td>             
                </tr>
              <?php endforeach;?>
             </tbody>
           </table>
          </div> 
       </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
