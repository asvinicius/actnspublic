<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );
?>
<head>
    <title>Eliminatorio</title>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Escalação</h2>
				<ol>
					<li><a href="<?= base_url('eliminatorio');?>"> Voltar </a></li>
				</ol>
			</div>
		</div>
	</section>
	<section id="pricing" class="pricing">
		<div class="container">
			<div class="text-center">
				<img src="<?php echo $partial['et_shield'] ?>" alt="..." class="align-center" width="90"  />
				<h2>  <?= $partial['et_name']; ?> </h2>
				<h4>  <?php echo number_format($partial['et_point'], 2, '.', ''); ?> pontos </h4>
			</div>
		</div>
    </section>
	<section id="cta-pricing" class="cta-pricing">
		<div class="container">
			<div class="row">
				<?php if ($pontuados) { ?>
					<table class="table table-sm">
						<tbody>
							<?php foreach ($pontuados as $patleta) { ?>
								<tr class="<?php if($patleta->pa_capitao == 1) { echo "table-primary";} ?>">
									<td> 
										<img src="<?php echo $squad['clubes'][$patleta->atletasclube]['escudos']['30x30'] ?>"> 
									</td>
									<td>
										<dt>
											<?php echo $patleta->atletasapelido; ?>
											<?php if($patleta->pa_capitao == 1) { ?>
												<i class="icofont-copyright"></i>
											<?php } ?>
										</dt>
										<dd><?php echo $squad['posicoes'][$patleta->atletasposicao]['nome'] ?></dd>
									</td>
									<td>
										<?php echo number_format($patleta->atletaspontos, 2, '.', '') ?> 
									</td>
									<td>
										<?php if($patleta->pa_capitao == 1) { ?>
											<span class="badge badge-success">
												<?php echo number_format(($patleta->atletaspontos*2), 2, '.', '') ?>
											</span> 
										<?php } ?> 
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php }else{ ?>
					<h4>Sem parciais no momento</h4>
				<?php } ?>
			</div>
		</div>
    </section>
	<?php if ($pontuados) { ?>
    	<section id="pricing" class="pricing">
    		<div class="container">
    			<div class="row">
    			    <h3>Reservas</h3>
    				<?php if ($reservas) { ?>
    					<table class="table table-sm">
    						<tbody>
    							<?php foreach ($reservas as $ratleta) { ?>
    								<tr>
    									<td> 
    										<img src="<?php echo $squad['clubes'][$ratleta->atletasclube]['escudos']['30x30'] ?>"> 
    									</td>
    									<td>
    										<dt>
    											<?php echo $ratleta->atletasapelido; ?>
    										</dt>
    										<dd><?php echo $squad['posicoes'][$ratleta->atletasposicao]['nome'] ?></dd>
    									</td>
    									<td>
    										<?php echo number_format($ratleta->atletaspontos, 2, '.', '') ?> 
    									</td>
    								</tr>
    							<?php } ?>
    						</tbody>
    					</table>
    				<?php }else{ ?>
    					<h4>Sem reservas escalados</h4>
    				<?php } ?>
    			</div>
    		</div>
        </section>
    <?php } ?>
</main>