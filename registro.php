<?php
    require 'database.php';

    $message = ""; 

    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nombre'])) { 
        $sql = "INSERT INTO usuarios (email, nombre, password) VALUES (:email, :nombre, :password)";
        $stmt = $conn->prepare($sql);
        $stmt-> bindParam(':email', $_POST['email']);
        $stmt-> bindParam(':nombre', $_POST['nombre']);

        // Se hashean las contraseñas
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam('password', $password);
    
        if ($stmt->execute()) {
            $message = 'Successfully created new user';
            header("Location: ingresar.php");
        } else {
            $message = 'Sorry, there was an error creating your acount, try again later.';
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Registro</title>
        <link rel="stylesheet" href="assets/css/estilo_registro.css">
    </head>
    <body>
        <h2> Registro </h2>

        <?php if (!empty($message)): ?>
        <p> <?= $message ?> </p>
        <?php endif; ?>


        <form method="POST" action="registro.php">
            Email: <br/>
            <input type="text" name="email"><br/>
            Nombre:<br/>
            <input type="text" name="nombre"><br/>
            Password: <br/>
            <input type="password" name="password"> <br/>
            Confirmar Password:<br/>
            <input type="password" name="confirmPassword"> <br/>

            <input type="submit" value="Registrarse">
        </form>

        <a href="index.php"> <p>Volver</p> </a>

    </body>


</html>