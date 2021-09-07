<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
$e = ($_POST['f_escr']);
$r = ($_POST['f_act']);

// $sql = "call multas_recargos('$e', '$r')";
$sql ="CALL pdiasLaborales('$e', '$r')";

if ($result = mysqli_query($conn, $sql)) {
    $ver=mysqli_fetch_array($result);
    $content = $ver[0];    
    echo $content;
    mysqli_free_result($result);
}
mysqli_close($conn);

?>


