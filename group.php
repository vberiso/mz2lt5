<?php
  $page_title = 'Lista de grupos';
  require_once('includes/load.php');
  
   page_require_level(1);
  $all_groups = find_all('user_groups');

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="content-heading">   
   Nivel de Seguridad
   <small>Perfiles de Usuarios</small>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel-body right">
      <a href="add_group.php" class="btn btn-labeled btn-amcora"> 
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
          <span>Grupos</span>
       </strong>         
      </div>
       <div class="panel-body">
        <div class="table-responsive">
            <table id="datatable1" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Nombre del grupo</th>
                    <th class="text-center" style="width: 20%;">Nivel de Seguridad</th>
                    <th class="text-center" style="width: 15%;">Estado</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($all_groups as $a_group): ?>
                  <tr>
                   <td class="text-center"><?php echo count_id();?></td>
                   <td><?php echo remove_junk(ucwords($a_group['group_name']))?></td>
                   <td class="text-center">
                     <?php echo remove_junk(ucwords($a_group['group_level']))?>
                   </td>
                   <td class="text-center">
                   <?php if($a_group['group_status'] === '1'): ?>
                    <span class="label label-success"><?php echo "Activo"; ?></span>
                  <?php else: ?>
                    <span class="label label-danger"><?php echo "Inactivo"; ?></span>
                  <?php endif;?>
                   </td>
                   <td class="text-center">
                     <div class="btn-group">
                        <a href="edit_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-gris" data-toggle="tooltip" title="Editar">
                          <i class="glyphicon glyphicon-pencil"></i>
                       </a>
                        <a href="delete_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-amcora" data-toggle="tooltip" title="Eliminar">
                          <i class="glyphicon glyphicon-remove"></i>
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
