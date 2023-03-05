<head>
    <title>Código</title>
</head>
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="span4">
                <div class="inner-heading">
                    <h2>APP Parciais</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="content">
    <div class="container">
        <div class="row">
          <div class="span9">
            <h4><?php echo $equipea['equipe_nome']." vs ".$equipeb['equipe_nome']; ?></h4>
            <textarea rows="15" style="width:800px; resize: none" readonly="readonly"><?php
                    $c = 0;
                    foreach ($regdata as $simple) {
                        if($c == 0){
                            echo $equipea['equipe_nome']." vs ".$equipeb['equipe_nome']."=>".$simple->time;
                        }else{
                            echo ";".$simple->time;
                        }
                        $c++;
                    }
                ?></textarea>
          </div>
          <div class="span3">
            <a href="<?= base_url('jogos');?>" class="btn btn-large btn-theme btn-block">Voltar</a>
          </div>
        </div>
        <!-- divider -->
        <div class="row">
          <div class="span12">
            <div class="solidline">
            </div>
          </div>
        </div>
        <!-- end divider -->
        <!-- Descriptions -->
        <p>Para acompanhar as parciais, baixe o aplicativo PARCIAIS CFC, disponível na App Store e no Google Play;</p>
        <p>Dentro do app, peça para importar grupo e cole o código acima; Peça para importar e acompanhe as parciais da rodada</p>
        
       
        </div>
        
      </div>
</section>