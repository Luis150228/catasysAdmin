<?php
$n = ($_GET['n']);
$e = ($_GET['e']);
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php');
include (QR_PATH.'qrlib.php');

QRcode::png('http://localhost/TrasladosPhp/print/printTraslado.php?n='.$n.'&e='.$e)

?>