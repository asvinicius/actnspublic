<head>
    <title>Notícias</title>
    <meta charset="utf-8">
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
					<article class="entry" data-aos="fade-up">
						<?php if($news){ ?>
							<div class="entry-img">
								<img src="assets/img/blog-1.jpg" alt="" class="img-fluid">
							</div>
							<h2 class="entry-title">
								<?php echo $news['newstitle']; ?>
							</h2>
							<div class="entry-meta">
								<ul>
									<li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <?php echo date('d/m/Y', strtotime($news['newsdate'])); ?></li>
									<li class="d-flex align-items-center"><i class="icofont-comment"></i> 
										<?php if($comments){ ?>
											<?php if($num == 1){ ?>
												<?= $num ?> comentário
											<?php }else{ ?>
												<?= $num ?> comentários
											<?php } ?>
										<?php }else{ ?>
											Nenhum comentário
										<?php } ?>
									</li>
								</ul>
							</div>
							<div class="entry-content">
								<?php echo $news['newscontent']; ?>
							</div>
							<div class="entry-footer clearfix">
							</div>
						<?php }else{ ?>
							<h5>Desculpe, notícia não encontrada.</h5>
						<?php } ?>
					</article>
					<?php if($news){ ?>
						<div class="blog-comments" data-aos="fade-up">
							<?php if($sendcomment  != null){ ?>
								<div class="<?php echo $sendcomment['class']; ?>">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<?php echo $sendcomment['message']; ?>
								</div>
							<?php } ?>
							<?php if($comments){ ?>
								<?php if($num == 1){ ?>
									<h4 class="comments-count"> <?= $num ?> comentário </h4>
								<?php }else{ ?>
									<h4 class="comments-count"> <?= $num ?> comentários </h4>
								<?php } ?>
								<?php foreach($comments as $comment){ ?>
									<div id="comment-<?= $comment->commentid ?>" class="comment clearfix">
										<h5><?php echo $comment->commentauthor; ?></h5>
										<time datetime="<?php echo date('Y-m-d', strtotime($comment->commentdate)); ?>"><?php echo date('d/m/Y', strtotime($comment->commentdate)); ?></time>
										<p><?php echo $comment->commentmessage; ?></p>
									</div>
								<?php } ?>
							<?php }else{ ?>
								<h5>Nenhum comentário. Seja o primeiro!</h5>
							<?php } ?>
							<div class="reply-form">
								<h4>Deixe seu comentário</h4>
								<p>Seu e-mail não será publicado. Todos os campos são obrigatórios</p>
								<form action="<?= base_url('noticias/comentar'); ?>" method="post">
									<div class="row">
										<input type="hidden" id="commentnews" name="commentnews" value="<?= $news['newsid']; ?>">
										<div class="col-md-6 form-group">
											<input type="text" name="commentauthor" class="form-control" id="commentauthor" placeholder="Seu nome" data-rule="minlen:4" data-msg="Necessário no mínimo 4 caracteres" required>
										</div>
										<div class="col-md-6 form-group">
											<input type="text" name="commentemailauthor" class="form-control" id="commentemailauthor" placeholder="Seu email" required>
										</div>
									</div>
									<div class="row">
										<div class="col form-group">
											<textarea rows="6" name="commentmessage" id="commentmessage" class="form-control" placeholder="Escreva seu comentário" style="resize: none"></textarea>
										</div>
									</div>
									<button type="submit" class="btn btn-primary">Enviar</button>
								</form>
							</div>
						</div>
					<?php } ?>
				</div>