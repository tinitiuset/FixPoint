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
        $guia->getGuiaDespiece(3); /*$_POST['id']*/

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
        <div>
        <br/>
        <!--Datos tecnicos-->
        <table border="1px solid black">
            <tbody>
              <tr>
                <td class="tg-0lax" colspan="2" rowspan="2">FICHA DE REPARACION</td>
                <td class="tg-0lax">NUMERO DE FICHA</td>
                <td class="tg-0lax">'.$guia->getNumFicha().'</td>
              </tr>
              <tr>
                <td class="tg-0lax">FECHA</td>
                <td class="tg-0lax">'.$guia->getFecha().'</td>
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
                <td class="tg-0lax">CIUDAD</td>
                <td class="tg-0lax"></td>
                <td class="tg-0lax">EDAD</td>
                <td class="tg-0lax"></td>
              </tr>
              <tr>
                <td class="tg-0lax">TELEFONO</td>
                <td class="tg-0lax" colspan="3"></td>
              </tr>
              <tr>
                <td class="tg-0lax">CORREO ELECTRONICO</td>
                <td class="tg-0lax" colspan="3">'.$usuario->getEmail().'</td>
              </tr>
            </tbody>
        </table>
        <!--Tabla Informacion-->
        <table border="1px solid black">
            <thead>
              <tr>
                <th colspan="2">INFORMACION DEL OBJETO A REPARAR</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>QUE ES?</td>
                <td>'.$guia->getPropuesta().'</td>
              </tr>
              <tr>
                <td>QUE LE PASA?</td>
                <td>'.$guia->getAverias().'</td>
              </tr>
              <tr>
                <td>QUE TE PROPONES HACER?</td>
                <td>'.$guia->getSolucion().'</td>
              </tr>
            </tbody>
            </table>
            <!--Tabla Pasos-->
            <table border="1px solid black">
                <thead>
                  <tr>
                    <th>SEGUIMIENTO DE LA REPARACION</th>
                    <th>DETALLES (FOTOS)</th>
                  </tr>
                </thead>
                <tbody>
                  '.$pasos.'
                </tbody>
            </table>
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
            <div>
                <form method="post" action="pdf.php">
                <input type="hidden" name="html" value="'.base64_encode(getContent()).'">
                <label class="formButton"><span> </span><input type="submit" name="accion" formaction="./pdf.php" value="Descargar PDF" /></label>
                </form> 
            </div>
        ';
    echo $content;
}

getHeader($args);
pdfForm();
echo(getContent());
pdfForm();
getFooter($args);
