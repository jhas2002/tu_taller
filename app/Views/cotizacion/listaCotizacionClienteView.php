<div class="p-0 p-cont ">
	<div class="container-fluid fondoAdmin">
		<div class="container pt-5 pb-5">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="font-bebas text-dark">MIS COTIZACIONES</h1>
				</div>
			</div>
			<div class="row">
				<table class="table text-dark bg-white table-striped table-bordered border-primary" id="tablaDatos">
					<thead class="font-monserrat-medium negrita">
						<tr>
							<th class="font-bebas negrita text-center fs-3" colspan="8">LISTA COTIZACIONES</th>
						</tr>
						<tr>
							<th class="col text-center">Nombre Taller</th>
							<th class="col text-center">Servicio</th>
							<th class="col text-center">Tiempo</th>
							<th class="col text-center">Costo</th>
							<th class="col text-center">Detalles</th>
							
						</tr>
					</thead>
					<tbody class="">
						<?php
						foreach ($cotizaciones as $row) 
						{?>
							<tr class="text-center align-middle">
								<td><?php echo $row->nombre ?></td>
								<td><?php echo $row->servicio ?></td>
								<td><?php echo $row->tiempoAproximado ?></td>
								<td><?php echo $row->costo ?></td>
								<td>
									<form action="<?php echo base_url('public/cotizacion/clientecotizacionpdf') ?>" target="_blanck" method="post">
										<input type="text" name="idCotizacion" value="<?php echo $row->idCotizacion ?>" hidden>
										<?php  
											if ($row->costo != '') {?>
												<button id="btnAceptar" class="btn btn-success rounded-pill" type="submit"> 	<span class="bi bi-check-square icon"></span>
							    				</button>
							    				<?php
											}
											else
											{
										?>
										<button id="btnAceptar" class="btn btn-success rounded-pill" type="submit" disabled="true"> 	<span class="bi bi-check-square icon"></span>
							    		</button>
											<?php } ?>
									</form></td>
								
								
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
<!-- Modal Confirmar Cita-->

<div class="modal fade" id="mdRealizarCotizacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Realizar Cotizacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/cotizacion/realizarcotizacion') ?>" target="_self" method="post">
      	<div class="modal-body">
	      	<input type="text" name="idCliente" id="idCliente" hidden>
	      	<input type="text" name="idCotizacion" id="idCotizacion" hidden>
	      	<div class="form-group">
	      		<label>Descripción de la solución</label>
	      		<input type="text"  requiered name="txtDescripcion" class="form-control">
	      	</div>
	      	<div class="form-group">
	      		<label>Costo</label>
	      		<input type="decimal"  requiered name="txtCosto" class="form-control">
	      	</div>
	      	<div class="form-group">
	      		<label>Tiempo aproximado de reparación</label>
	      		<input type="text"  requiered name="txtTiempoAproximado" class="form-control">
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" id="btnGuardarPsw" >Guardar</button>
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
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">COTIZACIÓN EXITOSA</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Se envio la cotización con exito</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cotizacion/listacotizacionpentientetaller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">ERROR</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 font-monserrat-regular pt-2">Hubo un error al registrar la cotizacion intentelo otra vez</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/listacotizacionpentientetaller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
	function realizarCotizacion(cotizacion, cliente) 
	{
        document.getElementById("idCotizacion").value = cotizacion;
        document.getElementById("idCliente").value = cliente;
    }
</script>