<?php
  $page_title = 'Residentes';
  require_once('includes/load.php');
  
  page_require_level(1);
  $result = find_all_residentes();

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="content-heading">   
   Residentes
   <small>Configuración de residentes</small>
</div>

<div class="row" id="opciones"> 
  <div class="panel-body right">
    <div class="col-lg-3 col-sm-6">
    </div>
            <div class="row">
            <div class="col-md-12">
                <div class="panel-body right">
                    <a href="a_residente.php" class="btn btn-labeled btn-amcora"> 
                    <span class="btn-label"><i class="fa fa-plus"></i></span>Agregar
                    </a>
                    </button>
                </div>    
            </div>  
            </div>
  </div> 
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>Listado de Residentes</span>
     </strong>       
    </div>
     <div class="panel-body">
        <div class="table-responsive">
            <table id="datatable1" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th>No. Casa</th>
                  <th>Residente</th>                  
                  <th>Telefono</th>
                  <th class="text-center">Tipo Residente</th>                  
                  <th class="text-center">Vehiculo</th>
                  <th class="text-center">Mascota</th>
                  <th>Cuota</th>                                   
                  <th class="text-center" style="width: 50px;">Estatus</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($result as $a_result): ?>
                <tr>
                 <td class="text-center"><?php echo remove_junk(ucwords($a_result['id']))?></td>
                 <td class="text-center"><?php echo remove_junk(ucwords($a_result['numero_casa']))?></td>
                 <td><?php echo remove_junk(ucwords($a_result['usuario']))?></td>
                 <td class="text-center"><?php echo remove_junk(ucwords($a_result['telefono_usuario']))?></td>  
                 <td class="text-center"><?php echo remove_junk(ucwords($a_result['tipo_usuario']))?></td>  
                 <td class="text-center">
                 <?php if($a_result['vehiculo'] === '1'): ?>
                  <span class="label label-success"><?php echo "Si"; ?></span>
                 <?php else: ?>
                  <span class="label label-danger"><?php echo "No"; ?></span>
                 <?php endif;?>
                 </td>
                 <td class="text-center">
                 <?php if($a_result['mascotas'] === '1'): ?>
                  <span class="label label-success"><?php echo "Si"; ?></span>
                 <?php else: ?>
                  <span class="label label-danger"><?php echo "No"; ?></span>
                 <?php endif;?>                 
                 </td>
                 <td class="text-center"><?php  echo "$".number_format($a_result['cuota'], 2, ".", ","); ?></td> 
                 <td class="text-center">
                 <?php if($a_result['idestado'] === '1'): ?>
                  <span class="label label-success"><?php echo "Activo"; ?></span>
                 <?php else: ?>
                  <span class="label label-danger"><?php echo "No Aporta"; ?></span>
                 <?php endif;?>
                 </td>
                 <td class="text-right">
                      <a href="e_residente.php?id=<?php echo (int)$a_result['id'];?>" class="btn btn-sm btn-info" data-toggle="tooltip" title="Editar">
                        <em class="fa fa-pencil"></em>
                      </a>
                      <a href="h_residente.php?id=<?php echo (int)$a_result['id'];?>" class="btn btn-sm btn-gris" data-toggle="tooltip" title="Historico">
                        <i class="glyphicon glyphicon-usd"></i>
                     </a>   
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
<style type="text/css">

#opciones div div a:hover{
  text-decoration: none;
  cursor: pointer;
  color: #656565;
}
</style>
<?php include_once('layouts/footer.php'); ?>
