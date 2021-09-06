<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
$e = ($_POST['f_escr']);
$r = ($_POST['f_act']);

$sql = "call multas_recargos('$e', '$r')";
if ($result = mysqli_query($conn, $sql)) {
    $ver=mysqli_fetch_array($result);

    $content = '
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-md-3 label-control" for="userinput2">Rango</label>
            <div class="col-md-9 mx-auto">
                <input data-toggle="tooltip" data-placement="top" title="Formato de Traslado" type="text" name="form_atd_show" id="form_atd_show" class="form-control border-primary" placeholder="TD" value="'.$ver[0].'">
                <input type="text" name="form_atd" id="form_atd" value="'.$ver[0].'">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-md-3 label-control" for="userinput2">Multas</label>
            <div class="col-md-9 mx-auto">
                <input data-toggle="tooltip" data-placement="top" title="Formato de Traslado" type="text" name="form_atd_show" id="form_atd_show" class="form-control border-primary" placeholder="TD" value='.$ver[1].'>
                <input type="number" name="form_atd" id="form_atd" value='.$ver[1].'>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label class="col-md-3 label-control" for="userinput2">Recargos</label>
            <div class="col-md-9 mx-auto">
            <input data-toggle="tooltip" data-placement="top" title="Formato de Traslado" type="text" name="form_atd_show" id="form_atd_show" class="form-control border-primary" placeholder="TD" value='.$ver[2].'>
            <input type="number" name="form_atd" id="form_atd" value='.$ver[2].'>
            </div>
        </div>
    </div>
    ';
    echo $content;
    mysqli_free_result($result);
}

// if ($resultado = mysqli_query($conn,$sql_update)) {

//     /* obtener el array asociativo */
//     while ($fila = mysqli_fetch_row($resultado)) {
//         printf ("%s (%s) (%s)\n", $fila[0], $fila[1], $fila[2]);
//     }
//     /* liberar el conjunto de resultados */
//     mysqli_free_result($resultado);
// }
/* cerrar la conexión */
mysqli_close($conn);

?>


