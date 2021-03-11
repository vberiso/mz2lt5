<?php
  $page_title = 'Recibo de Pago';
  require_once('includes/load.php');
  
   page_require_level(4);  

   $id = $_GET['id'];
   $detalle = find_detalle_pago_id($id); 

?>
<?php include_once('layouts/header.php'); ?>

<div class="panel-body right">
<a href="<?=$_SERVER["HTTP_REFERER"]?>" class="btn btn-labeled btn-amcora"> 
        <span class="btn-label"><i class="fa fa-angle-double-left"></i></span>Regresar</a>                         
</div>  
<div class="panel">
  <table style="width: 100%">
    <tr>
      <td style="text-align: left;"><img src="libs/images/edo-cta-hd.jpg"></td>
      <td rowspan="6" style="text-align: right;"><img src="libs/images/logo-edo-cta.jpg"></td></td>     
    </tr> 
    <tr>
      <td>
         <small><strong>Nombre del Paciente:</strong></small>
         <small class="text-muted"><?php echo remove_junk(ucwords($detalle['paciente']))?></small>
         <small class="text-muted"><?php echo remove_junk(ucwords($detalle['id']))?></small>
         <small class="text-muted"><?php echo remove_junk(ucwords($detalle['nombre']))?></small>
         <small class="text-muted"><?php echo remove_junk(ucwords($detalle['tipo_pago']))?></small>
         <?php $letra = numletras($detalle['monto'],1); ?>
         <small class="text-muted"><?php echo remove_junk(ucwords($letra)) ?></small>
      </td>      
    </tr>
    <tr>    
    <tr>
        <td colspan="9" ><div class="text-right text-bold">Importe</div></td>
        <td>
           <div class="text-right text-bold">$<?php echo number_format($detalle['monto'], 2, ".", ","); ?></div>
        </td>
     </tr>        
  </table> 
                   
<hr class="hidden-print">
<div class="clearfix">
   <button type="button" onclick="window.print();" class="btn btn-default pull-left">Imprimir</button>          
</div>    
</div>

<?php include_once('layouts/footer.php'); ?>
