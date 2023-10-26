<style type="text/css">
  #map{
    height: 400px;
    width: 600px;
  }
</style>
<div class="container-fluid pt-5 min-vh-100">
	<div class="row m-0 p-0 pt-5 min-vh-100 justify-content-center align-items-center text-center pb-5">
		<div id="map"></div>
            <button class="btn btn-bg"id="ubicacion">Mi ubicacion</button>
            <textarea id="txtTalleres" hidden>
              <?php
                foreach ($talleres as $row) 
                {
                   echo $row->idTaller."/".$row->latitud."/".$row->longitud."/".$row->nombre."\n";
                 } 
              ?>
            </textarea>
	</div>
</div>

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

		  	navigator.geolocation.getCurrentPosition(
		  		(position)=>{
		  			const coords = { 
		  				lat: position.coords.latitude,
		  				lng: position.coords.longitude
		  			};

		  			console.log(coords);
            addMarker({
            coordenadas:coords,
            content:'<h1>Tu ubicacion</h1>'
            });
		  			map.setCenter(coords);
            var distancia = getDistanciaMetros(position.coords.latitude, position.coords.longitude,-17.331379,-66.226109);
            console.log(distancia);
            /*haciendo un array con las distancias*/
            for (var i = 0; i < talleresLista.length; i++) 
            {
              var aux = talleresLista[i].trim();
              let taller = aux.split("/");
              taller.push(getDistanciaMetros(position.coords.latitude, position.coords.longitude,taller[1],taller[2]))
              distanciaLista.push(getDistanciaMetros(position.coords.latitude, position.coords.longitude,taller[1],taller[2]));
              talleresCercanos[i] = taller;
            }
            /**/
            distanciaLista = distanciaLista.sort(function(a, b){return a - b});
            console.log(distanciaLista);
            console.log(position.coords.longitude);
            var cont = 0;
            for (var i = 0; i < 3; i++) 
            {
              for (var y = 0; y < talleresCercanos.length; y++) 
              {
                if (distanciaLista[i] == talleresCercanos[y][4]) 
                {
                  listaTalleresCercanos[i] = talleresCercanos[y];
                }
              }

              
            }
            for (var i = 0; i < listaTalleresCercanos.length; i++) 
            {
              console.log(listaTalleresCercanos[i][2]);
              addMarker({
              coordenadas:{lat:parseFloat(listaTalleresCercanos[i][1]),lng:parseFloat(listaTalleresCercanos[i][2])},
              content:'<h1>'+listaTalleresCercanos[i][3]+'</h1>  <button class="btn btn-bg">Solicitar Ayuda</button>'
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
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTcQ4yNd2AeeXine1Kl3Y1sBKIe1qJ0Ro&callback=initMap"
    async defer></script>
