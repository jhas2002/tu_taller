<div class="p-0 p-cont ">
	<div class="container-fluid fondoAdmin">
		<div class="container pt-5 pb-5">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="font-bebas text-dark">CITAS</h1>
				</div>
			</div>
			<div class="row">
				<table class="table text-dark bg-white table-striped table-bordered border-primary" id="tablaDatos">
					<thead class="font-monserrat-medium negrita">
						<tr>
							<th class="font-bebas negrita text-center fs-3" colspan="8">LISTA CITAS</th>
						</tr>
						<tr>
							<th class="col text-center">Nombre cliente</th>
							<th class="col text-center">Descripción </th>
							<th class="col text-center">Servicio </th>
							<th class="col text-center">Fecha Cita</th>
							<th class="col text-center">Aceptar</th>
							<th class="col text-center">Rechazar</th>
							
						</tr>
					</thead>
					<tbody class="">
						<?php
						foreach ($citas as $row) 
						{?>
							<tr class="text-center align-middle">
								<td><?php echo $row->cliente ?></td>
								<td><?php echo $row->descripcionProblema ?></td>
								<td><?php echo $row->servicio ?></td>
								<td><?php echo $row->fechaCita ?></td>
								<td><button id="btnAceptar" class="btn btn-success rounded-pill" type="button" onclick="aceptarCita('<?php echo $row->idCita; ?>', '<?php echo $row->idCliente ?>')" data-bs-toggle="modal" data-bs-target="#mdAceptarCita"> 	<span class="bi bi-check-square icon"></span>
							    </button></td>
								<td><button class="btn btn-danger rounded-pill" type="button" onclick="rechazarCita('<?php echo $row->idCita; ?>', '<?php echo $row->idCliente ?>')" data-bs-toggle="modal" data-bs-target="#mdRechazarCita"> 	<span class="bi bi-trash3-fill icon"></span> 
							    </button>
							</td>
								
								
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!--Modal En Espera-->
<div class="modal3 container-fluid" name="modalEspera" id="modalEspera" hidden="true">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-2">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">

			    			<h5 class="fs-4 pt-3 pb-1">EN PROCESO</h5>
			    		</div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4 pt-4 pb-4">
					    		<div class="spinner"></div>
					    		
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<!-- Modal Confirmar Cita-->

<div class="modal fade" id="mdAceptarCita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Aceptar Cita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/cita/aceptarcita') ?>" target="_self" method="post">
      	<div class="modal-body">
	      	<input type="text" name="idCliente" id="idCliente" hidden>
	      	<input type="text" name="idCita" id="idCita" hidden>
	      	<div class="form-group">
	      		<label>seleccione el día de la cita</label>
	      		<input type="datetime-local" min="<?php echo date('Y-m-d h:i', time()); ?>" requiered name="fechaCita" class="form-control">
	      	</div>
	      	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" id="btnGuardarPsw" onclick="MostrarModal()">Guardar</button>
	      </div>
      </form>
      
    </div>
  </div>
</div>
<!-- Modal Rechazar-->

<div class="modal fade" id="mdRechazarCita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Rechazar Cita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/cita/rechazarcita') ?>" target="_self" method="post">
      	<div class="modal-body">
	      	<input type="text" name="idCliente" id="idClienteR" hidden>
	      	<input type="text" name="idCita" id="idCitaR" hidden>
	      	<div class="form-group">
	      		<label>Escriba el motivo del rechazo</label>
	      		<input type="text" requiered name="txtMotivo" class="form-control">
	      	</div>
	      	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" id="btnGuardarPsw" onclick="MostrarModal()" >Guardar</button>
	      </div>
      </form>
      
    </div>
  </div>
</div>



<?php
if ($messageReport=='1') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-4">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-3 pt-3 pb-1">La cita se programó correctamente </h5>
			    		</div>

					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cita/listacitapendientetaller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}
if ($messageReport=='2') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-4">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-3 pt-3 pb-1">Error inesperado inténtelo otra vez</h5>
			    		</div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cita/listacitapendientetaller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}
if ($messageReport=='3') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-4">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-3 pt-3 pb-1">La cita fue rechazada exitosamente </h5>
			    		</div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cita/listacitapendientetaller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}
if ($messageReport=='4') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-4">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-3 pt-3 pb-1">Error inesperado inténtelo otra vez</h5>
			    		</div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cita/listacitapendientetaller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>

<script type="text/javascript">
	function aceptarCita(cita, cliente) 
	{
        document.getElementById("idCita").value = cita;
        document.getElementById("idCliente").value = cliente;
    }
    function rechazarCita(cita, cliente) 
	{
        document.getElementById("idCitaR").value = cita;
        document.getElementById("idClienteR").value = cliente;
    }
    function MostrarModal()
    {
    	document.getElementById("modalEspera").hidden = false;
    	//document.getElementById("mdRealizarCotizacion").hidden = true;
    	$('#mdAceptarCita').modal('hide');
    	$('#mdRechazarCita').modal('hide');
    }
</script>