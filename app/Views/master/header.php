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
		<header>
			<a class="logo" href="<?php echo base_url('public/') ?>">
				<img src="<?php echo base_url('sources/images/logo.png') ?>" alt="Tu Taller logo">
			</a>
			<?php
			$session = session();
			if ($session->has("rol")) 
			{
				if ($session->get('rol') == '2') 
				{
			?>
					<div class="nav-item dropdown">
						<a href="#" class="text-dark nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="<?php if($session->get('foto') == '1'){echo base_url('sources/images/usuario').'/'.$session->get('id').'.jpg';}else{echo base_url('sources/images/usuario/0.png');} ?>" class="btn-outline-light p-0 m-0 rounded-circle" width="50px"><span class="text-dark"><?php echo $session->get('nombre')?></span></a>
						<div class="dropdown-menu fade-down bg-select">
							<a href="<?php echo base_url('public/cliente/perfilcliente') ?>" class="dropdown-item">Perfil</a>
							<a href="<?php echo base_url('public/usuario/logout') ?>" class="dropdown-item">Cerrar Sesión</a>
						</div>
					</div>
			<?php
				}
				if ($session->get('rol') == '3') 
				{
			?>
					<div class="nav-item dropdown">
						<a href="#" class="text-dark nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="<?php if($session->get('foto') == '1'){echo base_url('sources/images/usuario').'/'.$session->get('id').'.jpg';}else{echo base_url('sources/images/usuario/0.png');} ?>" class="btn-outline-light p-0 m-0 rounded-circle" width="50px"><span class="text-dark"><?php echo $session->get('nombre')?></span></a>
						<div class="dropdown-menu fade-down bg-select">
							<a href="<?php echo base_url('public/taller/perfiltaller') ?>" class="dropdown-item">Perfil</a>
							<a href="<?php echo base_url('public/usuario/logout') ?>" class="dropdown-item">Cerrar Sesión</a>
						</div>
					</div>
			<?php
				}
			}
			else {
			?>
				<a class="init" href="<?php echo base_url('public/usuario/login') ?>">
					<button class="login">Iniciar sesión</button>
				</a>
			<?php
			} ?>
		</header>
	</div>
