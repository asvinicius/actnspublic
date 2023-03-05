<head>
    <title>Histórico</title>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>Dados históricos</h2>
			</div>

		</div>
	</section>
	<section id="historic" class="historic">
		<div class="container">
			<div class="row no-gutters">
				<h3> Sua mitada fica aqui </h3>
                <table class="table">
                    <?php if ($years) { ?>
                        <thead>
                            <tr>
                                <th title="Ano">Ano</th>
                                <th title="Liga clássica">Liga clássica</th>
                                <th title="Bolao">Bolão</th>
                                <th title="Mata-mata">Mata-mata</th>
                                <th title="Mata-mata">Equipes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($years as $year) { ?>
                                <tr>
                                    <td><strong><?php echo $year->yeardesc ?></strong></td>
                                    <td>
										<?php if($year->yearclassic == 1){ ?>
											<a href="<?= base_url('historico/classica/'.$year->yearid); ?>"><i class="icon-plus"> Veja mais</i></a>
										<?php } else{ ?>
											<i class="icon-ban-circle"> Indisponível</i>
										<?php } ?>
									</td>
                                    <td>
										<?php if($year->yearcontest == 1){ ?>
											<a href="<?= base_url('historico/bolao/'.$year->yearid); ?>"><i class="icon-plus"> Veja mais</i></a>
										<?php } else{ ?>
											<i class="icon-ban-circle"> Indisponível</i>
										<?php } ?>
									</td>
                                    <td>
										<?php if($year->yearplayoff == 1){ ?>
											<a href="<?= base_url('historico/matamata/'.$year->yearid); ?>"><i class="icon-plus"> Veja mais</i></a>
										<?php } else{ ?>
											<i class="icon-ban-circle"> Indisponível</i>
										<?php } ?>
									</td>
                                    <td>
										<?php if($year->squad == 1){ ?>
											<a href="<?= base_url('historico/equipes/'.$year->yearid); ?>"><i class="icon-plus"> Veja mais</i></a>
										<?php } else{ ?>
											<i class="icon-ban-circle"> Indisponível</i>
										<?php } ?>
									</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php }else{ ?>
                        <h4>Não temos informações históricas!</h4>
                    <?php } ?>
                </table>
			</div>
		</div>
    </section>
</main>