<div class="p-0 p-cont ">
	<div class="container-fluid fondoAdmin">
		<div class="container pt-5 pb-5">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="font-bebas text-dark">MIS COTIZACIONES</h1>
				</div>
			</div>
			<div class="row">
				<table class="table text-dark bg-white table-striped table-bordered border-primary" id="tablaDatos">
					<thead class="font-monserrat-medium negrita">
						<tr>
							<th class="font-bebas negrita text-center fs-3" colspan="8">LISTA COTIZACIONES</th>
						</tr>
						<tr>
							<th class="col text-center">Nombre Taller</th>
							<th class="col text-center">Servicio</th>
							<th class="col text-center">Tiempo</th>
							<th class="col text-center">Costo</th>
							<th class="col text-center">Detalles</th>
							
						</tr>
					</thead>
					<tbody class="">
						<?php
						foreach ($cotizaciones as $row) 
						{?>
							<tr class="text-center align-middle">
								<td><?php echo $row->nombre ?></td>
								<td><?php echo $row->servicio ?></td>
								<td><?php echo $row->tiempoAproximado ?></td>
								<td><?php echo $row->costo ?></td>
								<td>
									<form action="<?php echo base_url('public/cotizacion/clientecotizacionpdf') ?>" target="_blanck" method="post">
										<input type="text" name="idCotizacion" value="<?php echo $row->idCotizacion ?>" hidden>
										<?php  
											if ($row->costo != '') {?>
												<button id="btnAceptar" class="btn btn-success rounded-pill" type="submit"> 	<span class="bi bi-check-square icon"></span>
							    				</button>
							    				<?php
											}
											else
											{
										?>
										<button id="btnAceptar" class="btn btn-success rounded-pill" type="submit" disabled="true"> 	<span class="bi bi-check-square icon"></span>
							    		</button>
											<?php } ?>
									</form></td>
								
								
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