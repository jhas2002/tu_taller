<div class="p-0 p-cont ">
	<div class="container-fluid fondoAdmin">
		<div class="container pt-5 pb-5">
			
		
			<div class="row">
				<table class="table text-dark bg-white table-striped table-bordered border-primary" id="tablaDatos">
					<thead class=" negrita">
						<tr>
							<th class=" negrita text-center fs-3" colspan="8">LISTA CITAS</th>
						</tr>
						<tr>
							<th class="col text-center">Nombre Taller</th>
							<th class="col text-center">Descripción </th>
							<th class="col text-center">Servicio</th>
							<th class="col text-center">Fecha Cita</th>
							<th class="col text-center">Estado</th>
							
						</tr>
					</thead>
					<tbody class="">
						<?php
						foreach ($citas as $row) 
						{?>
							<tr class="text-center align-middle">
								<td><?php echo $row->taller ?></td>
								<td><?php echo $row->descripcionProblema ?></td>
								<td><?php echo $row->servicio ?></td>
								<td><?php echo $row->fechaCita ?></td>
								<td <?php if($row->estado == '1'){echo "style = 'background: #FCF002'";} elseif($row->estado == '2'){echo "style = 'background: #92F257'";}elseif($row->estado == '3'){echo "style = 'background: #F25757'";}elseif($row->estado == '0'){echo "style = 'background: #F8FF5D'";}elseif($row->estado == '-1'){echo "style = 'background: #FF2300'";}?>><?php if($row->estado == '1'){echo 'Pendiente';} elseif($row->estado == '2'){echo 'Finalizado';}elseif($row->estado == '3'){echo "No Presentado";}elseif($row->estado == '0'){echo "En Espera";}elseif($row->estado == '-1'){echo "RECHAZADO";}?></td>
								
								
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


