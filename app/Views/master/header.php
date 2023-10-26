<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tu Taller</title>
	<meta name="description" content="No tumbar :v">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="<?php echo base_url('sources/css/header.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('sources/css/footer.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('sources/css/estilos.css') ?>">
	<!-- Bootstrap--> 
	<link rel="stylesheet" href="<?php echo base_url('sources/css/bootstrap.css') ?>">
	<script src="<?php echo base_url('sources/js/bootstrap.bundle.min.js') ?>"></script>
	<!--Iconos-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<!--Captcha
	<script src="https://www.google.com/recaptcha/enterprise.js?render=6LcqVeUnAAAAAL1S6WxvROauup1dFBwmQmeZuFEw"></script>
-->

	<script src = "https://code.jquery.com/jquery-3.5.1.js"> </script>

</head>
<body>
	<div>
		<?php
			$session = session();
			if ($session->has("rol")) 
			{
				if ($session->get('rol') == '2') 
				{
			?>
					<nav class="navbar navbar-expand-sm navbar-light sticky-top bg-nav" >
						<a class="navbar-brand" href="<?php echo base_url('public/') ?>" width="auto">
							<img src="<?php echo base_url('sources/images/logo.png') ?>" alt="Tu Taller logo" class="logo">
						</a>
						<button type="button" class="navbar-toggler mb-1 me-4  btn-light" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					    	<span class="navbar-toggler-icon btn-light"></span>
					    </button>
						<div class="collapse navbar-collapse" id="navbarCollapse">
							<div class="navbar-nav ms-auto me-4">
								<a href="<?php echo base_url('public/taller/listataller')?>" class="eliminar-subrayado nav-item nav-link">
				                	<button type="submit" class="btn btn-light rounded-pill btn-head font-monserrat-bold">TALLERES</button>
				                </a>
								<a href="<?php echo base_url('public/cotizacion/listacotizacioncliente')?>" class="eliminar-subrayado nav-item nav-link">
				                	<button type="submit" class="btn btn-light rounded-pill btn-head font-monserrat-bold">COTIZACIÓN</button>
				                </a>
				                <a href="<?php echo base_url('public/docente/listadocentes')?>" class="eliminar-subrayado nav-item nav-link">
				                	<button type="submit" class="btn btn-light rounded-pill btn-head font-monserrat-bold">AGENDAR</button>
				                </a>
				                <a href="<?php echo base_url('public/ayuda/mapaayuda')?>" class="eliminar-subrayado nav-item nav-link">
				                	<button type="submit" class="btn btn-light rounded-pill btn-head font-monserrat-bold">SOLICITAR AYUDA</button>
				                </a>
				                <a href="<?php echo base_url('public/foro/listaforo')?>" class="eliminar-subrayado nav-item nav-link">
				                	<button type="submit" class="btn btn-light rounded-pill btn-head font-monserrat-bold">FORO</button>
				                </a>
				                <div class="nav-item dropdown">
									<a href="#" class="text-dark nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="<?php if($session->get('foto') == '1'){echo base_url('sources/images/usuario').'/'.$session->get('id').'.jpg';}else{echo base_url('sources/images/usuario/0.png');} ?>" class="btn-outline-light p-0 m-0 rounded-circle" width="50px"><span class="text-dark"><?php echo $session->get('nombre')?></span></a>
									<div class="dropdown-menu fade-down bg-select">
										<a href="<?php echo base_url('public/cliente/perfilcliente') ?>" class="dropdown-item">Perfil</a>
										<a href="<?php echo base_url('public/usuario/logout') ?>" class="dropdown-item">Cerrar Sesión</a>
									</div>
								</div>
				            </div>
						</div>
					</nav>

			<?php
				}
				if ($session->get('rol') == '3') 
				{
			?>
					

					<nav class="navbar navbar-expand-sm navbar-light sticky-top bg-nav" >
						<a class="navbar-brand" href="<?php echo base_url('public/') ?>" width="auto">
							<img src="<?php echo base_url('sources/images/logo.png') ?>" alt="Tu Taller logo" class="logo">
						</a>
						<button type="button" class="navbar-toggler mb-1 me-4  btn-light" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
					    	<span class="navbar-toggler-icon btn-light"></span>
					    </button>
						<div class="collapse navbar-collapse" id="navbarCollapse">
							<div class="navbar-nav ms-auto me-4">
								<a href="<?php echo base_url('public/taller/listaservicio')?>" class="eliminar-subrayado nav-item nav-link">
				                	<button type="submit" class="btn btn-light rounded-pill btn-head font-monserrat-bold">SERVICIOS</button>
				                </a>
								<a href="<?php echo base_url('public/cotizacion/listacotizaciontaller')?>" class="eliminar-subrayado nav-item nav-link">
				                	<button type="submit" class="btn btn-light rounded-pill btn-head font-monserrat-bold">COTIZACION</button>
				                </a>
				                <a href="<?php echo base_url('public/cita/listacitataller')?>" class="eliminar-subrayado nav-item nav-link">
				                	<button type="submit" class="btn btn-light rounded-pill btn-head font-monserrat-bold">AGENDAR</button>
				                </a>
				                
				                <div class="nav-item dropdown">
									<a href="#" class="text-dark nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="<?php if($session->get('foto') == '1'){echo base_url('sources/images/usuario').'/'.$session->get('id').'.jpg';}else{echo base_url('sources/images/usuario/0.png');} ?>" class="btn-outline-light p-0 m-0 rounded-circle" width="50px"><span class="text-dark"><?php echo $session->get('nombre')?></span></a>
									<div class="dropdown-menu fade-down bg-select">
										<a href="<?php echo base_url('public/taller/perfiltaller') ?>" class="dropdown-item">Perfil</a>
										<a href="<?php echo base_url('public/usuario/logout') ?>" class="dropdown-item">Cerrar Sesión</a>
									</div> 
								</div>
				            </div>
						</div>
					</nav>
			<?php
				}
			}
			else {
			?>
				<nav class="navbar navbar-light sticky-top bg-nav">
					<a class="navbar-brand" href="<?php echo base_url('public/') ?>" width="auto">
							<img src="<?php echo base_url('sources/images/logo.png') ?>" alt="Tu Taller logo" class="logo">
						</a>
					<a class="init me-4" href="<?php echo base_url('public/usuario/login') ?>">
						<button class="login">Iniciar sesión</button>
					</a>
				</nav>
				
				
			<?php
			} ?>
	</div>
