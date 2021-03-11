<?php
  $page_title = 'Agregar Proveedor';
  require_once('includes/load.php');
  
  page_require_level(1); 
  //Llenamos las listas
  $tiposervicio = find_all('tipo_servicio'); 
?>
<?php
  if(isset($_POST['add'])){ 


   if(empty($errors)){        
        $nombre = remove_junk($db->escape($_POST['nombre']));   
        $telefono = remove_junk($db->escape($_POST['telefono']));   
        $especialidad = remove_junk($db->escape($_POST['especialidad']));                           
        $estatus = 1;
        $optgrupo = remove_junk($db->escape($_POST['id_estado']));       

        $query  = "INSERT INTO proveedores (";
        $query .="nombre,telefono,descripcion,estatus,idtiposervicio ";                
        $query .=") VALUES (";
        $query .=" '{$nombre}','{$telefono}','{$especialidad}','{$estatus}','{$optgrupo}' ";        
        $query .=")";

        if($db->query($query)){          
          $session->msg('s',"Guardo Registro! ");
          //Grabamos en Bitacora
          $user_id = (int)$_SESSION['user_id'];
          $evento = "Agrego un proveedor";
          bitacora($user_id, $evento);          
          redirect('proveedores.php', false);
        } else {          
          $session->msg('d','Error al crear proveedor!');
          redirect('a_proveedor.php', false);
        }
   } else {
     $session->msg("d", $errors);
     redirect('a_proveedor.php',false);
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
   Proveedor
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
       <form  method="post" action="a_proveedor.php" data-parsley-validate="" novalidate="" class="form-horizontal" role="form" onsubmit="return valida()">                
          <div class="panel-body">

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Nombre (s):</label>
                   <div class="col-sm-6">
                       <input id="nombre" name="nombre" type="name" required="required" class="form-control" style="text-transform:uppercase" >
                       <ul class="parsley-errors-list filled" id="required-nombre" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

               <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Teléfono:</label>
                   <div class="col-sm-6">
                       <input id="telefono" name="telefono" type="name" required="required" class="form-control" >
                       <ul class="parsley-errors-list filled" id="required-telefono" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Actividades:</label>
                   <div class="col-sm-6">
                       <input id="especialidad" name="especialidad" type="name" required="required" class="form-control" style="text-transform:uppercase" >
                       <ul class="parsley-errors-list filled" id="required-especialidad" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>    

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label">Grupo:</label>
                   <div class="col-sm-6">                     
                        <select class="form-control" name="id_estado" id="id_estado">
                          <option value="0">Seleccione Grupo</option>
                        <?php  foreach ($tiposervicio as $cata): ?>
                          <option value="<?php echo (int)$cata['id'] ?>">
                            <?php echo $cata['descripcion'] ?></option>
                        <?php endforeach; ?>
                        </select>
                       <ul class="parsley-errors-list filled" id="required-id_estado" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>      
                           
          </div><!-- ./panel-body -->
          <div class="panel-footer text-center">
             <button type="submit" name="add" id="add" class="btn btn-amcora">Guardar</button>
             <a href="proveedores.php" class="btn btn-gris">Cancelar</a>
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
   if(!required("nombre")) {resp=false;}    
   if(!required("telefono")) {resp=false;}     
   if(!required("especialidad")) {resp=false;}    
  return resp;
}
</script>
<?php include_once('layouts/footer.php'); ?>
