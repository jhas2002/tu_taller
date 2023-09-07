<div class=" p-cont">
	<div class="container-fluid fondo p-0 pb-5">
		<div class="container">
			<div class="row text-center pb-2 pt-2">
				<h1 class="font-bebas text-white">CAMBIAR CONTRASEÑA</h1>
			</div>
			<div class="row pt-4">
				<div class="col-md-4"></div>
				<div class="col-md-4 bg-registro border-curvo">
					<form action="<?php echo base_url('public/usuario/cambiarpassword') ?>" target="_self" method="post">
						<div class="row-fluid text-center pt-3 pb-3">
							<div class="form-group">
								<label class="font-monserrat-bold">Nueva Contraseña</label>
								<div class="input-group">
									<input type="password" name="password" id="txtPassword" onkeyup="comparar()" class="form-control font-monserrat-regular" required minlength="8">
									<span class="input-group-text">
										<button id="" class=" border-0 btn-success" type="button" onclick="mostrarPassword()"><span class="bi bi-eye-slash-fill icon"></span> 
								    	</button>
									</span>
								</div>
								<div id="strengthMessage"></div>
							</div>
						</div>
						<div class="row-fluid text-center pt-3 pb-3">
							<div class="form-group">
								<input type="text" name="key" value="<?php echo $key?>" hidden>
								<label class="font-monserrat-bold">Repetir Contraseña</label>
								<div class="input-group flex-nowrap">
									<input type="password" name="txtRepetirContraseña" id="txtRepetirContraseña" placeholder="" onkeyup="comparar()" class="form-control form-control font-monserrat-regular" required minlength="8">
									<span class="input-group-text">
										<button id="" class="w-100 border-0 btn-success" type="button" onclick="mostrarPasswordRepetir()"><span class="bi bi-eye-slash-fill icon2"></span> 
							      		</button>
									</span>
								</div>
								<div class="text-danger" id="feedback" hidden>
							        Las contraseñas tienen que ser iguales
							    </div>
							</div>
						</div>
						<div class="row-fluid text-center pt-2 pb-4">
							<button type="submit" id="btnCambiar" disabled class="btn btn-bg btn-lg font-monserrat-black rounded-pill">CAMBIAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('sources/js/passwordMostrar.js') ?>"></script>
<script type="text/javascript">
	function comparar() 
	{
	  var repeatPassword = document.getElementById("txtRepetirContraseña");
	  var password = document.getElementById("txtPassword");

	  if(password.value == repeatPassword.value)
	  {
	  	document.getElementById("btnCambiar").disabled = false;
	  	document.getElementById("feedback").hidden = true;
	  }
	  else
	  {
	  	document.getElementById("btnCambiar").disabled = true;
	  	document.getElementById("feedback").hidden = false;
	  }
	}
</script>