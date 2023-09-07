  divmapa=document.getElementById('map');
  function initMap(){
    //opciones del mapa
    var options={ //menor zoom + lejos
      zoom:14,
      center:{lat:-17.379131,lng:-66.161832}
    }

    //nuevo mapa
    var map =new google.maps.Map(divmapa,options);

    //listener click mapa
    google.maps.event.addListener(map,'click',function(event){
      //agregr un marcador
      addMarker({coordenadas:event.latLng});
    });

    addMarker({
    coordenadas:{lat:-17.379131,lng:-66.161832},
    iconImage:'http://maps.google.com/mapfiles/ms/micons/sportvenue.png',
    content:"<h1>Feliz Caballo</h1>"
    }); //estadio
    addMarker({
      coordenadas:{lat:-17.385858,lng:-66.163511},
      iconImage:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
       content:'<h1>Parque para hacer familia</h1>'
    }); //parque de la familia
    addMarker({
    coordenadas:{lat:-17.391592,lng:-66.182051},
    iconImage:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
     content:'<h1>hipodromo</h1>'
    }); //hipodromo
    addMarker({
      coordenadas:{lat:-17.388383, lng:-66.156003}
    });//plaza colon
    addMarker({
      coordenadas:{lat:-17.383281, lng:-66.159712}
    });//burguerking

    //plaza -17.388383, -66.156003
    //burguerking -17.383281, -66.159712

    //Funcion Add marker
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
