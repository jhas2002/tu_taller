<div class="p-0 p-cont">
	<div class="container-fluid p-0 pt-4 pb-5 fondoAdmin">
		<div class="row m-0 text-center pb-2 pt-2">
			<h1 class="font-bebas text-dark">DETALLE TALLER</h1>
		</div>
		<div class="row m-0">
			<div class="col-md-1"></div>
			<div class="col-md-10 bg-light border-curvo">
				<div class="row pt-4 pb-2 align-items-center ">
					<div class="col-md-4 align-items-center text-center ps-4 pe-4 pb-0">
						<img src="<?php if($foto == 0){echo base_url('sources/images/usuario/0.png');} else{echo base_url('sources/images/usuario').'/'.$idTaller.'.jpg';} ?>" class="img-fluid pb-5" alt="...">
						<!--<a href="" class=""><button class="btn btn-lg btn-bg rounded-pill font-monserrat-black">INSCRIBIRSE</button></a>-->
					</div>
					<div class="col-md-4">
						<h4 class="font-bebas sb-t-verde">DATOS TALLER</h4>
						<p class="font-monserrat-regular text-negrita">
							Nombre: <?php echo $nombre ?> <br>
							Numero Teléfono: <?php echo $telefono ?> <br>
							Dirección: <?php echo $direccion ?> <br>
							<a target="_blanck" href="https://maps.google.com/?q=<?php echo $latitud.','.$longitud;?>">VER EN MAPA</a>
						</p>
						<h4 class="font-bebas sb-t-verde">DESCRIPCIÓN</h4>
						<p class="font-monserrat-regular text-negrita">
							<?php 
								if (!$descripcion) 
								{
									echo "El usuario no puso una descripcion.";
								}
								else
								{
									echo nl2br($descripcion);
								}
							

							?>
						</p>
						<h4 class="font-bebas sb-t-verde">SERVICIOS</h4>
						<p class="">
							<?php  
								foreach ($servicios as $row) {
									echo $row->descripcion;?> <br>
									<?php 
								}
							?>
						</p>
						<h4>HORARIO</h4>
						<p id="pHorario">
							<?php  
								foreach ($horario as $row) {
									echo $row->dia.': '.$row->HoraInicio.' a '.$row->HoraFin;?> <br>
									<?php 
								}
							?>
						</p>
						<br>
						
					</div>
					<div class="col-md-4 align-text-top">
						<h4 class="font-bebas sb-t-verde">SOLICITAR CITA</h4>
						<button type="button" class="btn btn-bg rounded-pill" data-bs-toggle="modal" data-bs-target="#mdSolicitarCita">Agendar Cita</button>
						<br>
						<br>
						<br>
						<h4 class="font-bebas sb-t-verde">SOLICITAR COTIZACIÓN</h4>
						<button type="button" class="btn btn-bg rounded-pill" data-bs-toggle="modal" data-bs-target="#mdSolicitarCotizacion">Cotizar</button>
					</div>

					
					</div>
				</div>
			</div>
		</div> 
	</div>
</div>

<!-- Modal Solicitar Cita-->
<div class="modal fade" id="mdSolicitarCita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Solicitar Cita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="citaform" action="<?php echo base_url('public/cita/solicitarcita') ?>" target="_self" method="post" >
      	<div class="modal-body">
	      	<input type="text" name="id" value="<?php echo $idTaller?>" hidden>
	      	<h5>Horario del taller</h5>
	      	<p id="pHorario">
	      		<?php  
	      		foreach ($horario as $row) 
	      		{
	      			echo $row->dia.': '.$row->HoraInicio.' a '.$row->HoraFin;?> <br>
	      			<?php 
	      		}
	      		?>
	      	</p>
	      	<div class="form-group">
	      		<label>Servicios</label>
	      		<select name="selecServicio" id="selecServicioCita" class="form-select rounded-pill" required>
	      			<option selected disabled value="1">Seleccione un Servicio</option>
	      			<?php
	      			foreach($servicios as $row){
	      			?>
	      			<option ><?php echo $row->descripcion; }?></option>
				</select>
				<div class="text-danger" id="feedback2" hidden>
	      			Este campo es obligatorio
	      		</div>
	      	</div>
	      	
	      	<div class="form-group">
	      		<label class="font-monserrat-regular">Seleccione un día de preferencia</label>
	      		<input type="datetime-local" name="fechaPreferida" id="fechaPreferida" class="form-control" min="<?php echo date('Y-m-d h:i', time()); ?>" value = "<?php echo date('Y-m-d h:i', time()); ?>">
	      		<div class="text-danger" id="feedback" hidden>
	      			El día y hora debe ser uno dentro del horario del taller.
	      		</div>
	      	</div>
	      	<div class="form-group">
	      		<label class="font-monserrat-regular">Descripción problema</label>
	      		<textarea class="form-control form-control" name="txtDescripcion" id="txtDescripcion" placeholder="Descripcion" rows="5" required></textarea>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="button" onclick="solicitarCita()" class="btn btn-success" id="btnGuardarPsw">Guardar</button>
	      </div>
      </form>
      
    </div>
  </div>
</div>

<!-- Modal Solicitar cotizacion-->
<div class="modal fade" id="mdSolicitarCotizacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Solicitar Cotización</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="citaform" action="<?php echo base_url('public/cotizacion/solicitarcotizacion') ?>" target="_self" method="post" class="needs-validation" novalidate>
      	<div class="modal-body">
	      	<input type="text" name="id" value="<?php echo $idTaller?>" hidden>
	      	<div class="form-group">
	      		<label>Seleccione el Servicio que quiere cotizar</label>
	      		<select name="selecServicio" id="selecServicio" class="form-select rounded-pill" required>
	      			<option selected disabled value="">Seleccione un Servicio</option>
	      			<?php
	      			foreach($servicios as $row){
	      			?>
	      			<option ><?php echo $row->descripcion; }?></option>
				</select>
				<div class="valid-feedback">
	              Correcto.
	            </div>
	            <div class="invalid-feedback">
	              Debe seleccionar un servicio
	            </div>
	      	</div>

	      	<div class="form-group">
	      		<label>Describa su problema</label>
	      		<textarea class="form-control form-control" name="txtDescripcionProblema" id="txtDescripcionProblema" placeholder="Descripcion" rows="5" required></textarea>
	      		<div class="valid-feedback">
	              Correcto.
	            </div>
	            <div class="invalid-feedback">
	              Este campo es obligatorio
	            </div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" id="btnGuardarPsw">Guardar</button>
	      </div>
      </form>
      
    </div>
  </div>
</div>

<script type="text/javascript">
	function solicitarCita() 
	{
		var horario = document.getElementById('pHorario').textContent;
		var horarioLineas = horario.split("\n");
		var verficador = '0';
		var selec = document.getElementById('selecServicioCita').value;

		var fechaComoCadena = document.getElementById('fechaPreferida').value;
		var diasLiteral = [
		  'Domingo',
		  'Lunes',
		  'Martes',
		  'Miercoles',
		  'Jueves',
		  'Viernes',
		  'Sabado',
		];
		var numeroDia = new Date(fechaComoCadena).getDay();
		var nombreDia = diasLiteral[numeroDia];

		for (var i = 0; i < horarioLineas.length; i++) 
		{
			var dias = horarioLineas[i].trim().split(":");
			
			if (dias[0].trim() == diasLiteral[numeroDia]) 
			{
				verficador = '1';
			}
		}
		if (verficador != '1') 
		{
			document.getElementById("feedback").hidden = false;
		}
		if (selec =='1') 
		{
			document.getElementById("feedback2").hidden = false;
		}
		else
		{
			document.getElementById("feedback2").hidden = true;
		}
		if (verficador == '1' && selec !='1') 
		{
			document.getElementById("citaform").submit();
			
		}
       
    }
</script>
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
