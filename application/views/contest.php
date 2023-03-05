<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );
?>
<head>
    <title>Bolão Acretinos</title>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Bolão</h2>
				<?php if($json['status_mercado'] == 2){ ?>
    				<ol>
    					<li><a href="<?= base_url('bolao/codigo/'.$spin);?>"> Código </a></li>
    				</ol>
    			<?php } ?>
			</div>
		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
				<?php if($json['status_mercado'] == 1){ ?>
				    <div class="col-lg-12 entries">
    					<article class="entry" data-aos="fade-up">
    						<?php if ($spindata['numteams'] == 0) { ?>
    							<h4> Nenhum time inscrito para a <strong><?= $spin ?>ª</strong> rodada. </h4>
    						<?php } ?>
    						<?php if ($spindata['numteams'] == 1) { ?>
    							<h4> 1 time inscrito para a <strong><?= $spin ?>ª</strong> rodada. </h4>
    						<?php } ?>
    						<?php if ($spindata['numteams'] > 1) { ?>
    							<h4> <?= $spindata['numteams'] ?> times inscritos para a <strong><?= $spin ?>ª</strong> rodada. </h4>
    						<?php } ?>
    						<form action="<?= base_url('bolao/pesquisar'); ?>" method="post">
    							<div class="row">
    							    <div class="col-md-8 form-group">
    				                    <input type="text" name="searchlabel" class="form-control" id="searchlabel" placeholder="Time ou Cartoleiro" data-rule="minlen:4" data-msg="Necessário no mínimo 4 caracteres" required>
    						        </div>
    							    <div class="col-md-4 form-group">
    				                    <button type="submit" class="btn btn-primary btn-block">Pesquisar</button>
    						        </div>
    						    </div>
    						</form>
    						<table class="table table-sm table-hover table-responsive-sm">
    							<?php if ($teams) { ?>
    								<tbody>
    									<?php foreach ($teams as $team) { ?>
    										<tr>
    											<td><img src="<?php echo $team->teamshield ?>" width="40" alt="..."/></td>
    											<td>
    												<dt><?php echo $team->teamname ?></dt>
    												<dd><?php echo $team->teamcoach ?></dd>
    											</td>
    										</tr>
    									<?php } ?>
    								</tbody>
    							<?php }else{ ?>
    								<h4>Nenhum time foi encontrado!</h4>
    							<?php } ?>
    						</table>
    					</article>
    					<div class="blog-pagination">
    						<ul class="justify-content-center">
    							<?php if($page == 0){ ?>
    								<li class="disabled">
    									<i class="icofont-rounded-left"></i>
    								</li>
    							<?php } else{ ?>
    								<li>
    									<a href="<?= base_url('bolao/pagina/'.($page-1)); ?>"><i class="icofont-rounded-left"></i></a>
    								</li>
    							<?php } ?>
    							<?php if($mult == true){ ?>
    								<?php for($i = 0; $i<intdiv($itens, 50); $i++){ ?>
    									<?php if($i == $page){ ?>
    										<li class="active">
    											<a href="<?= base_url('bolao/pagina/'.$i); ?>"><?php echo $i+1; ?></a>
    										</li>
    									<?php } else {?>
    										<li>
    											<a href="<?= base_url('bolao/pagina/'.$i); ?>"><?php echo $i+1; ?></a>
    										</li>
    									<?php } ?>
    								<?php } ?>
    							<?php } else { ?>
    								<?php for($i = 0; $i<=intdiv($itens, 50); $i++){ ?>
    									<?php if($i == $page){ ?>
    										<li class="active">
    											<a href="<?= base_url('bolao/pagina/'.$i); ?>"><?php echo $i+1; ?></a>
    										</li>
    									<?php } else {?>
    										<li>
    											<a href="<?= base_url('bolao/pagina/'.$i); ?>"><?php echo $i+1; ?></a>
    										</li>
    									<?php } ?>
    								<?php } ?>
    							<?php } ?>
    							<?php if($page == intdiv($itens, 50)){ ?>
    								<li class="disabled">
    									<i class="icofont-rounded-right"></i>
    								</li>
    							<?php } else{ ?>
    								<li>
    									<a href="<?= base_url('bolao/pagina/'.($page+1)); ?>"><i class="icofont-rounded-right"></i></a>
    								</li>
    							<?php } ?>
    						</ul>
    					</div>
					</div>
				<?php } else { ?>
					<?php if ($partial) { ?>
					    <?php if($json['status_mercado'] == 2){ ?>
						    <h4> Parciais</h4>
					    <?php } else { ?>
						    <h4> Mercado em manutenção </h4>
					    <?php } ?>
						<table class="table table-hover table-responsive-sm" id="dataTable">
							<tbody>
								<?php $cont = 1; ?>
								<?php foreach ($partial as $pteam) {  ?>
									<tr class="<?php if($cont < 11) { echo "table-success";}else{if($cont < 21) { echo "table-primary";}} ?>">
										<td>
										    <dd>
    											<span class="badge <?php if($cont < 11) { echo "badge-success";}else{ if($cont < 21) { echo "badge-primary";}else{ echo "badge-secondary";}} ?>">
    												<small><?php echo $cont."º" ?></small>
    											</span>
											    <img src="<?php echo $pteam->teamshield ?>" width="15" alt="..."/>
											</dd>
										</td>
										<td>
										    <small><a href="<?= base_url('bolao/escalacao/'.$pteam->teamid); ?>"><?php echo $pteam->teamname ?></a><small> [ <?php echo $pteam->teamcoach ?> ]</small></small>
											<dd>
											    <small>
										            <small>
											            <strong>© <?php echo $pteam->atletasapelido ?></strong>
    											    </small>
											    </small>
											</dd>
										</td>
										<td>
									        <small>
									            <?php echo number_format($pteam->partialpoints, 2, '.', '') ?>
									        </small>
										    <?php if ($cont < 21) { ?>
        									    <dd class="text-success">
        									        <small>
            									        <small>
            									            <strong>
                									            <?php if ($cont < 6) { ?>
                									                <?php switch ($cont) {
                									                     case 1:
                									                        ?> R$<?php echo number_format((($paiddata['paidteams']*8.5)*0.5)-50, 2, ',', '.') ;?> <?php
                									                        break;
                									                     case 2: 
                									                        ?> R$<?php echo number_format((($paiddata['paidteams']*8.5)*0.17)-17, 2, ',', '.') ;?> <?php
                									                        break;
                									                     case 3: 
                									                        ?> R$<?php echo number_format((($paiddata['paidteams']*8.5)*0.12)-12, 2, ',', '.') ;?> <?php
                									                        break;
                									                     case 4: 
                									                        ?> R$<?php echo number_format((($paiddata['paidteams']*8.5)*0.07)-7, 2, ',', '.') ;?> <?php
                									                        break;
                									                     case 5: 
                									                        ?> R$<?php echo number_format((($paiddata['paidteams']*8.5)*0.04)-4, 2, ',', '.') ;?> <?php
                									                        break; 
                									                } ?>
                									            <?php } else { ?>
                									                <?php if ($cont < 11) { ?>
                									                    R$<?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> 
                                                    			    <?php } else { ?>
                                                    			        Grátis
                									                <?php } ?>
                									            <?php } ?>
            									            </strong>
            									        <small>    
        									        <small>    
        								        </dd>
									        <?php } ?>
										</td>
									</tr>
									<?php $cont++; ?>
								<?php } ?>
							</tbody>
						</table>
					<?php }else{ ?>
						<h4>Sem parciais no momento</h4>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</section>
	<section id="cta-pricing" class="cta-pricing">
		<div class="container" style="text-align:center">
			<?php if($json['status_mercado'] == 1){ ?>
				<h3>Premiação parcial</h3>
				<div>
				    <?php if($json['rodada_atual'] == 38){ ?>
				        <dt><strong>1º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.5), 2, ',', '.') ;?> (50%)</strong></dt>
    					<dt><strong>2º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.17), 2, ',', '.') ;?> (17%)</strong></dt>
    					<dt><strong>3º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.12), 2, ',', '.') ;?> (12%)</strong></dt>
    					<dt><strong>4º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.07), 2, ',', '.') ;?> (7%)</strong></dt>
    					<dt><strong>5º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.04), 2, ',', '.') ;?> (4%)</strong></dt>
    					<dt><strong>6º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
    					<dt><strong>7º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
    					<dt><strong>8º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
    					<dt><strong>9º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
    					<dt><strong>10º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
				    <?php } else { ?>
    					<?php if($paiddata['paidteams'] <= 60){ ?>
    				        <dt><strong>1º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.5), 2, ',', '.') ;?> (50%)</strong></dt>
        					<dt><strong>2º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.17), 2, ',', '.') ;?> (17%)</strong></dt>
        					<dt><strong>3º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.12), 2, ',', '.') ;?> (12%)</strong></dt>
        					<dt><strong>4º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.07), 2, ',', '.') ;?> (7%)</strong></dt>
        					<dt><strong>5º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.04), 2, ',', '.') ;?> (4%)</strong></dt>
        					<dt><strong>6º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>7º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>8º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>9º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>10º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
    				    <?php } else { ?>
        					<dt><strong>1º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.5)-50, 2, ',', '.') ;?> (50%)</strong></dt>
        					<dt><strong>2º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.17)-17, 2, ',', '.') ;?> (17%)</strong></dt>
        					<dt><strong>3º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.12)-12, 2, ',', '.') ;?> (12%)</strong></dt>
        					<dt><strong>4º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.07)-7, 2, ',', '.') ;?> (7%)</strong></dt>
        					<dt><strong>5º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.04)-4, 2, ',', '.') ;?> (4%)</strong></dt>
        					<dt><strong>6º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>7º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>8º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>9º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>10º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>11º - Rodada FREE!!</strong></dt>
        					<dt><strong>12º - Rodada FREE!!</strong></dt>
        					<dt><strong>13º - Rodada FREE!!</strong></dt>
        					<dt><strong>14º - Rodada FREE!!</strong></dt>
        					<dt><strong>15º - Rodada FREE!!</strong></dt>
        					<dt><strong>16º - Rodada FREE!!</strong></dt>
        					<dt><strong>17º - Rodada FREE!!</strong></dt>
        					<dt><strong>18º - Rodada FREE!!</strong></dt>
        					<dt><strong>19º - Rodada FREE!!</strong></dt>
        					<dt><strong>20º - Rodada FREE!!</strong></dt>
        				<?php } ?>
    				<?php } ?>
					<small>Taxa de administração: 15%</small>
				</div>
			<?php } else { ?>
				<?php if($json['status_mercado'] == 2){ ?>
					<h3>Premiação final</h3>
					<div>
    					<?php if($json['rodada_atual'] == 38){ ?>
    				        <dt><strong>1º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.5), 2, ',', '.') ;?> (50%)</strong></dt>
        					<dt><strong>2º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.17), 2, ',', '.') ;?> (17%)</strong></dt>
        					<dt><strong>3º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.12), 2, ',', '.') ;?> (12%)</strong></dt>
        					<dt><strong>4º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.07), 2, ',', '.') ;?> (7%)</strong></dt>
        					<dt><strong>5º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.04), 2, ',', '.') ;?> (4%)</strong></dt>
        					<dt><strong>6º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>7º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>8º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>9º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>10º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02), 2, ',', '.') ;?> (2%)</strong></dt>
    				    <?php } else { ?>
        					<dt><strong>1º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.5)-50, 2, ',', '.') ;?> (50%)</strong></dt>
        					<dt><strong>2º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.17)-17, 2, ',', '.') ;?> (17%)</strong></dt>
        					<dt><strong>3º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.12)-12, 2, ',', '.') ;?> (12%)</strong></dt>
        					<dt><strong>4º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.07)-7, 2, ',', '.') ;?> (7%)</strong></dt>
        					<dt><strong>5º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.04)-4, 2, ',', '.') ;?> (4%)</strong></dt>
        					<dt><strong>6º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>7º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>8º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>9º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>10º - R$  <?php echo number_format((($paiddata['paidteams']*8.5)*0.02)-2, 2, ',', '.') ;?> (2%)</strong></dt>
        					<dt><strong>11º - Rodada FREE!!</strong></dt>
        					<dt><strong>12º - Rodada FREE!!</strong></dt>
        					<dt><strong>13º - Rodada FREE!!</strong></dt>
        					<dt><strong>14º - Rodada FREE!!</strong></dt>
        					<dt><strong>15º - Rodada FREE!!</strong></dt>
        					<dt><strong>16º - Rodada FREE!!</strong></dt>
        					<dt><strong>17º - Rodada FREE!!</strong></dt>
        					<dt><strong>18º - Rodada FREE!!</strong></dt>
        					<dt><strong>19º - Rodada FREE!!</strong></dt>
        					<dt><strong>20º - Rodada FREE!!</strong></dt>
        				<?php } ?>
    					<small>Taxa de administração: 15%</small>
					</div>
				<?php } else { ?>
				<?php } ?>
			<?php } ?>
		</div>
    </section>
</main>