<?php

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Iniciar Sesión</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1,
        maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="../CSS/CSS_InicioSesion.css">
    </head>
    <body>
        <div class="container">
            <header>
                <h1>Iniciar Sesión</h1>
                <p>Nuevo? <a  class="enlace" href="">Crear una cuenta</a></p>
            </header>
            <form action="" method="post">
                <p>Correo electrónico</p>
                <input type='email' placeholder="Email@ejemplo.com" 
                required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Utiliza un correo válido, con esta estructura:Email@ejemplo.com">
                <p>Contraseña <a href="" class="enlace">Se te olvidó?</a></p>
                <input type="password" name="pass" pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*"
                title="Una contraseña válida es un conjuto de caracteres, donde cada uno consiste de una letra mayúscula o minúscula, o un dígito. 
                La contraseña debe empezar con una letra y contener al menor un dígito" required>
                <p><input type="submit" class="btn-iniciarSesion" value="Iniciar sesión"></p>
            </form>
        </div>  
    </body>
</html>