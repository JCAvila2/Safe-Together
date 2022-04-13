<?php
    //session_start();
    require 'database.php';
    $sql = 'SELECT email, nombre, latitud, longitud FROM usuarios';


    //ejecutar query
    $records = $conn->prepare($sql);
    $records->execute();

    //traducir para imprimir
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
    
    print_r($results);

?>
<!DOCTYPE html>
<html>
    <hear>
        <title>Prueba de query</title>
    </hear>

    <body> 

    <h2>Este es el html de la query</h2>

    </body>



</html>


