<?php
  $page_title = 'Editar Grupo';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $e_group = find_by_id('user_groups',(int)$_GET['id']);
  if(!$e_group){
    $session->msg("d","Missing Group id.");
    redirect('group.php');
  }
?>
<?php
  if(isset($_POST['update'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $status = remove_junk($db->escape($_POST['status']));

        $query  = "UPDATE user_groups SET ";
        $query .= "group_name='{$name}',group_level='{$level}',group_status='{$status}'";
        $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
        $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Grupo se ha actualizado! ");
                    //Grabamos en Bitacora
          $user_id = (int)$_SESSION['user_id'];
          $evento = "Actualizo grupo de usuario id=".(int)$_GET['id'];
          bitacora($user_id, $evento);   
          redirect('group.php?id='.(int)$e_group['id'], false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado el grupo!');
          redirect('edit_group.php?id='.(int)$e_group['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('edit_group.php?id='.(int)$e_group['id'], false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="content-heading">   
   Grupos
   <small>Perfiles de Usuarios</small>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-pencil"></span>
          <span>Nuevo grupo de usuarios</span>
       </strong>         
      </div>
       <form  method="post" action="edit_group.php?id=<?php echo (int)$e_group['id'];?>" data-parsley-validate="" novalidate="" class="form-horizontal" role="form">                
          <div class="panel-body">             
             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Nombre del grupo:</label>
                   <div class="col-sm-6">                   
                      <input id="group-name" name="group-name" type="name" required="required" class="form-control" value="<?php echo remove_junk(ucwords($e_group['group_name'])); ?>">
                       <ul class="parsley-errors-list filled" id="required-group-name" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>
            
             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Nivel de Seguridad:</label>
                   <div class="col-sm-6">                    
                       <input id="group-level" name="group-level" type="number" required="required" class="form-control" value="<?php echo (int)$e_group['group_level']; ?>">
                       <ul class="parsley-errors-list filled" id="required-group-level" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="status">Estado:</label>
                   <div class="col-sm-6">
                        <select class="form-control" name="status">
                          <option <?php if($e_group['group_status'] === '1') echo 'selected="selected"';?> value="1"> Activo </option>
                          <option <?php if($e_group['group_status'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                          <option <?php if($e_group['group_status'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                        </select>
                       <ul class="parsley-errors-list filled" id="required-status" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset><!-- AVISO -->                  
          </div><!-- ./panel-body -->
          <div class="panel-footer text-center">
             <button type="submit" name="update" id="update" class="btn btn-amcora">Actualizar</button>
             <a href="group.php" class="btn btn-gris">Cancelar</a>
          </div>           
        </form><!-- /form -->
    </div><!-- ./panel panel-default -->
  </div>   
</div>
<?php include_once('layouts/footer.php'); ?>
