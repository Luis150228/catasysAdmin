<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos

$sql ="CALL claves()";

$result=mysqli_query($conn,$sql);
$cbx = "<option value=''>Tipo Movimiento</option>";

while ($ver=mysqli_fetch_row($result)) {
    $cbx=$cbx.'<option value='.$ver[1].'>'.utf8_encode($ver[2]).'</option>';
}
mysqli_free_result($result);
mysqli_close($conn);

echo  $cbx;

?>


