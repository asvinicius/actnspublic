<head>
    <title>X1</title>
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
				<h2>X1</h2>
			</div>
		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
			    <div class="col-lg-12 entries">
			        
				    <h3 style="text-align:center" > X1 do século </h3>
				    
					<table class="table table-hover table-borderless table-responsive-sm" >
						<tbody>
							<tr>
								<td style="text-align:right">
								    <a href="<?= base_url('equipes/equipe/'.$confraria['equipe_id']); ?>"><img src="<?php echo "https://www.acretinos.com.br/assets/img/equipes/".$confraria['equipe_escudo'].".png" ?>" alt="..." class="align-center" width="45" /></a>
								</td>
								<td style="text-align:right" class="hidden-sm">
									<dt><h4><a href="<?= base_url('equipes/equipe/'.$confraria['equipe_id']); ?>"><?php echo $confraria['equipe_nome'] ?></a></h4></dt>
								</td>
								<td style="text-align:right">
									<dd class="text-info"> <h4> <?php echo number_format(($confraria['equipe_pontos'])/5, 2, '.', '') ?> </h4> </dd>
								</td>
								
								<td style="text-align:center">
									<dd><i class="icofont-close"></i></dd>
								</td>
								
								<td>
									
									<dd class="text-info"> <h4> <?php echo number_format(($fuleiros['equipe_pontos'])/5, 2, '.', '') ?> </h4> </dd>
								</td>
								<td class="hidden-sm">
									<dt><h4><a href="<?= base_url('equipes/equipe/'.$fuleiros['equipe_id']); ?>"><?php echo $fuleiros['equipe_nome'] ?></a></h4></dt>
								</td>
								<td>
								    <a href="<?= base_url('equipes/equipe/'.$fuleiros['equipe_id']); ?>"><img src="<?php echo "https://www.acretinos.com.br/assets/img/equipes/".$fuleiros['equipe_escudo'].".png" ?>" alt="..." class="align-center" width="45" /></a>
								</td>
							</tr>		
						</tbody>
					</table>
			    </div>
			</div>
		</div>
    </section>
</main>