<div class=" p-cont">
	<div class="container-fluid fondo p-0 pt-4 pb-5">
		<div class="container">
			<div class="row text-center pb-2 pt-2">
				<h1>RCUPERAR CONTRASEÑA</h1>
			</div>
			<div class="row pt-4">
				<div class="col-md-4"></div>
				<div class="col-md-4 bg-registro border-curvo">
					<form action="<?php echo base_url('public/usuario/enviarcodigo') ?>" target="_self" method="post">
						<div class="row-fluid text-center pt-3 pb-3">
							<div class="form-group">
								<label>Correo Electrónico</label>
								<input type="email" name="email" class="form-control" placeholder="ejemplo@gmail.com">
							</div>
						</div>
						<div class="row">
							<div class="g-recaptcha" data-sitekey="6LcgnQEoAAAAAJ--2zg0s_Xfwv90McAM7mhAE6rz"></div>
						</div>
						<div class="row-fluid text-center pt-2 pb-4">
							<button type="submit" class="btn btn-bg btn-lg rounded-pill">ENVIAR</button>
						</div>
					</form>
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
			    			<h5 class="fs-1 pt-3 pb-1">ADVERTENCIA</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 font-monserrat-regular pt-2">El correo electornico proporcionado no se encuentra registrado por favor asegurese de ingresar el correo electronico adecuado.</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/usuario/login')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}?>
