<?php
    session_start();    
    require 'database.php';


    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT email, password, nombre FROM usuarios WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';
        //&& password_verify($_POST['password'], $results['password'])
        if (count($results) > 0) {  // arreglar password
            $_SESSION['email'] = $results['email'];
            $_SESSION['nombre'] = $results['nombre']; // se crea una variable de sesion (Se puede acceder a esta desde otros .php)
            header("Location: mapa.php");
        } else {
            $message = 'Credenciales Incorrectos';    
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Ingresa</title>
        <link rel="stylesheet" href="assets/css/estilo_ingresar.css">
    </head>

    <body>
        <h2>Ingresar</h2>

        <?php if (!empty($message)): ?>
        <p> <?= $message ?> </p>
        <?php endif; ?>

        <form method="POST" action="ingresar.php">
            Email: <br/>
            <input type="text" name="email"><br/>
            Password: <br/>
            <input type="password" name="password"> <br/>
            <input type="submit" value="Ingresar">
        </form>
        <a href="index.php"> <p>Volver</p> </a>
    </body>
</html>