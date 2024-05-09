<div class=" p-0 pb-5 p-cont">
	<div class="container-fluid pt-5 fondoUsuarios min-vh-100">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1 class="font-bebas text-dark">USUARIOS</h1>
			</div>
		</div>
		<div class="row pt-5 pb-5">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="row row-cols-1 row-cols-md-3 g-4 p-0">
					<?php
					foreach ($usuarios as $row) 
					{?>
						<div class="col">
							<div class="card h-100 text-center border-curvo card-difu">
								<div class="card-body">
									<h5 class="card-title text-center font-monserrat-medium text-dark" ><?php 
									if ($row->rol == 2) {
										echo $row->cliente;
									}
									else{ echo $row->taller;}
									?></h5>
									<?php if($row->fotoCliente == 0 && $row->rol == 2)
									{?>
										<img src="<?php echo base_url('sources/images/usuario').'/'.'0.png' ?>" class="card-img-top" alt="...">
									<?php
									}
									elseif ($row->fotoTaller == 0 && $row->rol == 3) {
										?>
										<img src="<?php echo base_url('sources/images/usuario').'/'.'0.png' ?>" class="card-img-top" alt="...">
									<?php
									}
									else
									{?>
										<img src="<?php echo base_url('sources/images/usuario').'/'.$row->id.'.jpg' ?>" class="card-img-top" alt="...">
										<?php
									}
									?>
									
									<br>
									
									<button type="submit" class="btn btn-danger rounded-pill font-monserrat-black" onclick="confirmacion('<?php echo $row->id; ?>')" data-bs-toggle="modal" data-bs-target="#mdConfirmar">BANEAR</button>
								</div>
							</div>
						</div>
					<?php
					}?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Confirmar Cita-->

<div class="modal" id="mdConfirmar" tabindex="-1" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>¿ESTÁ SEGURO DE BANEAR A ESTE USUARIO?</h5>
            </div>
            <form id="deleteform" action="<?php echo base_url('public/admin/banearUsuario') ?>" method="POST" target="_self">
                <div class="modal-body d-flex justify-content-center">
                    <input type="text" name="idUsuario" id="idUsuario" hidden>
                    <button type="submit" class="btn btn-bga">
                        BANEAR
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
			    			<h5 class="fs-1 pt-3 pb-1">BANEO EXITOSO</h5>
			    		</div>
					    <div class="text-center">
					    	<p class="fs-4 pt-2">El usuario fue eliminado con exito</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/admin/listaUsuarios')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
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
					    	<p class="fs-4 pt-2">Hubo un error al eliminar al usuario intentelo otra vez</p>
					    </div>
					    <div class="row text-center align-items-center">
					    	<div class="col-md-4"></div>
					    	<div class="col-md-4">
					    		<a href="<?php echo base_url('public/admin/listaUsuarios')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
	function confirmacion(usuario) 
	{
        document.getElementById("idUsuario").value = usuario;
    }
</script>