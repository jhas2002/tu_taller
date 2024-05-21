<?php  
use App\Controllers\Reporte;
  $reporte = new Reporte();
$session = session();
date_default_timezone_set('America/La_Paz');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reporte</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@500&display=swap" rel="stylesheet">
</head>
<style>
	@page {
		margin-left: 0;
		margin-right: 0;
		margin-top: 5;
	}
</style>
<body>
	<h1 style="font-family: 'Bebas Neue', cursive; font-size: 35px; position: absolute; left:45%; ">TU TALLER</h1>
	<img src="<?php echo base_url('sources/images/logo.jpg') ?>" alt="ITC logo" style="width: 150px;">
	<h2 style="font-family: 'Bebas Neue', cursive; margin-left: 20px;">Reporte:</h2>
	<p style="font-family: 'Montserrat', sans-serif; margin-left: 25px;"><strong>Reporte generado por : </strong> <?php echo $session->get('nombre'); ?></p>
	<p style="font-family: 'Montserrat', sans-serif; margin-left: 25px;"><strong>Fecha en que se generó: </strong> <?php echo date('Y-m-d h:i:s a', time()); ?></p>
	<p style="font-family: 'Montserrat', sans-serif; margin-left: 25px;"><strong>Reporte generado de: </strong> <?php echo $fechaInicio.' hasta '.$fechaFinal ?></p>
	<h2 style="font-family: 'Bebas Neue', cursive; margin-left: 20px;">Detalle:</h2>
	<p style="font-family: 'Montserrat', sans-serif; margin-left: 25px;">
    <?php
    if ($tipoReporte == 4) {
      for ($i=0; $i < count($dataReporte); $i++) 
      { 
        echo $dataReporte[$i][0].': '.$dataReporte[$i][1];
        ?>
        <br>
        <?php
      }
      
    }
    else
    {
      foreach ($dataReporte as $row) 
      {?>
        <?php
        if ($titulo == 'Calificacion por mes') 
        {
          echo $reporte->fechaLiteral($row->nombre).': '.$row->cantidad.' Estrellas';
        } 
        else
        {
          echo $row->nombre.': '.$row->cantidad;
        }

        ?>
        <br>
        <?php
      }
    }
      
      ?>
      </p>
      <h1 style="font-family:'Bebas Neue', cursive; text-align:center;"><?php echo $titulo ?></h1>
      <div style="display: flex; justify-content: center; width: 100%; text-align: center;">
      	<!--<img src="https://quickchart.io/chart?c={type:'bar',data: {
          labels: [<?php /*foreach ($dataReporte as $row) {
          if ($titulo == 'Calificacion por mes') {echo '\''.$reporte->fechaLiteral($row->nombre). '\',';}else{$separador = explode(' ', $row->nombre); echo '\''.$separador[0].'\',';}} ?>],datasets:[{label:'',data: [<?php foreach ($dataReporte as $row) {
echo $row->cantidad.',';} */?>],backgroundColor: ['rgba(0, 116, 217, 1)', 'rgba(255, 65, 54, 1)', 'rgba(46, 204, 64, 1)', 'rgba(255, 133, 27, 1)', 'rgba(127, 219, 255, 1)', 'rgba(177, 13, 201, 1)'] }] } }" style=" text-align: center; width: 500px;">-->
      </div>
      <div style="<?php if ($titulo == 'Calificacion por mes') {
      	echo "margin-left: 40%;";
      }else{echo "margin-left: 20%;";} ?>">
      	<table>
      		<?php 
    $colores = ['rgba(0, 116, 217, 1)', 'rgba(255, 65, 54, 1)', 'rgba(46, 204, 64, 1)', 'rgba(255, 133, 27, 1)', 'rgba(127, 219, 255, 1)', 'rgba(177, 13, 201, 1)'];
    $count = 0;
     /* foreach ($dataReporte as $row) 
      {?>
      	<tr>
      		<td>
      		<div style="background: <?php echo $colores[$count] ?>; width: 30px; height: 10px;"></div>
      		</td>
      		<td>
      	<?php
				if ($titulo == 'Calificacion por mes') 
      	{
        	echo $reporte->fechaLiteral($row->nombre).': ';
      	}	
				else
      	{
       		echo $row->nombre;
      	}
      	?>
      	</td>
      	<?php
      	$count++;
      	?>
      	</tr>
      	<?php
      }*/
      ?>
      	</table>
      </div>
      <br>
      <br>
      <?php  
      if ($dataDetalleReporte !=null && $tipoReporte == 1) 
        {?>
        <div style="display: flex; justify-content: center; width: 100%; text-align: center; position: absolute; left:20%;">
        <table style="border-collapse: collapse;">
          <thead>
            <tr>
              <th style="border: 1px solid black; padding: 10px;font-family: 'Bebas Neue'; font-size: 35px;" colspan="4">Detalle Reporte</th>
            </tr>
            <tr style="font-family: 'Montserrat', sans-serif; margin-left: 25px;" >
              <th style="border: 1px solid black; padding: 10px;">Nombre cliente</th>
              <th style="border: 1px solid black; padding: 10px;">Servicio</th>
              <th style="border: 1px solid black; padding: 10px;">Fecha de la cita</th>
              <th style="border: 1px solid black; padding: 10px;">Estado</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dataDetalleReporte as $row) 
            {?>
              <tr style="font-family: 'Montserrat', sans-serif; margin-left: 22px;">
                <td style="border: 1px solid black; padding: 10px;"><?php echo $row->cliente ?></td>
                <td style="border: 1px solid black; padding: 10px;"><?php echo $row->servicio ?></td>
                <td style="border: 1px solid black; padding: 10px;"><?php echo $row->fechaCita ?></td>
                <td style="border: 1px solid black; padding: 10px;"><?php if ($row->estado == -1) {
                  echo "Rechazada";
                }elseif($row->estado == 0 ){
                  echo "Pendiente";
                }elseif ($row->estado == 1 ) {
                  echo "Esperando Atencion";
                }elseif ($row->estado = 2) {
                  echo "Atencion Finalizada";
                }elseif ($row->estado == 3) {
                  echo "No Se presento";
                } ?></td>
                
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
      }
      ?>

      <?php  
      if ($dataDetalleReporte !=null && $tipoReporte == 2) 
        {?>
        <div style="display: flex; justify-content: center; width: 100%; text-align: center; position: absolute; left:30%;">
        <table style="border-collapse: collapse;">
          <thead>
            <tr>
              <th style="border: 1px solid black; padding: 10px;font-family: 'Bebas Neue'; font-size: 35px;" colspan="3">Detalle Reporte</th>
            </tr>
            <tr style="font-family: 'Montserrat', sans-serif; margin-left: 25px;" >
              <th style="border: 1px solid black; padding: 10px;">Nombre cliente</th>
              <th style="border: 1px solid black; padding: 10px;">Servicio</th>
              <th style="border: 1px solid black; padding: 10px;">Costo</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dataDetalleReporte as $row) 
            {?>
              <tr style="font-family: 'Montserrat', sans-serif; margin-left: 22px;">
                <td style="border: 1px solid black; padding: 10px;"><?php echo $row->cliente ?></td>
                <td style="border: 1px solid black; padding: 10px;"><?php echo $row->servicio ?></td>
                <td style="border: 1px solid black; padding: 10px;"><?php echo $row->costo ?></td>
                
                
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
      }
      ?>

      <?php  
      if ($dataReporte !=null && $tipoReporte == 3) 
        { ?>
        <div style="display: flex; justify-content: center; width: 100%; text-align: center; position: absolute; left:37%;">
        <table style="border-collapse: collapse;">
          <thead>
            <tr>
              <th style="border: 1px solid black; padding: 10px;font-family: 'Bebas Neue'; font-size: 35px;" colspan="2">Detalle Reporte</th>
            </tr>
            <tr style="font-family: 'Montserrat', sans-serif; margin-left: 25px;" >
              <th style="border: 1px solid black; padding: 10px;">Mes</th>
              <th style="border: 1px solid black; padding: 10px;">Calificacion</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dataReporte as $row) 
            {?>
              <tr style="font-family: 'Montserrat', sans-serif; margin-left: 22px;">
                <td style="border: 1px solid black; padding: 10px;"><?php echo $reporte->fechaLiteral($row->nombre) ?></td>
                <td style="border: 1px solid black; padding: 10px;"><?php echo $row->cantidad ?></td>
                
                
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
      }
      ?>
      <?php  
      if ($dataDetalleReporte !=null && $tipoReporte == 4) 
        {?>
        <div style="display: flex; justify-content: center; width: 100%; text-align: center; position: relative; left:20%;">
        <table style="border-collapse: collapse;">
          <thead>
            <tr>
              <th style="border: 1px solid black; padding: 10px;font-family: 'Bebas Neue'; font-size: 35px;" colspan="4">Detalle Reporte</th>
            </tr>
            <tr style="font-family: 'Montserrat', sans-serif; margin-left: 25px;" >
              <th style="border: 1px solid black; padding: 10px;">Nombre cliente</th>
              <th style="border: 1px solid black; padding: 10px;">Servicio</th>
              <th style="border: 1px solid black; padding: 10px;">Fecha de la cita</th>
              <th style="border: 1px solid black; padding: 10px;">Estado</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dataDetalleReporte as $row) 
            {?>
              <tr style="font-family: 'Montserrat', sans-serif; margin-left: 22px;">
                <td style="border: 1px solid black; padding: 10px;"><?php echo $row->cliente ?></td>
                <td style="border: 1px solid black; padding: 10px;"><?php echo $row->servicio ?></td>
                <td style="border: 1px solid black; padding: 10px;"><?php echo $row->fechaCita ?></td>
                <td style="border: 1px solid black; padding: 10px;"><?php if ($row->estado == -1) {
                  echo "Rechazada";
                }elseif($row->estado == 0 ){
                  echo "Pendiente";
                }elseif ($row->estado == 1 ) {
                  echo "Esperando Atencion";
                }elseif ($row->estado = 2) {
                  echo "Atencion Finalizada";
                }elseif ($row->estado == 3) {
                  echo "No Se presento";
                } ?></td>
                
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
      }
      ?>

</body>

</html>