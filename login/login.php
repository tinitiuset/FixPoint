<?php
session_start();

if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_email'])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Secure Login System PHP</title>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
    <div>
        <form class="p-5 rounded shadow"
              action="auth.php"
              method="post">
            <h1>LOGIN</h1>
            <!-- recibe la variable si existe desde auth.php -->
            <?php if (isset($_GET['error'])) { ?>
                <!-- Aqui meter alerta  -->
                <div class="alert alert-danger" role="alert">
                    <!-- htmlspecialchars convierte el mayor y menor en entidades html para que puedan mostrarse
                     y verse sin tratarlas-->
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="inputEmail"
                       >Email
                </label>
                <input type="email"
                       name="email"
                       value="<?php if (isset($_GET['email'])) echo(htmlspecialchars($_GET['email'])) ?>"
                       class="form-control"
                       id="inputEmail">
            </div>
            <div class="mb-3">
                <label for="inputPassword"
                       class="form-label">Contraseña
                </label>
                <input type="password"
                       name="password"
                       id="inputPassword">
            </div>
            <button type="submit"
            >LOGIN
            </button>
        </form>
    </div>
    </body>
    </html>

    <?php
} else {
    header("Location: index.php");
}
?>
