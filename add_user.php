<?php
  $page_title = 'Agregar usuarios';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $groups = find_all('user_groups');
?>
<?php
  if(isset($_POST['add_user'])){

   $req_fields = array('full-name','username','password','level' );
   validate_fields($req_fields);

   if(empty($errors)){
       $name   = remove_junk($db->escape($_POST['full-name']));
       $username   = remove_junk($db->escape($_POST['username']));
       $password   = remove_junk($db->escape($_POST['password']));
       $user_level = (int)$db->escape($_POST['level']);
       $password = sha1($password);
        $query = "INSERT INTO users (";
        $query .="name,username,password,user_level,status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$username}', '{$password}', '{$user_level}','1'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s'," Cuenta de usuario ha sido creada");
          //Grabamos en Bitacora
          $user_id = (int)$_SESSION['user_id'];
          $evento = "Agrego un nuevo usuario";
          bitacora($user_id, $evento);                    
          redirect('users.php', false);
        } else {
          //failed
          $session->msg('d',' No se pudo crear la cuenta.');
          redirect('add_user.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_user.php',false);
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
   Usuarios del Sistema
   <small>Perfiles de Usuarios</small>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-plus"></span>
          <span>Agregar usuario</span>
       </strong>         
      </div>
       <form method="post" action="add_user.php" data-parsley-validate="" novalidate="" class="form-horizontal" role="form" onsubmit="return valida()">                
          <div class="panel-body">
             
             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Nombre:</label>
                   <div class="col-sm-6">                     
                      <input id="full-name" name="full-name" type="text" required="required" class="form-control">
                       <ul class="parsley-errors-list filled" id="required-full-name" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>
            
             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="username">Usuario:</label>
                   <div class="col-sm-6">
                       <input id="username" name="username" type="text" required="required" class="form-control">
                       <ul class="parsley-errors-list filled" id="required-username" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="password">Contraseña:</label>
                   <div class="col-sm-6">
                      <input id="password" name="password" type="password" required="required" class="form-control">
                       <ul class="parsley-errors-list filled" id="required-password" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

               <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Nivel de Seguridad:</label>
                   <div class="col-sm-6">
                       <select class="form-control" name="level">
                        <?php foreach ($groups as $group ):?>
                         <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                      <?php endforeach;?>
                      </select>
                       <ul class="parsley-errors-list filled" id="required-status" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

          </div><!-- ./panel-body -->
          <div class="panel-footer text-center">
             <button type="submit" name="add_user" id="add_user" class="btn btn-amcora">Guardar</button>
             <a href="users.php" class="btn btn-gris">Cancelar</a>
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
  if(!required("full-name")) {resp=false;}
  if(!required("username")) {resp=false;}
  if(!required("password")) {resp=false;}
  return resp;
}
</script>
<?php include_once('layouts/footer.php'); ?>
