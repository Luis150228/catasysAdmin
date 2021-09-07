<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
// $t = ('U');
$t = ($_POST['tipop']);

$sql ="CALL valoresTipoFraccion('$t');";

$result=mysqli_query($conn,$sql);

$cbx = "<option selected value=''>Tipo Fraccionamiento</option>";

while ($ver=mysqli_fetch_row($result)) {
    $cbx=$cbx.'<option value='.$ver[2].'>'.utf8_encode($ver[1]).'</option>';
}

echo  $cbx;
?>


