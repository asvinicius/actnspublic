				<div class="col-lg-4">
					<div class="sidebar" data-aos="fade-left">
						<h3 class="sidebar-title">Pesquisar</h3>
						<div class="sidebar-item search-form">
							<form action="<?= base_url('noticias/pesquisar');?>" method="post">
								<input placeholder="Pesquisar..." type="text" name="searchlabel" id="searchlabel">
								<button type="submit"><i class="icofont-search"></i></button>
							</form>
						</div>
						<h3 class="sidebar-title">Categorias</h3>
						<div class="sidebar-item categories">
							<ul>
								<?php foreach ($categories as $category){ ?>
									<li><a href="<?= base_url('noticias/categorias/' . $category->categoryid); ?>"><?php echo $category->categoryname; ?></a></li>
								<?php } ?>
							</ul>
						</div>
						<h3 class="sidebar-title">Notícias importantes</h3>
						<div class="sidebar-item recent-posts">
							<?php if ($noticemenu) { ?>
								<?php foreach ($noticemenu as $newsmenu) { ?>
									<div class="post-item clearfix">
										<img src="<?php echo "https://gerenciar.acretinos.com.br/assets/img/news/".$newsmenu->newsthumb; ?>" alt="">
										<h4><a href="<?= base_url('noticias/noticia/' . $newsmenu->newsslug); ?>"><?php echo $newsmenu->newstitle; ?></a></h4>
										<time datetime="<?php echo date('Y-m-d', strtotime($newsmenu->newsdate)); ?>"><?php echo date('d/m/Y', strtotime($newsmenu->newsdate)); ?></time>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
						<h3 class="sidebar-title">Tags</h3>
						<div class="sidebar-item tags">
							<ul>
								<?php foreach ($tags as $tag){ ?>
									<li><a href="<?= base_url('noticias/tags/' . $tag->tagid); ?>"><?= $tag->tagname; ?></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
</main>