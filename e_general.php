<?php
  $page_title = 'Editar Catalogo';
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
?>
<?php

  $e_result = find_by_id($tabla_catalogo,(int)$_GET['id']);
  if(!$e_result){
    $session->msg("d","Sin seleccion de id.");
    redirect('general.php?op='.$op_catalogo);
  }
?>
<?php
  if(isset($_POST['update'])){

   $req_fields = array('clave','descripcion');
   validate_fields($req_fields);

   if(empty($errors)){

        $descripcion = remove_junk($db->escape($_POST['descripcion']));

        $query  = "UPDATE ".$tabla_catalogo." SET ";
        $query .= "descripcion='{$descripcion}' ";        
        $query .= "WHERE ID='{$db->escape($e_result['id'])}'";
        $result = $db->query($query);

         if($result && $db->affected_rows() === 1){          
          $session->msg('s',"Guardo Registro! ");       
          $user_id = (int)$_SESSION['user_id'];
          $evento = "Edito ".$tabla_catalogo." id=".(int)$_GET['id'];
          bitacora($user_id, $evento);   
          redirect('general.php?op='.$op_catalogo, false);
        } else {
          $session->msg('d','Lamentablemente no se ha actualizado!');
          redirect('e_general.php?id='.(int)$e_result['id']."&op=".$op_catalogo, false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('e_general.php?id='.(int)$e_result['id']."&op=".$op_catalogo, false);
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
   <?php echo remove_junk(ucwords(str_replace("_"," ",$tabla_catalogo)))?>
   <small>Configuración de catálogos</small>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-pencil"></span>
          <span>Edición</span>
       </strong>         
      </div>
       <form  method="post" action="e_general.php?id=<?php echo (int)$e_result['id']."&op=".$op_catalogo;?>" data-parsley-validate="" novalidate="" class="form-horizontal" role="form">                
          <div class="panel-body">             

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Id:</label>
                   <div class="col-sm-6">                   
                      <input id="clave" name="clave" type="nunmber" required="required" class="form-control" readonly value="<?php echo remove_junk(ucwords($e_result['id'])); ?>">
                       <ul class="parsley-errors-list filled" id="required-clave" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Descripción:</label>
                   <div class="col-sm-6">                   
                      <input id="descripcion" name="descripcion" type="name" required="required" class="form-control" value="<?php echo remove_junk(ucwords($e_result['descripcion'])); ?>">
                       <ul class="parsley-errors-list filled" id="required-descripcion" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>   

          <!-- AVISO -->                  
          </div><!-- ./panel-body -->
          <div class="panel-footer text-center">
             <button type="submit" name="update" id="update" class="btn btn-amcora">Actualizar</button>
             <a href= <?php echo 'general.php?op='.$op_catalogo ?> class="btn btn-gris">Cancelar</a>
          </div>           
        </form><!-- /form -->
    </div><!-- ./panel panel-default -->
  </div>   
</div>
<?php include_once('layouts/footer.php'); ?>

