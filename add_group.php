<?php
  $page_title = 'Agregar grupo';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  if(isset($_POST['add'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);

   if(find_by_groupName($_POST['group-name']) === false ){
     $session->msg('w','<b>Error!</b> El nombre de grupo ya existe en la base de datos');
     redirect('add_group.php', false);
   }elseif(find_by_groupLevel($_POST['group-level']) === false) {
     $session->msg('w','<b>Error!</b> El nivel de grupo ya existe en la base de datos ');
     redirect('add_group.php', false);
   }
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $status = remove_junk($db->escape($_POST['status']));

        $query  = "INSERT INTO user_groups (";
        $query .="group_name,group_level,group_status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$level}','{$status}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"Grupo creado! ");
          //Grabamos en Bitacora
          $user_id = (int)$_SESSION['user_id'];
          $evento = "Agrego un nuevo grupo de usuarios";
          bitacora($user_id, $evento);          
          redirect('group.php', false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se pudo crear el grupo!');
          redirect('add_group.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_group.php',false);
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
          <span class="glyphicon glyphicon-plus"></span>
          <span>Nuevo grupo de usuarios</span>
       </strong>         
      </div>
       <form  method="post" action="add_group.php" data-parsley-validate="" novalidate="" class="form-horizontal" role="form" onsubmit="return valida()">                
          <div class="panel-body">
             
             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Nombre del grupo:</label>
                   <div class="col-sm-6">
                      <input id="group-name" name="group-name" type="name" required="required" class="form-control">
                       <ul class="parsley-errors-list filled" id="required-group-name" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>
            
             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Nivel de Seguridad:</label>
                   <div class="col-sm-6">
                       <input id="group-level" name="group-level" type="number" required="required" class="form-control" min="1" max="20">
                       <ul class="parsley-errors-list filled" id="required-group-level" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="status">Estado:</label>
                   <div class="col-sm-6">
                       <select class="form-control" name="status">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                      </select>
                       <ul class="parsley-errors-list filled" id="required-status" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>
                            
          </div><!-- ./panel-body -->
          <div class="panel-footer text-center">
             <button type="submit" name="add" id="add" class="btn btn-amcora">Guardar</button>
             <a href="group.php" class="btn btn-gris">Cancelar</a>
          </div>           
        </form><!-- /form -->
    </div><!-- ./panel panel-default -->
  </div>   
</div>
<script>
function valida() {
  $(".parsley-errors-list").hide();
  $(".parsley-error").removeClass('parsley-error');

  var resp = true;
  if(!required("group-name")) {resp=false;}
   if(!required("group-level")) {resp=false;}
  return resp;
}
</script>
<?php include_once('layouts/footer.php'); ?>
