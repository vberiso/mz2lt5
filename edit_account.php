<?php
  $page_title = 'Editar Cuenta';
  require_once('includes/load.php');
   page_require_level(3);
?>
<?php
//update user image
  if(isset($_POST['submit'])) {
  $photo = new Media();
  $user_id = (int)$_POST['user_id'];
  $photo->upload($_FILES['file_upload']);
  if($photo->process_user($user_id)){
    $session->msg('s','La foto fue subida al servidor.');
    redirect('edit_account.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('edit_account.php');
    }
  }
?>
<?php
 //update user other info
  if(isset($_POST['update'])){
    $req_fields = array('name','username' );
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$_SESSION['user_id'];
           $name = remove_junk($db->escape($_POST['name']));
       $username = remove_junk($db->escape($_POST['username']));
            $sql = "UPDATE users SET name ='{$name}', username ='{$username}' WHERE id='{$id}'";
    $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Cuenta actualizada. ");
            //Grabamos en Bitacora
            $user_id = (int)$_SESSION['user_id'];
            $evento = "Actualizo la cuenta del usuario";
            bitacora($user_id, $evento);   
            redirect('edit_account.php', false);
          } else {
            $session->msg('d',' Lo siento, actualización falló.');
            redirect('edit_account.php', false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_account.php',false);
    }
  }
?>

<?php $user = current_user(); ?>
<?php
  if(isset($_POST['update_pass'])){

    $req_fields = array('new-password','old-password','id' );
    validate_fields($req_fields);

    if(empty($errors)){

             if(sha1($_POST['old-password']) !== current_user()['password'] ){
               $session->msg('w', "Tu antigua contraseña no coincide");
               redirect('edit_account.php.php',false);
             }

            $id = (int)$_POST['id'];
            $new = remove_junk($db->escape(sha1($_POST['new-password'])));
            $sql = "UPDATE users SET password ='{$new}' WHERE id='{$db->escape($id)}'";
            $result = $db->query($sql);
                if($result && $db->affected_rows() === 1):
                  $session->logout();
                  $session->msg('s',"Inicia sesión con tu nueva contraseña.");
                  redirect('index.php', false);
                else:
                  $session->msg('d',' Lo siento, actualización falló.');
                  redirect('edit_account.php', false);
                endif;
    } else {
      $session->msg("d", $errors);
      redirect('edit_account.php',false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">  
  <div class="col-md-6">
      <?php echo display_msg($msg); ?>    
  </div>
</div>
<div class="row">  
  <div class="col-md-4">
    <form class="form" action="edit_account.php" method="POST" enctype="multipart/form-data">
      <div class="panel panel-default">
        <div class="panel-body text-center">
          <div class="pv-lg">
             <img src="uploads/users/<?php echo $user['image'];?>" class="center-block img-responsive img-circle img-thumbnail thumb96">
          </div>
          <h3 class="m0 text-bold"><?php echo remove_junk(ucfirst($user['name'])); ?></h3>
          <div class="mv-lg"><p>Cambiar mi foto</p></div>            
          <fieldset>
            <div class="form-group">
               <label class="col-sm-2 control-label">Archivo:</label>
               <div class="col-sm-10">
                 <input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
                  <input type="file" name="file_upload"  data-classbutton="btn btn-default" data-classinput="form-control inline" class="form-control filestyle" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
               </div>
            </div>
         </fieldset>                            
       </div>
      <div class="panel-footer text-center">
         <button type="submit" name="submit" class="btn btn-amcora">Guardar</button>
      </div>  
     </form> 
    </div>
  </div>  
  <div class="col-md-6">
    <div class="panel panel-default">      
      <form method="post" action="edit_account.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
      <div class="panel-body">          
        <fieldset>
          <legend>Editar Usuario</legend>
          <div class="form-group">
             <label class="col-sm-2 control-label" for="name" >Nombre</label>
             <div class="col-sm-10">
                <input type="name" name="name" class="form-control" value="<?php echo remove_junk(ucwords($user['name'])); ?>">
             </div>
          </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
               <label for="username"  class="col-sm-2 control-label">Usuario</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($user['username'])); ?>">
               </div>
            </div>
         </fieldset>
      </div>
      <div class="panel-footer text-center">
         <button type="submit" name="update" class="btn btn-amcora">Actualizar</button>        
      </div>
      </form> 
    </div>
  </div>

   <div class="col-md-6">
    <div class="panel panel-default">      
      <form method="post" action="edit_account.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
      <div class="panel-body">          
        <fieldset>
          <legend>Editar Contraseña</legend>
          <div class="form-group">
             <label class="col-sm-3 control-label" for="oldPassword" >Contraseña Anterior</label>
             <div class="col-sm-9">
                <input type="password" class="form-control" name="old-password">
             </div>
          </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
               <label for="newPassword"  class="col-sm-3 control-label">Nueva Contraseña</label>
               <div class="col-sm-9">
                  <input ype="password" class="form-control" name="new-password">
               </div>
            </div>
         </fieldset>
      </div>
      <div class="panel-footer text-center">
        <input type="hidden" name="id" value="<?php echo (int)$user['id'];?>">
         <button type="submit" name="update_pass" class="btn btn-amcora">Actualizar</button>        
      </div>
      </form> 
    </div>
  </div>
</div>


<?php include_once('layouts/footer.php'); ?>
