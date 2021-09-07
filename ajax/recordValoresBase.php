<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
$uma = ($_POST['tipo_uma']);
$v_fisc = str_replace(',','',($_POST['v_fisc']));
$v_operac = str_replace(',','',($_POST['v_operac']));
$v_peric = str_replace(',','',($_POST['v_peric']));
// $dias_tr = str_replace(',','',($_POST['dias_tr']));

$sql ="CALL valoresBase('$uma', '$v_fisc', '$v_operac', '$v_peric')";

if ($result = mysqli_query($conn, $sql)) {
    $ver=mysqli_fetch_array($result);
    // $data = $ver[0]; 
    $arr = array(
        'valorBase' => $ver[1],
        'impuestoTD' => $ver[2],
        'uma' => $ver[0]
    );
    $data =  json_encode($arr);
    echo $data;
    // print_r($data);
    mysqli_free_result($result);
}
mysqli_close($conn);
?>



