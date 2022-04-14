// obtener la ubicacion por medio del navegador
navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
    enableHighAccuracy:true,
    trackUserLocation:true
  })
  function successLocation(location) { // funcion que se ejecuta cuando se puede acceder correctamente a la ubicacion del usuario
    actualizarLocalizacionDB(location.coords.latitude, location.coords.longitude) //enviar la ubicacion actual a la base de datos
    mostrarUsuario()
    hacerMapa([location.coords.longitude, location.coords.latitude]) // crear mapa
    console.log("Se pudo acceder corretamente a la localizacion")
  }
  
  function errorLocation() { // funcion que se ejecuta si no se puede acceder a la localizacion del usuario
    console.log("No se pudo acceder a la localizacion.")
    alert("No pudimos acceder a tu localización, cambia los permisos en la configuración del navegador")
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
    // colocar marcador en la ubicacion actual del usuario
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
    buscarUsuarios() // buscar y colocar marcadores de otros usuarios en el mapa
  }
  
  // funcion para agregar marcadores de otros usuarios en el mapa
  function agregarMarcador(nombre, localizacionUsuario) {
    let element2 = document.createElement('div')
    element2.className = 'marker2'
    let marker2 = new mapboxgl.Marker(element2).setLngLat({
      lng: localizacionUsuario[0],
      lat: localizacionUsuario[1]
    })
    .addTo(map)
    console.log("Se encontro al usuario " + nombre + " en la latitud: " + localizacionUsuario[1] + " y en la longitud: " + localizacionUsuario[0])
  }
  
  // funcion para mostrar nombre el usuario en el header
  function mostrarUsuario() {
    var valorNombre = document.createTextNode(userName)
    document.getElementById("username").appendChild(valorNombre)
    console.log("El correo del usuario es: " + userEmail)
    console.log("El nombre del usuario es: " + userName)
  }

  // funcion para enviar la ubicacion actual a la base de datos
  function actualizarLocalizacionDB(latitudActual, longitudActual) {
    var nuevaLocalizacion = {};
    nuevaLocalizacion.email = userEmail;
    nuevaLocalizacion.latitud = latitudActual;
    nuevaLocalizacion.longitud = longitudActual;
    console.log(nuevaLocalizacion)
    $.ajax({
      url:"actualizarUbicacion.php",
      method: "post",
      data: { nuevaLocalizacion:JSON.stringify(nuevaLocalizacion)} ,
      success: function(res) {
        console.log("Datos enviados correctamente: " + res)
      }
    })
  }

  // agregar los marcadores de otros usuarios
  function buscarUsuarios() {     
    let lat;
    let long;
    let nombre;
    for (var i = 0; i < baseDeDatosInfo.length; i++) {
      lat = baseDeDatosInfo[i]['latitud'];
      long = baseDeDatosInfo[i]['longitud'];
      nombre = baseDeDatosInfo[i]['nombre'];
      if (nombre != userName) {
        agregarMarcador(nombre, [long, lat]) // agregar marcador al mapa
      }  
    }
  }