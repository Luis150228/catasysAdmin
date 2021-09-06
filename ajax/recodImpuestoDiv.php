<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
// $t = ('U');
$t = ($_POST['tipop']);

$sql ="CALL valoresImpDivision('$t');";

$result=mysqli_query($conn,$sql);

$cbx = "<option selected value=''>Division/Lotificacion</option>";

while ($ver=mysqli_fetch_row($result)) {
    $cbx=$cbx.'<option value='.$ver[2].'>'.utf8_encode($ver[1]).'</option>';
}

echo  $cbx;
// if ($result = mysqli_query($conn, $sql)) {
//     while ($ver = mysqli_fetch_row($result)) {
//         $arr = array(
//             'id' => $ver[0],
//             'name' => $ver[1],
//             'valor' => $ver[2]
//         );
//         // $data = json_encode($arr);
//         // echo $data;
//         // echo ',';
//         echo $arr[0];
//     }
// }

// mysqli_free_result($result);
// mysqli_close($conn);
?>


