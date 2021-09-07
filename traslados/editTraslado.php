<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php');
?>
<?php
include (INCLUDE_PATH.'load.php');
include (LAYOUTSAPP_PATH.'head.php');
page_require_level(2);
$data_form = folioModal($_GET['id']);
$fomatoTD = dataValores('valores', 'AVISO TRASLADO');
?>
</head>

<title>CatovaTech Traslados</title>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-compact-menu material-vertical-layout material-layout 2-columns fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
<?php include (LAYOUTSAPP_PATH.'header.php');?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
<?php include (LAYOUTSAPP_PATH.'menu.php');?>  

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-header row">
            <div class="content-header-light col-12">
                <div class="row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <h3 class="content-header-title">CATOVATECH</h3>
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Administracion</a>
                                    </li>
                                    <li class="breadcrumb-item active">Sistema de Catastro
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right col-md-3 col-12">
                        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                            <button class="btn btn-success round box-shadow-2 px-2 mb-1" id="btnGroupDrop1" type="button"><a href="addTraslado.php">Agregar Traslado</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Traslado num Nota: <?php echo $data_form['folio']?>, Total a pagar : <strong id="strongTotal"><?php echo number_format($data_form['imp_total'],2)?></strong></h4>
                                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal" id="print">Imprimir</button>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                            <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                    <div id="mensajes"></div>
                                </div>
                                <div class="card-content collapse">
                                    <div class="card-body card-dashboard">
                                        <p class="card-text">Base de traslados</p>
                                        <form class="form form-horizontal" id="frmTraslados" name="frmTraslados" method="post">
                                            <input type="hidden" id="nota" name="nota" value="<?php echo $data_form['folio']?>">
                                            <input type="hidden" id="usr_genera" name="usr_genera" value="<?php echo $data_form['usr_genera']?>" >
                                            <input type="hidden" id="usr_mod" name="usr_mod" value="<?php echo $data_form['usr_mod']?>" >
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-home"></i> Datos del Predio </h4>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Aquiriente</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="adquiriente" type="text" name="adquiriente" id="adquiriente" class="form-control border-primary" placeholder="Adquiriente" value="<?php echo $data_form['adquiriente']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Enajenante</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Enajenante" type="text" name="enajenante" id="enajenante" class="form-control border-primary" placeholder="Enajenante" value="<?php echo $data_form['enajenante']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Tipo Predio</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <select data-toggle="tooltip" data-placement="top" title="Tipo de Movimiento" name="tipop" id="tipop"class="form-control border-primary" >
                                                                    <option selected value="<?php echo $data_form['tipop']?>"><?php if ( $data_form['tipop'] = 'U') {echo 'Urbano';} else {echo 'Rustico';}?></option>
                                                                    <option value="">Tipo de Predio</option>
                                                                    <option value="R">Rustico</option>
                                                                    <option value="U">Urbano</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Tipo Movimiento</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <select data-toggle="tooltip" data-placement="top" title="Tipo de Movimiento" name="tipoMovn" id="tipoMovn"class="select2 form-control border-primary" >
                                                                </select>
                                                                <input type="hidden" name="tipoMov" id="tipoMov" value="<?php echo $data_form['tipomov']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Fecha de Escritura</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Fecha Escritura" type="date" name="f_escr" id="f_escr" class="form-control border-primary" placeholder="Fecha Escritura" value="<?php echo $data_form['f_escr']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Fecha de Recepcion</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Fecha Recepcion" type="date" name="f_act" id="f_act" class="form-control border-primary" placeholder="Fecha Recepcion" value="<?php echo $data_form['f_act']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Notario</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <select data-toggle="tooltip" data-placement="top" title="Notario" name="notari" id="notari"class="select2 form-control border-primary" >
                                                                    <option selected value="<?php echo $data_form['notari']?>"><?php echo utf8_encode($data_form['notario'])?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Escritura</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="N° Escritura" type="text" name="num_escr" id="num_escr" class="form-control border-primary" placeholder="Num Escritura" value="<?php echo $data_form['num_escr']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Superficie</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Superficie" type="text" name="area" id="area" class="form-control border-primary" placeholder="Superficie" value="<?php echo $data_form['area']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Dias Trascurridos</label>
                                                            <div class="col-md-9 mx-auto" id="div_dias_tr">
                                                            <input data-toggle="tooltip" data-placement="top" title="Dias Transcurridos" type="text" name="dias_tr" id="dias_tr" class="form-control border-primary" placeholder="Dias" readonly value="<?php echo $data_form['dias_tr']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Cta Origen</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Cta Origen" type="text" name="cta_o" id="cta_o" class="form-control border-primary" placeholder="Cta Origen" value="<?php echo $data_form['cta_o']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Cta Apertura</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Cta Apertura" type="text" name="cta_ap" id="cta_ap" class="form-control border-primary" placeholder="Nvo Numero de cta." value="<?php echo $data_form['cta_ap']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Clave Catastral</label>
                                                            <div class="col-md-9 mx-auto" id="div_dias_tr">
                                                            <input data-toggle="tooltip" data-placement="top" title="Clave Catastral" type="text" name="c_catas" id="c_catas" class="form-control border-primary" placeholder="Clave Catastral" maxlength="20" value="<?php echo $data_form['c_catas']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="form-section"><i class="la la-bar-chart"></i> Valores y Referencias</h4>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1">Valor Fiscal</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="$ Fiscal" type="text" name="v_fisc" id="v_fisc" class="form-control border-primary" placeholder="Valor Fiscal" value="<?php echo number_format($data_form['v_fisc'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Valor Operacion</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="$ Operacion" type="text" name="v_operac" id="v_operac" class="form-control border-primary" placeholder="Valor Operacion" value="<?php echo number_format($data_form['v_operac'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Valor Pericial</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="$ Pericial" type="text" name="v_peric" id="v_peric" class="form-control border-primary" placeholder="Valor Pericial" value="<?php echo number_format($data_form['v_peric'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput1" >Tipo de Reduccion</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <select data-toggle="tooltip" data-placement="top" title="Tipo de Reduccion" name="tipo_uma" id="tipo_uma" class="form-control border-primary">
                                                                    <option value="<?php echo $data_form['tipo_uma']?>"><?php echo $data_form['tipo_uma']?> Anual</option>
                                                                    <option value="10 UMA">10 UMA Anual</option>
                                                                    <option value="15 UMA">15 UMA Anual</option>
                                                                    <option value="20 UMA">20 UMA Anual</option>
                                                                </select>
                                                                <input readonly type="number" name="imp_r_uma" id="imp_r_uma" class="form-control border-primary" value="<?php echo $data_form['imp_r_uma']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Base para calculo</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Valor base" type="text" name="b_imp_td" id="b_imp_td" class="form-control border-primary" placeholder="Base de Calculo" value="<?php echo number_format($data_form['b_imp_td'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Impuesto Traslacion de dominio</label>
                                                            <div class="col-md-9 mx-auto">
                                                            <input data-toggle="tooltip" data-placement="top" title="Impuesto Traslacion de dominio" type="text" name="imp_td" id="imp_td" class="form-control border-primary" placeholder="Base de Calculo" value="<?php echo number_format($data_form['imp_td'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                            <div class="form-group row">
                                                                <label class="col-md-3 label-control" for="userinput2">Division o Lotificacion</label>
                                                                <div class="col-md-9 mx-auto">
                                                                    <select data-toggle="tooltip" data-placement="top" title="Tipo de Division o lotificacion" name="tipovnt_select" id="tipovnt_select"class="form-control border-primary" ></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="col-md-3">
                                                            <div class="form-group row">
                                                                <label class="col-md-3 label-control" for="userinput2">Imp. Fraccion</label>
                                                                <div class="col-md-9 mx-auto">
                                                                    <select data-toggle="tooltip" data-placement="top" title="Tipo de venta Fracción" name="imp_fracc_select" id="imp_fracc_select"class="form-control border-primary" >
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Honorarios</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Honorarios" type="text" name="imp_hons" id="imp_hons" class="form-control border-primary" placeholder="Honorarios" value="<?php echo number_format($data_form['imp_hons'],2)?>">
                                                                <input data-toggle="tooltip" data-placement="top" title="Recibo Honorarios" class="form-control border-primary" placeholder="Recibo de Honorarios" type="text" name="honorarios_recibo" id="honorarios_recibo" value="<?php echo $data_form['honorarios_recibo']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Formato T.D.</label>
                                                            <div class="col-md-9 mx-auto">
                                                            <input data-toggle="tooltip" data-placement="top" title="Formato de Traslado" type="text" name="form_atd" id="form_atd" class="form-control border-primary" placeholder="Formato Traslado" value="$<?php echo number_format($fomatoTD['valor'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                    <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Constancia de no Adeudo</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Constancia de no Adeudos" type="text" name="imp_cert_na" id="imp_cert_na" class="form-control border-primary" placeholder="TD" value="$<?php echo number_format($data_form['imp_cert_na'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4 class="form-section"><i class="ft-pie-chart"></i> Calculo Preveiw</h4>

                                                <div class="row" id="divFracc" >
                                                    <div class="col-md-3">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">% Division</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="% Por Division" type="text" name="tipovnt" id="tipovnt" class="form-control border-primary" placeholder="% Por Division" value="<?php echo $data_form['tipovnt']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">$ Division</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="$ Imp  Division" type="text" name="impue_div" id="impue_div" class="form-control border-primary" placeholder="$ Imp  Division" value="<?php echo number_format($data_form['impue_div'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">% Fraccionamiento</label>
                                                            <div class="col-md-9 mx-auto">
                                                            <input data-toggle="tooltip" data-placement="top" title="% De Fraccionamiento" type="text" name="imp_fracc" id="imp_fracc" class="form-control border-primary" placeholder="% De Fraccionamiento" value="<?php echo $data_form['imp_fracc']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">% Fraccionamiento</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="$ Imp de Fraccionamiento" type="text" name="impue_fracc" id="impue_fracc" class="form-control border-primary" placeholder="$ Imp de Fraccionamiento" value="<?php echo $data_form['impue_fracc']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" id="multas_recargos" >
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Rango de dias</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Rango de dias" type="text" name="rangoDias" id="rangoDias" class="form-control border-primary" placeholder="Rango de Dias" value="<?php echo number_format($data_form['rango_dias'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Multas</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input data-toggle="tooltip" data-placement="top" title="Multas" type="text" name="imp_multa" id="imp_multa" class="form-control border-primary" placeholder="TD" value="<?php echo number_format($data_form['imp_multa'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput2">Recargos</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <input type="text" id="prc_recargo" name="prc_recargo" class="form-control border-primary" ata-toggle="tooltip" data-placement="top" title="PRCRecargos">
                                                                <input data-toggle="tooltip" data-placement="top" title="Recargos" type="text" name="imp_recar" id="imp_recar" class="form-control border-primary" placeholder="TD" value="<?php echo number_format($data_form['imp_recar'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control" for="userinput5">Total</label>
                                                            <div class="col-md-9 mx-auto">
                                                                <h4 id="totalH4">Total a pagar $ <?php echo number_format($data_form['imp_total'],2)?></h4>
                                                                <input class="form-control border-primary" type="hidden" placeholder="Total a Pagar" id="imp_total" name="imp_total" value="<?php echo number_format($data_form['imp_total'],2)?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions text-right">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                                <button type="button" class="btn btn-secondary mr-1" id="calcular">
                                                    <i class="ft-play"></i> Calcular
                                                </button>
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#default">
                                                        Guardar
                                                    </button>
                                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#default">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button> -->
                                            </div>

                                            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                        <input type="hidden" class="form-control" id="nameUser" placeholder="" readonly value="<?php echo remove_junk(ucfirst($user['name']));?>">
                                                                        <input type="hidden" class="form-control" id="usr_mod" placeholder="" readonly value="<?php echo remove_junk(ucfirst($user['username']));?>">
                                                                    <fieldset class="form-group floating-label-form-group">
                                                                        <label for="title">Estatus</label>
                                                                        <select class="form-control" id="status_traslado" name="status_traslado">
                                                                        <option selected value="Abierto">Abierto</option>
                                                                        <option value="Preautorizar">Preautorizar</option>
                                                                        <option value="Cancelado">Cancelado</option>
                                                                        </select>
                                                                    </fieldset>
                                                                    <br>
                                                                    <fieldset class="form-group floating-label-form-group">
                                                                        <label for="title1">Description</label>
                                                                        <textarea class="form-control" id="obs_pre" name="obs_pre" rows="1" placeholder="Motivo de la modificacion" require></textarea>
                                                                    </fieldset>
                                                                    <br>
                                                                    <fieldset class="form-group floating-label-form-group">
                                                                        <label for="title1">Historial</label>
                                                                        <textarea class="form-control" readonly id="view_obs_pre" name="view_obs_pre" rows="3"><?php echo $data_form['obs_pre']?></textarea>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-outline-primary" id="save">Guardar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php include (LAYOUTSAPP_PATH.'footer.php');?>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <?php include (LAYOUTSAPP_PATH.'scripts.php');?>
    <script src="../js/app.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>