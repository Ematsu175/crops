<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2023 Laurent MINGUET
 */
require_once '../../../autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    $content = ob_get_clean();
    $content = '
    <html>
        <body>
            <h1>Esta es una prueba</h1>
            <p>
                Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. 
                Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, 
                cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó 
                una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.
                No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, 
                quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de 
                las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más 
                con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
                
            </p>
        </body>
    </html>';
    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $html2pdf->output('example00.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
