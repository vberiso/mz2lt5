<?php
  $page_title = 'Busquedas';
  require_once('includes/load.php');
  
  page_require_level(4); 

  //Llenamos las listas
  $residentes =find_all_residentes_activos();
  $ubicaciones=find_no_casa_activa();
?>
<?php include_once('layouts/header.php'); ?>
<link rel="stylesheet" href="libs/css/main.css" id="maincss">
<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="content-heading">   
   Buscar
   <small>Residentes</small>
</div>

<div id="v_seleccionar">
  <div class="unwrap">
     <div class="bg-cover">
        <div class="container container-md pv-lg">
           <div class="text-center mb-lg pb-lg">
              <div class="h1 text-bold">¿Cómo quiere buscar?</div>
              <p>Seleccione la opción que más sea de su agrado</p>
           </div>
        </div>
     </div>
  </div>

  <div class="row">
    <div class="container container-md"> 
       <div class="col-xs-12 col-sm-4 col-md-6">          
          <a id="paciente" href="javascript:seleccionarOpcion(1)">
            <div class="panel widget">
              <div class="portlet-handler ui-sortable-handle">
                 <div class="row row-table row-flush">
                    <div class="col-xs-4 bg-info-dark text-center">
                       <em class="fa fa-user fa-3x"></em>
                    </div>
                    <div class="col-xs-8">
                       <div class="panel-body text-center">
                          <h4 class="h1 text-bold mt0">Nombre</h4>
                          <p class="mb0 text-muted">Buscar por nombre</p>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
          </a>
       </div>

       <div class="col-xs-12 col-sm-4 col-md-6">          
          <a id="cuarto" href="javascript:seleccionarOpcion(2)">
            <div class="panel widget">
              <div class="portlet-handler ui-sortable-handle">
                 <div class="row row-table row-flush">
                    <div class="col-xs-4 bg-warning-dark text-center">
                       <em class="fa fa-home fa-3x"></em>
                    </div>
                    <div class="col-xs-8">
                       <div class="panel-body text-center">
                          <h4 class="h1 text-bold mt0">Casa</h4>
                          <p class="mb0 text-muted">Buscar por número casa</p>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
          </a>
       </div>              
    </div>
    </div>
  </div>
</div>

<div id="v_buscar_paciente" style="display: none;">  
  <div class="unwrap">
     <div class="bg-cover">
        <div class="container container-md pv-lg">
           <div class="text-center mb-lg pb-lg">
              <div class="h1 text-bold">Buscar Residente</div>              
           </div>
        </div> 
     </div>
  </div>
  <div class="container container-md">
     <form action="" class="form"> 
        <div class="input-group input-group-lg">                     
           <select  class="form-control required" id="select2-1" name="select2-1" data-width="100%" >
             <option value="0"></option>
             <?php foreach ($residentes as $residente ):?>
             <option value="<?php echo $residente['id'];?>"><?php echo ucwords($residente['nombre']);?></option>
             <?php endforeach;?>
          </select>   
           <span class="input-group-btn">
              <button id="regresar" 
                      type="button" 
                      class="btn btn-info btn-lg" 
                      onclick="seleccionarOpcion(0);"><strong>Regresar</strong></button>
           </span>
        </div>
     </form>
   </div>
</div> 

<div id="v_buscar_cuarto" style="display: none;">  
  <div class="unwrap">
     <div class="bg-cover">
        <div class="container container-md pv-lg">
           <div class="text-center mb-lg pb-lg">
              <div class="h1 text-bold">Seleccionar Casa</div>              
           </div>
        </div> 
     </div>
  </div>
  <div class="container container-md">
     <form action="" class="form"> 
        <div class="input-group input-group-lg">                     
           <select  class="form-control required" id="select2-2" name="select2-2" data-width="100%" >
             <option value="0"></option>
             <?php foreach ($ubicaciones as $ubicacion ):?>
             <option value="<?php echo $ubicacion['id'];?>"><?php echo ucwords($ubicacion['descripcion']);?></option>
             <?php endforeach;?>
          </select>   
           <span class="input-group-btn">
              <button id="regresar" 
                      type="button" 
                      class="btn btn-info btn-lg" 
                      onclick="seleccionarOpcion(0);"><strong>Regresar</strong></button>
           </span>
        </div>
     </form>
   </div>
</div>

<div id="v_buscar_consultorio" style="display: none;">  
  <div class="unwrap">
     <div class="bg-cover">
        <div class="container container-md pv-lg">
           <div class="text-center mb-lg pb-lg">
              <div class="h1 text-bold">Consultorios</div>              
           </div>
        </div> 
     </div>
  </div>
  <div class="container container-md">
      
   </div>
</div>

<div id="v_paciente" style="display: none;"> 
    <div class="row">
      <div class="col-md-12">
        <a href="p_buscar.php" class="btn btn-warning">Regresar</a>
        <div class="panel panel-default">                       
               <div class="panel-body">
                  <div id="detalle">
                     Aqui va el paciente
                  </div>
               </div>
         </div>      
      </div>
    </div>
</div>
    
<?php include_once('layouts/footer.php'); ?>

<script type="text/javascript">
  $(document).ready(function(){  
  
  $("#select2-1").change(function() {
    if ($("#select2-1 option:selected").val() != 0 )
        obtenerPaciente($('#select2-1').val()); 
  });

  $("#select2-2").change(function() {
    if ($("#select2-2 option:selected").val() != 0 )
       {
         id_ubicacion = $(this).val();
          $.post("getidPaciente.php", { id_ubicacion: id_ubicacion }, function(data){
                            obtenerPaciente(data); 
                          });  
       }
  });

}); 

function obtenerPaciente(id) {     
   window.location.replace('#?id=' + id);   
}

</script>
<script type="text/javascript">
function seleccionarOpcion(opcion) {  
  if(opcion==0)
  {    
    $('#v_seleccionar').css('display','block'); 
    $('#v_buscar_paciente').css('display','none'); 
    $('#v_buscar_cuarto').css('display','none');    
    $('#v_buscar_consultorio').css('display','none');   
  }     
  if(opcion==1)
  {    
    $('#v_seleccionar').css('display','none'); 
    $('#v_buscar_paciente').css('display','block');      
    $('#v_buscar_cuarto').css('display','none');     
    $('#v_buscar_consultorio').css('display','none');       
  }   
  if(opcion==2)
  {    
    $('#v_seleccionar').css('display','none'); 
    $('#v_buscar_paciente').css('display','none');   
    $('#v_buscar_cuarto').css('display','block');  
    $('#v_buscar_consultorio').css('display','none');         
  }  
   
}
</script>

<style type="text/css">

#v_seleccionar div div a:hover{
  text-decoration: none;
  cursor: pointer;
  color: #656565;
}
</style>