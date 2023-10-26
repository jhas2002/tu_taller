<div class=" p-0  p-cont">
	<div class="container-fluid pt-5 min-vh-100" style="background: #131514">
		<div class="conatiner">
			<div class="row m-0 pb-5">
				<div class="col-md-2"></div>
				<div class="col-md-8 bg-white border-curvo pb-5">
					<div class="container p-0 ">
						<div class="row m-0 pt-4 ">
							<div class="col-md-1">
								<img src="<?php if($foto == 0){echo base_url('sources/images/usuario/fotoUsuario.png');} else{echo base_url('sources/images/usuario').'/'.$idUsuario.'.jpg';} ?>" class="img-tamaño-foro">
							</div>
							<div class="col-md-7">
								<h4 class="font-monserrat-bold"><?php echo $nombre ?></h4>
								<h5 class="font-monserrat-regular"><?php echo $pregunta ?></h5>
							</div>
						</div>
						<div class="row pt-3 pb-4">
							<h6>Haz tu comentario</h6>
							<form action="<?php echo base_url('public/foro/comentarioforo') ?>" target="_self" method="post">
								<div class="col-auto">
									<input type="text" name="comentario" class="form-control rounded-pill" placeholder="Escribe tu comentario">
									<input type="text" name="pregunta" value="<?php echo $idForo ?>" hidden>
								</div>
								<?php  
									$session = session();
									if ($session->get('rol') == '2') 
									{?>
										<div class="col-auto pt-2">
											<button type="submit" class="btn btn-bg rounded-pill font-monserrat-black">COMENTAR</button> 
										</div>
									<?php
									}
									else
									{ ?>
										<div class="col-auto pt-2">
											<button type="button" class="btn btn-bg rounded-pill font-monserrat-black"data-bs-toggle="modal" data-bs-target="#iniciaSesion">COMENTAR</button>
										</div>
										<!-- Modal -->
										<div class="modal fade" id="iniciaSesion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
										  <div class="modal-dialog">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="staticBackdropLabel">Advertencia</h5>
										        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										      </div>
										      <div class="modal-body">
										        Debe iniciar sesión para poder comentar.
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
										        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
										      </div>
										    </div>
										  </div>
										</div>
										
										<?php
									}
								?>
								
							</form>
							
						</div>
						<?php  
							foreach ($respuestas as $row) 
							{?>
								<div class="row pt-4 border-top border-4" style="border-color: #000!important">
									<div class="col-md-1">
										<img src="<?php if($row->foto == 0){echo base_url('sources/images/usuario/fotoUsuario.png');} else{echo base_url('sources/images/usuario').'/'.$row->idUsuario.'.jpg';} ?>" class="img-tamaño-foro2">
									</div>
									<div class="col-md-7">
										<h4 class="font-monserrat-bold"><?php echo $row->nombre ?></h4>
										<h5 class="font-monserrat-regular"><?php echo $row->comentario ?></h5>
									</div>
								</div>
								<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>