<?php  
	use App\Controllers\Home;
?>
<div class="p-cont">
	<div class="container-fluid p-0">
		<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
		  <div class="carousel-inner">
		    <div class="carousel-item active">
		    	<img src="<?php echo base_url('sources/images/fondos/fondo1.jpg') ?>" class="d-block w-100" alt="...">
		    	<div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
		    		<div class="container">
		    			<div class="row justify-content-center">
		    				<div class="col-md-6">
		    					<div class="row">
		    						<div class="col-md-6 align-items-center">
		    							<h2 class="txt-grande text-white text-center counter font-bebas" id="numeroEst"><strong>444</strong></h2>
		    							<h2 class="text-white text-mediano text-center font-bebas"><strong>NÚMERO DE VISITANTES</strong></h2>
		    						</div>
		    						<div class="col-md-6 align-items-center">
		    							<h2 class="txt-grande text-white text-center counter font-bebas" id="numeroCur"><strong>69</strong></h2>
		    							<h2 class="text-white text-mediano text-center font-bebas"><strong>NÚMERO DE TALLERES</strong></h2>
		    						</div>
		    					</div>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		    <div class="carousel-item">
		    	<img src="<?php echo base_url('sources/images/fondos/fondo1.jpg') ?>" class="img-fluid d-block w-100" alt="...">
		    	<div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
		    		<div class="container">
		    			<div class="row justify-content-center">
		    				<div class="col-sm-10 col-lg-8">
		    					<h1 class="display-3 text-white font-bebas text-center">Tu Taller</h1>
		    					<p class="fs-5 text-white mb-4 pb-2 font-monserrat-regular text-center">Es una pagina web que busca ayuda a proporcionar informacion de los talleres registrados en el area </p>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		  </div>
		  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="visually-hidden">Previous</span>
		  </button>
		  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="visually-hidden">Next</span>
		  </button>
		</div>
	</div>
	
	<!--<div class="container-fluid vh-100 p-0">
		<div class="container-fluid fondo1 p-0">
			<div class="row m-0 pt-5 align-items-center">
				
				<div class="col-lg-1"></div>
				<div class="col-lg-6 col-sm-6 p-3">
					<h1 class="text-white text-center font-bebas">NUESTRA DISTINCIÓN:</h1>
					<ul class="colum-2">
						
						<li class="listof font-monserrat-regular">Diapositivas a disposición de nuestros estudiantes.</li>
						<li class="listof font-monserrat-regular">Las clases son grabadas y están a disposición del estudiante.</li>
						<li class="listof font-monserrat-regular">Clases Teóricas y Practicas.</li>
						<li class="listof font-monserrat-regular">Clases Virtuales y Presenciales.</li>
						<li class="listof font-monserrat-regular">Cursos actualizados.</li>
					</ul>
				</div>
				<div class="col-lg-4 col-sm-4 p-3 pb-5" >-->
					<!--<img src="<?php echo base_url('sources/images/prueba1.jpg') ?>">
				</div>
			</div>
		</div>
	</div>-->
	
	<div class="container-fluid p-0" >
		<h1 class="text-dark text-center font-bebas fondo m-0" >FORO</h1>
		<div class="row m-0 p-0 justify-content-center align-items-center text-center min-vh-100 fondoForo">
			
			<div class="row justify-content-center align-items-center pb-5 m-0 min-vh-100 cont">
				<div class="col-sm-9 col-lg-9">
					<div class="row row-cols-1 row-cols-md-3 g-4 m-0 justify-content-center">
						<?php
							foreach ($foro as $row) 
							{?>
								<div class="col">
									<div class="card border-0 mb-3 card-difu border-curvo fondo h-100" style="max-width: 18rem;" data-aos="fade-right">
									  <div class="card-header bg-transparent">
									  	<div class="row m-0">
									  		<img src="<?php if($row['foto'] == 0){echo base_url('sources/images/usuario/0.png');} else{echo base_url('sources/images/usuario').'/'.$row['idUsuario'].'.jpg';} ?>" height="175px" width="10px" class="rounded-circle">
										  	<h5 class="card-text"><?php echo $row['nombre'] ?>:</h5>
										  	<p class="font-monserrat-regular"><?php echo $row['pregunta'] ?></p>
									  	</div>
									  </div>
									  <div class="card-body">
									  	<?php  
									  		foreach ($row['respuestas'] as $row2) 
									  		{?>
									  			<div class="container-fluid p-0">
											  		<div class="row align-items-center p-0">
												  		<div class="col-md-2">
												  			<img src="<?php if($row2->foto == 0){echo base_url('sources/images/usuario/0.png');} else{echo base_url('sources/images/usuario').'/'.$row2->idUsuario.'.jpg';} ?>" width="50px" class="rounded-circle">
												  		</div>
												  		<div class="col-md-10 ps-3">
												  			<h5 class="card-text text-center"><?php echo $row2->nombre ?>:</h5>
												  		</div>
												  	</div>
												  	<div class="row pt-1">
												  		<p class="font-monserrat-regular"><?php echo $row2->comentario ?></p>
												  	</div>
											  	</div>
											  	<?php
									  		}
									  	?>
									  </div>
									  
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
