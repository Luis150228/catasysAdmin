<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
$e = ($_POST['f_escr']);
$r = ($_POST['f_act']);

$sql ="CALL multas_recargos('$e', '$r')";

if ($result = mysqli_query($conn, $sql)) {
    $ver=mysqli_fetch_array($result);
    $arr = array(
        'rango' => $ver[0],
        'multa' => $ver[1],
        'prcRecargo' => $ver[2]
    );
    $data =  json_encode($arr);
    echo $data;
    mysqli_free_result($result);
}
mysqli_close($conn);

?>


