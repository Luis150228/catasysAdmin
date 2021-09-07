<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
// $t = ('U');
$a = ($_POST['id']);

$sql ="CALL deleteDiaLibre('$a')";
// echo $sql;

if ($result = mysqli_query($conn, $sql)) {
    $ver=mysqli_fetch_array($result);
    $arr = array(
        'mensaje' => $ver[0],
        'codigo' => $ver[1],
        'id' => $ver[2]
    );
    $data =  json_encode($arr);
    echo $data;
    mysqli_free_result($result);
}
mysqli_close($conn);

?>