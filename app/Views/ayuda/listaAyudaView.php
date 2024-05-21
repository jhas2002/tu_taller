<style type="text/css">
	#map{
    height: 400px;
    width: 100%;
  }
</style>
<div class="p-0 p-cont ">
	<div class="container-fluid fondoAdmin">
		<div class="container pt-5 pb-5">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="font-bebas text-dark">AYUDAS</h1>
				</div>
			</div>
			<div class="row">
				<table class="table text-dark bg-white table-striped table-bordered border-primary" id="tablaDatos">
					<thead class="font-monserrat-medium negrita">
						<tr>
							<th class="font-bebas negrita text-center fs-3" colspan="8">LISTA AYUDAS</th>
						</tr>
						<tr>
							<th class="col text-center">Nombre cliente</th>
							<th class="col text-center">Descripción problema</th>
							<th class="col text-center">Descripción automóvil</th>
							<th class="col text-center">Estado</th>
							<th class="col text-center">Mapa</th>
							<th class="col text-center">Aceptar</th>
							<th class="col text-center">Rechazar</th>
							
						</tr>
					</thead>
					<tbody class="">
						<?php
						foreach ($ayudas as $row) 
						{?>
							<tr class="text-center align-middle">
								<td><?php echo $row->nombreCliente ?></td>
								<td><?php echo $row->problema ?></td>
								<td><?php echo $row->descripcionAutomovil ?></td>
								<td><?php if ($row->estado == 1) {
									echo "Pendiente";
								}else{
									echo "Aceptada";
								} ?></td>
								<td><a href="https://maps.google.com/?q=<?php echo $row->longitudCliente.','.$row->latitudCliente;?>" target= "_blanck"><button id="btnDetalles" class="btn btn-primary rounded-pill" type="button"> 	<span class="bi bi-aspect-ratio-fill icon"></span>
							    </button></a></td>
								<td><button id="btnAceptar" class="btn btn-success rounded-pill" type="button" onclick="aceptarAyuda('<?php echo $row->idAyuda; ?>', '<?php echo $row->nombreCliente ?>')" data-bs-toggle="modal" data-bs-target="#mdAceptarAyuda"> 	<span class="bi bi-check-square icon"></span>
							    </button></td>
								<td><button class="btn btn-danger rounded-pill" type="button" onclick="rechazarAyuda('<?php echo $row->idAyuda; ?>', '<?php echo $row->nombreCliente ?>')" data-bs-toggle="modal" data-bs-target="#mdRechazarCita"> 	<span class="bi bi-trash3-fill icon"></span> 
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
<!-- Modal Confirmar Ayuda-->

<div class="modal fade" id="mdAceptarAyuda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Aceptar Ayuda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/ayuda/aceptarayuda') ?>" target="_self" method="post">
      	<div class="modal-body text-center">
	      	<input type="text" name="idAyuda" id="idAyuda" hidden>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" id="btnGuardarPsw" >Guardar</button>
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
        <h5 id="staticBackdropLabel">Rechazar Ayuda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/ayuda/rechazarayuda') ?>" target="_self" method="post">
      	<div class="modal-body">
	      	<input type="text" name="idAyuda" id="idAyudaR" hidden>
	      	<div class="form-group">
	      		
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
			<div class="col-md-4">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-3 pt-3 pb-1">Ayuda aceptada </h5>
			    		</div>

					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/ayuda/listaayudataller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
			    			<h5 class="fs-3 pt-3 pb-1">Fallo al aceptar la ayuda</h5>
			    		</div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/ayuda/listaayudataller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
			    			<h5 class="fs-3 pt-3 pb-1">La ayuda fue rechazada</h5>
			    		</div>

					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/ayuda/listaayudataller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
			    			<h5 class="fs-3 pt-3 pb-1">Fallo al rechazar la ayuda</h5>
			    		</div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/ayuda/listaayudataller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
	function aceptarAyuda(ayuda) 
	{
        document.getElementById("idAyuda").value = ayuda;
    }
    function rechazarAyuda(ayuda) 
	{
        document.getElementById("idAyudaR").value = ayuda;
    }
</script>