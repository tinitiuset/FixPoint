<?php

require 'db_conn.php';

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

    $consultaEmail = 'SELECT email FROM usuario where email=' .$email . ';';
    $consultaDni = 'SELECT dni FROM usuario where email=' . $dni . ';';

    $query = $conn->prepare($consultaEmail);
    $query->execute();
    $execQuery = $query->fetch();




    if($execQuery->ro > 0){
        $queryEmail = false;
    }
    else{
        $queryEmail = true;
    }

    echo $queryEmail;

    if ($queryEmail) {
        $mensajeError = '- El DNI que está intentando registrar ya existe.<br>';
    }
    if ($consultaEmail) {
        $mensajeError .= '- El EMAIL que está intentando registrar ya existe.<br>';
    }


    /* Si no existen y la pass es correcta */
    if (!$consultaDni && !$consultaEmail) {
        $insertUsuario = "INSERT INTO usuario (nombre,apellidos, dni,email, password) 
                    VALUES (:nombre, :apellidos,:dni,:email,:password)";
        $statement = $conn->prepare($insertUsuario);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':apellidos', $apellidos);
        $statement->bindParam(':dni', $dni);
        $statement->bindParam(':email', $email);

        /*HASHEAMOS la contraseña por seguridad*/
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $statement->bindParam(':password', $password);

        /*Ejecutamos consulta*/

        if ($statement->execute()) {
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
    <script src="js/scriptRegistro.js"></script>
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