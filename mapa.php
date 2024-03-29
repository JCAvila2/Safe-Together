<?php
    session_start();
    $emailDeUsuario = $_SESSION['email'];
    $nombreDeUsuario = $_SESSION['nombre'];
    require 'database.php';    
    $sql = 'SELECT email, nombre, latitud, longitud FROM usuarios';
    //ejecutar query
    $records = $conn->prepare($sql);
    $records->execute();
    // convertir en un objeto
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
        <link rel="icon" href="assets/imagenes/miUbicacion.png" type="image/x-icon">
        <title>Safe Together</title>
        <link rel="stylesheet" href="assets/css/estilo_mapa.css">
        <script src="assets/js/script.js" defer></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <div class="parent">
                <a class="titulo" href="salir.php"> Safe Together </a>
                <a href="salir.php" class="change-icon" style="text-decoration:none; color:white;"> 
                    <div class="nombreUsuario"> 
                        <span class="change-icon">   
                            <i class="fa fa-user-circle-o" aria-hidden="true"> <i style="font-family: verdana; font-size: 1vw;"> <?php echo $nombreDeUsuario ?> </i> </i>   
                            <i class="fa fa-sign-out " aria-hidden="true"> <i style="font-family: verdana; font-size: 1vw;"> Salir </i> </i>  
                        </span> 
                    </div> 
                </a>
            </div>
        </header>
        <div id='map'></div> <!-- Mapbox -->        

        <!-- Obtener los datos de php para enviarlos a js -->
        <script> 
            var baseDeDatosInfo = <?php echo json_encode($results)?> // objeto con las coordenadas de otros usuarios
            <?php
                echo "var userName = '$nombreDeUsuario';";
                echo "var userEmail = '$emailDeUsuario';";
            ?>
        </script>
    </body>
</html>