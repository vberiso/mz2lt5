<?php
  $page_title = 'Agregar Catalogo';
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
  if(isset($_POST['add'])){

   $req_fields = array('descripcion');
   validate_fields($req_fields);

   if(find_by_clavegeneral($tabla_catalogo,$_POST['descripcion']) === false ){
     $session->msg('w','<b>Error!</b> La clave ya existe en la base de datos');
     redirect('general.php?op='.$op_catalogo, false);
   }

   if(empty($errors)){       
        $descripcion = remove_junk($db->escape($_POST['descripcion']));
        $estatus = '1';    

        $query  = "INSERT INTO ".$tabla_catalogo." (";
        $query .="descripcion, estatus";
        $query .=") VALUES (";
        $query .=" '{$descripcion}', '{$estatus}'";
        $query .=")";


        if($db->query($query)){          
          $session->msg('s',"Guardo Registro! ");
          //Grabamos en Bitacora
          $user_id = (int)$_SESSION['user_id'];
          $evento = "Agrego un nuevo ".$tabla_catalogo." id=".(int)$_GET['id'];
          bitacora($user_id, $evento);          
          redirect('general.php?op='.$op_catalogo, false);
        } else {          
          $session->msg('d','Error al crear dato!');
          redirect('a_general.php?op='.$op_catalogo, false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('a_general.php?op='.$op_catalogo, false);
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
          <span class="glyphicon glyphicon-plus"></span>
          <span>Alta</span>
       </strong>         
      </div>
       <form  method="post" action="a_general.php?op=<?php echo $op_catalogo;?>" data-parsley-validate="" novalidate="" class="form-horizontal" role="form" onsubmit="return valida()">                
          <div class="panel-body">          
            
             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Descripción:</label>
                   <div class="col-sm-6">
                       <input id="descripcion" name="descripcion" type="name" required="required" class="form-control" style="text-transform:uppercase" >
                       <ul class="parsley-errors-list filled" id="required-descripcion" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>           
          </div><!-- ./panel-body -->
          <div class="panel-footer text-center">
             <button type="submit" name="add" id="add" class="btn btn-amcora">Guardar</button>
             <a href= <?php echo 'general.php?op='.$op_catalogo ?> class="btn btn-gris">Cancelar</a>
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
   if(!required("descripcion")) {resp=false;}
    
  return resp;
}

<?php include_once('layouts/footer.php'); ?>
