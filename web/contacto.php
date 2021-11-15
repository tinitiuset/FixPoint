<?php
require "functions.php";

$args = [
    'title' => 'Contacto',
    'styles' => [
        'css/footer.css',
        'css/contacto.css',
        'css/index.css',
        'css/header.css',
        'css/ventanasModales.css',
    ],
    'scripts' => [
        'js/menu.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js',

    ]
];

function getContent()
{
    $content = '
    <div class="container-contact-general">
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4827.30567453729!2d-2.4836119677739594!3d41.766906901814!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x469c9525026cc4ad!2sCentro%20Integrado%20De%20Formaci%C3%B3n%20Profesional%20Pic%C3%B3%20Frentes!5e0!3m2!1ses!2ses!4v1635229473370!5m2!1ses!2ses"
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class="map-ubication">
        <ul class="contact-info">
            <li>
            <i class="fas fa-map-marker-alt"><span class="bold">&nbsp;Dirección</span></i>
                <p>C/ Gervasio Manrique de Lara, 2, 42004, Soria</p>
            </li>
            <li>
            <i class="fas fa-phone-alt"><span class="bold">&nbsp;Teléfono</span></i>
                <br>
                <p>975239443</p>
            </li>
            <li>
                <i class="fas fa-envelope"><span class="bold">&nbsp;Email</span></i>
                <p><a href="mailto:42007213@educa.jcyl.es">info@fixpoint.com</a></p>
            </li>
            <li>
                <i class="fas fa-globe-americas pimg"><span class="bold">&nbsp;Web</span></i><br>
                <p><a href="http://cifppicofrentes.centros.educa.jcyl.es" target="_blank">http://cifppicofrentes.centros.educa.jcyl.es</a>
                </p>
            </li>
        </ul>
    </div>
    <div class="bottom-information">
       <table class="scheduleTable">
            <tr>
               <td colspan="2">
                    <h2>Horario</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Lunes</p>
                </td>
                <td>
                    <p>10:00 – 15:00</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Martes</p>
                </td>
                <td>
                    <p>10:00 – 14:05</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Miercoles</p>
                </td>
                <td>
                    <p>Cerrado</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Jueves</p>
                </td>
                <td>
                    <p>10:00 – 14:05</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Viernes</p>
                </td>
                <td>
                    <p>10:00 – 14:05</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">Sabados, domingos y festivos cerrado</td>
            </tr>
       </table>
    </div>
</div>
    ';
    echo $content;
}

getHeader($args);
getContent();
getFooter($args);
