<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/css/animate.min.css'); ?>" rel="stylesheet"/>
        <link href="<?= base_url('assets/css/paper-dashboard.css'); ?>" rel="stylesheet"/>
        <link href="<?= base_url('assets/css/demo.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="<?= base_url('assets/css/themify-icons.css'); ?>" rel="stylesheet">

    </head>
    <body>

        <div class="wrapper">
            <div class="sidebar" data-background-color="white" data-active-color="info">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="<?= base_url(); ?>" class="simple-text" title="Início">
                            Grades League
                        </a>
                    </div>

                    <ul class="nav">
                        <?php if($status == 2){ ?>
                            <li class="<?php if($page['current'] != null){if($page['current']["id"] == 2){echo 'active';}} ?>">
                                <a href="<?= base_url('partial'); ?>" title="Parciais">
                                    <i class="ti-stats-up"></i>
                                    <p>Parciais</p>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="<?php if($page['current'] != null){if($page['current']["id"] == 3){echo 'active';}} ?>">
                            <a href="<?= base_url('overall'); ?>" title="Tabela Geral">
                                <i class="ti-view-list-alt"></i>
                                <p>Tabela Geral</p>
                            </a>
                        </li>
                        <li class="<?php if($page['current'] != null){if($page['current']["id"] == 4){echo 'active';}} ?>">
                            <a href="<?= base_url('month'); ?>" title="Tabela Mês">
                                <i class="ti-calendar"></i>
                                <p>Tabela Mês</p>
                            </a>
                        </li>
                        <li class="<?php if($page['current'] != null){if($page['current']["id"] == 5){echo 'active';}} ?>">
                            <a href="<?= base_url('bank'); ?>" title="Banco">
                                <i class="ti-wallet"></i>
                                <p>Banco</p>
                            </a>
                        </li>
                        <li class="<?php if($page['current'] != null){if($page['current']["id"] == 6){echo 'active';}} ?>">
                            <a href="<?= base_url('info'); ?>" title="Informações">
                                <i class="ti-info"></i>
                                <p>Informações</p>
                            </a>
                        </li>
                        <li class="active-pro">
                            <a href="<?= base_url('login/signout'); ?>" title="Sair">
                                <i class="ti-power-off"></i>
                                <p>Sair</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/js/jquery-1.10.2.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/bootstrap-checkbox-radio.js'); ?>"></script>
    <script src="<?= base_url('assets/js/chartist.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap-notify.js'); ?>"></script>
    <script src="<?= base_url('assets/js/paper-dashboard.js'); ?>"></script>
    <script src="<?= base_url('assets/js/demo.js'); ?>"></script>

</html>
