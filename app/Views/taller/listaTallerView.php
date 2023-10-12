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
									<button class="btn btn-lg p-0 m-0 "><span class="bi bi-star-fill icon icon-estrella"></span></button>
									<button class="btn btn-lg p-0 m-0"><span class="bi bi-star-fill icon icon-estrella"></span></button>
									<button class="btn btn-lg p-0 m-0"><span class="bi bi-star-half icon icon-estrella"></span></button>
									<button class="btn btn-lg p-0 m-0"><span class="bi bi-star icon icon-estrella"></span></button>
									<button class="btn btn-lg p-0 m-0"><span class="bi bi-star icon icon-estrella"></span></button>
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
<?php
if ($messageReport=='1') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">SOLICITUD EXITOSA</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Su cita ha sido enviada espere la confirmación en su correo electrónico</p>
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
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">ERROR</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Hubo un error al solicitar su cita</p>
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
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">SOLICITUD DE COTIZACION EXITOSA</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Su solicitud para una cotización fue enviada correctamente se le enviara una respuesta al correo.</p>
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
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">ERROR</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Hubo un error al solicitar su cotizacion</p>
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
