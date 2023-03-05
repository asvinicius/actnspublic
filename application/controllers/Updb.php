<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );

class Updb extends CI_Controller {
    
    // /opt/cpanel/ea-php71/root/usr/bin/php /home/wwacre/public_html/index.php updatepartial uptodate
    // /opt/cpanel/ea-php71/root/usr/bin/php /home/wwacre/public_html/index.php updatepartial updatesquad
    
    public function uptodate($limite = null){
        set_time_limit(12000);
        ini_set('default_socket_timeout', 12000);
        
        $this->load->model('ParciaisModel');
		$this->load->model('PAModel');
		$this->load->model('PRModel');
		$this->load->model('AtletasModel');
		$this->load->model('RegistryModel');
		$atletas = new AtletasModel();
		$partial = new ParciaisModel();
		$pa = new PAModel();
		$pr = new PRModel();
		$registry = new RegistryModel();
		
		$start_time = microtime(true); // Metrica de tempo de execução
		
		$json = $this->getstatus();
		
		if($json['status_mercado'] == 2){
		
    		$inscritos = $registry->codelistfree($json['rodada_atual']);
    		$div = intdiv(count($inscritos), 20);
    		
    		$inicio = $limite * $div;
    		
    		if($limite < 19){
    		    for($j = $inicio; $j < $inicio + $div; $j++){
        	        $this->addpartial($inscritos[$j]->registryteam);
        	    }
    		} else {
    		    for($j = $inicio; $j < count($inscritos); $j++){
        	        $this->addpartial($inscritos[$j]->registryteam);
        	    }
    		}
		}
	    
	    $end_time = microtime(true); // Métrica de tempo de execução
	    $execution_time = ($end_time - $start_time); // Métrica de tempo de execução
        
    }
    
    public function addpartial($teamid){ 
		$this->load->model('ParciaisModel');
		$this->load->model('PAModel');
		$this->load->model('PRModel');
		$this->load->model('AtletasModel');
		$atletas = new AtletasModel();
		$partial = new ParciaisModel();
		$pa = new PAModel();
		$pr = new PRModel();
		
		$partialaux = $partial->search($teamid);
		
		if($partialaux){
		    
		    if($this->checkchange($teamid)){
		    
    		    $paitem = $pa->getsquad($partialaux['partialteam']);
    	        $points = 0;
    	        
                foreach($paitem as $teamatletas){
    	            $getatleta = $atletas->search($teamatletas->pa_atleta);
    	            if($teamatletas->pa_capitao == 1){
    					$points += 2*($getatleta['atletaspontos']);
    				} else {
    					$points += $getatleta['atletaspontos'];
    				}
                }
                
                $partialdata['partialid'] = $partialaux['partialid'];
    			$partialdata['partialteam'] = $partialaux['partialteam'];
    			$partialdata['partialcap'] = $partialaux['partialcap'];
    			$partialdata['partialpoints'] = $points;
    			
    			if($partial->update($partialdata)){
    				
    			}
		    }
		    
		} else {
		    
		    $team = $this->getsquad($teamid);
		    
			$partialdata['partialid'] = null;
			$partialdata['partialteam'] = $teamid;
			$partialdata['partialcap'] = $team['capitao_id'];
			$partialdata['partialpoints'] = 0;
			
			if($partial->save($partialdata)){
				
				foreach($team['atletas'] as $teamatletas){
					$atletaitem = $atletas->search($teamatletas['atleta_id']);
					
					if($atletaitem){
						$padata['pa_id'] = null;
						$padata['pa_team'] = $teamid;
						$padata['pa_atleta'] = $teamatletas['atleta_id'];
						
						if($team['capitao_id'] == $teamatletas['atleta_id']){
							$padata['pa_capitao'] = 1;
						} else {
							$padata['pa_capitao'] = 0;
						}
						
						if($pa->save($padata)){
						}
					} else {
						$atletasdata['atletasid'] = $teamatletas['atleta_id'];
						$atletasdata['atletasnome'] = $teamatletas['nome'];
						$atletasdata['atletasapelido'] = $teamatletas['apelido'];
						$atletasdata['atletasclube'] = $teamatletas['clube_id'];
						$atletasdata['atletasposicao'] = $teamatletas['posicao_id'];
						$atletasdata['atletaspontos'] = 0;
						
						if($atletas->save($atletasdata)){
						
							$padata['pa_id'] = null;
							$padata['pa_team'] = $teamid;
							$padata['pa_atleta'] = $teamatletas['atleta_id'];
							
							if($team['capitao_id'] == $teamatletas['atleta_id']){
								$padata['pa_capitao'] = 1;
							} else {
								$padata['pa_capitao'] = 0;
							}
							
							if($pa->save($padata)){
							}
						}
					}
				}
				foreach($team['reservas'] as $teamreservas){
					$atletaitem = $atletas->search($teamreservas['atleta_id']);
					
					if($atletaitem){
						$prdata['pr_id'] = null;
						$prdata['pr_team'] = $teamid;
						$prdata['pr_atleta'] = $teamreservas['atleta_id'];
						
						if($pr->save($prdata)){
						}
					} else {
						$atletasdata['atletasid'] = $teamreservas['atleta_id'];
						$atletasdata['atletasnome'] = $teamreservas['nome'];
						$atletasdata['atletasapelido'] = $teamreservas['apelido'];
						$atletasdata['atletasclube'] = $teamreservas['clube_id'];
						$atletasdata['atletasposicao'] = $teamreservas['posicao_id'];
						$atletasdata['atletaspontos'] = 0;
						
						if($atletas->save($atletasdata)){
						
							$prdata['pr_id'] = null;
							$prdata['pr_team'] = $teamid;
							$prdata['pr_atleta'] = $teamreservas['atleta_id'];
							
							if($pr->save($prdata)){
							}
						}
					}
				}
			}
		}
	}
	
	public function checkchange($teamid){ 
        set_time_limit(12000);
        ini_set('default_socket_timeout', 12000);
        
		$this->load->model('ParciaisModel');
		$this->load->model('PAModel');
		$this->load->model('PRModel');
		$partial = new ParciaisModel();
		$pa = new PAModel();
		$pr = new PRModel();
		
        $change = $this->getchange($teamid);
        
        if($change){
            foreach($change as $changeitem){
                
                $changeatleta = $pa->forchange($teamid, $changeitem['saiu']['atleta_id']);
                $changereserva = $pr->forchange($teamid, $changeitem['entrou']['atleta_id']);
                
                if($changeatleta){
					
	                $padata['pa_id'] = $changeatleta['pa_id'];
					$padata['pa_team'] = $changeatleta['pa_team'];
					$padata['pa_atleta'] = $changereserva['pr_atleta'];
					$padata['pa_capitao'] = $changeatleta['pa_capitao'];
					
					$prdata['pr_id'] = $changereserva['pr_id'];
					$prdata['pr_team'] = $changereserva['pr_team'];
					$prdata['pr_atleta'] = $changeatleta['pa_atleta'];
					
					if($pa->update($padata)){}
					if($pr->update($prdata)){}
					
					if($changeatleta['pa_capitao'] == 1){
    					$parcialitem = $partial->search($teamid);
    					
    					$partialdata['partialid'] = $parcialitem['partialid'];
            			$partialdata['partialteam'] = $parcialitem['partialteam'];
            			$partialdata['partialcap'] = $changereserva['pr_atleta'];
            			$partialdata['partialpoints'] = $parcialitem['partialpoints'];
            			
            			if($partial->update($partialdata)){}
					}
                }
            }
        }
        return true;
	}
	
	public function getsquad($teamid=null) {
        
        $url = 'https://api.cartola.globo.com/time/id/'.$teamid;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die(curl_error($ch));
        }
        
        curl_close($ch);
        
        $json = json_decode($result, true);
        
        return $json;
    }
    
    public function getchange($teamid=null) {
        
        $url = 'https://api.cartola.globo.com/time/substituicoes/'.$teamid;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die(curl_error($ch));
        }
        
        curl_close($ch);
        
        $json = json_decode($result, true);
        
        return $json;
    }
    
}