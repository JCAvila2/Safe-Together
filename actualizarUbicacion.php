<?php 

    require 'database.php';

    $ubicacion = json_decode($_POST['nuevaLocalizacion']);
    $email = ($ubicacion->email);
    $latitud = ($ubicacion->latitud);
    $longitud = ($ubicacion->longitud);

    
    print_r("Usuario: " . $email .  " Lat: " . $latitud . " Long: " . $longitud);


    $sql = "UPDATE usuarios SET latitud = '$latitud', longitud = '$longitud' WHERE email = '$email';";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        print_r(" Enviado correctamente.");
    } else {
        print_r(" Error al actualizar las coordenadas en la base de datos.");
    }
    

?>