<div class="p-0 p-cont ">
	<div class="container-fluid fondoAdmin">
		<div class="container pt-5 pb-5">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="font-bebas text-dark">COTIZACIÓN</h1>
				</div>
			</div>
			<div class="row pb-4 pt-4">
				<div class="col-md-8">
					<a href="<?php echo base_url('public/cotizacion/listacotizacionpendientetaller')?>"><button class="btn btn-bg rounded-pill" data-bs-toggle="modal" data-bs-target="#agregarServicio">COTIZACIONES POR RESPONDER</button></a>
				</div>
			</div>
			<div class="row">
				<table class="table text-dark bg-white table-striped table-bordered border-primary" id="tablaDatos">
					<thead class="font-monserrat-medium negrita">
						<tr>
							<th class="font-bebas negrita text-center fs-3" colspan="8">LISTA COTIZACIONES</th>
						</tr>
						<tr>
							<th class="col text-center">Nombre cliente</th>
							<th class="col text-center">Descripcion</th>
							<th class="col text-center">Servicio</th>
							<th class="col text-center">Estado</th>
							
						</tr>
					</thead>
					<tbody class="">
						<?php
						foreach ($cotizaciones as $row) 
						{?>
							<tr class="text-center align-middle">
								<td><?php echo $row->cliente ?></td>
								<td><?php echo $row->descripcionProblema ?></td>
								<td><?php echo $row->servicio ?></td>
								<td><?php if($row->estado == '1'){echo 'Realizado';} else{echo 'Deshabilitado';}?></td>
								
								
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