<?php

use Grupo3\FixPoint\Connection;

require '../web/Connection.php';

$mensajeError = '';

/* Conseguimos datos */


if (!empty($_REQUEST['apellidos']) &&
    !empty($_REQUEST['nombre']) &&
    !empty($_REQUEST['dni']) &&
    !empty($_REQUEST['email']) &&
    !empty($_REQUEST['passwordConfirm']) &&
    !empty($_REQUEST['password']
    )) {

    $apellidos = $_REQUEST['apellidos'];
    $nombre = $_REQUEST['nombre'];
    $dni = $_REQUEST['dni'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['passwordConfirm'];
    $passwordConfirm = $_REQUEST['password'];


    /*Comprobar si existe ese email o dni ya que son unique*/

    $queryEmail = "select email from usuario where email = '$email'";

    $sqlEmail = Connection::executeQuery($queryEmail);

    $numFilasSqlEmail = $sqlEmail->fetchAll();

    $queryDni = "SELECT dni FROM usuario where dni='$dni';";

    $sqlDni = Connection::executeQuery($queryDni);


    $numFilasSqlDni = $sqlDni->fetchAll();


    if ($numFilasSqlEmail) {
        $mensajeError .= '- El EMAIL que está intentando registrar ya existe.<br>';
    }
    if ($numFilasSqlDni) {
        $mensajeError .= '- El DNI que está intentando registrar ya existe.<br>';
    }


    if (!$numFilasSqlEmail && !$numFilasSqlDni) {


        echo "entre";

        /*HASHEAMOS la contraseña por seguridad*/
        $password = password_hash($password, PASSWORD_BCRYPT);
        $insertUsuario = "INSERT INTO usuario (nombre,apellidos, dni,email, password)
                        VALUES ('$nombre', '$apellidos','$dni','$email','$password')";

        /*Ejecutamos consulta*/

        if (Connection::executeQuery($insertUsuario)) {
            $mensajeError = 'Usuario creado correctamente';
        } else {
            $mensajeError = 'ERROR al crear el usuario, contacte con el administrador.';
        }
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <script src="../web/JS/scriptRegistro.js"></script>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>


<h1>SignUp</h1>
<span>or <a href="login.php">Login</a></span>

<form action="registro.php" id="formularioRegistro">
    <label for="dni">DNI</label>
    <input name="dni" type="text">
    <label for="nombre">nombre</label>
    <input name="nombre" type="text">
    <label for="apellidos">apellidos</label>
    <input name="apellidos" type="text">
    <label for="email">email</label>
    <input name="email" type="text">
    <label for="password">password</label>
    <input name="password" type="password">
    <label for="passwordConfirm">passwordConfirm</label>
    <input name="passwordConfirm" type="password">
    <input type="submit" value="Submit">

    <div class="alert alert-danger" id="alertwarning" role="alert">
        <?php if (!empty($mensajeError)): ?>
            <p> <?= $mensajeError ?></p>
        <?php endif; ?>

    </div>
    <p><?= $mensajeError ?></p>
</form>

</body>
</html>