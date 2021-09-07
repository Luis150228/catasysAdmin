<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
?>
<?php
include (INCLUDE_PATH.'load.php');
include (LAYOUTSAPP_PATH.'head.php');
page_require_level(4);
$data_reporte = mostrarValores();
$user = current_user();
?>
</head>

<title>CatovaTech Traslados</title>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-compact-menu material-vertical-layout material-layout 2-columns   fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">

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
                                    <li class="breadcrumb-item"><a href="#">Valores</a>
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
                                    <h4 class="card-title"><?php echo remove_junk(ucfirst($user['name']));?></h4>
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
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <p class="card-text">Base de traslados</p>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Descripcion</th>
                                                        <th>Valor</th>
                                                        <th>Actualizado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($data_reporte as $data):?>
                                                    <tr>
                                                        <td><button type="button" class="btn grey btn-outline-secondary" data-toggle="modal" data-target="#valores">Editar</button></td>
                                                        <td><?php echo $data['descripcion'];?></td>
                                                        <td><?php echo $data['valor'];?></td>
                                                        <td><?php echo $data['f_actualiza'];?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Descripcion</th>
                                                        <th>Valor</th>
                                                        <th>Actualizado</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
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

    <div class="modal fade text-left" id="bootstrap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel35"> Modificar</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <fieldset class="form-group floating-label-form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control" id="email" placeholder="Email Address">
                        </fieldset>
                        <br>
                        <fieldset class="form-group floating-label-form-group">
                            <label for="title">Password</label>
                            <input type="password" class="form-control" id="title" placeholder="Password">
                        </fieldset>
                        <br>
                        <fieldset class="form-group floating-label-form-group">
                            <label for="title1">Description</label>
                            <textarea class="form-control" id="title1" rows="3" placeholder="Description"></textarea>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
                        <input type="submit" class="btn btn-outline-primary btn-lg" value="Login">
                    </div>
                </form>
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
    <!-- <script src="./js/app.js"></script> -->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>