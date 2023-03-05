<head>
    <title>Notícias</title>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Notícias</h2>
			</div>
		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 entries">
					<?php if ($notice) { ?>
						<?php foreach ($notice as $news) { ?>
							<article class="entry" data-aos="fade-up">
								<div class="entry-img">
									<img src="<?php echo "http://gerenciar.acretinos.com.br/assets/img/news/".$news->newsthumb; ?>" alt="" class="img-fluid">
								</div>
								<h2 class="entry-title">
									<a href="<?= base_url('noticias/noticia/' . $news->newsslug); ?>"><?php echo $news->newstitle; ?></a>
								</h2>
								<div class="entry-meta">
									<ul>
										<li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <time datetime="<?php echo date('Y-m-d', strtotime($news->newsdate)); ?>"><?php echo date('d/m/Y', strtotime($news->newsdate)); ?></time></li>
									</ul>
								</div>
								<div class="entry-content">
									<p>
										<?php echo $news->newsresume; ?>
									</p>
									<div class="read-more">
										<a href="<?= base_url('noticias/noticia/' . $news->newsslug); ?>">Leia mais</a>
									</div>
								</div>
							</article>
						<?php } ?>
						<!--
						<div class="blog-pagination">
							<ul class="justify-content-center">
								<li class="disabled"><i class="icofont-rounded-left"></i></li>
								<li><a href="#">1</a></li>
								<li class="active"><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#"><i class="icofont-rounded-right"></i></a></li>
							</ul>
						</div>
						-->
					<?php } else { ?>
						<h5> Nenhuma notícia a ser exibida. </h5>
					<?php } ?>
				</div>