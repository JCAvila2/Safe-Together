// obtener la ubicacion del navegador
navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
    enableHighAccuracy:true,
    trackUserLocation:true
  })
  function successLocation(location) { // funcion que se ejecura cuando se puede acceder correctamente a la ubicacion del usuario
    console.log(location);
    //mostrarUsuario()
    hacerMapa([location.coords.longitude, location.coords.latitude])
  }
  function errorLocation() { // funcion que se ejecuta si no se puede acceder a la localizacion del usuario
    console.log("No se pudo acceder a la localizacion.")
    alert("No se puede acceder a la localizacion.")
    mostrarUsuario()
  }
  
  
  function hacerMapa(location) { // funcion para crear el mapa de mapbox y colocarlo en el div con el id "map"
    mapboxgl.accessToken = 'pk.eyJ1IjoiamNhdmlsYTIiLCJhIjoiY2wxcjFiMWFxMDd6bzNsb2Z2dTRtZ2Z0ZiJ9.iS9nrhwTCWO-27O7V3CwRA'; //token de mapbox
    globalThis.map = new mapboxgl.Map({
      container:"map",
      style:"mapbox://styles/mapbox/streets-v11",
      center: location,
      zoom: 16
    })
    
    //colocar marcador en la ubicacion del usuario
    let element = document.createElement('div')
    element.className = 'marker'
    let marker = new mapboxgl.Marker(element).setLngLat({
      lng: location[0],
      lat: location[1]
    })
    .addTo(map)
    
    // barra de navegacion
    const nav = new mapboxgl.NavigationControl();
    map.addControl(nav);
  
  
  
    // agregar los marcadores de otros usuarios
    for (var i = 0; i < 3; i++) {
      let lat = 4.866699;
      let long = -74.050632;
      let nombre = "Usuario ejemplo " + i;
      agregarMarcador(nombre, [long, lat])
    }
  
  }
  
  // funcion para agregar marcadores de usuarios en el mapa
  function agregarMarcador(nombre, localizacionUsuario) {
    let element2 = document.createElement('div')
    element2.className = 'marker2'
    let marker2 = new mapboxgl.Marker(element2).setLngLat({
      lng: localizacionUsuario[0],
      lat: localizacionUsuario[1]
    })
    .addTo(map)
    console.log("Se encontro al usuario " + nombre + " en la latitud: " + localizacionUsuario[1] + " y longitud: " + localizacionUsuario[0])
  }
  
  // funcion para mostrar nombre el usuario
  function mostrarUsuario() {
    /*
    var nombreEnBD = "Nombre de Usuario"
    var valorNombre = document.createTextNode(nombreEnBD)
    document.getElementById("username").appendChild(valorNombre)
    */
  
    var valorNombre = document.createTextNode(jsvar)
    document.getElementById("username").appendChild(valorNombre)
    console.log("El correo del usuario es: " + jsvar)
  
  
  }