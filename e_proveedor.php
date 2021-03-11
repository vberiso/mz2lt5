<?php
  $page_title = 'Editar Proveedor';
  require_once('includes/load.php');
  
  page_require_level(1);

  //Llenamos las listas
  $tiposervicio = find_all('tipo_servicio'); 

  $e_result = find_by_id('proveedores',(int)$_GET['id']);
  if(!$e_result){
    $session->msg("d","Sin seleccion de id.");
    redirect('proveedores.php');
  }
  $id_proveedor = (int)$_GET['id'];

?>
<?php
  if(isset($_POST['update'])){

   if(empty($errors)){
        $nombre = remove_junk($db->escape($_POST['nombre']));   
        $telefono = remove_junk($db->escape($_POST['telefono']));   
        $especialidad = remove_junk($db->escape($_POST['especialidad']));                                   
        $optgrupo = remove_junk($db->escape($_POST['id_estado']));                           

        $query  = "UPDATE proveedores SET ";          
        $query .= "nombre='{$nombre}',telefono='{$telefono}' , ";    
        $query .= "descripcion='{$especialidad}' , ";    
        $query .= "idtiposervicio='{$optgrupo}' ";            
        $query .= "WHERE ID='{$id_proveedor}'";
        $result = $db->query($query);

         if($result && $db->affected_rows() === 1){    

          $session->msg('s',"Guardo Registro! ");       
          $user_id = (int)$_SESSION['user_id'];
          $evento = "Edito proveedor id=".(int)$_GET['id'];
          bitacora($user_id, $evento);   
          redirect('proveedores.php?id='.(int)$e_result['id'], false);

        } else {

          $session->msg('d','Lamentablemente no se ha actualizado!');
          redirect('e_proveedor.php?id='.(int)$e_result['id'], false);

        }
   } else {
     $session->msg("d", $errors);
    redirect('e_proveedor.php?id='.(int)$e_result['id'], false);
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
   Proveedores
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
       <form  method="post" action="e_proveedor.php?id=<?php echo (int)$e_result['id'];?>" data-parsley-validate="" novalidate="" class="form-horizontal" role="form">                
          <div class="panel-body">             

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Id:</label>
                   <div class="col-sm-6">                   
                      <input id="clave" name="clave" type="name" required="required" class="form-control" value="<?php echo remove_junk(ucwords($e_result['id'])); ?>" readonly>
                       <ul class="parsley-errors-list filled" id="required-clave" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Nombre:</label>
                   <div class="col-sm-6">                   
                      <input id="nombre" name="nombre" type="name" required="required" class="form-control" value="<?php echo remove_junk(ucwords($e_result['nombre'])); ?>">
                       <ul class="parsley-errors-list filled" id="required-nombre" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>  

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Telefono:</label>
                   <div class="col-sm-6">                   
                      <input id="telefono" name="telefono" type="name" required="required" class="form-control" value="<?php echo remove_junk(ucwords($e_result['telefono'])); ?>">
                       <ul class="parsley-errors-list filled" id="required-telefono" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>  

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Actividades:</label>
                   <div class="col-sm-6">                   
                      <input id="especialidad" name="especialidad" type="name" required="required" class="form-control" value="<?php echo remove_junk(ucwords($e_result['descripcion'])); ?>">
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
                          <option value="<?php echo (int)$cata['id']; ?>" <?php if($e_result['idtiposervicio'] === $cata['id']): echo 'selected'; endif; ?> >
                            <?php echo remove_junk($cata['descripcion']); ?></option>                            
                        <?php endforeach; ?>
                        </select>
                       <ul class="parsley-errors-list filled" id="required-id_estado" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>      


          <!-- AVISO -->                  
          </div><!-- ./panel-body -->
          <div class="panel-footer text-center">
             <button type="submit" name="update" id="update" class="btn btn-amcora">Actualizar</button>
             <a href="proveedores.php" class="btn btn-gris">Cancelar</a>
          </div>           
        </form><!-- /form -->
    </div><!-- ./panel panel-default -->
  </div>   
</div>
<?php include_once('layouts/footer.php'); ?>
