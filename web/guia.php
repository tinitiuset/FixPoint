<?php

use Grupo3\FixPoint\model\CreadorGuia;
use Grupo3\FixPoint\model\guiaDespiece;
use Grupo3\FixPoint\model\User;
use Mpdf\Mpdf;

require_once "functions.php";
require_once __DIR__ . '/../vendor/autoload.php';



$args = [
    'title' => 'Guia despiece',
    'styles' => [
        'css/footer.css',
        'css/index.css',
        'css/header.css',
        'css/ventanasModales.css',
        'css/guia.css',
        'css/productos.css'
    ],

    'scripts' => [
        'js/menu.js',
        'js/slider.js',
        'js/modales.js',
        'js/scriptRegistro.js',
        'js/logout.js'
    ]
];

function getContent()
{
    try {
        $guia = new guiaDespiece('', '', '', '', '', '');
        $guia->getGuiaDespiece($_POST['id']);

        $creadorGuia = new creadorguia();
        $creadorGuia->getCreadorGuiaByNumFicha($guia->getNumFicha());

        $usuario = new User();
        $usuario->getUserPublicData($creadorGuia->getDni());

        $pasos = '';
        foreach ($guia->getPasos() as $paso) {
            $pasos .= '
                    <tr>
                        <td>'.$paso['detalle'].'</td>
                        <td><img src="'.$paso['foto'].'" alt=""></td>
                    </tr>';
        }

        $content= '
        <div class="guia-container-wrapper">
        <div class="guia-container" style="width: 100%;">
        <br/>
        <!--Datos tecnicos-->
        <table style="border: 1px solid black; width: 100%;">
            <tbody>
              <tr>
                <td class="tg-0lax" colspan="2" rowspan="2" style="border: 1px solid black; font-weight: bold">FICHA DE REPARACION</td>
                <td class="tg-0lax" style="border: 1px solid black;">NUMERO DE FICHA</td>
                <td class="tg-0lax" style="border: 1px solid black;">'.$guia->getNumFicha().'</td>
              </tr>
              <tr>
                <td class="tg-0lax" style="border: 1px solid black;">FECHA</td>
                <td class="tg-0lax" style="border: 1px solid black;">'.$guia->getFecha().'</td>
              </tr>
              <tr>
                <td class="tg-0lax">NOMBRE</td>
                <td class="tg-0lax" colspan="3">'.$usuario->getNombre().'</td>
              </tr>
              <tr>
                <td class="tg-0lax">APELLIDOS</td>
                <td class="tg-0lax" colspan="3">'.$usuario->getApellidos().'</td>
              </tr>
              <tr>
                <td class="tg-0lax">CICLO DE REFERENCIA</td>
                <td class="tg-0lax" colspan="3"></td>
              </tr>
              <tr>
                <td class="tg-0lax">CORREO ELECTRONICO</td>
                <td class="tg-0lax" colspan="3">'.$usuario->getEmail().'</td>
              </tr>
            </tbody>
        </table>
        <!--Tabla Informacion-->
        <table style="width: 100%; border: 1px solid black;">
            <thead>
              <tr>
                <th colspan="2" style="border: 1px solid black;">INFORMACION DEL OBJETO A REPARAR</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>¿Que es?</td>
                <td>'.$guia->getPropuesta().'</td>
              </tr>
              <tr>
                <td>¿Que le ocurre?</td>
                <td>'.$guia->getAverias().'</td>
              </tr>
              <tr>
                <td>¿Que te propones hacer?</td>
                <td>'.$guia->getSolucion().'</td>
              </tr>
            </tbody>
            </table>
            <!--Tabla Pasos-->
            <table style="width: 100%; border: 1px solid black;">
                <thead>
                  <tr>
                    <th style="border: 1px solid black;">SEGUIMIENTO DE LA REPARACION</th>
                    <th style="border: 1px solid black;">DETALLES (FOTOS)</th>
                  </tr>
                </thead>
                <tbody>
                  '.$pasos.'
                </tbody>
            </table>
        </div>
        </div>
        ';


    } catch (Exception $e) {
        $content= 'No se ha selecionado niguna guia,'.$e.' ';
    }
    return $content;
}
function pdfForm()
{
    $content= '
            <div style="width: 80%">
                <br/>
                <form method="post" action="pdf.php">
                <input type="hidden" name="html" value="'.base64_encode(getContent()).'">
                <div class="downloadTextBox">
                    <label class="formButton">¡Descarga este PDF haciendo click en el botón! &nbsp;<span></span><input type="submit" class="boton" name="accion" formaction="./pdf.php" value="Descargar PDF" /></label>
                </div>
                </form>
                <br/> 
            </div>
        ';
    echo $content;
}

getHeader($args);
pdfForm();
echo(getContent());
pdfForm();
getFooter($args);
