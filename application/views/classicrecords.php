<head>
    <title>Histórico</title>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Recordes - Liga clássica</h2>
			</div>
		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 entries">
					<article class="entry" data-aos="fade-up">
						<?php if($desc == 2){ ?>
							<h3> Maiores pontuações da <strong> história </strong> </h3>
						<?php } else { ?>
							<h3> Maiores pontuações de <strong> <?= $year ?> </strong> </h3>
						<?php } ?>						
						<table class="table table-sm table-hover table-responsive-sm">
							<?php if ($top) { ?>
								<thead>
									<tr>
										<th title="Posição">#</th>
										<?php if($desc == 2){ ?>
											<th title="Ano">Ano</th>
										<?php } ?>
										<th title="Rodada">Rodada</th>
										<th title="Time">Time</th>
										<th title="Cartoleiro">Cartoleiro</th>
										<th title="Pontuação">Pontuação</th>
									</tr>
								</thead>
								<tbody>
									<?php $cont = 0;  ?>
									<?php foreach ($top as $top_team) {  ?>
										<?php $cont++; ?>
										<tr class="<?php if($cont <6) {echo "table-success";} ?>">
											<td><?php echo $cont."ª" ?></td>
											<?php if($desc == 2){ ?>
												<td><?php echo $top_team->topyear ?></td>
											<?php } ?>
											<td><?php echo $top_team->topround ?></td>
											<td><?php echo $top_team->topteam ?></td>
											<td><?php echo $top_team->topcoach ?></td>
											<td><?php echo number_format($top_team->topaward, 2, '.', '') ?></td>
										</tr>
									<?php } ?>
								</tbody>
							<?php }else{ ?>
								<h4>Não existe informações para sua busca!</h4>
							<?php } ?>
						</table>
					</article>
				</div>
				<div class="col-lg-3">
					<div class="sidebar" data-aos="fade-left">
						<h3 class="sidebar-title">Veja mais</h3>
						<div class="sidebar-item categories">
							<ul>
								<li><a href="<?= base_url('historico/recordesclassica');?>"> História </a></li>
								<li><a href="<?= base_url('historico/recordesclassicaano/2019');?>"> 2019 </a></li>
								<li><a href="<?= base_url('historico/recordesclassicaano/2020');?>"> 2020 </a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
</main>