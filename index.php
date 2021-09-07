<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasys/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
if($session->isUserLoggedIn(true)) { redirect('./home.php', false);}
?>
<?php
include (LAYOUTS_PATH.'head.php');
?>
<link rel="stylesheet" type="text/css" href="./app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="./app-assets/vendors/css/forms/icheck/custom.css">
<link rel="stylesheet" type="text/css" href="./app-assets/css/pages/login-register.css">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-content-menu material-vertical-layout material-layout 1-column   blank-page" data-open="click" data-menu="vertical-content-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-header row">
        </div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1"><img src="./app-assets/images/logo/logo-80x80.png" alt="branding logo"></div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="post" action="auth.php">
                                    <div class="card-content">
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>Bienvenido, Ingrese sus datos</span></p>
                                    <div class="card-body">
                                        <form class="form-horizontal" action="index.html" novalidate>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <?php echo display_msg($msg); ?>
                                                <input type="text" class="form-control" id="user-name" name="user-name" placeholder="Usuario" required>
                                                <div class="form-control-position">
                                                    <i class="la la-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control" id="user-password" name="user-password" placeholder="Contraseña" required>
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Olvidaste tu Contraseña?</a></div>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Ingresar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Page JS-->
    <?php include (LAYOUTS_PATH.'scripts.php');?>
    <script src="./app-assets/js/scripts/pages/material-app.js"></script>
    <script src="./app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="./app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="./app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>