<style type="text/css">
	#map{
    height: 400px;
    width: 100%;
  }
</style>
<div class=" p-0 pb-5  p-cont">
	<div class="container pt-5">
		<div class="row">
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
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Cochabamba</h4>
								<div id="map"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-12 text-center">
						<h1 class="font-bebas text-dark">MI PERFIL</h1>
					</div>
				</div>
				<form action="<?php echo base_url('public/taller/editartallermodel') ?>" target="_self" method="post">
					
					<div class="row bg-registro text-center align-items-center p-2">
						<div class="row-fluid pb-2">
							<input type="txt" name="txtNombre" class="form-control font-monserrat-regular text-center" value="<?php echo $nombre?>" readonly id="txtNombre">
						</div>
						<br>
						<div class="row pb-3">
							<div class="col-md-6 pb-2">
								<input type="text" name="txtTelefono" id="txtTelefono" class="font-monserrat-regular form-control text-center" value="<?php echo $telefono?>" readonly="readonly">
							</div>
							<div class="col-md-6 ">
								<input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control text-center" value="<?php echo $descripcion?>" readonly="readonly">
							</div>
						</div>	
						<div class="row-fluid pb-3">
							<input type="text" name="txtDireccion" id="txtDireccion" class="form-control bg-select text-center" value="<?php echo $direccion?>" readonly="readonly">
						</div>
						<div class="row pb-3">
							<div class="col-md-6 pb-2">
								<input type="text" name="txtLatitud" id="txtLatitud" class="form-control text-center" value="<?php echo $latitud ?>" readonly="readonly" hidden>
							</div>
							<div class="col-md-6">
								<input type="text" name="txtLongitud" id="txtLongitud" class="form-control text-center" value="<?php echo $longitud ?>" readonly="readonly" hidden>
							</div>
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
				<div class="row pt-3 text-center">
					<h4>HORARIO</h4>
				</div>
				<div class="row pt-3">
					<div class="col-md-4">
						<button type="button" class="btn btn-bg" data-bs-toggle="modal" data-bs-target="#mdAgregarDia">Agregar Día</button>
					</div>
				</div>
				<div class="row pb-3 pt-3">
					<table class="table table-info table-striped table-bordered border-info">
						<thead>
							<tr class="text-center">
								<th>Día</th>
								<th>Hora Inicio</th>
								<th>Hora Fin</th>
								<th>Editar</th>
								<th>Eliminar</th>
							</tr>	
						</thead>
						<tbody>
							<?php  
								foreach ($horario as $row) 
								{?>
									<tr class="text-center">
										<td><?php echo $row->dia ?></td>
										<td><?php echo $row->HoraInicio ?></td>
										<td><?php echo $row->HoraFin ?></td>
										<td><button id="show_password" class="btn btn-primary rounded-pill" type="button" onclick="editarHorario('<?php echo $row->dia; ?>', '<?php echo $row->HoraInicio; ?>', '<?php echo $row->HoraFin; ?>')" data-bs-toggle="modal" data-bs-target="#mdEditarDia"> 	<span class="bi bi-pencil icon"></span> 
							      	</button></td>
										<td><button class="btn btn-danger rounded-pill" type="button" onclick="confirmacion('<?php echo $row->dia; ?>')" data-bs-toggle="modal" data-bs-target="#confirmacionDelete"> 	<span class="bi bi-trash3-fill icon"></span> 
							      	</button></td>
									</tr>
								<?php
								}
							?>
						</tbody>		
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Agregar Dia-->
<div class="modal fade" id="mdAgregarDia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Agregar Día</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/taller/agregarhorariomodal') ?>" target="_self" method="post">
      	<div class="modal-body">
	      	<input type="text" name="id" value="<?php echo $id?>" hidden>
	      	<div class="form-group">
	      		<label class="text-start">Selecciona un Día:</label>
	      		<select name="selecDia" id="selecDia" class="form-select rounded-pill">
	      			<option selected disabled value="">Seleccione un Día</option>
	      			<?php
	      			foreach($dias as $row){
	      			?>
	      			<option><?php echo $row->nombreDia; }?></option>
	      		</select>
	      	</div>
	      	<div class="form-group">
	      		<label class="font-monserrat-regular">Hora Inicio</label>
	      		<select name="selecHoraInicio" id="selecHoraInicio" class="form-select rounded-pill">
	      			<option selected disabled>Selecciona una hora de inicio</option>
	      			<option>00:00</option>
	      			<option>01:00</option>
	      			<option>02:00</option>
	      			<option>03:00</option>
	      			<option>04:00</option>
	      			<option>05:00</option>
	      			<option>06:00</option>
	      			<option>07:00</option>
	      			<option>08:00</option>
	      			<option>09:00</option>
	      			<option>10:00</option>
	      			<option>11:00</option>
	      			<option>12:00</option>
	      			<option>13:00</option>
	      			<option>14:00</option>
	      			<option>15:00</option>
	      			<option>16:00</option>
	      			<option>17:00</option>
	      			<option>18:00</option>
	      			<option>19:00</option>
	      			<option>20:00</option>
	      			<option>21:00</option>
	      			<option>22:00</option>
	      			<option>23:00</option>
	      		</select>
	      	</div>
	      	<div class="form-group">
	      		<label class="">Hora Final</label>
	      		<select name="selecHoraFin" id="selecHoraFin" class="form-select rounded-pill">
	      			<option selected disabled>Selecciona una hora de fin</option>
	      			<option>00:00</option>
	      			<option>01:00</option>
	      			<option>02:00</option>
	      			<option>03:00</option>
	      			<option>04:00</option>
	      			<option>05:00</option>
	      			<option>06:00</option>
	      			<option>07:00</option>
	      			<option>08:00</option>
	      			<option>09:00</option>
	      			<option>10:00</option>
	      			<option>11:00</option>
	      			<option>12:00</option>
	      			<option>13:00</option>
	      			<option>14:00</option>
	      			<option>15:00</option>
	      			<option>16:00</option>
	      			<option>17:00</option>
	      			<option>18:00</option>
	      			<option>19:00</option>
	      			<option>20:00</option>
	      			<option>21:00</option>
	      			<option>22:00</option>
	      			<option>23:00</option>
	      		</select>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" id="btnGuardarNuevo">Guardar</button>
	      </div>
      </form>
      
    </div>
  </div>
</div>

<!-- Modal Editar Dia-->
<div class="modal fade" id="mdEditarDia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Editar Día</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editform" action="" target="_self" method="post">
      	<div class="modal-body">
	      	<input type="text" name="id" value="<?php echo $id?>" hidden>
	      	<div class="form-group">
	      		<label class="text-start">Día Seleccionado:</label>
	      		<input type="text" name="txtDia" id="txtDia2" class="form-control text-center" readonly="readonly">
	      	</div>
	      	<div class="form-group">
	      		<label class="font-monserrat-regular">Hora Inicio</label>
	      		<select name="selecHoraInicio" id="selecHoraInicioEdit" class="form-select rounded-pill">
	      			<option selected disabled>Selecciona una hora de inicio</option>
	      			<option>00:00</option>
	      			<option>01:00</option>
	      			<option>02:00</option>
	      			<option>03:00</option>
	      			<option>04:00</option>
	      			<option>05:00</option>
	      			<option>06:00</option>
	      			<option>07:00</option>
	      			<option>08:00</option>
	      			<option>09:00</option>
	      			<option>10:00</option>
	      			<option>11:00</option>
	      			<option>12:00</option>
	      			<option>13:00</option>
	      			<option>14:00</option>
	      			<option>15:00</option>
	      			<option>16:00</option>
	      			<option>17:00</option>
	      			<option>18:00</option>
	      			<option>19:00</option>
	      			<option>20:00</option>
	      			<option>21:00</option>
	      			<option>22:00</option>
	      			<option>23:00</option>
	      		</select>
	      	</div>
	      	<div class="form-group">
	      		<label class="">Hora Final</label>
	      		<select name="selecHoraFin" id="selecHoraFinEdit" class="form-select rounded-pill">
	      			<option selected disabled>Selecciona una hora de fin</option>
	      			<option>00:00</option>
	      			<option>01:00</option>
	      			<option>02:00</option>
	      			<option>03:00</option>
	      			<option>04:00</option>
	      			<option>05:00</option>
	      			<option>06:00</option>
	      			<option>07:00</option>
	      			<option>08:00</option>
	      			<option>09:00</option>
	      			<option>10:00</option>
	      			<option>11:00</option>
	      			<option>12:00</option>
	      			<option>13:00</option>
	      			<option>14:00</option>
	      			<option>15:00</option>
	      			<option>16:00</option>
	      			<option>17:00</option>
	      			<option>18:00</option>
	      			<option>19:00</option>
	      			<option>20:00</option>
	      			<option>21:00</option>
	      			<option>22:00</option>
	      			<option>23:00</option>
	      		</select>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" id="btnGuardarEditar">Guardar</button>
	      </div>
      </form>
      
    </div>
  </div>
</div>

<!-- Modal Confirmar Eliminar-->

<div class="modal" id="confirmacionDelete" tabindex="-1" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>¿ESTÁ SEGURO DE ELIMINARLO?</h5>
            </div>
            <form id="deleteform" action="" method="POST" target="_self">
                <div class="modal-body d-flex justify-content-center">
                    <input type="hidden" id="txtDia" value="0" name="txtDia">
                    <input type="text" name="id" value="<?php echo $id?>" hidden>
                    <button type="submit" class="btn btn-danger">
                        Eliminar
                    </button>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

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
      	<form action="<?php echo base_url('public/taller/cambiarfototaller') ?>" enctype="multipart/form-data" novalidate target="_self" method="post">
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
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">CAMBIO EXITOSO</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">La cuenta se actualizo de manera exitosa</p>
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

if ($messageReport=='4') {
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
					    	<p class="fs-4 pt-2">La foto fue cambiada con exito</p>
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

if ($messageReport=='5') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">EXITO AL AGREGAR</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Se agrego una nueva hora con exito</p>
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

if ($messageReport=='6') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">FALLO AL AGREGAR</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">No se pudo agregar un nuevo dia intentelo otra vez</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/perfilTaller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}

if ($messageReport=='7') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">EXITO AL ELIMINAR</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Se elimino el dia con exito</p>
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

if ($messageReport=='8') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">FALLO AL ELIMINAR UN DIA</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">No se pudo eliminar el dia seleccionado intentelo otra vez</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/perfilTaller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}

if ($messageReport=='9') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">EXITO AL EDITAR</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Se edito el dia con exito</p>
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

if ($messageReport=='10') {
	?>
	<div class="modal2 container-fluid">
		<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
			<div class="col-md-6">
			    <div class="container bg-modal-message border-curvo">
			    	<div class="modal-content border-0">
			    		<div class="row text-center border-curvo-top2 bg-modal-titulo">
			    			<h5 class="fs-1 pt-3 pb-1">FALLO AL EDITAR UN DIA</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">No se pudo editar el dia seleccionado intentelo otra vez</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/perfilTaller')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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

	function confirmacion(dia) 
	{
        document.getElementById("deleteform").action = "<?php echo base_url('/public/taller/deletehorario'); ?>";
        document.getElementById("txtDia").value = dia;
    }

    function editarHorario(dia, horaInicio, horaFin) 
	{
        document.getElementById("editform").action = "<?php echo base_url('/public/taller/editarhorario'); ?>";
        document.getElementById("txtDia2").value = dia;
        document.getElementById("selecHoraInicioEdit").value = horaInicio;
        document.getElementById("selecHoraFinEdit").value = horaFin;
        
    }
</script>
<script type="text/javascript">
	function habilitar()
	{
		document.getElementById('txtNombre').readOnly= false ;
		document.getElementById('txtTelefono').readOnly= false ;
		document.getElementById('txtDescripcion').readOnly= false ;
		document.getElementById('txtDireccion').readOnly= false ;
		document.getElementById('btnGuardar').hidden=false;
		document.getElementById('btnEditar').hidden=true;
	}
</script>
<script type="text/javascript">
  divmapa=document.getElementById('map');
  var latitud = document.getElementById('txtLatitud').value;
  var longitud = document.getElementById('txtLongitud').value;
  function initMap(){
    //opciones del mapa
    var options={ //menor zoom + lejos
      zoom:12,
      center:{lat: parseFloat(latitud),lng:parseFloat(longitud)}
    }
    //nuevo mapa
    var map =new google.maps.Map(divmapa,options);
    //Agregando un marcador - Marker
    var estadio = {lat: parseFloat(latitud) , lng: parseFloat(longitud)};
    var marker=new google.maps.Marker({position: estadio, map: map});
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTcQ4yNd2AeeXine1Kl3Y1sBKIe1qJ0Ro&callback=initMap"
    async defer></script>