<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );
?>
<head>
    <title>Eliminatório Acretinos</title>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Eliminatório</h2>
				<?php if($showcode == 0){ ?>
    				<ol>
    					<li><a href="<?= base_url('eliminatorio/codigo');?>"> Código </a></li>
    				</ol>
    			<?php } ?>
			</div>
		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
				<?php if ($partial) { ?>
				    <?php if($json['status_mercado'] == 1){ ?>
					    <h4> Times para a próxima rodada</h4>
				    <?php } else { ?>
					    <?php if($json['status_mercado'] == 2){ ?>
    					    <h4> Parciais</h4>
    				    <?php } else { ?>
    					    <h4> Mercado em manutenção </h4>
    				    <?php } ?>
				    <?php } ?>
					<table class="table table-hover table-responsive-sm" id="dataTable">
					    
					    <?php if($json['rodada_atual'] < 33){ ?>
        		            <?php $sub = 3; ?>
        		        <?php } else { ?>
        		            <?php if($json['rodada_atual'] < 38){ ?>
        		                <?php $sub = 2; ?>
        		            <?php } else { ?>
        		                <?php $sub = 0; ?>
        		            <?php } ?>
        		        <?php } ?>
					    
						<tbody>
						    <?php $corte = count($partial)-$sub; ?>
							<?php $cont = 1; ?>
							<?php foreach ($partial as $pteam) {  ?>
								<tr class="<?php if($cont > $corte) { echo "table-danger";} ?>">
									<td>
									    <dd>
											<span class="badge <?php if($cont > $corte) { echo "badge-danger";}else{ echo "badge-secondary";} ?>">
												<small><?php echo $cont."º" ?></small>
											</span>
										    <img src="<?php echo $pteam->et_shield ?>" width="25" alt="..."/>
										</dd>
									</td>
									<td>
									    <small><a href="<?= base_url('eliminatorio/escalacao/'.$pteam->et_id); ?>"><?php echo $pteam->et_name ?></a><small> [ <?php echo $pteam->et_coach ?> ]</small></small>
									    <?php if($json['status_mercado'] != 1){ ?>
    										<dd>
    										    <small>
    									            <small>
    										            <strong>© <?php echo $pteam->atletasapelido ?></strong>
    											    </small>
    										    </small>
    										</dd>
										<?php } ?>
									</td>
									<?php if($showpt == 0){ ?>
    									<td>
    								        <small>
    								            <?php echo number_format($pteam->et_point, 2, '.', '') ?>
    								        </small>
    								        <dd class="text-success">
    									        <small>
        									        <small>
        									            <strong>
            									            <?php if ($cont < 7) { ?>
            									                <?php switch ($cont) {
            									                     case 1:
            									                        ?> R$ 1.000,00 <?php
            									                        break;
            									                     case 2: 
            									                        ?> R$ 600,00 <?php
            									                        break;
            									                     case 3: 
            									                        ?> R$ 400,00 <?php
            									                        break;
            									                     case 4: 
            									                        ?> R$ 250,00 <?php
            									                        break;
            									                     case 5: 
            									                        ?> R$ 150,00 <?php
            									                        break; 
            									                     case 6: 
            									                        ?> R$ 100,00 <?php
            									                        break; 
            									                } ?>
            									            <?php } else { ?>
        									                    R$ R$ 50,00 
            									            <?php } ?>
        									            </strong>
        									        <small>    
    									        <small>    
    								        </dd>
    									</td>
									<?php } else { ?>
									    <td>
									        <small>
    									        <small>
    									            <strong>
        									            <?php if ($cont < 7) { ?>
        									                <?php switch ($cont) {
        									                     case 1:
        									                        ?> R$ 1.000,00 <?php
        									                        break;
        									                     case 2: 
        									                        ?> R$ 600,00 <?php
        									                        break;
        									                     case 3: 
        									                        ?> R$ 400,00 <?php
        									                        break;
        									                     case 4: 
        									                        ?> R$ 250,00 <?php
        									                        break;
        									                     case 5: 
        									                        ?> R$ 150,00 <?php
        									                        break; 
        									                     case 6: 
        									                        ?> R$ 100,00 <?php
        									                        break; 
        									                } ?>
        									            <?php } else { ?>
    									                    R$ R$ 50,00 
        									            <?php } ?>
    									            </strong>
    									        <small>    
									        <small>  
    									</td>
									<?php } ?>
								</tr>
								<?php $cont++; ?>
							<?php } ?>
						</tbody>
					</table>
                    <p><span class="badge badge-warning">Repescagem</span></p>
					<p><span class="badge badge-danger"><small>Zona de corte</small></span></p>
				<?php }else{ ?>
					<h4>Sem parciais no momento</h4>
				<?php } ?>
			</div>
		</div>
	</section>
	<section id="cta-pricing" class="cta-pricing">
		<div class="container" style="text-align:center">
			<h3>Premiação final</h3>
			<div>
		        <dt><strong>1º - R$ 1.000,00 </strong></dt>
		        <dt><strong>2º - R$ 600,00 </strong></dt>
		        <dt><strong>3º - R$ 400,00 </strong></dt>
		        <dt><strong>4º - R$ 250,00 </strong></dt>
		        <dt><strong>5º - R$ 150,00 </strong></dt>
		        <dt><strong>6º - R$ 100,00 </strong></dt>
		        <dt><strong>7º - R$ 50,00 </strong></dt>
		        <dt><strong>8º - R$ 50,00 </strong></dt>
		        <dt><strong>9º - R$ 50,00 </strong></dt>
		        <dt><strong>10º - R$ 50,00 </strong></dt>
		        <hr />
		        
		        <?php if($json['rodada_atual'] < 33){ ?>
		            <dt><strong>3 serão eliminados na rodada <?= $json['rodada_atual']; ?> </strong></dt>
		        <?php } else { ?>
		            <?php if($json['rodada_atual'] < 38){ ?>
		                <dt><strong>2 serão eliminados na rodada <?= $json['rodada_atual']; ?> </strong></dt>
		            <?php } ?>
		        <?php } ?>
		        
		        
				<small>Taxa de administração: 10%</small>
			</div>
		</div>
    </section>
</main>