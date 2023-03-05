<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );

class Updatepartial extends CI_Controller {
    
    // /opt/cpanel/ea-php71/root/usr/bin/php /home/wwacre/public_html/index.php updatepartial uptodate
    // /opt/cpanel/ea-php71/root/usr/bin/php /home/wwacre/public_html/index.php updatepartial updatesquad
    
    public function retomaparcial(){
        set_time_limit(12000);
        ini_set('default_socket_timeout', 12000);
        
        $this->load->model('PartialModel');
		$this->load->model('PartialatletasModel');
		$this->load->model('AtletasModel');
		$this->load->model('PartidasModel');
		$this->load->model('RegistryModel');
		$atletas = new AtletasModel();
		$partidas = new PartidasModel();
		$partial = new PartialModel();
		$pa = new PartialatletasModel();
		$registry = new RegistryModel();
		
		$reglisting = $registry->codelistfree(35);
		
		foreach($reglisting as $regitem){
			$partialaux = $partial->search($regitem->registryteam);
			
			if(!$partialaux){
    		    $partialdata['partialid'] = null;
    			$partialdata['partialteam'] = $regitem->registryteam;
    			$partialdata['partialcap'] = 0;
    			$partialdata['partialpoints'] = 0;
    			
    			if($partial->save($partialdata)){
    			    
    			}
    		}
		}
    }
    
    public function uptodate(){ 
        set_time_limit(12000);
        ini_set('default_socket_timeout', 12000);
        
		$this->load->model('PartialModel');
		$this->load->model('PartialatletasModel');
		$this->load->model('AtletasModel');
		$this->load->model('PartidasModel');
		$this->load->model('RegistryModel');
		$atletas = new AtletasModel();
		$partidas = new PartidasModel();
		$partial = new PartialModel();
		$pa = new PartialatletasModel();
		$registry = new RegistryModel();
		
		$json = $this->getstatus();
		
		if($json['status_mercado'] == 2){
			$pontuados = $this->getpontuados();
			$partidasaux = $this->getpartidas();
			$patletas = $atletas->listing();
			$listpartidas = $partidas->listing();
			
			$pontuadoitens = $pontuados['atletas'];
			if($patletas){
				foreach($patletas as $atleta){
					$atletasdata['atletasid'] = $atleta->atletasid;
					$atletasdata['atletasnome'] = $atleta->atletasnome;
					$atletasdata['atletasapelido'] = $atleta->atletasapelido;
					$atletasdata['atletasclube'] = $atleta->atletasclube;
					$atletasdata['atletasposicao'] = $atleta->atletasposicao;
					$atletasdata['atletaspontos'] = $pontuadoitens[$atleta->atletasid]['pontuacao'];
					
					if($atletas->update($atletasdata)){
						
					}
				}
			} else {
				$reglisting = $registry->codelistfree($json['rodada_atual']);
				
				foreach($reglisting as $regitem){
					$this->addpartial($regitem->registryteam);
				}
			}
			$partidaitens = $partidasaux['partidas'];
			if($listpartidas){
				foreach($partidaitens as $thegame){
					$partidadata['partida_id'] = $thegame['partida_id'];
					$partidadata['clube_casa_id'] = $thegame['clube_casa_id'];
					$partidadata['clube_visitante_id'] = $thegame['clube_visitante_id'];
					if($thegame['valida'] == true){
						$partidadata['valida'] = 1;
					} else {
						$partidadata['valida'] = 0;
					}
					$partidadata['status_transmissao_tr'] = $thegame['status_transmissao_tr'];
					
					if($partidas->update($partidadata)){
						
					}
				}
			} else {
				foreach($partidaitens as $thegame){
					$partidadata['partida_id'] = $thegame['partida_id'];
					$partidadata['clube_casa_id'] = $thegame['clube_casa_id'];
					$partidadata['clube_visitante_id'] = $thegame['clube_visitante_id'];
					if($thegame['valida'] == true){
						$partidadata['valida'] = 1;
					} else {
						$partidadata['valida'] = 0;
					}
					$partidadata['status_transmissao_tr'] = $thegame['status_transmissao_tr'];
					
					if($partidas->save($partidadata)){
						
					}
				}
			}
		}
	}
	
    public function updatesquad(){ 
        set_time_limit(18000);
        ini_set('default_socket_timeout', 18000);
        
		$this->load->model('PartialModel');
		$this->load->model('PartialatletasModel');
		$this->load->model('ReservaModel');
		$this->load->model('AtletasModel');
		$this->load->model('RegistryModel');
		$this->load->model('PartidasModel');
		$partidas = new PartidasModel();
		$atletas = new AtletasModel();
		$partial = new PartialModel();
		$pa = new PartialatletasModel();
		$pr = new ReservaModel();
		$registry = new RegistryModel();
		
		$json = $this->getstatus();
		
		if($json['status_mercado'] == 2){
			
			$instant = $partial->listing();
			
			$num = 1;
			
			foreach($instant as $instapartial){
				
				$paitem = $pa->getsquad($instapartial->partialteam);
				$points = 0;
				
				if(count($paitem) == 12){
					$pontuados = $this->getpontuados();
					$pontuadoitens = $pontuados['atletas'];
					foreach($paitem as $teamatletas){
						if($pontuadoitens[$teamatletas->pa_atleta]){
							$getatleta = $atletas->search($teamatletas->pa_atleta);
							if($teamatletas->pa_capitao == 1){
								$points += 2*($getatleta['atletaspontos']);
							} else {
								$points += $getatleta['atletaspontos'];
							}
						} else {
				            $pritem = $pr->getsquad($instapartial->partialteam);
							$titular = $atletas->search($teamatletas->pa_atleta);
							$partidaaux = $partidas->finished($titular['atletasclube']);
							if($partidaaux['status_transmissao_tr'] == "ENCERRADA"){									
								foreach($pritem as $reservas){
									if($pontuadoitens[$reservas->pr_atleta]){
										if($pontuadoitens[$reservas->pr_atleta]['posicao_id'] == $titular['atletasposicao']){
											$novotitular['pa_id'] = $teamatletas->pa_id;
											$novotitular['pa_team'] = $teamatletas->pa_team;
											$novotitular['pa_atleta'] = $reservas->pr_atleta;
											$novotitular['pa_capitao'] = $teamatletas->pa_capitao;
											
											$novoreserva['pr_id'] = $reservas->pr_id;
											$novoreserva['pr_team'] = $reservas->pr_team;
											$novoreserva['pr_atleta'] = $teamatletas->pa_atleta;
											
											if($pa->update($novotitular)){
												if($pr->update($novoreserva)){
													$getatleta = $atletas->search($novotitular['pa_atleta']);
													if($teamatletas->pa_capitao == 1){
														$points += 2*($getatleta['atletaspontos']);
													} else {
														$points += $getatleta['atletaspontos'];
													}
												}
											}
										}
									}
								}
							}
						}
					}	
					
					$partialitem = $partial->search($instapartial->partialteam);
				
					if($partialitem){
						$partialdata['partialid'] = $partialitem['partialid'];
						$partialdata['partialteam'] = $partialitem['partialteam'];
						$partialdata['partialcap'] = $partialitem['partialcap'];
						$partialdata['partialpoints'] = $points;
						
						if($partial->update($partialdata)){
							
						}
					}
				} else {
					$this->addpartial($instapartial->partialteam);
				}
			}
		}
	}
	
	public function addpartial($teamid){ 
		$this->load->model('PartialModel');
		$this->load->model('PartialatletasModel');
		$this->load->model('ReservaModel');
		$this->load->model('AtletasModel');
		$atletas = new AtletasModel();
		$partial = new PartialModel();
		$pa = new PartialatletasModel();
		$pr = new ReservaModel();
		
		$partialaux = $partial->search($teamid);
		
		if($partialaux){
		    
			$team = $this->getsquad($teamid);
				
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
	
	public function getpontuados() {
        $url = 'https://api.cartola.globo.com/atletas/pontuados';
        
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
	
	public function getpartidas() {
        $url = 'https://api.cartola.globo.com/partidas';
        
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
}