<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos

$id = ($_POST['id']);
$desc = ($_POST['descripcion']);
$valor = ($_POST['valor']);
$sustento = ($_POST['sustento']);

$sql ="CALL saveValores('$id', '$desc', '$valor', '$sustento')";
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