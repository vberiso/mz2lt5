<?php
  $page_title = 'Editar Usuario';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $e_user = find_by_id('users',(int)$_GET['id']);
  $groups  = find_all('user_groups');
  if(!$e_user){
    $session->msg("d","Missing user id.");
    redirect('users.php');
  }
?>

<?php
//Update User basic info
  if(isset($_POST['update'])) {
    $req_fields = array('name','username','level');
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$e_user['id'];
           $name = remove_junk($db->escape($_POST['name']));
       $username = remove_junk($db->escape($_POST['username']));
          $level = (int)$db->escape($_POST['level']);
       $status   = remove_junk($db->escape($_POST['status']));
            $sql = "UPDATE users SET name ='{$name}', username ='{$username}',user_level='{$level}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Datos de cuenta actualizada ");
          
            $user_id = (int)$_SESSION['user_id'];
            $evento = "Actualizo cuenta de usuario";
            bitacora($user_id, $evento);               
            redirect('users.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Lo siento no se actualizó los datos.');
            redirect('edit_user.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_user.php?id='.(int)$e_user['id'],false);
    }
  }
?>
<?php
// Update user password
if(isset($_POST['update-pass'])) {
  $req_fields = array('password');
  validate_fields($req_fields);
  if(empty($errors)){
           $id = (int)$e_user['id'];
     $password = remove_junk($db->escape($_POST['password']));
     $h_pass   = sha1($password);
          $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->escape($id)}'";
       $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          $session->msg('s',"Se ha actualizado la contraseña del usuario. ");
          redirect('edit_user.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d','No se pudo actualizar la contraseña de usuario..');
          redirect('edit_user.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('edit_user.php?id='.(int)$e_user['id'],false);
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
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading clearfix">
        <strong>
           <span class="glyphicon glyphicon-pencil"></span>
            Actualiza cuenta <?php echo remove_junk(ucwords($e_user['name'])); ?>           
        </strong>
       </div>
       <form method="post" action="edit_user.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">
         <div class="panel-body">  

            <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Nombre:</label>
                   <div class="col-sm-10">                     
                      <input id="name" name="name" type="name" required="required" class="form-control" value="<?php echo remove_junk(ucwords($e_user['name'])); ?>">
                       <ul class="parsley-errors-list filled" id="required-name" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="username">Usuario:</label>
                   <div class="col-sm-10">                     
                      <input id="username" name="username" type="text" required="required" class="form-control" value="<?php echo remove_junk(ucwords($e_user['username'])); ?>">
                       <ul class="parsley-errors-list filled" id="required-username" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>


             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Nivel de Seguridad:</label>
                   <div class="col-sm-6">
                      <select class="form-control" name="level" id="level">
                        <?php foreach ($groups as $group ):?>
                         <option <?php if($group['group_level'] === $e_user['user_level']) echo 'selected="selected"';?> value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                      <?php endforeach;?>
                      </select>
                       <ul class="parsley-errors-list filled" id="required-level" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>           
       
         </div><!-- ./panel-body -->
          <div class="panel-footer text-center">
             <button type="submit" name="update" id="update" class="btn btn-amcora">Actualizar</button>
             <a href="users.php" class="btn btn-gris">Cancelar</a>
          </div> 
        </form>
     </div>
  </div>
  <!-- Change password form -->
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-pencil"></span>
          Cambiar contraseña de <?php echo remove_junk(ucwords($e_user['name'])); ?>
        </strong>
      </div>
      <form action="edit_user.php?id=<?php echo (int)$e_user['id'];?>" method="post" class="clearfix">
        <div class="panel-body">   
            <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="password">Contraseña:</label>
                   <div class="col-sm-6">
                      <input id="password" name="password" type="password" required="required" class="form-control">
                       <ul class="parsley-errors-list filled" id="required-password" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>       
        </div><!-- ./panel-body -->
        <div class="panel-footer text-center">
           <button type="submit" name="update-pass" id="update-pass" class="btn btn-amcora">Cambiar</button>
        </div> 
      </form>
    </div>
  </div>

 </div>
<?php include_once('layouts/footer.php'); ?>
