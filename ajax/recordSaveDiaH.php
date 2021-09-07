<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos

$id = ($_POST['id']);
$desc = ($_POST['descripcion']);
$ini = ($_POST['f_ini']);
$fin = ($_POST['f_fin']);

$sql ="CALL saveDiaLibre('$id', '$desc', '$ini', '$fin')";
// echo $sql;
if ($result = mysqli_query($conn, $sql)) {
    $ver=mysqli_fetch_array($result);
    $arr = array(
        'id' => $ver[2],
        'codigo' => $ver[1],
        'mensaje' => $ver[0]
    );
    $data =  json_encode($arr);
    echo $data;
    mysqli_free_result($result);
}
mysqli_close($conn);
?>



