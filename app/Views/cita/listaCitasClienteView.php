<div class="p-0 p-cont ">
	<div class="container-fluid fondoAdmin">
		<div class="container pt-5 pb-5">
			
		
			<div class="row">
				<table class="table text-dark bg-white table-striped table-bordered border-primary" id="tablaDatos">
					<thead class=" negrita">
						<tr>
							<th class=" negrita text-center fs-3" colspan="8">LISTA CITAS</th>
						</tr>
						<tr>
							<th class="col text-center">Nombre Taller</th>
							<th class="col text-center">Descripcion</th>
							<th class="col text-center">Servicio</th>
							<th class="col text-center">Fecha Cita</th>
							<th class="col text-center">Estado</th>
							
						</tr>
					</thead>
					<tbody class="">
						<?php
						foreach ($citas as $row) 
						{?>
							<tr class="text-center align-middle">
								<td><?php echo $row->taller ?></td>
								<td><?php echo $row->descripcionProblema ?></td>
								<td><?php echo $row->servicio ?></td>
								<td><?php echo $row->fechaCita ?></td>
								<td <?php if($row->estado == '1'){echo "style = 'background: #FCF002'";} elseif($row->estado == '2'){echo "style = 'background: #92F257'";}elseif($row->estado == '3'){echo "style = 'background: #F25757'";}elseif($row->estado == '0'){echo "style = 'background: #F8FF5D'";}elseif($row->estado == '-1'){echo "style = 'background: #FF2300'";}?>><?php if($row->estado == '1'){echo 'Pendiente';} elseif($row->estado == '2'){echo 'Finalizado';}elseif($row->estado == '3'){echo "No Presentado";}elseif($row->estado == '0'){echo "En Espera";}elseif($row->estado == '-1'){echo "RECHAZADO";}?></td>
								
								
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
<!-- Modal Finalizar Cita-->

<div class="modal fade" id="mdFinalizarCita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Finalizar Cita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/cita/finalizarcita') ?>" target="_self" method="post">
      	<div class="modal-body text-center">
	      	<input type="text" name="idCita" id="idCita" hidden>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" >Guardar</button>
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
        <h5 id="staticBackdropLabel">Cancelar Cita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/cita/cancelarcita') ?>" target="_self" method="post">
      	<div class="modal-body">
	      	<input type="text" name="idCita" id="idCitaR" hidden>
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
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">FINALIZACIÓN EXITOSO</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Se finalizo la cita con exito</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cita/listacitataller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
					    	<p class="fs-4 font-monserrat-regular pt-2">Hubo un error al finalizar la cita intentelo otra vez</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cita/listacitataller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">CANCELACIÓN EXITOSA</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Se cancelo la cita con exito</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cita/listacitataller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">ERROR</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 font-monserrat-regular pt-2">Hubo un error al cancelar la cita intentelo otra vez</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cita/listacitataller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
	function finalizarCita(cita) 
	{
        document.getElementById("idCita").value = cita;
    }
    function citaNo(cita) 
	{
        document.getElementById("idCitaR").value = cita;
    }
</script>