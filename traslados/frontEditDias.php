<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php');
?>
<?php
include (INCLUDE_PATH.'load.php');
include (LAYOUTSAPP_PATH.'head.php');
page_require_level(2);
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
                        <h3 class="content-header-title">CATASYS</h3>
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Dias Inhabiles</a>
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
                <section id="sizing">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Dias Inhabiles</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">

                                        <div id="mensajes"></div>

                                        <div class="card-text">
                                            <p class="card-text">Capture los dias de vacaciones o inhabiles correspodientes al a??o actual. En caso de puentes solo poner los dias laborales que no se trabajaran por ejemplo si el puente es del viernes al martes se debe capturar 2 fechas una para el dia viernes y otra para el lunes, para no considerar los fines de semana entre estos dias.</p>
                                        </div>

                                        <form class="form" id="frm_dias" name="frm_dias" method="post">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-calendar"></i> Vacaciones o dias Inhabiles</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1" class="sr-only">Inicio</label>
                                                            <input data-toggle="tooltip" data-placement="top" title="Descripcion" type="text" name="descripcion" id="descripcion" class="form-control border-primary" placeholder="Descripcion del dia inhabil" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1" class="sr-only">Inicio</label>
                                                            <input data-toggle="tooltip" data-placement="top" title="Fecha Inicio" type="date" name="f_ini" id="f_ini" class="form-control border-primary" placeholder="Fecha Recepcion" value="<?php echo date("Y-m-d")?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2" class="sr-only">Fin</label>
                                                            <input data-toggle="tooltip" data-placement="top" title="Fecha Inicio" type="date" name="f_fin" id="f_fin" class="form-control border-primary" placeholder="Fecha Recepcion" value="<?php echo date("Y-m-d")?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-outline-warning mr-1">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-outline-primary">
                                                    <i class="ft-check"></i> Guardar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tabla de dias</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">

                                        <div class="card-text">
                                            <p class="card-text">Dias inhabiles y vacaciones.</p>
                                        </div>

                                        <div class="card-text">
                                            <form method="POST" id="frm-buscar" name="frm-buscar">
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="buscar" class="sr-only">Buscar</label>
                                                            <input type="text" id="buscar" name="buscar" class="form-control border-primary" placeholder="Buscar...">
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>

                                        <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Descripcion</th>
                                                        <th>Inicio</th>
                                                        <th>Fin</th>
                                                        <th>A??o</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="content-dia">
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Descripcion</th>
                                                        <th>Inicio</th>
                                                        <th>Fin</th>
                                                        <th>A??o</th>
                                                        <th> </th>
                                                    </tr>
                                                </tfoot>
                                            </table>

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
    <script src="../js/appDias.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>