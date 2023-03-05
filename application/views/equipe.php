<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );
?>
<head>
    <title><?= $equipe['equipe_nome']; ?></title>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2><?= $equipe['equipe_nome']; ?></h2>
				<ol>
					<li><a href="<?= base_url('equipes/codigo/'.$equipe['equipe_id']);?>"> Código </a></li>
					<li><a href="<?= base_url('equipes');?>"> Voltar </a></li>
				</ol>
			</div>
		</div>
	</section>
	<section id="pricing" class="pricing">
		<div class="container">
			<div class="text-center">
				<img src="<?php echo "https://www.acretinos.com.br/assets/img/equipes/".$equipe['equipe_escudo'].".png" ?>" alt="..." class="align-center" width="90"  />
				<h2>  <?= $equipe['equipe_nome']; ?> </h2>
				<h4>  <?php echo number_format($equipe['equipe_pontos']/5, 2, '.', '') ?> de média somada </h4>
			</div>
		</div>
    </section>
	<section id="cta-pricing" class="cta-pricing">
		<div class="container">
			<div class="row">
				<?php if ($ranking) { ?>
					<table class="table table-sm">
					    <thead>
                            <tr>
                                <th title="Escudo"></th>
                                <th title="Time">Time</th>
                                <th title="Pontos">Pontos</th>
                            </tr>
                        </thead>
						<tbody>
							<?php foreach ($times as $time) { ?>
								<tr>
									<td><img src="<?php echo $time->tiescudo ?>" width="30" alt="..."/></td>
									<td>
										<dt>
											<?php echo $time->tinome ?>
										</dt>
										<dd><?php echo $time->ticartoleiro ?></dd>
									</td>
									<td><?php echo number_format($time->tipontos, 2, '.', '') ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php }else{ ?>
					<h4>Sem informações para sua busca</h4>
				<?php } ?>
			</div>
		</div>
    </section>
</main>