<?php
// require('fpdf.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php');
include (PDF_PATH.'fpdf.php');
include (INCLUDE_PATH.'load.php');
include (QR_PATH.'qrlib.php');

$n = ($_GET['nota']);
$e = ($_GET['num_escr']);

$sql ="CALL printTraslado('$n', '$e')";

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
        'imp_total' => $ver[41],
        'elaoro' => $ver[42],
        'autorizo' => $ver[43],
        'itd' => $ver[44],
        'prcRecargos' => $ver[45]
    );
    mysqli_free_result($result);
}

mysqli_close($conn);

$fechas = date_default_timezone_set('America/Mexico_City');
$formatmoney = setlocale(LC_MONETARY, 'en_US');
$foryear = date("ym");
QRcode::png("http://localhost/TrasladosPhp/print/printTrasladoPublic.php?nota=$ver[0]&num_escr=$ver[4]", 'print.png');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../app-assets/images/logo/logo-80x80.png',10,8,30);
    $this->Image('print.png', 10, 250, 35, 35, 'png');
    $this->Image('print.png', 180, 8, 20, 20, 'png');
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Título
    $this->Cell(0,5,'TESORERIA MUNICIPAL',0,1,'C');
    $this->SetFont('Arial','B',7);
    $this->Cell(0,5,'SUBDIRECCION DE IMPUESTO INMOBILIARIO Y CATASTRO',0,1,'C');
    $this->Cell(0,5,'ADMINISTRACION 2020-2023',0,0,'C');
    $this->SetFont('Arial','B',15);
    $this->Ln(8);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada 190
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(242,243,244);
// $pdf->SetTextColor(255,255,255);
// $pdf->SetTextColor(112,128,144);
$pdf->Cell(113,5,'',0,0,'L',0);
$pdf->Cell(30,5,'Fecha de Calculo',1,0,'R',0);
$pdf->Cell(47,5,''.$ver[29],1,1,'R',0);//Salto

$pdf->Cell(113,5,'',0,0,'L',0);
$pdf->Cell(30,5,'Fecha de Pago',1,0,'R',0);
$pdf->Cell(47,5,'',1,1,'L',0);//Salto

$pdf->Cell(113,5,'',0,0,'L',0);
$pdf->Cell(30,5,'Num de Recibo',1,0,'R',0);
$pdf->Cell(47,5,'',1,1,'L',0);//Salto

$pdf->Cell(47,4,'NOTA : ',1,0,'L',1);
$pdf->Cell(47,4,$ver[0],1,0,'L',0);
$pdf->Cell(47,4,'TIPO PREDIO',1,0,'L',1);
$pdf->Cell(49,4,$ver[3],1,1,'L',0);//Salto

$pdf->Cell(47,4,'FECHA ESCRITURA : ',1,0,'L',1);
$pdf->Cell(47,4,$ver[5],1,0,'L',0);
$pdf->Cell(47,4,'FECHA NOTA',1,0,'L',1);
$pdf->Cell(49,4,$ver[6],1,1,'L',0);//Salto

$pdf->Cell(47,4,'NUM. ESCRITURA : ',1,0,'L',1);
$pdf->Cell(47,4,$ver[4],1,0,'L',0);
$pdf->Cell(47,4,'CVE MOV.',1,0,'L',1);
$pdf->Cell(49,4,$ver[10],1,1,'L',0);//Salto

$pdf->Cell(47,4,'CTA ORIGEN : ',1,0,'L',1);
$pdf->Cell(47,4,$ver[11],1,0,'L',0);
$pdf->Cell(47,4,'CTA APERTURA.',1,0,'L',1);
$pdf->Cell(49,4,$ver[12],1,1,'L',0);//Salto

$pdf->Cell(47,4,'EFECTO : ',1,0,'L',1);
$pdf->Cell(47,4,$ver[30],1,0,'L',0);
$pdf->Cell(47,4,'CVE. CATASTRAL',1,0,'L',1);
$pdf->Cell(49,4,$ver[31],1,1,'L',0);//Salto

$pdf->Cell(190,2,'',0,1,'C',0);//Salto

$pdf->Cell(47,4,'ENAJENANTE : ',1,0,'L',1);
$pdf->Cell(143,4,utf8_decode($ver[1]),1,1,'L',0);//Salto
$pdf->Cell(47,4,'ADQUIRIENTE : ',1,0,'L',1);
$pdf->Cell(143,4,utf8_decode($ver[2]),1,1,'L',0);//Salto
$pdf->Cell(47,4,'NOTARIO : ',1,0,'L',1);
$pdf->Cell(143,4,utf8_decode($ver[20]),1,1,'L',0);//Salto

$pdf->Cell(190,2,'',0,1,'C',0);//Salto

$pdf->Cell(35,4,'VALOR FISCAL: ',1,0,'C',1);
$pdf->Cell(31,4,number_format($ver[16]),1,0,'C',0);
$pdf->Cell(31,4,'VALOR OPERACION : ',1,0,'C',1);
$pdf->Cell(31,4,number_format($ver[15]),1,0,'C',0);
$pdf->Cell(31,4,'VALOR PERICIAL : ',1,0,'C',1);
$pdf->Cell(31,4,number_format($ver[17]),1,1,'C',0);
$pdf->Cell(190,4,'',0,1,'C',0);//Salto
$pdf->SetFont('Arial','B',10);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->Cell(190,4,'CALCULO PARA EL PAGO DE IMPUESTOS',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'(1) IMPUESTO SOBRE TRASLACION DE DOMINIO',1,0,'L',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,$ver[44],1,0,'C',0);
$pdf->Cell(31,4,$ver[35],1,1,'R',1);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'BASE DEL IMPUESTO',1,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,number_format($ver[32]+$ver[19]),1,0,'C',0);
$pdf->Cell(31,4,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'REDUCCION',1,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,number_format($ver[19]),1,0,'C',0);
$pdf->Cell(31,4,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'BASE P/IMPUESTO T.D.',1,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,number_format($ver[32]),1,0,'R',1);
$pdf->Cell(31,4,'',0,1,'C',0);//Salto

$pdf->Cell(190,3,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'(2) IMPUESTO SOBRE DIVISION Y LOTIFICACION ',1,0,'L',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,$ver[13],1,0,'C',0);
$pdf->Cell(31,4,$ver[37],1,1,'R',1);//Salto

$pdf->Cell(190,3,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(86,4,'(3) IMPUESTO DE FRACCIONAMIENTO ',1,0,'L',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(11,4,'Area: ',1,0,'C',0);
$pdf->Cell(31,4,$ver[9].' M2',1,0,'C',0);
$pdf->Cell(31,4,$ver[14],1,0,'C',0);
$pdf->Cell(31,4,$ver[38],1,1,'R',1);//Salto

$pdf->Cell(190,3,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'MULTAS Y RECARGOS',1,0,'L',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,$ver[8],1,0,'C',0);
$pdf->Cell(31,4,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'(4) RECARGOS',1,0,'L',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,$ver[45],1,0,'C',0);
$pdf->Cell(31,4,$ver[39],1,1,'R',1);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'(5) MULTAS',1,0,'L',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,$ver[7].' DIAS',1,0,'C',0);
$pdf->Cell(31,4,$ver[40],1,1,'R',1);//Salto

$pdf->Cell(190,3,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'(6) HONORARIOS DE VALUACION ',1,0,'L',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,'',1,0,'C',0);
$pdf->Cell(31,4,$ver[36],1,1,'R',1);//Salto

$pdf->Cell(190,3,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'(7) CONSTANCIA DE NO ADEUDO ',1,0,'L',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,'',1,0,'C',0);
$pdf->Cell(31,4,$ver[33],1,1,'R',1);//Salto

$pdf->Cell(190,3,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'(8) FORMATO TRASLADO DE DOMINIO ',1,0,'L',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,'',1,0,'C',0);
$pdf->Cell(31,4,$ver[34],1,1,'R',1);//Salto

$pdf->Cell(190,3,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(128,4,'',0,0,'L',0);
$pdf->Cell(31,4,'TOTAL A PAGAR ',1,0,'C',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(31,4,$ver[41],1,1,'R',1);//Salto

$pdf->Cell(190,3,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',9);
$pdf->Cell(93,4,'Municipio de Guanajuato, Gto.',0,0,'R',0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(4,4,'',0,0,'C',0);
$pdf->Cell(93,4,'01 de Septiembre de 2021',0,1,'L',0);//Salto

$pdf->Cell(190,4,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','', 9);
$pdf->Cell(93,4,'FIRMA DE AUTORIZACION',1,0,'C',1);
$pdf->Cell(4,4,'',0,0,'C',0);
$pdf->Cell(93,4,'FIRMA DE ELABORO',1,1,'C',1);//Salto

$pdf->Cell(93,15,'',1,0,'C',0);
$pdf->Cell(4,15,'',0,0,'C',0);
$pdf->Cell(93,15,'',1,1,'C',0);//Salto


$pdf->SetFont('Arial','',9);
$pdf->Cell(93,5,$ver[43],'T',0,'C',0);
$pdf->Cell(4,5,'',0,0,'C',0);
$pdf->Cell(93,5,$ver[42],'T',1,'C',0);//Salto

$pdf->Cell(190,1,'',0,1,'C',0);//Salto

$pdf->SetFont('Arial','',7);
$pdf->Cell(93,4,'DIRECTOR DE CATASTRO',0,0,'C',0);
$pdf->Cell(4,4,'',0,0,'C',0);
$pdf->Cell(93,4,'COORDINADOR DE PREDIAL',0,1,'C',0);//Salto

$pdf->Cell(190,3,'','B',1,'C',0);//Salto

$pdf->SetFont('Arial','',5);
$pdf->Cell(15,5,'CLAVE (1)',0,0,'L',0);
$pdf->MultiCell(175,5, utf8_decode('ART. 7 DE LA LEY DE INGRESOS PARA EL MUNICIPIO DE GUANAJUATO, GTO. - ART. 179, 179 BIS, 180,181,182, 183,184 Y 185 DE LA LEY DE HACIENDA PARA LOS MUNICIPIO DEL EDO.GTO.'),0, 'L');

$pdf->Cell(15,5,'CLAVE (2)',0,0,'L',0);
$pdf->MultiCell(175,5, utf8_decode('ART. 8, INCISO I, II Y III LEY DE INGRESOS PARA EL MUNICIPIO DE GUANAJUATO, GTO. - ART. 186, 187,188, 189 Y 191 DE LA LEY DE HACIENDA PARA LOS MUNICIPIOS DEL ESTADO DE GTO.'),0, 'L');

$pdf->Cell(15,5,'CLAVE (3)',0,0,'L',0);
$pdf->MultiCell(175,5, utf8_decode('ART. 9, Tarifas; LEY DE INGRESOS PARA EL MUNICIPIO DE GUANAJUATO, GTO. - ART. 186, 187,188, 189 Y 191 DE LA LEY DE HACIENDA PARA LOS MUNICIPIOS DEL ESTADO DE GTO.'),0, 'L');

$pdf->Cell(15,5,'CLAVE (4)',0,0,'L',0);
$pdf->MultiCell(175,5, utf8_decode('ART. 38, LEY DE INGRESOS PARA EL MUNICIPIO DE GUANAJUATO, GTO. - ART. 184 DE LA LEY DE HACIENDA PARA LOS MUNICIPIOS DEL ESTADO DE GTO.'),0, 'L');

$pdf->Cell(15,5,'CLAVE (5)',0,0,'L',0);
$pdf->MultiCell(175,5, utf8_decode('ART. 41, DIAS HABILES: LEY DE INGRESOS PARA EL MUNICIPIO DE GUANAJUATO, GTO. - ART. 186, 187,188, 189 Y 191 DE LA LEY DE HACIENDA PARA LOS MUNICIPIOS DEL ESTADO DE GTO.'),0, 'L');

$pdf->Cell(15,5,'CLAVE (6)',0,0,'L',0);
$pdf->MultiCell(175,5, utf8_decode('ART. 9, Tarifas; LEY DE INGRESOS PARA EL MUNICIPIO DE GUANAJUATO, GTO. - ART. 69 FRACC. I Y II, ART. 70 FRACC. I, ART. 73 FRACC. I, ART. 74 FRACC. I: DE LA LEY DE HACIENDA PARA LOS MUNICIPIOS DEL ESTADO DE GTO.'),0, 'L');

$pdf->Cell(15,5,'CLAVE (7)',0,0,'L',0);
$pdf->MultiCell(175,5, utf8_decode('ART. 32 FRACCION II, DE LA LEY DE INGRESOS PARA EL MUNICIPIO DE GUANAJUATO, GTO.'),0, 'L');

$pdf->Cell(15,5,'CLAVE (8)',0,0,'L',0);
$pdf->MultiCell(175,5, utf8_decode('DISPOSICION ADMINISTRATIVA.'),0, 'L');

$pdf->Cell(190,1,'','T',1,'C',0);//Salto

$pdf->SetFont('Arial','',7);
$pdf->Cell(2,4,'',0,0,'C',0);
$pdf->Cell(183,4,$ver[25].'&/&'.$ver[22],0,1,'R',0);

$pdf->Output();

?>