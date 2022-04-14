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
        // Se verifica si se creo una cuenta
        if ($stmt->execute()) {
            $message = 'Cuenta creada correctamente';
            header("Location: index.php");
        } else {
            $message = 'Lo sentimos, ocurrió un error creando tu cuenta';
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="assets/imagenes/miUbicacion.png" type="image/x-icon">
        <title>Registro</title>
        <link rel="stylesheet" href="assets/css/estilo_registro.php" media="screen">
    </head>
    <body>
        <div class="registro">
            <h1>REGISTRARSE</h1>
            <?php if (!empty($message)): ?>
                <p style="text-align: center;"> <?= $message ?> </p>
            <?php endif; ?>
            <form method="POST" action="registro.php">
                <div class="txt_field">
                    <input type="text" name="email" required>
                    <label>Correo</label>
                </div>
                <div class="txt_field">
                    <input type="text" name="nombre" required>
                    <label>Nombre</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="password" required>
                    <label>Contraseña</label>
                </div>
                <input type="submit" value="Ingresar">
                <div class="ingresar">
                    ¿Ya tienes cuenta? <a href="index.php"> Registrarse</a>
                </div>
            </form>
        </div>
    </body>
</html>