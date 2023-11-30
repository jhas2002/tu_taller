<?php  
  use App\Controllers\Reporte;
?>
<div class="p-0  p-cont">
	<div class="container-fluid pb-5 fondoAdmin">
    <div class="container pt-5 pb-5">
      <div class="row justify-content-center">
        <div class="col-md-4 text-center">
          <form action="<?php echo base_url('public/reporte/reportes') ?>" target="_self" method="post">
            <select class="form-select" name="txtTipoReporte" id="txtTipoReporte">
              <option value="">Seleccione un tipo</option>
              <option value="1">Cantidad de Citas por Tipo</option>
              <option value="2">Cantidad de Cotizaciones por Tipo</option>
              <option value="3">Calificacion por mes</option>
              <option value="4">Citas Totatales</option>
            </select>
            <div class="row" id="divFechas" hidden>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="font-monserrat-bold">Fecha Inicio</label>
                  <input type="date" name="fechaInicio" id="fechaInicio" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label >Fecha Final</label>
                  <input type="date" name="fechaFinal" id="fechaFinal" class="form-control">
                </div>
              </div>
            </div>
            <div class="row text-center align-items-center justify-content-center" id="divAño" hidden>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Año</label>
                  <input class="form-control" type="numbre" name="txtAño" min="2015">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success font-monserrat-black">GENERAR</button>
          </form>
        </div>
      </div>
      <?php  
        if ($dataReporte != '') 
        {
          ?>
          <div class="row pt-3 pb-3">
            <div class="col-md-12 text-center">
              <form action="<?php echo base_url('public/reporte/reportepdf') ?>" target="_blanck" method="post">
                <input type="date" name="fechaInicio" class="form-control" value="<?php echo $fechaInicio ?>" hidden>
                <input type="date" name="fechaFinal" class="form-control" value="<?php echo $fechaFinal ?>" hidden>
                <input type="text" name="txtTipoReporte" value="<?php echo $tipoReporte ?>" hidden>
                <input type="text" name="txtAño" value="<?php echo $año ?>" hidden>
                <button type="submit" class="btn btn-success font-monserrat-black">EXPORTAR PDF</button>
              </form>
            </div>
          </div>
        <?php
        }
        else
        {?>
          <div class="row pt-3 pb-3">
            <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-success font-monserrat-black" disabled>EXPORTAR PDF</button>
            </div>
          </div>
          <?php
        }
      ?>
      
      <div class="row">
        <div class="col-md-12 text-center">
          <h1 class="font-bebas text-dark">REPORTES</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="card chart-container text-white">
            <canvas id="chart" class=""></canvas>
          </div>
        </div>
      </div>
      <br>
      <br>
      <?php  
      if ($dataDetalleReporte !=null && $tipoReporte == 1) 
        {?>
        <div class="row align-items-center text-center justify-content-center">
        <table class="table text-dark table-striped table-bordered border-primary" id="tablaDatos">
          <thead class="font-monserrat-medium negrita">
            <tr>
              <th class="negrita text-center fs-3" colspan="8">Detalle Reporte</th>
            </tr>
            <tr>
              <th class="col text-center">Nombre cliente</th>
              <th class="col text-center">Servicio</th>
              <th class="col text-center">Fecha de la cita</th>
              <th class="col text-center">Estado</th>
              
            </tr>
          </thead>
          <tbody class="">
            <?php
            foreach ($dataDetalleReporte as $row) 
            {?>
              <tr class="text-center align-middle">
                <td><?php echo $row->cliente ?></td>
                <td><?php echo $row->servicio ?></td>
                <td><?php echo $row->fechaCita ?></td>
                <td><?php if ($row->estado == -1) {
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
        <div class="row align-items-center text-center justify-content-center">
        <table class="table text-dark table-striped table-bordered border-primary" id="tablaDatos">
          <thead class="font-monserrat-medium negrita">
            <tr>
              <th class="negrita text-center fs-3" colspan="8">Detalle Reporte</th>
            </tr>
            <tr>
              <th class="col text-center">Nombre cliente</th>
              <th class="col text-center">Servicio</th>
              <th class="col text-center">Costo</th>
              
            </tr>
          </thead>
          <tbody class="">
            <?php
            foreach ($dataDetalleReporte as $row) 
            {?>
              <tr class="text-center align-middle">
                <td><?php echo $row->cliente ?></td>
                <td><?php echo $row->servicio ?></td>
                <td><?php echo $row->costo ?></td>
                
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
        {?>
        <div class="row align-items-center text-center justify-content-center">
        <table class="table text-dark table-striped table-bordered border-primary" id="tablaDatos">
          <thead class="font-monserrat-medium negrita">
            <tr>
              <th class="negrita text-center fs-3" colspan="8">Detalle Reporte</th>
            </tr>
            <tr>
              <th class="col text-center">Mes</th>
              <th class="col text-center">Calificación</th>
              
            </tr>
          </thead>
          <tbody class="">
            <?php
            $reporte = new Reporte();
            foreach ($dataReporte as $row) 
            {?>
              <tr class="text-center align-middle">
                <td><?php echo $reporte->fechaLiteral($row->nombre) ?></td>
                <td><?php echo $row->cantidad ?></td>
                
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
        <div class="row align-items-center text-center justify-content-center">
        <table class="table text-dark table-striped table-bordered border-primary" id="tablaDatos">
          <thead class="font-monserrat-medium negrita">
            <tr>
              <th class="negrita text-center fs-3" colspan="8">Detalle Reporte</th>
            </tr>
            <tr>
              <th class="col text-center">Nombre cliente</th>
              <th class="col text-center">Servicio</th>
              <th class="col text-center">Fecha de la cita</th>
              <th class="col text-center">Estado</th>
              
            </tr>
          </thead>
          <tbody class="">
            <?php
            foreach ($dataDetalleReporte as $row) 
            {?>
              <tr class="text-center align-middle">
                <td><?php echo $row->cliente ?></td>
                <td><?php echo $row->servicio ?></td>
                <td><?php echo $row->fechaCita ?></td>
                <td><?php if ($row->estado == -1) {
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
    </div>
  </div>
</div>



<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js">
</script>
<?php  

if ($dataReporte != '' && $tipoReporte != '4') 
{
  $reporte = new Reporte();?>
  <script>
      const ctx = document.getElementById("chart").getContext('2d');
      const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [<?php foreach ($dataReporte as $row) {
          if ($titulo == 'Calificacion por mes') {echo '"'.$reporte->fechaLiteral($row->nombre). '",';}
          else
            {
              echo '"'.$row->nombre.'",';
            }
  } ?>],
          datasets: [{
            label: '<?php echo $titulo ?>',
            data: [<?php foreach ($dataReporte as $row) {
              echo $row->cantidad.',';
            } ?>],
            backgroundColor: ["#0074D9", "#FF4136", "#2ECC40",
            "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00",
            "#001f3f", "#39CCCC", "#01FF70", "#85144b",
            "#F012BE", "#3D9970", "#111111", "#AAAAAA"]
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
              }
            }]
          }
        },
        
      });
</script>
  <?php
}
if ($dataReporte != '' && $tipoReporte == '4') 
{
  $reporte = new Reporte();?>
  <script>
      const ctx = document.getElementById("chart").getContext('2d');
      const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [<?php for ($i = 0; $i < count($dataReporte); $i++) {
            echo '"'.$dataReporte[$i][0].'",';
          } ?>],
          datasets: [{
            label: '<?php echo $titulo ?>',
            data: [<?php for ($i=0; $i < count($dataReporte); $i++) { 
                echo '"'.$dataReporte[$i][1].'",';
            } ?>],
            backgroundColor: ["#0074D9", "#FF4136", "#2ECC40",
            "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00",
            "#001f3f", "#39CCCC", "#01FF70", "#85144b",
            "#F012BE", "#3D9970", "#111111", "#AAAAAA"]
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
              }
            }]
          }
        },
        
      });
</script>
  <?php
}
?>
<script type="text/javascript">
  var select = document.getElementById("txtTipoReporte");
  var divAño = document.getElementById("divAño");
  var divFecha = document.getElementById("divFechas");
select.addEventListener("change", function(){
  var selectedOption = this.options[this.selectedIndex];
  if (selectedOption.value == 3) 
  {
    divAño.hidden = false;
    divFecha.hidden = true;
  }
  else
  {
    divFecha.hidden = false;
    divAño.hidden = true;
  }
  console.log("Option selected: " + selectedOption.value);

});
</script>