<?php
  $page_title = 'Catalogos';
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

  $result = find_all($tabla_catalogo);
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="content-heading">   
   <?php echo remove_junk(ucwords(str_replace("_"," ",$tabla_catalogo)))?>
   <small>Configuración de catálogos</small>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel-body right">
      <a href="a_general.php?op=<?php echo $op_catalogo;?>" class="btn btn-labeled btn-amcora"> 
        <span class="btn-label"><i class="fa fa-plus"></i></span>Agregar
      </a>
     </button>
     </div>    
  </div>  
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span><?php echo remove_junk(ucwords(str_replace("_"," ",$tabla_catalogo)))?></span>
     </strong>       
    </div>
     <div class="panel-body">
        <div class="table-responsive">
            <table id="datatable1" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="text-center" style="width: 50px;">#</th>                  
                  <th>Descripción</th>                     
                  <th class="text-center" style="width: 10%;">Estado</th>                  
                </tr>
              </thead>
              <tbody>
              <?php foreach($result as $a_result): ?>
                <tr>
                 <td class="text-center"><?php echo count_id();?></td>                
                 <td>
                   <?php echo remove_junk(ucwords($a_result['descripcion']))?>
                 </td>                  
                 <td class="text-center">
                <?php if($a_result['estatus'] === '1'): ?>
                  <span class="label label-success"><?php echo "Activo"; ?></span>
                <?php else: ?>
                  <span class="label label-danger"><?php echo "Inactivo"; ?></span>
                <?php endif;?>
                 </td>
                 <td class="text-center">
                   <div class="btn-group">
                      <a href="e_general.php?id=<?php echo (int)$a_result['id']."&op=".$op_catalogo;?>" class="btn btn-xs btn-gris" data-toggle="tooltip" title="Editar">
                        <i class="glyphicon glyphicon-pencil"></i>
                     </a>
                      <a href="b_general.php?id=<?php echo (int)$a_result['id']."&op=".$op_catalogo;?>" class="btn btn-xs btn-amcora" data-toggle="tooltip" title="Desactivar/Activar">
                        <i class="glyphicon glyphicon-adjust"></i>
                      </a>
                      </div>
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
