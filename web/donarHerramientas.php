<?php
use Grupo3\FixPoint\Connection;

require "functions.php";


$args = [
    'title' => 'Donar Herramientas',
    'styles' => [
        'css/footer.css',
        'css/header.css',
        'css/index.css',
        'css/ventanasModales.css',
        'css/donar.css',
    ],
    'scripts' => [
        'js/menu.js',
        'js/slider.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js',
        'js/reservar.js',
    ]
];

function comprobarYEnviar(): string {
        if (!empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['email']) && !empty($_POST['donacion'])) {
            $name = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $telf = $_POST['telefono'];
            $msg = $_POST['donacion'];
            Connection::executeQuery("INSERT INTO solicituddonacion (nombre, apellidos, email, telefono, donacion)
            VALUES ('$name', '$apellidos', '$email', '$telf', '$msg')");
        return "Gracias por su colaboración, nos pondremos en contacto con usted.";

        } 
}

function getContent () {
    
    $content= '
    <h1 id="tituloTools">¡Necesitamos herramientas!</h1>
    <div class="containerDonar">
        <div Class="imagen">
            <img class="imgHerramientas" src="./img/herramienta.jpeg">
        </div>
        <div class="parrafos">
            <p class="textDonar">Para mantener la biblioteca de herramientas de FixPoint en funcionamiento,
                pedimos a las personas que donen herramientas</p>
            <p class="textDonar">Estamos muy interesados ​​en donaciones de herramientas manuales, eléctricas, 
                de jardín, equipos de pintura, escaleras y maquinaria para trabajar la madera. 
                También nos gustaría herramientas más especializadas para trabajos como enyesado,
                alicatado y reparación de bicicletas. Para ser honesto, estamos abiertos a ofertas
                de cualquier otra herramienta que le gustaría donar.</p>
            <p class="textDonar">Idealmente, nos gustaría herramientas que estén en buenas condiciones para estar 
                listas para usar, pero también consideraremos herramientas que necesitan reparaciones
                para poder practicar en el taller de despiece</p>
            <p class="textDonar">Si tienes algo para donar, ¡nos encantaría saberlo!
                Solo completa el formulario de abajo y recibiras un correo con las instrucciones. ¡Gracias!</p>
        </div>
        <div class="formulario">
            <form action="" method="post" id="formularioDonacion">
                <div class="contenedor">
                    <fieldset>
                        <legend class="title">
                            <Font>Nombre</font>
                            <span>*</span>
                        </legend>
                        <div class="nombreApellido">
                            <label class="nombre">
                                <input class="inputForm" type="text" name="nombre" id="nombreDonar" required autofocus><br>
                                <span class="nombre">Primer nombre</span>
                            </label>
                        </div>
                        <div class="nombreApellido">
                            <label class="nombre">
                                <input class="inputForm" type="text" name="apellidos" id="apellidosDonar" required><br>
                                <span class="nombre">Apellidos</span>
                            </label>
                        </div>
                    </fieldset>
                    <div>
                        <label class="titulo">Correo electrónico
                            <span>*</span>
                            <input class="inputForm" type="text" name="email" placeholder="Email@ejemplo.com" 
                            required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" requiered>
                        </label>
                    </div>
                    <div>
                        <label class="titulo">Número de teléfono
                            <input class="inputForm" type="text" name="telefono"
                            placeholder="000 00 00 00" required pattern="[0-9]{9}">
                        </label>
                    </div>
                    <div>
                        <label class="titulo">¿Qué le gustaría donar?
                            <span>*</span>
                            <textarea id="textArea" name="donacion" required></textarea>
                        </label>
                    </div>
                    <?php if (!empty($mensajeEnvio)): ?>
                        <p> <?= $mensajeEnvio ?></p>
                    <?php endif; ?>

                    </div>
                    <p id="mensajeEnvio"><?= $mensajeEnvio ?>
                    ' . comprobarYEnviar() . '
                    </p>
                    <input class="btnEnviar" type="submit" value="Enviar">
                </div>    
            </form>
        </div>
    </div>
    ';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);