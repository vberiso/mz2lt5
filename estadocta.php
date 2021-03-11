<?php
  $page_title = 'Estado de Cuenta';
  require_once('includes/load.php');
  
  page_require_level(4);
  //quien accede
  $current_user = current_user();
  if($current_user['user_level'] > 1) {
    $ocultar = 1;
  } else {
    $ocultar = 0;  
  }
  $result =find_all_estadocta($ocultar);

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="content-heading">   
   Estado de Cuenta
   <small>Pacientes</small>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>Listado de Pacientes [Historico]</span>
     </strong>       
    </div>
     <div class="panel-body">
        <div class="table-responsive">
            <table id="datatable1" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="text-center" style="width: 50px;"># id</th>
                  <th>Nombre</th>
                  <th>Sexo</th>
                  <th>Fecha de Ingreso</th>
                  <th>Total [Propios]</th>
                  <th>Total [Terceros]</th>
                  <th>Saldo Pend.</th> 
                  <?php if($ocultar == 0): ?> 
                  <th class="text-center">Reporta</th>   
                  <?php endif;?>              
                  <th class="text-center">Estatus</th>
                  <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($result as $a_result): ?>
                <tr>
                 <td class="text-center"><?php echo remove_junk(ucwords($a_result['id_hospitalizacion']))?></td>
                 <td><?php echo remove_junk(ucwords($a_result['nombre']))?></td>
                 <td><?php echo remove_junk(ucwords($a_result['sexo']))?></td>
                 <td>

                 <?php 
                    $fecha = new DateTime($a_result['fecha_ingreso']);
                    echo $fecha->format('d-m-Y');?>
                    
                  </td>
                 <?php 
                   $importe_pago = pagos($a_result['id_hospitalizacion']);  
                   $importe_adeudo = adeudos_clasifica($a_result['id_hospitalizacion']);  
                   $por_liquidar = ($importe_adeudo['total_no_propio'] + $importe_adeudo['total_propio']) - $importe_pago['monto'];
                 ?>   
                 <?php if($a_result['id_hospitalizacion'] !== '0'): ?>
                    <td><?php echo "$".number_format(($importe_adeudo['total_propio']), 2, ".", ",") ?></td>                 
                    <td><?php echo "$".number_format(($importe_adeudo['total_no_propio']), 2, ".", ",") ?></td>
                    <td><?php echo "$".number_format($por_liquidar, 2, ".", ",") ?></td>
                 <?php endif;?> 
                 <?php if($ocultar == 0): ?> 
                 <td class="text-center">
                    <div class="btn-group">
                      <a href="s_reporta.php?id=<?php echo (int)$a_result['id_hospitalizacion'];?>" 
                         class="btn btn-xs" data-toggle="tooltip" title="cambiar estado">
                        <?php if($a_result['reporta'] !== '0'): ?>
                            <i class="glyphicon glyphicon-ok"></i>
                        <?php else: ?>
                            <i class="glyphicon glyphicon-remove"></i>
                        <?php endif;?>
                      </a>
                    </div>
                 </td>
                 <?php endif;?> 
                 <td class="text-center">
                 <?php if($a_result['id_estado'] === '1'): ?>
                  <span class="label label-danger"><?php echo remove_junk(ucwords($a_result['descripcion']))?></span>
                 <?php else: ?>
                  <span> <?php echo remove_junk(ucwords($a_result['descripcion']))?></span>
                 <?php endif;?>  
                 </td>                        
                 <td class="text-center">
                 <?php if($a_result['id_hospitalizacion'] !== '0'): ?>                 
                   <div class="btn-group"> 
                      <a href="d_paciente.php?id=<?php echo (int)$a_result['id'];?>&idh=<?php echo (int)$a_result['id_hospitalizacion'];?>" class="btn btn-xs btn-gris" data-toggle="tooltip" title="Consultar">
                      Consultar                      
                     </a> 
                   </div>                 
                <?php endif;?> 
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
