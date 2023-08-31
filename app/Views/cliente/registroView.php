<div class="p-0 container-fluid ">
	<div class="container-fluid fondo pb-5 min-vh-100">
		<div class="container pt-5">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="text-white">REGISTRATE</h1>
				</div>
			</div>
			<div class="row pt-4">
				<div class="col-md-2"></div>
				<div class="col-md-8 bg-transparent border-0">
					<form action="<?php echo base_url('public/cliente/registrarmodel') ?>" target="_self" method="post" enctype="multipart/form-data" class="form-control bg-registro border-curvo needs-validation" novalidate onsubmit="return submitUserForm();">

						<div class="row text-center">
							<div class="col-md-12 pt-2">
								Foto de perfil
								<br>
								<input type="file" id="file-upload" name="photo" accept=".jpg">
							</div>
							<br>
						</div>
						<div class="row text-center">
							<div class="col-md-12">
								<img src="<?php echo base_url('sources/images/usuario/0.png'); ?>" id="imagen" width="200" height="200" style="margin: auto; border-radius:10em;" />
							</div>
						</div>
						<div class="row ">
							<div class="col-md-12 pt-2">
								<div class="form-group text-center">
									<label for="txtnombreUsuario" >Nombres</label>
									<input  type="text" class="form-control rounded-pill" name="txtNombre" id="txtNombre" placeholder="Nombres" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)+$" required>
								    <div class="valid-feedback">
								     	Correcto.
								    </div>
								    <div class="invalid-feedback">
								        Este campo es obligatorio
								    </div>
								</div>

							</div>
						</div>
						<div class="row pt-1">
							<div class="col-md-6">
								<div class="form-group text-center">
									<label>Primer Apellido</label>
									<input type="txt" name="txtPrimerApellido" id="txtPrimerApellido" placeholder="Primer Apellido" class="form-control rounded-pill" required pattern="^[a-z A-Z]+$">
									<div class="valid-feedback">
								     	Correcto.
								    </div>
								    <div class="invalid-feedback">
								        Este campo es obligatorio
								    </div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group text-center">
									<label>Segundo Apellido</label>
									<input type="txt" name="txtSegundoApellido" id="txtSegundoApellido" placeholder="Segundo Apellido" class="form-control rounded-pill" pattern="^[a-z A-Z]+$">
									<div class="valid-feedback">
								     	Correcto.
								    </div>
								    <div class="invalid-feedback">
								        Por favor ingrese datos validos
								    </div>
								</div>
								
							</div>
						</div>
						<div class="row pt-1">
							<div class="col-md-6">
								<div class="form-group text-center">
									<label>Correo Electrónico</label>
									<input type="email" name="txtEmail" id="txtEmail" placeholder="ejemplo@gmail.com" class="form-control rounded-pill" required>
									<div class="valid-feedback">
								     	Correcto.
								    </div>
								    <div class="invalid-feedback">
								        Este campo es obligatorio
								    </div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group text-center">
									<label>Celular</label>
									<input type="text" name="txtNumeroCelular" id="txtNumeroCelular" placeholder="77788899" class="form-control rounded-pill" required pattern="^[0-9]+$" minlength="8" maxlength="11">
									<div class="valid-feedback">
								     	Correcto.
								    </div>
								    <div class="invalid-feedback">
								        Este campo es obligatorio
								    </div>
								</div>
							</div>
						</div>
						<div class="row pt-1">
							<div class="col-md-6">
								<div class="form-group text-center">
									<label class="font-monserrat-bold">Contraseña</label>
									<div class="input-group">
										<input type="password" name="txtPassword" id="txtPassword" onkeyup="comparar()" class="form-control font-monserrat-regular" required minlength="8">
										<span class="input-group-text">
											<button id="" class=" border-0 btn-success" type="button" onclick="mostrarPassword()"><span class="bi bi-eye-slash-fill icon"></span> 
								      	</button>
										</span>
									</div>
									<div id="strengthMessage"></div>
									<div class="valid-feedback">
								     	Correcto.
								    </div>
								    <div class="invalid-feedback">
								        Este campo es obligatorio
								    </div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group text-center">
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
									<div class="valid-feedback">
								     	Correcto.
								    </div>
								    <div class="invalid-feedback">
								        Este campo es obligatorio
								    </div>
								</div>
							</div>
						</div>
						
						
														
						<div class="row pt-4 pb-4">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-bg rounded-pill btn-lg" id="btnRegistrarse" style="background: " >REGISTRARSE</button>
							</div>
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
			    			<h5 class="fs-1 pt-3 pb-1">REGISTRO EXITOSO</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 font-monserrat-regular pt-2">Su cuenta a sido creada de manera exitosa, para iniciar sesion debe verificar su correo electronico, se le envio un correo para poder completar con su registro.</p>
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
					    	<p class="fs-4 font-monserrat-regular pt-2">Ya existe una cuenta registrada con el mismo correo electornico.</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/usuario/login')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var previewZone = document.getElementById('imagen');
                previewZone.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            var previewZone = document.getElementById('imagen');
            previewZone.src = "usuario/0.png";
        }
    }

    var fileUpload = document.getElementById('file-upload');
    fileUpload.onchange = function(e) {
        readFile(e.srcElement);
    }
</script>
<script src="<?php echo base_url('sources/js/passwordMostrar.js') ?>"></script>
<script type="text/javascript">
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
<script>
	function comparar() 
	{
	  var repeatPassword = document.getElementById("txtRepetirContraseña");
	  var password = document.getElementById("txtPassword");

	  if(password.value == repeatPassword.value)
	  {
	  	document.getElementById("btnRegistrarse").disabled = false;
	  	document.getElementById("feedback").hidden = true;
	  }
	  else
	  {
	  	document.getElementById("btnRegistrarse").disabled = true;
	  	document.getElementById("feedback").hidden = false;
	  }
	}
function submitUserForm() {
	/*var response = grecaptcha.getResponse();
		if(response.length == 0) {
			document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">Este campo es obligatorio</span>';
			return false;
	}*/
	return true;
}
</script>