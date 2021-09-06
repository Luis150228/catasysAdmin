<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
$e = ($_POST['f_escr']);
$r = ($_POST['f_act']);

// $sql = "call multas_recargos('$e', '$r')";
$sql ="CALL formatoTD()";

if ($result = mysqli_query($conn, $sql)) {
    $ver=mysqli_fetch_array($result);
    $arr = array(
        'formato' => $ver[0],
        'noAdeudo' => $ver[1]
    );
    $data =  json_encode($arr);
    echo $data;
    mysqli_free_result($result);
}
mysqli_close($conn);
?>


