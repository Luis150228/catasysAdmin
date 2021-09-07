<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
$t = ($_POST['id']);
// $t = ('6');

$sql ="CALL valoresGral('$t');";
if ($result = mysqli_query($conn, $sql)) {
    $ver = mysqli_fetch_array($result);
        $arr = array(
            'id' => $ver[0],
            'name' => $ver[1],
            'valor' => $ver[2]
        );
        $data = json_encode($arr);
        echo $data;
        mysqli_free_result($result);
}

mysqli_close($conn);
?>


