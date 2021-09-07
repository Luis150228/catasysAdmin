<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos

// $n = ($_POST['tipop']);
$n = ('2');

// $sql = "call multas_recargos('$e', '$r')";
$sql ="CALL printTraslado('$n')";

if ($result = mysqli_query($conn, $sql)) {
    $ver=mysqli_fetch_array($result);
    $arr = array(
        'nota' => $ver[0],
        'comprador' => $ver[1],
        'vendedor' => $ver[2],
        'tipo' => $ver[3],
        'num_escr' => $ver[4],
        'escriturado' => $ver[5],
        'recibido' => $ver[6],
        'tiempo' => $ver[7],
        'rango_dias' => $ver[8],
        'superficie' => $ver[9],
        'tipomov' => $ver[10],
        'ctaOrigen' => $ver[11],
        'ctaNueva' => $ver[12],
        'prcDivision' => $ver[13],
        'prcFracc' => $ver[14],
        'operación' => $ver[15],
        'fiscal' => $ver[16],
        'pericial' => $ver[17],
        'uma' => $ver[18],
        'impUMA' => $ver[19],
        'notario' => $ver[20],
        'capturo' => $ver[21],
        'firmCreador' => $ver[22],
        'diaCaptura' => $ver[23],
        'Autorizo' => $ver[24],
        'firmAutoriza' => $ver[25],
        'diaAutoriza' => $ver[26],
        'usr_mod' => $ver[27],
        'status_traslado' => $ver[28],
        'f_mod' => $ver[29],
        'efectos' => $ver[30],
        'cveCatastral' => $ver[31],
        'baseImpuestoTD' => $ver[32],
        'imp_cert_na' => $ver[33],
        'form_atd' => $ver[34],
        'imp_td' => $ver[35],
        'imp_hons' => $ver[36],
        'impue_div' => $ver[37],
        'impue_fracc' => $ver[38],
        'imp_recar' => $ver[39],
        'imp_multa' => $ver[40],
        'imp_total' => $ver[41]
    );
    $data =  json_encode($arr);
    // echo $data;
    mysqli_free_result($result);
}
mysqli_close($conn);
echo $ver[41];

?>


