<?php
    session_start();    
    require 'database.php';
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT email, password, nombre FROM usuarios WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $message = '';
        if (!empty($results) && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['email'] = $results['email']; // se crea una variable de sesion (Se puede acceder a esta desde otros .php)
            $_SESSION['nombre'] = $results['nombre']; // se crea una variable de sesion (Se puede acceder a esta desde otros .php)
            header("Location: mapa.php");
        } else {
            $message = 'Correo o Contraseña Incorrectos';    
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ingresar</title>
        <link rel="stylesheet" href="assets/css/estilo_ingresar.php" media="screen">
    </head>
    <body>
        <div class="center">
            <h1>INGRESAR</h1>
            <?php if (!empty($message)): ?>
                <p style="text-align: center;"> <?= $message ?> </p>
            <?php endif; ?>
            <form method="POST" action="ingresar.php">
                <div class="txt_field">
                    <input type="text" name="email" required>
                    <label>Correo</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="password" required>
                    <label>Contraseña</label>
                </div>
                <input type="submit" value="Ingresar">
                <div class="registro">
                    ¿No tienes cuenta? <a href="registro.php">Crear cuenta</a>
                </div>
            </form>
        </div>
    </body>
</html>