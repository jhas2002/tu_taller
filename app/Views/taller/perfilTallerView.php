<div class="container-fluid ">
	<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
		<div class="row pb-3">
			<div class="col-md-6">
				<button type="button" class="btn btn-bg rounded-pill" data-bs-toggle="modal" data-bs-target="#mdCambiar">CAMBIAR CONTRASEÑA</button>
			</div>
			<div class="col-md-6 pt-cell">
				
			</div>
		</div>
	</div>
	
</div>


<!-- Modal -->
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
<?php
if ($messageReport=='3') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">CAMBIO EXITOSO</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">La contraseña se cambio con exito</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/perfilTaller')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
					    	<p class="fs-4 pt-2">La contraseña actual no es correcta</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/perfilTaller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
</script>