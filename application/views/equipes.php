<head>
    <title>Liga de equipes</title>
    <style>
        @media only screen and (max-width: 768px) {
            td.hidden-sm{display:none; }
        }
    </style>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Liga de equipes</h2>
				<ol>
				    <?php if($rodada < 10){ ?>
					    <li><a href="<?= base_url('equipes/rodada/10');?>"> Mata-mata </a></li>
					<?php }else{ ?>
					    <li><a href="<?= base_url('equipes/rodada/9');?>"> Fase de grupos </a></li>
					<?php } ?>
				</ol>
			</div>
		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
			    <?php if($rodada < 10){ ?>
    				<div class="col-lg-7 entries">
    					<article class="entry" data-aos="fade-up">
    						<h3> Grupo A </h3>
    						<table class="table table-sm table-hover table-responsive-sm">
    							<?php if ($grupo1) { ?>
    								<thead>
    									<tr>
    										<th title="Posição">#</th>
                                            <th title="Escudo"></th>
                                            <th title="Equipe">Equipe</th>
                                            <th title="Pontos">P</th>
                                            <th title="Média">M</th>
    									</tr>
    								</thead>
    								<tbody>
    									<?php $cont = 0;  ?>
    									<?php foreach ($grupo1 as $g1equipe) {  ?>
    										<?php $cont++; ?>
    										<tr class="<?php if($cont < 5) {echo "table-success";} ?>">
    											<td>
    												<span class="badge <?php if($cont < 5) { echo "badge-success";}else{ echo "badge-secondary";} ?>">
    													<?php echo $cont."º" ?>
    												</span>
    											</td>
    											<td>
    											    <img src="<?php echo "https://www.acretinos.com.br/assets/img/equipes/".$g1equipe->equipe_escudo.".png" ?>" alt="..." class="align-center" width="30" />
    											</td>
    											<td>
    												<dt><a href="<?= base_url('equipes/equipe/'.$g1equipe->equipe_id); ?>"><?php echo $g1equipe->equipe_nome ?></a></dt>
    											</td>
    											<td>
    												<dd><?php echo $g1equipe->ranking_pontos ?></dd>
    											</td>
    											<td><?php echo number_format(($g1equipe->equipe_pontos)/5, 2, '.', '') ?></td>
    										</tr>
    									<?php } ?>			
    								</tbody>
    							<?php }else{ ?>
    								<h4>Não existe informações para sua busca!</h4>
    							<?php } ?>
    						</table>
    						<hr />
    						<h3> Grupo B </h3>
    						<table class="table table-sm table-hover table-responsive-sm">
    							<?php if ($grupo2) { ?>
    								<thead>
    									<tr>
    										<th title="Posição">#</th>
                                            <th title="Escudo"></th>
                                            <th title="Equipe">Equipe</th>
                                            <th title="Pontos">P</th>
                                            <th title="Média">M</th>
    									</tr>
    								</thead>
    								<tbody>
    									<?php $cont = 0;  ?>
    									<?php foreach ($grupo2 as $g2equipe) {  ?>
    										<?php $cont++; ?>
    										<tr class="<?php if($cont < 5) {echo "table-success";} ?>">
    											<td>
    												<span class="badge <?php if($cont < 5) { echo "badge-success";}else{ echo "badge-secondary";} ?>">
    													<?php echo $cont."º" ?>
    												</span>
    											</td>
    											<td>
    											    <img src="<?php echo "https://www.acretinos.com.br/assets/img/equipes/".$g2equipe->equipe_escudo.".png" ?>" alt="..." class="align-center" width="30" />
    											</td>
    											<td>
    												<dt><a href="<?= base_url('equipes/equipe/'.$g2equipe->equipe_id); ?>"><?php echo $g2equipe->equipe_nome ?></a></dt>
    											</td>
    											<td>
    												<dd><?php echo $g2equipe->ranking_pontos ?></dd>
    											</td>
    											<td><?php echo number_format(($g2equipe->equipe_pontos)/5, 2, '.', '') ?></td>
    										</tr>
    									<?php } ?>			
    								</tbody>
    							<?php }else{ ?>
    								<h4>Não existe informações para sua busca!</h4>
    							<?php } ?>
    						</table>
    					</article>
    				</div>
    				<div class="col-lg-5">
    					<div class="sidebar" data-aos="fade-left">
    						<div class="sidebar-item tags">
    							<ul>
    								<li>
    								    <?php if($rodada > 1){ ?>
    								        <a href="<?= base_url('equipes/rodada/'.($rodada-1));?>"><i class="icofont-arrow-left"></i></a>
    								    <?php } ?>
    								</li>
    								<li>
    								    <?php if($rodada < 9){ ?>
    								        <li><a href="<?= base_url('equipes/rodada/'.($rodada+1));?>"><i class="icofont-arrow-right"></i></a></li>
    								    <?php } ?>
    								</li>
    							</ul>
    						</div>						
    						<?php if($jogos){ ?>
    							<h3 class="sidebar-title">Rodada <?= $rodada ?></h3>
    							<table class="table table-sm table-hover table-responsive-sm">
    							    <tbody>
    							        <?php foreach ($jogos as $jogo) { ?>
    							            <tr>
    							                <td style="text-align:right">
    							                    <dt><?php echo $jogo->tnamea ?></dt>
    											    <dd class="<?php if($jogo->status == 2){echo "text-primary";}else{echo "text-success";}?>">
    											        <?php if($jogo->status == 0){ ?>
        							                        <?php echo number_format(($jogo->apontos)/5, 2, '.', '') ?>
        							                    <?php } else { ?>
        							                        <?php if($jogo->status == 2){ ?>
        							                            <?php echo number_format(($jogo->apontos)/5, 2, '.', '') ?>
        							                        <?php } ?>
        							                    <?php } ?>
    											    </dd>
    							                </td>
    							                <td style="text-align:center"><i class="icofont-close"></i></td>
    							                <td>
    							                    <dt><?php echo $jogo->tnameb ?></dt>
    											    <dd class="<?php if($jogo->status == 2){echo "text-primary";}else{echo "text-success";}?>">
    											        <?php if($jogo->status == 0){ ?>
        							                        <?php echo number_format(($jogo->bpontos)/5, 2, '.', '') ?>
        							                    <?php } else { ?>
        							                        <?php if($jogo->status == 2){ ?>
        							                            <?php echo number_format(($jogo->bpontos)/5, 2, '.', '') ?>
        							                        <?php } ?>
        							                    <?php } ?>
    											    </dd>
    							                </td>
    							            </tr>
    							        <?php } ?>
    							    </tbody>
    							</table>
    						<?php } ?>
    					</div>
    				</div>
    			<?php } else { ?>
    			    <?php if($rodada < 12){ ?>
        			    <div class="col-lg-12 entries">
    					    <h3 style="text-align:center" >
    					        <?php if($rodada > 9){ ?>
        					        <?php if($rodada > 10){ ?>
        					            <a href="<?= base_url('equipes/rodada/'.($rodada-1));?>"><i class="icofont-arrow-left"></i></a>
        					        <?php } ?>
        					    <?php } ?>
        					    
        					    <?php if($rodada == 10){ ?>
        					        Quartas de final 
        					    <?php } ?>
        					    <?php if($rodada == 11){ ?>
        					        Semi final 
        					    <?php } ?>
        					    <?php if($rodada == 12){ ?>
        					        Final 
        					    <?php } ?>
        					    
    					        <?php if($rodada > 9){ ?>
        					        <?php if($rodada < 12){ ?>
        					            <a href="<?= base_url('equipes/rodada/'.($rodada+1));?>"><i class="icofont-arrow-right"></i></a>
        					        <?php } ?>
        					    <?php } ?>
    					    </h3>
    						<table class="table table-hover table-borderless table-responsive-sm" >
    							<tbody>
    							    
    								<?php if($jogos) { ?>
    							    
        								<?php foreach ($jogos as $jogo) { ?>
        									<tr>
        										<td style="text-align:right">
        										    <a href="<?= base_url('equipes/equipe/'.$jogo->aid); ?>"><img src="<?php echo "https://www.acretinos.com.br/assets/img/equipes/".$jogo->tescudoa.".png" ?>" alt="..." class="align-center" width="45" /></a>
        										</td>
        										<td style="text-align:right" class="hidden-sm">
        											<dt><h4><a href="<?= base_url('equipes/equipe/'.$jogo->aid); ?>"><?php echo $jogo->tnamea ?></a></h4></dt>
        										</td>
        										<td style="text-align:right">
        											<dd class="<?php if($jogo->status == 2){echo "text-primary";}else{echo "text-success";}?>">
        											    <?php if($jogo->status == 0){ ?>
        							                        <?php echo number_format(($jogo->apontos)/5, 2, '.', '') ?>
        							                    <?php } else { ?>
        							                        <?php if($jogo->status == 2){ ?>
        							                            <?php echo number_format(($jogo->apontos)/5, 2, '.', '') ?>
        							                        <?php } ?>
        							                    <?php } ?>
        											</dd>
        										</td>
        										<td style="text-align:center">
        											<dd><i class="icofont-close"></i></dd>
        										</td>
        										<td>
        											<dd class="<?php if($jogo->status == 2){echo "text-primary";}else{echo "text-success";}?>">
        										    	<?php if($jogo->status == 0){ ?>
        							                        <?php echo number_format(($jogo->bpontos)/5, 2, '.', '') ?>
        							                    <?php } else { ?>
        							                        <?php if($jogo->status == 2){ ?>
        							                            <?php echo number_format(($jogo->bpontos)/5, 2, '.', '') ?>
        							                        <?php } ?>
        							                    <?php } ?>
        							                </dd>
        										</td>
        										<td class="hidden-sm">
        											<dt><h4><a href="<?= base_url('equipes/equipe/'.$jogo->bid); ?>"><?php echo $jogo->tnameb ?></a></h4></dt>
        										</td>
        										<td>
        										    <a href="<?= base_url('equipes/equipe/'.$jogo->bid); ?>"><img src="<?php echo "https://www.acretinos.com.br/assets/img/equipes/".$jogo->tescudob.".png" ?>" alt="..." class="align-center" width="45" /></a>
        										</td>
        									</tr>
    								    <?php } ?>	
    								<?php } else { ?>	
    								    <h4 style="text-align:center" > Fase sem confrontos definidos </h4>
    								<?php } ?>			
    							</tbody>
    						</table>
        			    </div>
        	        <?php } else { ?>
        	            <div class="col-lg-12 entries">
            	            <h3 style="text-align:center" >
    					        <?php if($rodada > 9){ ?>
        					        <?php if($rodada > 10){ ?>
        					            <a href="<?= base_url('equipes/rodada/'.($rodada-1));?>"><i class="icofont-arrow-left"></i></a>
        					        <?php } ?>
        					    <?php } ?>
        					    <?php if($rodada == 12){ ?>
        					        Final 
        					    <?php } ?>
    					    </h3>
							<?php $cont = 0;  ?>
    					    <?php foreach ($jogos as $jogo) { ?>
    					        <table class="table table-hover table-borderless table-responsive-sm" >
    							    <tbody>
    							        <tr>
    										<td style="text-align:right">
    										    <a href="<?= base_url('equipes/equipe/'.$jogo->aid); ?>"><img src="<?php echo "https://www.acretinos.com.br/assets/img/equipes/".$jogo->tescudoa.".png" ?>" alt="..." class="align-center" width="45" /></a>
    										</td>
    										<td style="text-align:right" class="hidden-sm">
    											<dt><h4><a href="<?= base_url('equipes/equipe/'.$jogo->aid); ?>"><?php echo $jogo->tnamea ?></a></h4></dt>
    										</td>
    										<td style="text-align:right">
    											<dd class="<?php if($jogo->status == 2){echo "text-primary";}else{echo "text-success";}?>">
    											    <?php if($jogo->status == 0){ ?>
    							                        <?php echo number_format(($jogo->apontos)/5, 2, '.', '') ?>
    							                    <?php } else { ?>
    							                        <?php if($jogo->status == 2){ ?>
    							                            <?php echo number_format(($jogo->apontos)/5, 2, '.', '') ?>
    							                        <?php } ?>
    							                    <?php } ?>
    											</dd>
    										</td>
    										<td style="text-align:center">
    											<dd><i class="icofont-close"></i></dd>
    										</td>
    										<td>
    											<dd class="<?php if($jogo->status == 2){echo "text-primary";}else{echo "text-success";}?>">
    										    	<?php if($jogo->status == 0){ ?>
    							                        <?php echo number_format(($jogo->bpontos)/5, 2, '.', '') ?>
    							                    <?php } else { ?>
    							                        <?php if($jogo->status == 2){ ?>
    							                            <?php echo number_format(($jogo->bpontos)/5, 2, '.', '') ?>
    							                        <?php } ?>
    							                    <?php } ?>
    							                </dd>
    										</td>
    										<td class="hidden-sm">
    											<dt><h4><a href="<?= base_url('equipes/equipe/'.$jogo->bid); ?>"><?php echo $jogo->tnameb ?></a></h4></dt>
    										</td>
    										<td>
    										    <a href="<?= base_url('equipes/equipe/'.$jogo->bid); ?>"><img src="<?php echo "https://www.acretinos.com.br/assets/img/equipes/".$jogo->tescudob.".png" ?>" alt="..." class="align-center" width="45" /></a>
    										</td>
    									</tr>
    							    </tbody>
    						    </table>
    						    <?php if($cont == 0){ ?>
        						    <h3 style="text-align:center" >
                					    <?php if($rodada == 12){ ?>
                					        3º Lugar 
                					    <?php } ?>
            					    </h3>
            					<?php } ?>
        					    <?php $cont++;  ?>
    					    <?php } ?>
    				    </div>
        	        <?php } ?>
    			<?php } ?>
			</div>
		</div>
    </section>
</main>