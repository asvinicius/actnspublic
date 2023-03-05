<head>
    <title>Bolão Acretinos</title>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Dados históricos - Bolão Acretinos</h2>
			</div>
		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 entries">
					<article class="entry" data-aos="fade-up">
						<h3> Resultados da <strong><?= $spin ?>ª</strong> rodada de <strong><?= $year ?></strong> </h3>
						<table class="table table-sm table-hover table-responsive-sm">
							<?php if ($pasteround) { ?>
								<thead>
									<tr>
										<th title="Posição">#</th>
										<th title="Time">Time</th>
										<th title="Pontuação">Pontos</th>
									</tr>
								</thead>
								<tbody>
									<?php $cont = 0;  ?>
									<?php foreach ($pasteround as $pr_team) {  ?>
										<?php $cont++; ?>
										<tr class="<?php if($cont <11) {echo "table-success";} ?>">
											<td>
												<span class="badge <?php if($cont < 11) { echo "badge-success";}else{ echo "badge-secondary";} ?>">
													<?php echo $cont."º" ?>
												</span>
											</td>
											<td>
												<dt><?php echo $pr_team->ctrkteam ?></dt>
												<dd><?php echo $pr_team->ctrkcoach ?></dd>
											</td>
											<td><?php echo number_format($pr_team->ctrkaward, 2, '.', '') ?></td>
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
						<div class="sidebar-item tags">
							<ul>
								<li><a href="<?= base_url('historico/recordesbolao');?>">Recordes</a></li>
							</ul>
						</div>						
						<?php if($comp){ ?>
							<h3 class="sidebar-title">Rodadas passadas</h3>
							<div class="sidebar-item categories">
								<ul>
									<?php foreach ($comp as $data) { ?>
										<li><a href="<?= base_url('historico/bolaovariacao/'.$data->sc_spin.'-'.$year);?>"> <?= $data->sc_spin ?>ª Rodada </a> </li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
    </section>
</main>