<?php 
    session_start();
    $nombreDeUsuario = $_SESSION['nombre']; // se agrega el nombre en la pantalla
    // falta agregar las demas variables de la base de datos para el mapa

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
    <title>Safe Together</title>
    <link rel="stylesheet" href="assets/css/estilo_mapa.css">
    <script src="assets/js/script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="parent">
            <a class="titulo" href="#">Safe Together</a>
            <a href="salir.php" style="text-decoration:none; color:white"> <div class="nombreUsuario" id="username">  <i class="fa fa-user-circle-o" aria-hidden="true"></i> </div></a>
        </div>
    </header>

    <div id='map'></div> <!-- Mapbox -->
    
    <!-- Obtener los datos de php para enviarlos a js -->
    <script> 
        <?php
            echo "var jsvar = '$nombreDeUsuario';"
        ?>
    </script>

    <a href="salir.php">salir</a>
    
</body>
</html>