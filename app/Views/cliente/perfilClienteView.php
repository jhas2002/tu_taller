<div class=" p-0 pb-5  p-cont">
	<div class="container pt-5">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2">
				<div class="row ">
					<?php $session = session(); ?>
					<img src="<?php if($session->get('foto') == '1'){echo base_url('sources/images/usuario').'/'.$session->get('id').'.jpg';}else{echo base_url('sources/images/usuario/0.png');} ?>" class="rounded-circle">
				</div>
				<div class="row pt-3">
					<button type="button" class="btn btn-bg" data-bs-toggle="modal" data-bs-target="#cambiarFoto">CAMBIAR IMAGEN</button>
				</div>
				<div class="row pb-3 pt-3">
					<button type="button" class="btn btn-bg" data-bs-toggle="modal" data-bs-target="#mdCambiar">CAMBIAR CONTRASEÑA</button>
				</div>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-12 text-center">
						<h1 class="font-bebas text-dark">MI PERFIL</h1>
					</div>
				</div>
				<form action="<?php echo base_url('public/cliente/editarclientemodel') ?>" target="_self" method="post">
					
					<div class="row bg-registro text-center p-2">
						<div class="row-fluid pb-2 pt-2">
							<input type="txt" name="txtNombre" class="form-control font-monserrat-regular text-center" value="<?php echo $nombre?>" readonly id="txtNombre">
						</div>
						<br>
						<div class="row">
							<div class="col-md-6 pb-2">
								<input type="text" name="txtPrimerApellido" id="txtPrimerApellido" class="font-monserrat-regular form-control text-center" value="<?php echo $primerApellido?>" readonly="readonly">
							</div>
							<div class="col-md-6 ">
								<input type="text" name="txtSegundoApellido" id="txtSegundoApellido" class="font-monserrat-regular form-control text-center" value="<?php echo $segundoApellido?>" readonly="readonly">
							</div>
						</div>	
						<div class="row-fluid pb-3">
							<input type="text" name="txtTelefono" id="txtTelefono" class="form-control text-center font-monserrat-regular" value="<?php echo $celular?>" readonly="readonly">
						</div>
						<input type="text" name="id" value="<?php echo $id?>" hidden>
						<div class="row pb-3 align-items-center text-center">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<button type="button" class="btn btn-bg rounded-pill" onclick="habilitar()" id="btnEditar">EDITAR PERFIL</button>
								<button type="submit" id="btnGuardar" class="btn  btn-bg rounded-pill " hidden>GUARDAR</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal cambiar contraseña-->
<div class="modal fade" id="mdCambiar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Cambiar contraseña</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/usuario/cambiarcontraseña') ?>" target="_self" method="post">
      	<div class="modal-body">
	      	<input type="text" name="id" value="<?php echo $id?>" hidden>
	      	<div class="form-group">
	      		<label>Contraseña antigua</label>
	      		<input type="password" name="pswAntigua" class="form-control">
	      	</div>
	      	<div class="form-group">
	      		<label class="font-monserrat-regular">Nueva contraseña</label>
	      		<input type="password" onkeyup="comparar()" name="pswNueva" id="pswNueva" class="form-control">
	      	</div>
	      	<div class="form-group">
	      		<label class="font-monserrat-regular">Repetir Constraseña</label>
	      		<input type="password" onkeyup="comparar()" name="pswRepNueva" id="pswRepNueva" class="form-control">
	      		<div class="text-danger" id="feedback" hidden>
	      			Las contraseñas tienen que ser iguales
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" id="btnGuardarPsw" disabled>Guardar</button>
	      </div>
      </form>
      
    </div>
  </div>
</div>

<!-- Modal Cambiar Foto-->
<div class="modal fade" id="cambiarFoto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cambiar foto de perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<form action="<?php echo base_url('public/cliente/cambiarfotocliente') ?>" enctype="multipart/form-data" novalidate target="_self" method="post">
      		<div class="form-group text-center" style="overflow: hidden;">
				<label class="font-monserrat-bold">Foto perfil</label><br>
				<img src="<?php if($session->get('foto') == '1'){echo base_url('sources/images/usuario').'/'.$session->get('id').'.jpg';}else{echo base_url('sources/images/usuario/0.png');} ?>" class="rounded-circle img-thumbnail" id="imagen" ><br>
				<input type="file" accept="image/jpeg" class="font-monserrat-regular btn subirimagen" name="imgUsuario" id="file-upload">
				<br>
				<button type="submit" class="btn btn-bg rounded-pill font-monserrat-black" id="btnGuardarImagen" disabled>GUARDAR</button>
			</div>
      	</form>
      </div>
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
			    			<h5 class="fs-3 pt-3 pb-1">Se actualizo sus datos correctamente </h5>
			    		</div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cliente/perfilCliente')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
			    			<h5 class="fs-3 pt-3 pb-1">Su contraseña actual no coincide </h5>
			    		</div>

					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cliente/perfilCliente')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
			    			<h5 class="fs-3 pt-3 pb-1">Contraseña actualizada correctamente</h5>
			    		</div>

					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cliente/perfilCliente')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
			    			<h5 class="fs-3 pt-3 pb-1">Su foto se actualizo con éxito</h5>
			    		</div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/cliente/perfilCliente')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
	function comparar() 
	{
	  var repeatPassword = document.getElementById("pswRepNueva");
	  var password = document.getElementById("pswNueva");

	  if(password.value == repeatPassword.value)
	  {
	  	document.getElementById("btnGuardarPsw").disabled = false;
	  	document.getElementById("feedback").hidden = true;
	  }
	  else
	  {
	  	document.getElementById("btnGuardarPsw").disabled = true;
	  	document.getElementById("feedback").hidden = false;
	  }
	}

	function habilitar()
	{
		document.getElementById('txtNombre').readOnly= false ;
		document.getElementById('txtPrimerApellido').readOnly= false ;
		document.getElementById('txtSegundoApellido').readOnly= false ;
		document.getElementById('txtTelefono').readOnly= false ;
		document.getElementById('btnGuardar').hidden=false;
		document.getElementById('btnEditar').hidden=true;
	}
</script>

<script type="text/javascript">

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var previewZone = document.getElementById('imagen');
                previewZone.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
        else {
            var previewZone = document.getElementById('imagen');
            previewZone.src = "users/0.png";
        }
    }

    var fileUpload = document.getElementById('file-upload');
    fileUpload.onchange = function (e) {
    	var img = document.getElementsByClassName("subirimagen")[0].files[0].size;
    	if (img <= 200000) 
    	{
    		document.getElementById("btnGuardarImagen").disabled = false;
    		readFile(e.srcElement);
        	
    	}
    	else
    	{
    		alert("No se permiten imagenes mayores a 200KB");
    		document.getElementById('btnGuardarImagen').disabled = true;
    	}
        
    }
</script>