<div class="p-0 p-cont ">
	<div class="container-fluid fondoAdmin">
		<div class="container pt-5 pb-5">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="font-bebas text-dark">CITAS</h1>
				</div>
			</div>
			<div class="row pb-4 pt-4">
				<div class="col-md-8">
					<a href="<?php echo base_url('public/cita/listacitapendientetaller')?>"><button class="btn btn-bg rounded-pill" data-bs-toggle="modal" data-bs-target="#agregarServicio">CITAS POR PROGRAMAR</button></a>
				</div>
			</div>
			<div class="row">
				<table class="table text-dark bg-white table-striped table-bordered border-primary" id="tablaDatos">
					<thead class="font-monserrat-medium negrita">
						<tr>
							<th class="font-bebas negrita text-center fs-3" colspan="8">LISTA CITAS</th>
						</tr>
						<tr>
							<th class="col text-center">Nombre cliente</th>
							<th class="col text-center">Descripcion</th>
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
								<td><?php echo $row->cliente ?></td>
								<td><?php echo $row->descripcionProblema ?></td>
								<td><?php echo $row->servicio ?></td>
								<td><?php echo $row->fechaCita ?></td>
								<td><?php if($row->estado == '1'){echo 'Habilitado';} else{echo 'Deshabilitado';}?></td>
								
								
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
<!-- Modal Confirmar deshabilitar-->

<div class="modal" id="confirmacionDeshabilitar" tabindex="-1" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>¿ESTÁ SEGURO DE DESHABILITAR ESTE SERVICIO?</h5>
            </div>
            <form id="deleteform" action="<?php echo base_url('public/taller/deshabilitarserviciomodel') ?>" method="POST" target="_self">
                <div class="modal-body d-flex justify-content-center">
                    <input type="hidden" id="txtServicioDeshabilitar" value="0" name="txtServicioDeshabilitar">
                    <input type="text" name="id" value="<?php echo $id?>" hidden>
                    <button type="submit" class="btn btn-danger">
                        Deshabilitar
                    </button>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

            </div>
        </div>
    </div>
</div>
<!-- Modal Confirmar habilitar-->

<div class="modal" id="confirmacionHabilitar" tabindex="-1" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>¿ESTÁ SEGURO DE HABILITAR ESTE SERVICIO?</h5>
            </div>
            <form id="" action="<?php echo base_url('public/taller/habilitarserviciomodel') ?>" method="POST" target="_self">
                <div class="modal-body d-flex justify-content-center">
                    <input type="hidden" id="txtServicioHabilitar" value="0" name="txtServicioHabilitar">
                    <input type="text" name="id" value="<?php echo $id?>" hidden>
                    <button type="submit" class="btn btn-success">
                        Habilitar
                    </button>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

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
					    	<p class="fs-4 pt-2">Se agrego un servico de manera exitosa</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/listaservicio')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
					    	<p class="fs-4 font-monserrat-regular pt-2">Hubo un error al registrar el servicio intentelo otra vez</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/taller/listaservicio')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
	function confirmacionDeshabilitar(servicio) 
	{
        document.getElementById("txtServicioDeshabilitar").value = servicio;
    }
    function confirmacionHabilitar(servicio) 
	{
        document.getElementById("txtServicioHabilitar").value = servicio;
    }
</script>