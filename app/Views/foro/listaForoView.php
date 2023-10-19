<div class=" p-0 p-cont">
	<div class="container-fluid fondoAdmin pt-5 ">
		<div class="container  min-vh-100">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="font-bebas text-dark">NUESTRO FORO</h1>
				</div>
			</div>
			<div class="row pb-4">
				<?php  
					$session = session();
					if ($session->get('rol') == '2') 
					{?>
						<div class="col-md-4 text-center">
							<button class="btn btn-success  btn-lg font-monserrat-black" data-bs-toggle="modal" data-bs-target="#mdRealizarPregunta">REALIZAR PREGUNTA</button>
						</div>
					<?php
					}
					else
					{ ?>
						<div class="col-md-4 text-center">
							<button class="btn btn-success  btn-lg font-monserrat-black" data-bs-toggle="modal" data-bs-target="#iniciaSesion">REALIZAR PREGUNTA</button>
						</div>
						<!-- Modal -->
						<div class="modal fade" id="iniciaSesion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered">
						    <div class="modal-content">
						      <div class="modal-header bg-negro border-0">
						        <h5 class="modal-title text-white" id="staticBackdropLabel">Advertencia</h5>
						        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <div class="modal-body border-0">
						        Para poder publicar una pregunta es necesario iniciar sesión.
						      </div>
						      <div class="modal-footer border-0">
						        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
						      </div>
						    </div>
						  </div>
						</div>
						
						<?php
					}
				?>
				
			</div>
			<div class="row">
				<div class="container">
					<div class="row table-responsive">
						<table class="table text-dark bg-white table-bordered border-dark " id="tablaDatos">
							<thead class="font-monserrat-medium negrita">
								<tr>
									<th class="col text-center">Pregunta</th>
									<th class="col text-center">Respuestas</th>
									<th class="col text-center">Responer</th>
								</tr>
							</thead>
							<tbody class="font-monserrat-regular">
								<?php  
									foreach ($preguntas as $row) 
									{?>
										<tr>
											<td>
												<form action="<?php echo base_url('public/foro/detalleforo') ?>" target="_self" method="post">
													<input type="text" name="foro" value="<?php echo $row->idForo ?>" hidden>
													<a class="eliminar-subrayado text-ntc text-dark">
														<button type="submit" class="text-start text-ntc border-0 bg-transparent">
															<h6 class="text-negrita "><?php echo $row->nombre.': ' ?></h6>
															<?php echo $row->pregunta ?>	
														</button>
													</a>
												</form>
												
											</td>
											<td class="text-center align-middle"> <?php echo $row->respuestas.' Respuestas' ?></td>
											<td class="text-center align-middle">
												<form action="<?php echo base_url('public/foro/detalleforo') ?>" target="_self" method="post">
													<input type="text" name="foro" value="<?php echo $row->idForo ?>" hidden>
													<button type="submit" class="btn btn-success font-monserrat-black border-0">
														Respuestas	
													</button>
												</form>
											</td>
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
</div>

<!-- Modal Realizar Pregunta-->

<div class="modal fade" id="mdRealizarPregunta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Realizar Pregunta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/foro/registrarpregunta') ?>" target="_self" method="post">
      	<div class="modal-body">
	      	<div class="row ">
	      		<div class="col-md-12 pt-2">
	      			<div class="form-group text-center">
	      				<label class="font-monserrat-bold">Pregunta</label>
	      				<input type="txt" class="form-control form-control rounded-pill" name="txtPregunta" id="txtPregunta" placeholder="Escribe tu pregunta">
	      			</div>
	      		</div>
	      	</div>
	      	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="submit" class="btn btn-success" >Guardar</button>
	      </div>
      </form>
      
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
			    			<h5 class="fs-1 pt-3 pb-1">PREGUNTA EXITOSA</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">Se realizo su pregunta con exito</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/foro/listaforo')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
					    	</div>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
<?php
}?>