<?php

require 'db_conn.php';

$mensajeError = '';

if (!empty($_POST['apellidos']) &&
    !empty($_POST['nombre']) &&
    !empty($_POST['dni']) &&
    !empty($_POST['email']) &&
    !empty($_POST['passwordConfirm']) &&
    !empty($_POST['password']
    )) {

    /*Comprobar si existe ese email o dni ya que son unique*/

    $consultaEmail = 'SELECT email FROM usuario where email=' . $_POST['email'] . ';';
    $consultaDni = 'SELECT dni FROM usuario where email=' . $_POST['dni'] . ';';

    if ($consultaDni) {
        $mensajeError = '- El DNI que está intentando registrar ya existe.<br>';
    }
    if ($consultaEmail) {
        $mensajeError += '- El EMAIL que está intentando registrar ya existe.<br>';
    }

    /*Comprobar contraseñas*/
    if ($_POST['password'] != $_POST['passwordConfirm']) {
        $mensajeError += '- El EMAIL que está intentando registrar ya existe.<br>';
    } else {
        /* Si no existen y la pass es correcta */
        if (!$consultaDni && !$consultaEmail) {
            $insertUsuario = "INSERT INTO usuario (nombre,apellidos, dni,email, password) 
                    VALUES (:nombre, :apellidos,:dni,:email,:password)";
            $statement = $conn->prepare($insertUsuario);
            $statement->bindParam(':nombre', $_POST['nombre']);
            $statement->bindParam(':apellidos', $_POST['apellidos']);
            $statement->bindParam(':dni', $_POST['dni']);
            $statement->bindParam(':email', $_POST['email']);

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
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <script src="js/scriptRegistro.js"></script>
</head>
<body>

<?php if (!empty($mensajeError)): ?>
    <p> <?= $mensajeError ?></p>
<?php endif; ?>

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
</form>

</body>
</html>