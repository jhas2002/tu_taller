<?php
if ($messageReport != null) {
  $lista = explode("/", $messageReport);
}
else
{
  $lista[0] = '5';
  $lista[2] = '5';
  $lista[3] = '5';
  $lista[4] = '63881640';
}
 
?>
<style type="text/css">
  #map{
    height: 450px;
    width: 800px;
  }
</style>
<div class="container-fluid pt-2 min-vh-100">
	<div class="row m-0 p-0 pt-3 min-vh-100 justify-content-center align-items-center text-center pb-5">
    <div class="row justify-content-center align-items-center text-center">
      <div class="col-md-6">
        <button class="btn btn-bg mb-0"id="ubicacion">Mi ubicacion</button>
      </div>
      
    </div>
    
		<div id="map"></div>
            
            <textarea id="txtTalleres" hidden>
              <?php
                foreach ($talleres as $row) 
                {
                   echo $row->idTaller."/".$row->latitud."/".$row->longitud."/".$row->nombre."/".$row->fotoPerfil."/".$row->calificacion."\n";
                 } 
              ?>
            </textarea>
	</div>
</div>

<div class="modal fade" id="mdSolicitarAyuda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="staticBackdropLabel">Solicitar Ayuda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php echo base_url('public/ayuda/solicitarayuda') ?>" target="_self" method="post" class="needs-validation" novalidate>
        <div class="modal-body">
          <input type="text" name="idTaller" id="idTaller" hidden>
          <div class="form-group">
            <label>Descripción del problema</label>
            <input type="text"  requiered name="txtProblema" class="form-control" required>
            <div class="valid-feedback">
              Correcto.
            </div>
            <div class="invalid-feedback">
              Este campo es obligatorio
            </div>
          </div>
          <div class="form-group">
            <label>Descripción del automovil</label>
            <input type="text"  requiered name="txtDescripcionAuto" class="form-control" required>
            <div class="valid-feedback">
              Correcto.
            </div>
            <div class="invalid-feedback">
              Este campo es obligatorio
            </div>
          </div>
          <div class="form-group">
            <input type="text"  requiered name="txtLongitud" id="txtLongitud" class="form-control" hidden>
            <input type="text"  requiered name="txtLatitud" id="txtLatitud" class="form-control" hidden>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success" id="btnGuardarPsw" >Guardar</button>
        </div>
      </form>
      
    </div>
  </div>
</div>


<?php
if ($lista[0]=='1') {
  ?>
  <div class="modal2 container-fluid">
    <div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
      <div class="col-md-4">
          <div class="container bg-modal-message border-curvo">
            <div class="modal-content border-0">
              <div class="row text-center border-curvo-top2 bg-modal-titulo">
                <h5 class="fs-3 pt-3 pb-1">Solicitud de ayuda realizada </h5>
              </div>
              <div class="text-center">
                <a href="https://wa.me/591<?php echo $lista[4]?>?text=Buenas%20necesito%20ayuda%20en%20la%20siguiente%20ubicacion%20https://maps.google.com/?q=<?php echo $lista[3].','.$lista[2];?>" target="_blanck">
                  <button class="btn btn-bg rounded-pill btn-lg mt-3"> Enviar al Wasap </button>
                </a>
              </div>
              <div class="row text-center align-items-center">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <a href="<?php echo base_url('public/ayuda/mapaayuda')?>"><img src="<?php echo base_url('sources/images/done.png') ?>" class="align-items-center text-center" alt="ok logo" style="width: 100px;"></a>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php
}
if ($lista[0]=='2') {
  ?>
  <div class="modal2 container-fluid">
    <div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
      <div class="col-md-4">
          <div class="container bg-modal-message border-curvo">
            <div class="modal-content border-0">
              <div class="row text-center border-curvo-top2 bg-modal-titulo">
                <h5 class="fs-3 pt-3 pb-1">No se pudo solicitar ayuda inténtelo otra vez</h5>
              </div>

              <div class="row text-center align-items-center">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <a href="<?php echo base_url('public/ayuda/mapaayuda')?>"><img src="<?php echo base_url('sources/images/fail.png') ?>" class="align-items-center text-center" alt="fail logo" style="width: 100px;"></a>
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
  var divmapa=document.getElementById('map');

  function initMap(){
  	
    //opciones del mapa
    var options={
      zoom:13,  //zoom: mayor zoom mas cerca, menor mas lejos
      center:{lat:-17.385753,lng:-66.162968}//latitud longitud
    }

    //nuevo mapa
    var map=new google.maps.Map(divmapa, options);


   	ubicacion.addEventListener('click',()=>{
   		
		// distancees un valor en metros
		
    	if (navigator.geolocation) 
		  {
        var talleres = document.getElementById("txtTalleres").value;
        var talleresLista = talleres.split("\n");
        let talleresCercanos = [];
        let distanciaLista = [];
        let listaTalleresCercanos = [];
        var txtLatitud = document.getElementById("txtLatitud");
        var txtLongitud = document.getElementById("txtLongitud");
		  	navigator.geolocation.getCurrentPosition(
		  		(position)=>{
		  			const coords = { 
		  				lat: position.coords.latitude,
		  				lng: position.coords.longitude
		  			};
            txtLongitud.value = position.coords.latitude;
            txtLatitud.value = position.coords.longitude;
		  			console.log(coords);
            addMarker({
            coordenadas:coords,
            content:'<h1>Tu ubicacion</h1>'
            });
		  			map.setCenter(coords);
            /*haciendo un array con las distancias*/
            for (var i = 0; i < talleresLista.length; i++) 
            {
              var aux = talleresLista[i].trim();
              let taller = aux.split("/");
              taller.push(getDistanciaMetros(position.coords.latitude, position.coords.longitude,taller[1],taller[2]))
              distanciaLista.push(getDistanciaMetros(position.coords.latitude, position.coords.longitude,taller[1],taller[2]));
              talleresCercanos[i] = taller;
            }
            /*consiguiendo los 3 talleres mas cercanos*/
            distanciaLista = distanciaLista.sort(function(a, b){return a - b});
            console.log(distanciaLista);
            var cont = 0;
            for (var i = 0; i < 3; i++) 
            {
              for (var y = 0; y < talleresCercanos.length; y++) 
              {
                if (distanciaLista[i] == talleresCercanos[y][6]) 
                {
                  listaTalleresCercanos[i] = talleresCercanos[y];
                }
              }

              
            }
            for (var i = 0; i < listaTalleresCercanos.length; i++) 
            {
              var foto ='';
              var calificacion = '';
              /*fotos si o no para el card*/
              if (listaTalleresCercanos[i][4] == 0) 
              {
                foto = '<img src="<?php echo base_url('sources/images/usuario').'/'.'0.png' ?>" class="card-img-top img-card-ayuda" alt="..."> ';
              }
              else
              {
                foto = '<img src="<?php echo base_url('sources/images/usuario')?>'+'/'+listaTalleresCercanos[i][0]+'.jpg" class="card-img-top img-card-ayuda" alt="...">';
              }
              /*armando la calificacion*/
              if (listaTalleresCercanos[i][5] > 0) 
              {
                calificacion = calificacion + '<button class="btn btn-lg p-0 m-0"><span id="star-1" class="bi bi-star-fill icon icon-estrella estrella estrella-pintada"></span></button>';
              }
              else
              {
                calificacion = calificacion + '<button class="btn btn-lg p-0 m-0"><span id="star-1" class="bi bi-star-fill icon icon-estrella-ayuda estrella"></span></button>';
              }
              if (listaTalleresCercanos[i][5] > 1) 
              {
                calificacion = calificacion + '<button class="btn btn-lg p-0 m-0"><span id="star-2" class="bi bi-star-fill icon icon-estrella estrella estrella-pintada"></span></button>';
              }
              else
              {
                calificacion = calificacion + '<button class="btn btn-lg p-0 m-0"><span id="star-2" class="bi bi-star-fill icon icon-estrella-ayuda estrella"></span></button>';
              }
              if (listaTalleresCercanos[i][5] > 2) 
              {
                calificacion = calificacion + '<button class="btn btn-lg p-0 m-0"><span id="star-3" class="bi bi-star-fill icon icon-estrella estrella estrella-pintada"></span></button>';
              }
              else
              {
                calificacion = calificacion + '<button class="btn btn-lg p-0 m-0"><span id="star-3" class="bi bi-star-fill icon icon-estrella-ayuda estrella"></span></button>';
              }
              if (listaTalleresCercanos[i][5] > 3) 
              {
                calificacion = calificacion + '<button class="btn btn-lg p-0 m-0"><span id="star-4" class="bi bi-star-fill icon icon-estrella estrella estrella-pintada"></span></button>';
              }
              else
              {
                calificacion = calificacion + '<button class="btn btn-lg p-0 m-0"><span id="star-4" class="bi bi-star-fill icon icon-estrella-ayuda estrella"></span></button>';
              }
              if (listaTalleresCercanos[i][5] > 4) 
              {
                calificacion = calificacion + '<button class="btn btn-lg p-0 m-0"><span id="star-5" class="bi bi-star-fill icon icon-estrella estrella estrella-pintada"></span></button>';
              }
              else
              {
                calificacion = calificacion + '<button class="btn btn-lg p-0 m-0"><span id="star-5" class="bi bi-star-fill icon icon-estrella-ayuda estrella"></span></button>';
              }
              /*agregando los marcadores*/
              addMarker({
              coordenadas:{lat:parseFloat(listaTalleresCercanos[i][1]),lng:parseFloat(listaTalleresCercanos[i][2])},
              content:'<div class="card h-100 text-center border-curvo"><div class="card-body"><h5 class="card-title text-center">'+listaTalleresCercanos[i][3]+'</h5>'+foto+'<br>'+calificacion+'<br/><button type="button" onclick="solicitarAyuda('+listaTalleresCercanos[i][0]+')" data-bs-toggle="modal" data-bs-target="#mdSolicitarAyuda" class="btn btn-bg rounded-pill">Solicitar Ayuda</button></div></div>'
              });
            }
            console.log(listaTalleresCercanos);
		  		}
		  		);
		  }
		  else
		  {
		  	alert("Tu navegador no dispone de la geolocalizacion");
		  }
    });
    function addMarker(props){
      var marker=new google.maps.Marker({
      position: props.coordenadas, 
      map: map,
      //icon: props.iconImage
    });
    //control de iconos
    if (props.iconImage)
    {
      marker.setIcon(props.iconImage);
    }
    if (props.content)
    {
      var infoWindow=new google.maps.InfoWindow({
        content: props.content
      });

      marker.addListener('click',function(){
        infoWindow.open(map, marker);
      });
    }

    }
  }
function getDistanciaMetros(lat1,lon1,lat2,lon2)
{
  rad = function(x) {return x*Math.PI/180;}
  var R = 6378.137; //Radio de la tierra en km 
  var dLat = rad( lat2 - lat1 );
  var dLong = rad( lon2 - lon1 );
  var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(rad(lat1)) * 
  Math.cos(rad(lat2)) * Math.sin(dLong/2) * Math.sin(dLong/2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

  //aquí obtienes la distancia en metros por la conversion 1Km =1000m
  var d = R * c; 
  return d ; 
}
function solicitarAyuda(idTaller) 
  {
        document.getElementById("idTaller").value = idTaller;
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTcQ4yNd2AeeXine1Kl3Y1sBKIe1qJ0Ro&callback=initMap"
    async defer></script>
