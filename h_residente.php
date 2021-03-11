<?php
  $page_title = 'Historico de Pagos';
  require_once('includes/load.php');
  
   page_require_level(1);
   $result = find_historico_pagos((int)$_GET['id']);
   $min_max = ultimo_pago((int)$_GET['id']);   
   $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
   $residente = find_residente_id((int)$_GET['id']);
   
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="content-heading">   
   Historico de Pagos
   <small>Mantenimiento</small>
</div>

    <div class="col-lg-4 col-sm-8">
      <!-- START widget-->
      <div class="panel2 widget bg-gris">
         <div class="row row-table">
            <div class="col-xs-4 text-center bg-gris-dark pv-lg">
               <em class="icon-plus fa-3x"></em>
            </div>
            <div class="col-xs-8 pv-lg">                
               <div class="h2 mt0"><?php  echo "$".number_format($min_max['maximo'], 2, ".", ","); ?> </div>
               <div class="text-uppercase">Importe Último Pago</div>
            </div>
         </div>
      </div>
    </div>

    <div class="col-lg-4 col-sm-8">
      <!-- START widget-->
      <div class="panel2 widget bg-gris">
         <div class="row row-table">
            <div class="col-xs-4 text-center bg-gris-dark pv-lg">
               <em class="icon-plus fa-3x"></em>
            </div>
            <div class="col-xs-8 pv-lg">                
               <div class="h2 mt0"><?php  echo remove_junk(ucwords($residente['no_casa'])) ?> </div>
               <div class="text-uppercase"><?php  echo remove_junk(ucwords($residente['usuario'])) ?></div>
            </div>
         </div>
      </div>
    </div>
    
<div class="row">
  <div class="col-md-12">
    <div class="panel-body right">
      <a href="residentes.php" class="btn btn-labeled btn-amcora"> 
              <span class="btn-label"><i class="fa fa-angle-double-left"></i></span>Regresar
            </a>
     </div>    
  </div>  
</div>

<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>Historico</span>
     </strong>       
    </div>

     <div class="panel-body">
        <div class="table-responsive">
            <table id="datatable1" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="text-center" style="width: 50px;">#</th>                                    
                  <th>Fecha Cobro</th>
                  <th>Mes</th>
                  <th>Año</th>
                  <th>Cuota</th>
                  <th>Importe Pagado</th>
                  <th>Forma Pago</th>                  
                  <th>Recaudo</th>                  
                </tr>
              </thead>
              <tbody>
              <?php foreach($result as $a_result): ?>
                <tr>
                 <td class="text-center"><?php echo count_id();?></td>  
                 <td><?php echo remove_junk(ucwords($a_result['fecha_cobro'])) ?></td>
                 <td><?php echo remove_junk(ucwords($meses[$a_result['mes']-1])) ?></td>
                 <td><?php echo remove_junk(ucwords($a_result['anio'])) ?></td>
                 <td><?php echo "$".number_format($a_result['importe'], 2, ".", ",")?></td>
                 <td><?php echo "$".number_format($a_result['pago'], 2, ".", ",")?></td>
                 <td><?php echo remove_junk(ucwords($a_result['tipo_pago'])) ?></td>
                 <td><?php echo remove_junk(ucwords($a_result['usuario'])) ?></td>
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
