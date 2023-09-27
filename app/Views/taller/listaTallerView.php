<div class=" p-0 pb-5 p-cont">
	<div class="container-fluid pt-5 fondo1 min-vh-100">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1 class="font-bebas text-white">TALLERES</h1>
			</div>
		</div>
		<div class="row pt-5 pb-5">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="row row-cols-1 row-cols-md-3 g-4 p-0">
					<?php
					foreach ($talleres as $row) 
					{?>
						<div class="col">
							<div class="card h-100 text-center border-curvo card-difu">
								<div class="card-body">
									<h5 class="card-title text-center font-monserrat-medium text-white" ><?php echo $row->nombre?></h5>
									<?php if($row->fotoPerfil == 0)
									{?>
										<img src="<?php echo base_url('sources/images/usuario').'/'.'0.png' ?>" class="card-img-top" alt="...">
									<?php
									}
									else
									{?>
										<img src="<?php echo base_url('sources/images/usuario').'/'.$row->idTaller.'.jpg' ?>" class="card-img-top" alt="...">
										<?php
									}
									?>
									
									<br>
									<button class="btn btn-lg p-0 m-0 "><span class="bi bi-star-fill icon"></span></button>
									<button class="btn btn-lg p-0 m-0"><span class="bi bi-star-fill icon"></span></button>
									<button class="btn btn-lg p-0 m-0"><span class="bi bi-star-half icon"></span></button>
									<button class="btn btn-lg p-0 m-0"><span class="bi bi-star icon"></span></button>
									<button class="btn btn-lg p-0 m-0"><span class="bi bi-star icon"></span></button>
									<form action="<?php echo base_url('public/curso/detallecurso') ?>" target="_self" method="get">
										<input type="text" name="curso" hidden value="<?php echo $row->idTaller?>">
										<button type="submit" class="btn btn-bg rounded-pill font-monserrat-black">VER MÁS</button>
									</form>
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