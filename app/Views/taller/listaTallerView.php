<div class=" p-0 pb-5 p-cont">
	<div class="container-fluid pt-5 fondo1 min-vh-100">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1 class="font-bebas text-white">TALLERES</h1>
			</div>
		</div>
		<div class="row pt-5 pb-5">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="row row-cols-1 row-cols-md-3 g-4 p-0">
					<?php
					foreach ($talleres as $row) 
					{?>
						<div class="col">
							<div class="card h-100 text-center border-curvo card-difu">
								<div class="card-body">
									<h5 class="card-title text-center font-monserrat-medium text-white" ><?php echo $row->nombre?></h5>
									<?php if($row->fotoPerfil == 0)
									{?>
										<img src="<?php echo base_url('sources/images/usuario').'/'.'0.png' ?>" class="card-img-top" alt="...">
									<?php
									}
									else
									{?>
										<img src="<?php echo base_url('sources/images/usuario').'/'.$row->idTaller.'.jpg' ?>" class="card-img-top" alt="...">
										<?php
									}
									?>
									
									<br>
									<?php  
										if ($row->calificacion > 0) 
										{?>
											<button class="btn btn-lg p-0 m-0" onclick="calificarTaller('<?php echo $row->idTaller; ?>','1')" data-bs-toggle="modal" data-bs-target="#mdCalificar"><span id="star-1" class="bi bi-star-fill icon icon-estrella estrella estrella-pintada"></span></button>
										<?php
										}
										else
										{?>
											<button class="btn btn-lg p-0 m-0" onclick="calificarTaller('<?php echo $row->idTaller; ?>','1')" data-bs-toggle="modal" data-bs-target="#mdCalificar"><span id="star-1" class="bi bi-star-fill icon icon-estrella estrella"></span></button>
										<?php
										}
										if ($row->calificacion > 1) 
										{?>
											<button class="btn btn-lg p-0 m-0" onclick="calificarTaller('<?php echo $row->idTaller; ?>','2')" data-bs-toggle="modal" data-bs-target="#mdCalificar"><span id="star-2" class="bi bi-star-fill icon icon-estrella estrella estrella-pintada"></span></button>
										<?php
										}
										else
										{?>
											<button class="btn btn-lg p-0 m-0" onclick="calificarTaller('<?php echo $row->idTaller; ?>','2')" data-bs-toggle="modal" data-bs-target="#mdCalificar"><span id="star-2" class="bi bi-star-fill icon icon-estrella estrella"></span></button>
										<?php
										}
										if ($row->calificacion > 2) 
										{?>
											<button class="btn btn-lg p-0 m-0" onclick="calificarTaller('<?php echo $row->idTaller; ?>','3')" data-bs-toggle="modal" data-bs-target="#mdCalificar"><span id="star-3" class="bi bi-star-fill icon icon-estrella estrella estrella-pintada"></span></button>
										<?php
										}
										else
										{?>
											<button class="btn btn-lg p-0 m-0" onclick="calificarTaller('<?php echo $row->idTaller; ?>','3')" data-bs-toggle="modal" data-bs-target="#mdCalificar"><span id="star-3" class="bi bi-star-fill icon icon-estrella estrella"></span></button>
										<?php
										}
										if ($row->calificacion > 3) 
										{?>
											<button class="btn btn-lg p-0 m-0" onclick="calificarTaller('<?php echo $row->idTaller; ?>','4')" data-bs-toggle="modal" data-bs-target="#mdCalificar"><span id="star-4" class="bi bi-star-fill icon icon-estrella estrella estrella-pintada"></span></button>
										<?php
										}
										else
										{?>
											<button class="btn btn-lg p-0 m-0" onclick="calificarTaller('<?php echo $row->idTaller; ?>','4')" data-bs-toggle="modal" data-bs-target="#mdCalificar"><span id="star-4" class="bi bi-star-fill icon icon-estrella estrella"></span></button>
										<?php
										}
										if ($row->calificacion > 4) 
										{?>
											<button class="btn btn-lg p-0 m-0" onclick="calificarTaller('<?php echo $row->idTaller; ?>','5')" data-bs-toggle="modal" data-bs-target="#mdCalificar"><span id="star-5" class="bi bi-star-fill icon icon-estrella estrella estrella-pintada"></span></button>
										<?php
										}
										else
										{?>
											<button class="btn btn-lg p-0 m-0" onclick="calificarTaller('<?php echo $row->idTaller; ?>','5')" data-bs-toggle="modal" data-bs-target="#mdCalificar"><span id="star-5" class="bi bi-star-fill icon icon-estrella estrella"></span></button>
										<?php
										}
									?>
									<form action="<?php echo base_url('public/taller/detalletaller') ?>" target="_self" method="post">
										<input type="text" name="taller" hidden value="<?php echo $row->idTaller?>">
										<button type="submit" class="btn btn-bg rounded-pill font-monserrat-black">VER MÁS</button>
									</form>
								</div>
							</div>
						</div>
					<?php
					}?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Confirmar Cita-->

<div class="modal fade" id="mdCalificar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Confirmar Calificación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/calificar/registrarcalificacion') ?>" target="_self" method="post">
      	<input type="text" name="idTaller" id="idTaller" hidden>
	      	<input type="text" name="calificacion" id="calificacion" hidden>
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
			    			<h5 class="fs-3 pt-3 pb-1">Su solicitud de cita ha sido enviada espere la confirmación en su correo electrónico</h5>
			    		</div>

					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/listataller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
			    			<h5 class="fs-3 pt-3 pb-1">Error inesperado inténtelo otra vez </h5>
			    		</div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/listataller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
			    			<h5 class="fs-3 pt-3 pb-1">Su solicitud de cotización fue enviada correctamente. Se le enviará una respuesta al correo</h5>
			    		</div>

					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/listataller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
					    		<a href="<?php echo base_url('public/taller/listataller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}
if ($messageReport=='5') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-4">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-3 pt-3 pb-1">Su calificación fue exitosa. Gracias por calificar el taller</h5>
			    		</div>

					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/listataller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}
if ($messageReport=='6') {
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
					    		<a href="<?php echo base_url('public/taller/listataller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
	function calificarTaller(taller, calificacion) 
	{
        document.getElementById("idTaller").value = taller;
        document.getElementById("calificacion").value = calificacion;
    }
</script>
