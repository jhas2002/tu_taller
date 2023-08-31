<div>
	<div class="container-fluid p-0 fondo pb-5">
		<div class="container">
			<div class="row text-center pb-2 pt-2">
				<h1 class="">INICIAR SESION</h1>
			</div>
			<div class="row pt-4">
				<div class="col-md-4"></div>
				<div class="col-md-4 bg-registro border-curvo">
					<div class="row-fluid text-center">
						<img src="<?php echo base_url('sources/images/logo.png') ?>" alt="Tu Taller Logo" class="img-fluid">
					</div>
					<form action="<?php echo base_url('public/usuario/validacionlogin') ?>" target="_self" method="post">
						<div class="row-fluid text-center pt-3 pb-3">
							<div class="form-group">
								<label>Correo Electrónico</label>
								<input type="email" name="txtEmail" class="form-control rounded-pill" placeholder="Correo Electrónico">
							</div>
							<div class="form-group">
								
								<label>Contraseña</label>
								<div class="input-group">
							      <input type="password" name="txtPassword" id="txtPassword" onkeyup="Mostrar()" class="form-control rounded-pill" required placeholder="Contraseña">
							      <div class="input-group-append" id="mostrar" hidden>
							      	<button id="show_password" class="btn btn-primary rounded-pill" type="button" onclick="mostrarPassword()"> 	<span class="bi bi-eye-slash-fill icon"></span> 
							      	</button>
							     	</div>
							    </div>
							</div>
						</div>
						<div class="row-fluid text-center pt-2 pb-2">
							<a href="<?php echo base_url('public/usuario/recuperarcontraseña')?>">Recuperar contraseña</a>
						</div>
						<div class="row-fluid text-center pt-2 pb-2">
							<label>¿No tienes una cuenta?</label>
							<div class="btn-group">
	                            <button type="button" class="btn btn-bg-login dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
	                                Registrate
	                            </button>
	                            <ul class="dropdown-menu">
	                                <li><a class="dropdown-item drop" href="<?php echo base_url("public/cliente/registro"); ?>">Como Cliente</a></li>
	                                <li><a class="dropdown-item drop" href="<?php echo base_url("public/taller/registro"); ?>">Como Taller</a></li>
	                            </ul>
	                        </div>
						</div>
						<div class="row-fluid pb-5 text-center">
							<button class="btn btn-bg btn-lg rounded-pill">INICIAR SESION</button>
						</div> 
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if ($messageReport=='3') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">VERIFICACIÓN EXITOSA</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 font-monserrat-regular pt-2">Su cuenta a sido activada de manera exitosa, ya puede iniciar sesión</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/usuario/login')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}

if ($messageReport=='1') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">FALLO EN INICIO</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 font-monserrat-regular pt-2">No existe una cuenta con los credenciales proporcionados intentalo de nuevo</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/usuario/login')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
<script src="<?php echo base_url('sources/js/passwordMostrar.js') ?>"></script>