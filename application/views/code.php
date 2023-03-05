
<head><meta charset="utf-8">
    <title>Código</title>
</head>
<main id="main">
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center">
				<h2>APP externo</h2>
				<ol>
					<li><a href="<?= base_url('bolao');?>"> Voltar </a></li>
				</ol>
			</div>

		</div>
	</section>
	<section id="blog" class="blog">
		<div class="container">
			<div class="row">
			    <div class="col-lg-12 entries">
					<article class="entry" data-aos="fade-up">
						<h2 class="entry-title">
							Código para <strong>APP de parciais</strong>
						</h2>
        				<button onClick="copiarTexto()">Copiar código</button>
						<div class="entry-content" style="word-wrap: break-word;">
						    <hr />
							<?php echo "Bolão Acretinos #".$spin."=>".$finalcode; ?>
						</div>
        			</article>
        		</div>
			</div>
		</div>
    </section>
</main>
<input type="text" id="link" name="link" value="<?php echo "Bolão Acretinos #".$spin."=>".$finalcode; ?>"> 
<script>
  function copiarTexto() {
    var textoCopiado = document.getElementById("link");
    textoCopiado.select();
    document.execCommand("Copy");
    alert("Código copiado");
  }
</script>