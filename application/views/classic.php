<head>
    <title>Liga Clássica</title>	
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Liga Clássica</h2>
				<ol>
					<li><a href="<?= base_url('classica/order/campeonato');?>"> Campeonato </a></li>
					<li><a href="<?= base_url('classica/order/turno');?>"> Turno </a></li>
					<li><a href="<?= base_url('classica/order/mes');?>"> Mês </a></li>
				</ol>
			</div>
		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 entries">
					<h3> <?php echo $description; ?> </h3>
					<table class="table table-sm table-hover table-responsive-sm">
						<?php if ($ranking) { ?>
							<thead>
								<tr>
									<th title="Posição">#</th>
									<th title="Time">Time</th>
									<th title="Pontuação">Pontuação</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($ranking['times'] as $rk_team) {  ?>
									<?php $cont++; ?>
									<tr class="<?php if($cont <6) {echo "table-success";} ?>">
										<td>
											<span class="badge <?php if($cont < 6) { echo "badge-success";}else{ echo "badge-secondary";} ?>">
												<?php echo $cont."º" ?>
											</span>
										</td>
										<td>
											<dt><?php echo $rk_team['nome'] ?></dt>
											<dd><?php echo $rk_team['nome_cartola'] ?></dd>
										</td>
										<td><?php echo number_format($rk_team['pontos'][$description], 2, '.', '') ?></td>
									</tr>
								<?php } ?>
							</tbody>
						<?php }else{ ?>
							<h4>Não existe informações para sua busca!</h4>
						<?php } ?>
					</table>
					<div class="blog-pagination">
						<ul class="justify-content-center">
							<?php if($page == 1){ ?>
								<li class="disabled">
									<i class="icofont-rounded-left"></i>
								</li>
							<?php } else{ ?>
								<li>
									<a href="<?= base_url('classica/pagina/'.$description.'-'.($page-1)); ?>"><i class="icofont-rounded-left"></i></a>
								</li>
							<?php } ?>
							<?php if($mult == true){ ?>
								<?php for($i = 0; $i<intdiv($itens, 100); $i++){ ?>
									<?php if($i == $page-1){ ?>
										<li class="active">
											<a href="<?= base_url('classica/pagina/'.$description.'-'.($i+1)); ?>"><?php echo $i+1; ?></a>
										</li>
									<?php } else {?>
										<li>
											<a href="<?= base_url('classica/pagina/'.$description.'-'.($i+1)); ?>"><?php echo $i+1; ?></a>
										</li>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<?php for($i = 0; $i<=intdiv($itens, 100); $i++){ ?>
									<?php if($i == $page-1){ ?>
										<li class="active">
											<a href="<?= base_url('classica/pagina/'.$description.'-'.($i+1)); ?>"><?php echo $i+1; ?></a>
										</li>
									<?php } else {?>
										<li>
											<a href="<?= base_url('classica/pagina/'.$description.'-'.($i+1)); ?>"><?php echo $i+1; ?></a>
										</li>
									<?php } ?>
								<?php } ?>
							<?php } ?>
							<?php if($page == intdiv($itens, 100)+1){ ?>
								<li class="disabled">
									<i class="icofont-rounded-right"></i>
								</li>
							<?php } else{ ?>
								<li>
									<a href="<?= base_url('classica/pagina/'.$description.'-'.($page+1)); ?>"><i class="icofont-rounded-right"></i></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
    </section>
</main>