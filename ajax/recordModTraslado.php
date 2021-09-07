<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos


$v_fisc = str_replace(',','',($_POST['v_fisc']));

$nota = ($_POST['nota']);
$adquiriente = ($_POST['adquiriente']);
$enajenante = ($_POST['enajenante']);
$tipop = ($_POST['tipop']);
$num_escr = ($_POST['num_escr']);
$f_escr = ($_POST['f_escr']);
$f_act = ($_POST['f_act']);
$dias_tr = ($_POST['dias_tr']);
$area = ($_POST['area']);
$tipoMov = ($_POST['tipoMov']);
$tipoMovn = ($_POST['tipoMovn']);
$cta_o = ($_POST['cta_o']);
$cta_ap = ($_POST['cta_ap']);
$tipovnt = ($_POST['tipovnt']);
$imp_fracc = ($_POST['imp_fracc']);
$honorarios_recibo = ($_POST['honorarios_recibo']);
$imp_hons = str_replace(',','',($_POST['imp_hons']));
$v_operac = str_replace(',','',($_POST['v_operac']));
$v_fisc = str_replace(',','',($_POST['v_fisc']));
$v_peric = str_replace(',','',($_POST['v_peric']));
$tipo_uma = ($_POST['tipo_uma']);
$imp_r_uma = str_replace(',','',($_POST['imp_r_uma']));
$imp_cert_na = str_replace(',','',($_POST['imp_cert_na']));
$form_atd = str_replace(',','',($_POST['form_atd']));
$notari = ($_POST['notari']);
$obs_pre = ($_POST['obs_pre']);
$usr_genera = ($_POST['usr_genera']);
$usr_mod = ($_POST['usr_mod']);
$status_traslado = ($_POST['status_traslado']);
$c_catas = ($_POST['c_catas']);
$b_imp_td = str_replace(',','',($_POST['b_imp_td']));
$imp_td = str_replace(',','',($_POST['imp_td']));
$impue_div = str_replace(',','',($_POST['impue_div']));
$impue_fracc = str_replace(',','',($_POST['impue_fracc']));
$imp_recar = str_replace(',','',($_POST['imp_recar']));
$imp_multa = str_replace(',','',($_POST['imp_multa']));
$imp_total = str_replace(',','',($_POST['imp_total']));

$sql ="CALL saveTraslados('$nota', '$adquiriente', '$enajenante', '$tipop', '$num_escr', '$f_escr', '$f_act', '$dias_tr', '$area', '$tipoMov', '$tipoMovn', '$cta_o', '$cta_ap', '$tipovnt', '$imp_fracc', '$honorarios_recibo', '$imp_hons', '$v_operac', '$v_fisc', '$v_peric', '$tipo_uma', '$imp_r_uma', '$imp_cert_na', '$form_atd', '$notari', '$obs_pre', '$usr_genera', '$usr_mod', '$status_traslado', '$c_catas', '$b_imp_td', '$imp_td', '$impue_div', '$impue_fracc', '$imp_recar', '$imp_multa', '$imp_total')";
// echo $sql;
if ($result = mysqli_query($conn, $sql)) {
    $ver=mysqli_fetch_array($result);
    $arr = array(
        'respuesta' => $ver[0],
        'id' => $ver[1]
    );
    $data =  json_encode($arr);
    echo $data;
    mysqli_free_result($result);
}
mysqli_close($conn);
?>



