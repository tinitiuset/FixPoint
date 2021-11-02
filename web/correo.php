<?php

if (isset($_POST['Enviar'])) {
    if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['email']) && !empty($_POST[donacion])) {
        $name = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $msg = $_POST['donacion'];
        $header = "From: noreply@example.com" . "r\n";
        $header.= "Reply-To: noreply@example.com" . "r\n";
        $header.= "X-Mailer: PHP/". phpversion();
        $mail = @mail($mail, $nombre, $apellido, $msg, $header);
        if ($mail) {
            echo "<h4> El email se ha enviado correctamente</h4>";
        }


    }
    
}