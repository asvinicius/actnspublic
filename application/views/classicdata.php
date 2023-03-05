<head>
    <title>Histórico</title>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Dados históricos - Liga clássica</h2>
			</div>
		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 entries">
					<article class="entry" data-aos="fade-up">
						<h3> Liga Acretinos <?php echo $year; ?> - <?php echo $desc['descdefine']; ?> </h3>
						<table class="table table-sm table-hover table-responsive-sm">
							<?php if ($ranking) { ?>
								<thead>
									<tr>
										<th title="Posição">#</th>
										<th title="Time">Time</th>
										<th title="Pontuação">Pontos</th>
									</tr>
								</thead>
								<tbody>
									<?php $cont = 0;  ?>
									<?php foreach ($ranking as $rk_team) {  ?>
										<?php $cont++; ?>
										<tr class="<?php if($cont <6) {echo "table-success";} ?>">
											<td>
												<span class="badge <?php if($cont < 6) { echo "badge-success";}else{ echo "badge-secondary";} ?>">
													<?php echo $cont."º" ?>
												</span>
											</td>
											<td>
												<dt><?php echo $rk_team->clrkteam ?></dt>
												<dd><?php echo $rk_team->clrkcoach ?></dd>
											</td>
											<td><?php echo number_format($rk_team->clrkaward, 2, '.', '') ?></td>
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
								<li><a href="<?= base_url('historico/recordesclassica');?>">Recordes</a></li>
							</ul>
						</div>
						<h3 class="sidebar-title">Veja mais</h3>
						<div class="sidebar-item categories">
							<ul>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 1){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classica/'.$year);?>"> Campeonato </a></li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 2){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/2-'.$year);?>"> 1º Turno </li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 3){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/3-'.$year);?>"> 2º Turno </li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 4){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/4-'.$year);?>"> Abril </li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 5){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/5-'.$year);?>"> Maio </li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 6){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/6-'.$year);?>"> Junho </li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 7){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/7-'.$year);?>"> Julho </li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 8){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/8-'.$year);?>"> Agosto </li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 9){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/9-'.$year);?>"> Setembro </li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 10){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/10-'.$year);?>"> Outrubro </li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 11){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/11-'.$year);?>"> Novembro </li>
									<?php }
								?>
								<?php 
									$aux = 0;
									foreach ($rkall as $rk) { 
										if($rk->description == 12){
											$aux = 1;
										}
									}
									if($aux>0){ ?>
										<li><a href="<?= base_url('historico/classicavariacao/12-'.$year);?>"> Dezembro </li>
									<?php }
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
</main>