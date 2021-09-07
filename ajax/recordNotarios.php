<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos

// $sql ="CALL notarios()";

// if ($result = mysqli_query($conn, $sql)) {
//     $ver=mysqli_fetch_array($result);
//     $arr = array(
//         'id' => $ver[0],
//         'nombre' => $ver[1]
//     );
//     $data =  json_encode($arr);
//     echo $data;
//     mysqli_free_result($result);
// }
// mysqli_close($conn);

$sql ="CALL notarios()";

$result=mysqli_query($conn,$sql);

$cbx = "<option value=''>Notarios</option>";

while ($ver=mysqli_fetch_row($result)) {
    $cbx=$cbx.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
}

echo  $cbx;

?>


