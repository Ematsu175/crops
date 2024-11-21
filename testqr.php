<?php include('lib/phpqrcode/qrlib.php'); 
$file_name = 'qr/ejemplo.png';
QRcode::png('https://www.youtube.com/', $file_name,2,2,2);
?>