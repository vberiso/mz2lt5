<?php
  $page_title = 'Agregar Residente';
  require_once('includes/load.php');
  
  page_require_level(1); 
  //Llenamos las listas
  $estados = find_all('estados'); 
  $tipo_residente = find_all('tipo_residente'); 

?>
<?php
  if(isset($_POST['add'])){ 

   $req_fields = array('nombre');
   validate_fields($req_fields);

   if(find_by_nocasa($_POST['no_casa']) === false ){
     $session->msg('w','<b>Error!</b> Ya existe en la base de datos');
     redirect('a_residente.php', false);
   }

   if(empty($errors)){
        $no_casa = remove_junk($db->escape($_POST['no_casa']));        
        $nombre = remove_junk($db->escape($_POST['nombre']));        
        $idtiporesidenteu = remove_junk($db->escape($_POST['idtiporesidenteu']));                
        $telefono_usuario = remove_junk($db->escape($_POST['telefono_usuario']));                
        $propietario = remove_junk($db->escape($_POST['propietario']));                
        $telefono_propietario = remove_junk($db->escape($_POST['telefono_propietario'])); 
        $vehiculo = remove_junk($db->escape($_POST['vehiculo']));                               
        $mascota = remove_junk($db->escape($_POST['mascota']));                
        $cuota = remove_junk($db->escape($_POST['cuota']));  
        $id_estado = remove_junk($db->escape($_POST['id_estado']));     
        $fecha = date("Ymd");      

        $query = "START TRANSACTION";
        $db->query($query);   

        $query  = "INSERT INTO residentes (";
        $query .="no_casa,usuario, idtiporesidenteu, telefono_usuario, propietario, telefono_propietario,vehiculo, mascotas, idestado, cuota";                
        $query .=") VALUES (";
        $query .=" '{$no_casa}','{$nombre}','{$idtiporesidenteu}','{$telefono_usuario}' ,'{$propietario}','{$telefono_propietario}','{$vehiculo}','{$mascota}','{$id_estado}','{$cuota}' ";        
        $query .=")";

        if($db->query($query)){          
 
                $session->msg('s',"Guardo Registro! ");
                //En Firme
                $query = "COMMIT";
                $db->query($query);            
                //Grabamos en Bitacora
                $user_id = (int)$_SESSION['user_id'];
                $evento = "Agrego residente";
                bitacora($user_id, $evento);                           
                redirect('residentes.php', false);

        } else {          
          $session->msg('d','Error al crear residente!');
          $query = "ROLLBACK";
          $db->query($query);           
          redirect('a_residente.php', false);
        }
   } else {
     $session->msg("d", $errors);
     redirect('a_residente.php',false);
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
   Residente
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
       <form  method="post" action="a_residente.php" data-parsley-validate="" novalidate="" class="form-horizontal" role="form" onsubmit="return valida()">                
          <div class="panel-body"> 

          <fieldset>
              <div class="form-group">
                 <label class="col-sm-2 control-label" for="level">Número Casa:</label>
                 <div class="col-sm-6">
                     <div class="row">
                       <div class="col-md-4">
                         <input id="no_casa" name="no_casa" type="number" required="required" class="form-control" min="0" max='99' pattern="^[0-9]" title='Solo Numeros'>
                          <ul class="parsley-errors-list filled" id="required-no_casa" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul> 
                        </div>  
                      </div> 
                   </div>              
              </div>
           </fieldset> 

            <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Usuario:</label>
                   <div class="col-sm-6">
                       <input id="nombre" 
                              name="nombre" 
                              type="name" 
                              required="required" 
                              class="form-control"
                              style="text-transform:uppercase"  >
                       <ul class="parsley-errors-list filled" id="required-nombre" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

             <fieldset>
              <div class="form-group">
                 <label class="col-sm-2 control-label" for="level">Teléfono:</label>
                 <div class="col-sm-6">
                     <div class="row">
                       <div class="col-md-4">
                         <input id="telefono_usuario" name="telefono_usuario" type="number" required="required" class="form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title='Solo Numeros'>
                          <ul class="parsley-errors-list filled" id="required-telefono_usuario" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul> 
                        </div>  
                      </div> 
                   </div>              
              </div>
           </fieldset> 

           <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label">Tipo Usuario:</label>
                   <div class="col-sm-6">                     
                      <select class="form-control" name="idtiporesidenteu" id="idtiporesidenteu">
                          <option value="0">Seleccione Tipo Usuario</option>
                        <?php  foreach ($tipo_residente as $cata): ?>
                          <option value="<?php echo (int)$cata['id'] ?>">
                            <?php echo $cata['descripcion'] ?></option>
                        <?php endforeach; ?>
                        </select>
                       <ul class="parsley-errors-list filled" id="required-idtiporesidenteu" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>   
             
             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Propietario:</label>
                   <div class="col-sm-6">
                       <input id="propietario" 
                              name="propietario" 
                              type="name" 
                              required="required" 
                              class="form-control"
                              style="text-transform:uppercase"  >
                       <ul class="parsley-errors-list filled" id="required-propietario" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>

             <fieldset>
              <div class="form-group">
                 <label class="col-sm-2 control-label" for="level">Teléfono Propietario:</label>
                 <div class="col-sm-6">
                     <div class="row">
                       <div class="col-md-4">
                         <input id="telefono_propietario" name="telefono_propietario" type="number" required="required" class="form-control" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title='Solo Numeros'>
                          <ul class="parsley-errors-list filled" id="required-telefono_propietario" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul> 
                        </div>  
                      </div> 
                   </div>              
              </div>
           </fieldset> 

             <p id="z_alerta1">
             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Vehiculo:</label>
                   <div class="col-sm-6">
                     <div class="row">
                       <div class="col-md-2">
                        <label class="switch">
                          <input id="vehiculo" name="vehiculo" type="checkbox" value="1"  required="required" >
                          <span class="slider round"></span>
                        </label>  
                      </div>                       
                   </div>
                </div>
             </fieldset> 
             </p>

             <p id="z_alerta2">
             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="level">Mascotas:</label>
                   <div class="col-sm-6">
                     <div class="row">
                       <div class="col-md-2">
                        <label class="switch">
                          <input id="mascota" name="mascota" type="checkbox" value="1"  required="required" >
                          <span class="slider round"></span>
                        </label>  
                      </div>                       
                   </div>
                </div>
             </fieldset> 
             </p>  

          <fieldset>
              <div class="form-group">
                 <label class="col-sm-2 control-label" for="level">Cuota Mensual:</label>
                 <div class="col-sm-6">
                     <div class="row">
                       <div class="col-md-4">
                         <input id="cuota" name="cuota" type="number" required="required" class="form-control" min="100"  pattern="^[0-9]" title='Solo Numeros'>
                          <ul class="parsley-errors-list filled" id="required-cuota" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul> 
                        </div>  
                      </div> 
                   </div>              
              </div>
           </fieldset>                 

              <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label">Estatus:</label>
                   <div class="col-sm-6">                     
                      <select class="form-control" name="id_estado" id="id_estado">
                          <option value="0">Seleccione Estatus</option>
                        <?php  foreach ($estados as $cata): ?>
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
             <a href="residentes.php" class="btn btn-gris">Cancelar</a>
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
   if(!required("no_casa")) {resp=false;}  
   if(!required("nombre")) {resp=false;}   
   if(!required("cuota")) {resp=false;}   
   if(!required("idtiporesidenteu")) {resp=false;}   
   if(!required("id_estado")) {resp=false;}   
  return resp;
}
</script>


<?php include_once('layouts/footer.php'); ?>
