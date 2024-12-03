<?php
require ('../vendor/autoload.php');
require ('views/header/header_administrador.php');
require_once('invernadero.class.php');

$app=new Invernadero;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

$invernaderos = $app->readAll();

$activeWorksheet->setCellValue('A1', 'ID');
$activeWorksheet->setCellValue('B1', 'Nombre');
$activeWorksheet->setCellValue('C1', 'Area');
$activeWorksheet->setCellValue('D1', 'Latitud');
$activeWorksheet->setCellValue('E1', 'Longitud');
$activeWorksheet->setCellValue('F1', 'Fecha');

$row = 2;

foreach ($invernaderos as $invernadero) {
    $activeWorksheet->setCellValue('A' . $row, $invernadero['id_invernadero']);
    $activeWorksheet->setCellValue('B' . $row, $invernadero['invernadero']);
    $activeWorksheet->setCellValue('C' . $row, $invernadero['area']);
    $activeWorksheet->setCellValue('D' . $row, $invernadero['latitud']);
    $activeWorksheet->setCellValue('E' . $row, $invernadero['longitud']);
    $activeWorksheet->setCellValue('F' . $row, $invernadero['fecha_creacion']);
    $row++;
}

$writer = new Xlsx($spreadsheet);

$writer->save('invernaderos.xlsx');

echo "El archivo Excel ha sido generado con éxito.";
?>