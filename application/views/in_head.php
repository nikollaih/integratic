<!DOCTYPE html>
<html lang="es" xml:lang="es">  
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8"/> 
        <meta name="description" content="IntegraTIC">
        <meta name="author" content="Robinson Sánchez Cabezas">
        <link rel="shortcut icon" href="<?= base_url() ?>img/logogs.png">
        <title>IntegraTIC - Quindío</title>
        <!-- Base Css Files -->
        <link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet" />
        <!-- Font Icons -->
        <link href="<?= base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/fontawesome-6.7/css/all.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>css/material-design-iconic-font.min.css" rel="stylesheet">
        <!-- animate css -->
        <link href="<?= base_url() ?>css/animate.css" rel="stylesheet" />
        <!-- select2 css -->
        <link href="<?= base_url() ?>css/libraries/select2.min.css" rel="stylesheet" />
        <!-- Waves-effect -->
        <link href="<?= base_url() ?>css/waves-effect.css" rel="stylesheet">
        <!-- sweet alerts -->
        <link href="<?= base_url() ?>assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">
        <!-- Datatable -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/dataTables/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/dataTables/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/dataTables/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/dataTables/select.bootstrap4.min.css">

        <link href="<?= base_url() ?>css/helper.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>css/anuncios.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>css/foros.css" rel="stylesheet" type="text/css" />
        <!--<link href="https://kothing.github.io/editor/dist/css/kothing-editor.min.css" rel="stylesheet">-->
        <link href="<?= base_url() ?>css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>css/kothing.min.css" rel="stylesheet" type="text/css" />
        <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="<?= base_url() ?>js/jquery.min.js"></script>
        <script src="<?= base_url() ?>js/modernizr.min.js"></script> 
        <!-- Latest compiled and minified CSS -->
        <link href="<?= base_url() ?>css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?= base_url() ?>js/bootstrap-select.min.js"></script>   
        <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> --> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">   
    </head>

<style>
    .panel-heading{
        background-color: <?= configuracion()["color_secundario"] ?> !important;
    }
    .navbar-default{
        background-color: <?= configuracion()["color_principal"] ?> !important;
    }

    .modal-colored{
        background-color: <?= configuracion()["color_modal"] ?> !important;
        border-color: <?= configuracion()["color_modal"] ?> !important;
    }

    .btn-primary{
        background-color: <?= configuracion()["color_boton_primary"] ?> !important;
        border-color: <?= configuracion()["color_boton_primary"] ?> !important;
    }

    .btn-success{
        background-color: <?= configuracion()["color_boton_success"] ?> !important;
        border-color: <?= configuracion()["color_boton_success"] ?> !important;
    }

    .btn-warning{
        background-color: <?= configuracion()["color_boton_warning"] ?> !important;
        border-color: <?= configuracion()["color_boton_warning"] ?> !important;
    }

    .btn-danger{
        background-color: <?= configuracion()["color_boton_danger"] ?> !important;
        border-color: <?= configuracion()["color_boton_danger"] ?> !important;
    }
</style>