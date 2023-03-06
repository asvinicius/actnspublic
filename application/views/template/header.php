<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    error_reporting(0);
    ini_set(“display_errors”, 0 );
?>
<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:type" content="article">
		<meta property="og:title" content="<?= $ogdata['current']['title'] ?>">
		<meta property="og:description" content="<?= $ogdata['current']['description'] ?>">
		<meta property="og:url" content="<?= $ogdata['current']['url'] ?>">
		<meta property="og:image" content="<?= $ogdata['current']['image'] ?>">
		<meta property="og:image:width" content="72">
		<meta property="og:image:height" content="64">
		<meta property="og:image:alt" content="<?= $ogdata['current']['imagealt'] ?>">
        <meta property="fb:app_id" content="630334794335672">
        <meta name="keywords" content="<?= $ogdata['current']['keywords'] ?>">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet" />
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet" />
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
        <link href="assets/vendor/venobox/venobox.css" rel="stylesheet" />
        <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet" />
        <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
        <link href="assets/skins/default.css" rel="stylesheet" />
		<link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
		
		<!--
		<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/vendor/icofont/icofont.min.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
        <link href="<?= base_url('assets/vendor/animate.css/animate.min.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/vendor/venobox/venobox.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/vendor/owl.carousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/vendor/aos/aos.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/skins/default.css'); ?>" rel="stylesheet" />
		<link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
		-->
		
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
        <!--<link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" /> -->
        <link rel="shortcut icon" href="assets/img/favicon.png" />
        
        <style>
            a:link { 
                text-decoration:none; 
            } 
        </style>
    </head>

    <body>
		<section id="topbar" class="d-none d-lg-block">
			<div class="container d-flex">
			
				<div class="contact-info mr-auto">
				</div>
				<div class="social-links">
					<a href="https://facebook.com/acretinosliga" class="facebook" target="_blank"><i class="icofont-facebook"></i></a>
					<a href="https://instagram.com/acretinosliga" class="instagram" target="_blank"><i class="icofont-instagram"></i></a>
				</div>
			</div>
		</section>
		<header id="header">
			<div class="container d-flex">
				<div class="logo mr-auto">
					<!--<a href="<?= base_url('inicio'); ?>"><img src="<?= base_url('assets/img/logotipo2.png'); ?>" alt="" class="logo" /></a>-->
					<a href="<?= base_url('inicio'); ?>"><img src="assets/img/logotipo2.png" alt="" class="logo" /></a>
				</div>

				<nav class="nav-menu d-none d-lg-block">
					<ul>
						<li class="<?php if($ogdata['current']['id'] == 0){echo 'active';} ?>"><a href="<?= base_url('inicio'); ?>">Início</a></li>
						<li class="drop-down <?php if($ogdata['current']['id'] > 0 & $ogdata['current']['id'] < 3){echo 'active';} ?>">
							<a href="">Acretinos</a>
							<ul>
								<li class="<?php if($ogdata['current']['id'] == 1){echo 'active';} ?>"><a href="<?= base_url('sobre'); ?>">Sobre a Liga</a></li>
								<li class="<?php if($ogdata['current']['id'] == 2){echo 'active';} ?>"><a href="<?= base_url('historico'); ?>">Dados históricos</a></li>
							</ul>
						</li>
						<li class="drop-down <?php if($ogdata['current']['id'] > 2 & $ogdata['current']['id'] < 7){echo 'active';} ?>">
							<a href="">Ligas</a>
							<ul>
								<!-- <li class="<?php if($ogdata['current']['id'] == 3){echo 'active';} ?>"><a href="<?= base_url('classica'); ?>">Liga clássica </a></li> -->
								<li class="<?php if($ogdata['current']['id'] == 4){echo 'active';} ?>"><a href="<?= base_url('bolao'); ?>">Bolão tiro-curto </a></li>
								<!-- <li class="<?php if($ogdata['current']['id'] == 5){echo 'active';} ?>"><a href="<?= base_url('mata'); ?>">Mata-mata </a></li> -->
								<li class="<?php if($ogdata['current']['id'] == 6){echo 'active';} ?>"><a href="<?= base_url('equipes'); ?>">Liga de equipes </a></li>
								<li class="<?php if($ogdata['current']['id'] == 9){echo 'active';} ?>"><a href="<?= base_url('eliminatorio'); ?>">Eliminatório </a></li>
								
							</ul>
						</li>
						<!--
						<li class="<?php if($ogdata['current']['id'] == 7){echo 'active';} ?>">
							<a href="<?= base_url('noticias'); ?>">Notícias </a>
						</li>
						-->
						<li class="<?php if($ogdata['current']['id'] == 8){echo 'active';} ?>">
							<a href="<?= base_url('contato'); ?>">Contato </a>
						</li>
						<li class="<?php if($ogdata['current']['id'] == 10){echo 'active';} ?>">
							<a href="<?= "https://www.portal.acretinos.com.br"; ?>" target="_blank">Portal</a>
						</li>
					</ul>
				</nav>
			</div>
		</header>