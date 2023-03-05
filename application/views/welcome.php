<head>
    <title>ACRETINOS</title>
</head>

<section id="hero">
	<div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
		<?php if($notice){ ?>
			<div class="carousel-inner" role="listbox">
				<div class="carousel-item active" style="background-image: url(<?php echo base_url('assets/img/NEWPRINCIPAL.png'); ?>);">
					<div class="carousel-container">
						<div class="carousel-content animate__animated animate__fadeInUp">
							<h2>Bem vindo à <span>Liga Acretinos</span></h2>
							<p>Você está no site da <strong>melhor liga de Cartola FC da região norte</strong>. Junte-se para um 2022 de mitadas e ótimos prêmios.</p>
							<div class="text-center"></div>
						</div>
					</div>
				</div>
				<!--
				<?php foreach($notice as $news){ ?>
					<div class="carousel-item" style="background-image: url(<?php echo "http://gerenciar.acretinos.com.br/assets/img/news/".$news->newsfront; ?>);">
						<div class="carousel-container">
							<div class="carousel-content animate__animated animate__fadeInUp">
								<h2><?php echo $news->newstitle; ?></h2>
								<p><?php echo $news->newsresume; ?></p>
								<div class="text-center"><a href="<?= base_url('noticias/noticia/' . $news->newsslug); ?>" class="btn-get-started">Leia mais</a></div>
							</div>
						</div>
					</div>
				<?php } ?>
				-->
			</div>
			<a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
				<span class="sr-only">Anterior</span>
			</a>
			<a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
				<span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
				<span class="sr-only">Próxima</span>
			</a>
			<ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
		<?php } ?>
	</div>
</section>
<main id="main">
	<section id="cta" class="cta">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 text-center text-lg-left">
					<h3>O Bolão Acretinos premia em <span>TODAS</span> as rodadas!</h3>
					<p> Competição tiro-curto válida por uma rodada com ótimos prêmios.</p>
				</div>
				<div class="col-lg-3 cta-btn-container text-center">
					<a class="cta-btn align-middle" href="https://portal.acretinos.com.br" target="_blanck">Participe</a>
				</div>
			</div>
		</div>
    </section>
	<section id="services" class="services">
		<div class="container">
			<div class="section-title" data-aos="fade-up">
				<h2>Mais da <strong>Liga Acretinos</strong></h2>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="icon-box" data-aos="fade-up">
						<div class="icon"><i class="icofont-listing-number"></i></div>
						<h4 class="title"><a href="">Liga Clássica</a></h4>
						<p class="description">Uma unica inscrição e prêmios o ano todo</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="100">
						<div class="icon"><i class="icofont-focus"></i></div>
						<h4 class="title"><a href="">Bolão Acretinos</a></h4>
						<p class="description">Competição tiro-curto com ótimos prêmios em todas as rodadas</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
						<div class="icon"><i class="icofont-filter"></i></div>
						<h4 class="title"><a href="">Mata-mata</a></h4>
						<p class="description">Competições mata-mata divertidas</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
						<div class="icon"><i class="icofont-users-social"></i></div>
						<h4 class="title"><a href="">Equipes</a></h4>
						<p class="description">Competições por equipes muito competitivas</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="300">
						<div class="icon"><i class="icofont-newspaper"></i></div>
						<h4 class="title"><a href="">Notícias</a></h4>
						<p class="description">Tudo sobre o universo da Liga Acretinas</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="icon-box" data-aos="fade-up" data-aos-delay="400">
						<div class="icon"><i class="icofont-database"></i></div>
						<h4 class="title"><a href="">Dados históricos</a></h4>
						<p class="description">Aqui a sua mitada fica na história</p>
					</div>
				</div>
			</div>
		</div>
    </section>
</main>