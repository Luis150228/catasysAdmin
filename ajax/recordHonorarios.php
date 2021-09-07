<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos

// $a = str_replace(',','',($_POST['v_peric']));
$a = str_replace(',','',($_POST['v_peric']));
$b = ($_POST['tipop']);
$c = ($_POST['honorarios_recibo']);

// $sql = "call multas_recargos('$e', '$r')";
$sql ="CALL valoresHonorarios('$a', '$b', '$c')";

if ($result = mysqli_query($conn, $sql)) {
    $ver=mysqli_fetch_array($result);
    $arr = array(
        'honorarios' => $ver[0]
    );
    $data =  json_encode($arr);
    echo $data;
    mysqli_free_result($result);
}
mysqli_close($conn);

?>


