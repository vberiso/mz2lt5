<?php
  $page_title = 'Admin página de inicio';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
 $ind_1     = 0;
 $aportacion = indice_aportacion();
 $ingresos= ingresos_mensual();
 //$tipo_ingresos = ingresos_tipo_mensual();

?>
<?php include_once('layouts/header.php'); ?>


<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="libs/js/highcharts/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/funnel.js"></script>


<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="content-heading">   
   Tablero de Control
   <small data-localize="dashboard.WELCOME">PANEL</small>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">                    
            <div collapse="panelChart9" class="panel-wrapper">
                <div class="panel-body">
                    <div id="container1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-default">                    
            <div collapse="panelChart9" class="panel-wrapper">
                <div class="panel-body">
                    <div id="container2"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">                    
            <div collapse="panelChart9" class="panel-wrapper">
                <div class="panel-body">
                    <div id="container3"></div>
                </div>
            </div>
        </div>
    </div>
</div>  

<script>
Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Residentes Mz2 Lt5 18'
    },
    subtitle: {
        text: 'Aportan regularmente'
    },
    xAxis: {
        categories: [
            '# Residentes'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Viviendas que aportan'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:,.2f}</b> '
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [<?php
      foreach ($aportacion as $row):   
         echo "{name:'".$row["estado"]."', data:[".$row["viviendas"]."]},";
      endforeach;
      ?>]
});
   
</script>

<script>
Highcharts.chart('container2', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Ingresos'
    },
    subtitle: {
        text: 'Mes Actual'
    },
    xAxis: {
        categories: ['Ingresos'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'pesos',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' '
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Cuotas',
        data: [
        <?php
          foreach ($ingresos as $row):   
             echo $row["importe"].",";
          endforeach;
         ?>    
        ]    
    }]
});
</script>

<script>
Highcharts.chart('container3', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Egresos'
    },
    subtitle: {
        text: 'Mes Actual'
    },
    xAxis: {
        allowDecimals: false,
        labels: {
            formatter: function () {
                return this.value; 
            }
        }
    },
    yAxis: {
        title: {
            text: 'Pesos'
        },
        labels: {
            formatter: function () {
                return "$ " + this.value;
            }
        }
    },
    tooltip: {
        pointFormat: 'Importe : <b> $ {point.y:,.0f}</b>'
    },
    plotOptions: {
        area: {
            pointStart: 1,           
            marker: {
                enabled: false,
                symbol: 'circle',
                radius: 2,
                states: {
                    hover: {
                        enabled: true
                    }
                }
            }
        }
    },
    series: [{
        name: 'Ingresos',
        data: [
         <?php
          foreach ($ingresos as $row):   
             echo $row["importe"].",";
          endforeach;
         ?>
        ]   
    }]
});
</script>

<script>
  $(document).ready(function () {
    Highcharts.chart('container4', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Ingresos por Tipo Pago'
        },
        subtitle: {
            text: 'Mes Actual'
        },        
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.2f}% - $ {point.y:,.2f}</b> '
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: ' ',
            colorByPoint: true,
            data: [
                    <?php  foreach ($tipo_ingresos as $cata): ?>
                      <?php echo "{ name:'".$cata['tipo']."', y:".$cata['ingresos']."}," ?>
                    <?php endforeach; ?>
            ]
        }]
    });
});  
</script>

<?php include_once('layouts/footer.php'); ?>
