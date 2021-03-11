<?php
  $page_title = 'Editar Residente';
  require_once('includes/load.php');
  
   page_require_level(1);
  //Llenamos las listas
  $estados = find_all('estados'); 
  $tipo_residente = find_all('tipo_residente'); 

  $e_result = find_by_id('residentes',(int)$_GET['id']); 
  if(!$e_result){
    $session->msg("d","Sin seleccion de id.");
    redirect('residentes.php');
  }
  $id_residente = (int)$_GET['id'];
  
?>
<?php
  if(isset($_POST['update'])){

   $req_fields = array('nombre');
   validate_fields($req_fields);

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

          $query  = "UPDATE residentes SET ";
          $query .= "no_casa='{$no_casa}',usuario='{$nombre}', ";   
          $query .= "idtiporesidenteu='{$idtiporesidenteu}',telefono_usuario='{$telefono_usuario}', "  ;  
          $query .= "propietario='{$propietario}', telefono_propietario='{$telefono_propietario}' ,"  ;  
          $query .= "vehiculo='{$vehiculo}', mascotas='{$mascota}' ,"  ;  
          $query .= "idestado='{$id_estado}', cuota='{$cuota}' "  ;  
          $query .= "WHERE ID='{$id_residente}'";

          $result = $db->query($query);

          if($result && $db->affected_rows() === 1) 
          {
              $session->msg('s',"Guardo Registro! ");       
              $user_id = (int)$_SESSION['user_id'];
              $evento = "Edicion residente id=".(int)$_GET['id'];
              bitacora($user_id, $evento);   
              redirect('residentes.php?id='.(int)$e_result['id'], false);
          }
          else 
          {
            $session->msg('d','Sin cambios detectados. Modifique la información o cancele la edición.'. $actualiza_precio);
            redirect('e_residente.php?id='.(int)$e_result['id'], false);
          }
   }
   else {
     $session->msg("d", $errors);
    redirect('e_residente.php?id='.(int)$e_result['id'], false);
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
          <span class="glyphicon glyphicon-pencil"></span>
          <span>Edición</span>
       </strong>         
      </div>
       <form  method="post" action="e_residente.php?id=<?php echo (int)$e_result['id'];?>" data-parsley-validate="" novalidate="" class="form-horizontal" role="form" onsubmit="return valida()">                
          <div class="panel-body">             

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Identificador:</label>
                   <div class="col-sm-6">                   
                      <input id="clave" 
                             name="clave" 
                             type="name" 
                             required="required" 
                             class="form-control" 
                             value="<?php echo remove_junk(ucwords($e_result['id'])); ?>" 
                             readonly>
                       <ul class="parsley-errors-list filled" id="required-clave" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset>    

             <fieldset>
              <div class="form-group">
                 <label class="col-sm-2 control-label" for="level">Número Casa:</label>
                 <div class="col-sm-6">
                     <div class="row">
                       <div class="col-md-4">
                         <input id="no_casa" 
                                name="no_casa" 
                                type="number" 
                                required="required" 
                                class="form-control" 
                                value="<?php echo remove_junk(ucwords($e_result['no_casa'])); ?>" 
                                min="0" 
                                max='99' 
                                pattern="^[0-9]" 
                                title='Solo Numeros'>
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
                              style="text-transform:uppercase"
                              value="<?php echo remove_junk(ucwords($e_result['usuario'])); ?>" >
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
                         <input id="telefono_usuario" 
                                name="telefono_usuario" 
                                type="number" 
                                required="required" 
                                class="form-control" 
                                pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                                title='Solo Numeros'
                                value="<?php echo remove_junk(ucwords($e_result['telefono_usuario'])); ?>">
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
                          <option value="<?php echo (int)$cata['id']; ?>" <?php if($e_result['idtiporesidenteu'] === $cata['id']): echo 'selected'; endif; ?> >
                            <?php echo remove_junk($cata['descripcion']); ?></option>                            
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
                              style="text-transform:uppercase"  
                              value="<?php echo remove_junk(ucwords($e_result['propietario'])); ?>">
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
                         <input id="telefono_propietario" 
                                name="telefono_propietario" 
                                type="number" 
                                required="required" 
                                class="form-control" 
                                pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                                title='Solo Numeros'
                                value="<?php echo remove_junk(ucwords($e_result['telefono_propietario'])); ?>">
                          <ul class="parsley-errors-list filled" id="required-telefono_propietario" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul> 
                        </div>  
                      </div> 
                   </div>              
              </div>
           </fieldset>      


           <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Vehiculo:</label>
                   <div class="col-sm-6">
                        <select class="form-control" name="vehiculo">
                          <option <?php if($e_result['vehiculo'] === '1') echo 'selected="selected"';?> value="1">Sí </option>
                          <option <?php if($e_result['vehiculo'] === '0') echo 'selected="selected"';?> value="0">No</option>                         
                        </select>
                       <ul class="parsley-errors-list filled" id="required-vehiculo" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset> 

             <fieldset>
                <div class="form-group">
                   <label class="col-sm-2 control-label" for="name">Mascotas:</label>
                   <div class="col-sm-6">
                        <select class="form-control" name="mascota">
                          <option <?php if($e_result['mascotas'] === '1') echo 'selected="selected"';?> value="1">Sí </option>
                          <option <?php if($e_result['mascotas'] === '0') echo 'selected="selected"';?> value="0">No</option>                         
                        </select>
                       <ul class="parsley-errors-list filled" id="required-mascotas" style="display:none"><li class="parsley-required">*Campo requerido.</li></ul>
                   </div>
                </div>
             </fieldset> 

           <fieldset>
              <div class="form-group">
                 <label class="col-sm-2 control-label" for="level">Cuota Mensual:</label>
                 <div class="col-sm-6">
                     <div class="row">
                       <div class="col-md-4">
                         <input id="cuota" 
                                name="cuota" 
                                type="number" 
                                required="required" 
                                class="form-control" 
                                min="100"  
                                pattern="^[0-9]" 
                                title='Solo Numeros'
                                value="<?php echo remove_junk(ucwords($e_result['cuota'])); ?>">
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
                      <option value="0">Seleccione Tipo Usuario</option>
                        <?php  foreach ($estados as $cata): ?>                          
                          <option value="<?php echo (int)$cata['id']; ?>" <?php if($e_result['idestado'] === $cata['id']): echo 'selected'; endif; ?> >
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
