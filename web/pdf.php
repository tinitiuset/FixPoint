<?php

use Mpdf\Mpdf;
use Mpdf\MpdfException;

require_once __DIR__ . '/../vendor/autoload.php';
if (isset($_POST['html'])) {
    try {
        $mpdf = new Mpdf([
            'mode' => 'c',
            'tempDir' => __DIR__ . '/pdf'
        ]);
        $mpdf->WriteHTML(base64_decode($_POST['html']));
        $mpdf->Output();
    } catch (MpdfException $e) {
        echo($e);
    }
} else {
    echo 'Error Inesperado';
}
