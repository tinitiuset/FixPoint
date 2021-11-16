<?php

use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

require_once __DIR__ . '/../vendor/autoload.php';
if (isset($_POST['html'])) {
    try {
        $mpdf = new Mpdf([
            'mode' => 'c',
            'tempDir' => __DIR__ . '/pdf'
        ]);
        $stylesheet = file_get_contents(__DIR__.'/css/guia.css');
        $html = '
                <div>
                    <table style="width: 100%; border: 1px solid black">
                    <tbody>
                      <tr>
                        <td style="width: 25%"><img src="./img/LogoFix-250px.png" alt="FixPoint"></td>
                        <td style="width: 50%"></td>
                        <td style="width: 25%"><img src="./img/picofrentes.png" alt="Pico Frentes" style="padding-left: 5% "></td>
                      </tr>
                    </tbody>
                    </table>
                </div>';
        $html .= base64_decode($_POST['html']);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    } catch (MpdfException $e) {
        echo($e);
    }
} else {
    echo 'Error Inesperado';
}
