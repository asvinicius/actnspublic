<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );

class Parciais extends CI_Controller {
    
    public function uptodate($limite = null){
        set_time_limit(12000);
        ini_set('default_socket_timeout', 12000);
        
		$this->load->model('PartialequipeModel');
		$this->load->model('PEQatletasModel');
		$this->load->model('PRModel');
		$this->load->model('AtletasModel');
        $this->load->model('EquipesModel');
        $this->load->model('TEModel');
		$this->load->model('TabelaModel');
		$this->load->model('StatusModel');
		$atletas = new AtletasModel();
        $equipes = new EquipesModel();
        $te = new TEModel();
		$peq = new PartialequipeModel();
		$peq_atletas = new PEQatletasModel();
		$peq_reservas = new PRModel();
		$tabela = new TabelaModel();
		$status = new StatusModel();
		
		$json = $this->getstatus();
		
		if($json['status_mercado'] == 2){
		    
		    $inscritos = $te->listing();
    		$div = intdiv(count($inscritos), 20);
    		$inicio = $limite * $div;
    		
    		if($limite < 19){
    		    for($j = $inicio; $j < $inicio + $div; $j++){
        	        $this->addpartial($inscritos[$j]->te_time);
        	    }
    		} else {
    		    for($j = $inicio; $j < count($inscritos); $j++){
        	        $this->addpartial($inscritos[$j]->te_time);
        	    }
    		}
		    return false;
		}
		
    }
    
    public function addpartial($teamid){
		$this->load->model('PartialequipeModel');
		$this->load->model('PEQatletasModel');
		$this->load->model('AtletasModel');
		$this->load->model('PEQreservasModel');
		$peq = new PartialequipeModel();
		$peq_atletas = new PEQatletasModel();
		$atletas = new AtletasModel();
		$pr = new PEQreservasModel();
		
        $partialaux = $peq->search($teamid);
        
        if($partialaux){
            if($this->checkchange($teamid)){
                $paitem = $peq_atletas->getsquad($partialaux['peq_time']);
                $points = 0;
                
                foreach($paitem as $teamatletas){
                    $getatleta = $atletas->search($teamatletas->partialeq_atleta);
                    if($teamatletas->partialeq_capitao == 1){
    					$points += 2*($getatleta['atletaspontos']);
    				} else {
    					$points += $getatleta['atletaspontos'];
    				}
                }
                
                $peqdata['peq_id'] = $partialaux['peq_id'];
    			$peqdata['peq_time'] = $partialaux['peq_time'];
    			$peqdata['peq_points'] = $points;
    			
    			if($peq->update($peqdata)){
			
		        }
                
            }
        } else {
            $team = $this->getsquad($teamid);
            
            $peqdata['peq_id'] = null;
			$peqdata['peq_time'] = $teamid;
			$peqdata['peq_points'] = 0;
			
			if($peq->save($peqdata)){
		        foreach($team['atletas'] as $teamatletas){
		            $atletaitem = $atletas->search($teamatletas['atleta_id']);
		            
		            if($atletaitem){
		                $peqadata['partialeq_id'] = null;
    					$peqadata['partialeq_time'] = $teamid;
    					$peqadata['partialeq_atleta'] = $teamatletas['atleta_id'];
    					
    					if($team['capitao_id'] == $teamatletas['atleta_id']){
    						$peqadata['partialeq_capitao'] = 1;
    					} else {
    						$peqadata['partialeq_capitao'] = 0;
    					}
    					
    					if($peq_atletas->save($peqadata)){
    					}
		            } else {
		                $atletasdata['atletasid'] = $teamatletas['atleta_id'];
						$atletasdata['atletasnome'] = $teamatletas['nome'];
						$atletasdata['atletasapelido'] = $teamatletas['apelido'];
						$atletasdata['atletasclube'] = $teamatletas['clube_id'];
						$atletasdata['atletasposicao'] = $teamatletas['posicao_id'];
						$atletasdata['atletaspontos'] = 0;
						
						if($atletas->save($atletasdata)){
						    $peqadata['partialeq_id'] = null;
        					$peqadata['partialeq_time'] = $teamid;
        					$peqadata['partialeq_atleta'] = $teamatletas['atleta_id'];
        					
        					if($team['capitao_id'] == $teamatletas['atleta_id']){
        						$peqadata['partialeq_capitao'] = 1;
        					} else {
        						$peqadata['partialeq_capitao'] = 0;
        					}
        					
        					if($peq_atletas->save($peqadata)){
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
        
        $this->load->model('PartialequipeModel');
		$this->load->model('PEQatletasModel');
		$this->load->model('PEQreservasModel');
		$peq = new PartialequipeModel();
		$peq_atletas = new PEQatletasModel();
		$peq_reservas = new PEQreservasModel();
		
        $change = $this->getchange($teamid);
        
        if($change){
            foreach($change as $changeitem){
                
                $changeatleta = $peq_atletas->forchange($teamid, $changeitem['saiu']['atleta_id']);
                $changereserva = $peq_reservas->forchange($teamid, $changeitem['entrou']['atleta_id']);
                
                if($changeatleta){
					
	                $padata['partialeq_id'] = $changeatleta['partialeq_id'];
					$padata['partialeq_time'] = $changeatleta['partialeq_time'];
					$padata['partialeq_atleta'] = $changereserva['pr_atleta'];
					$padata['partialeq_capitao'] = $changeatleta['partialeq_capitao'];
					
					$prdata['pr_id'] = $changereserva['pr_id'];
					$prdata['pr_team'] = $changereserva['pr_team'];
					$prdata['pr_atleta'] = $changeatleta['partialeq_atleta'];
					
					if($peq_atletas->update($padata)){}
					if($peq_reservas->update($prdata)){}
                }
            }
        }
        return true;
	}
	
	public function equipesupdate($limite = null){ 
        set_time_limit(12000);
        ini_set('default_socket_timeout', 12000);
        
		$this->load->model('PartialequipeModel');
		$this->load->model('PEQatletasModel');
		$this->load->model('PEQreservasModel');
		$this->load->model('AtletasModel');
        $this->load->model('EquipesModel');
        $this->load->model('TEModel');
		$this->load->model('TabelaModel');
		$this->load->model('StatusModel');
		$atletas = new AtletasModel();
        $equipes = new EquipesModel();
        $te = new TEModel();
		$peq = new PartialequipeModel();
		$peq_atletas = new PEQatletasModel();
		$peq_reservas = new PEQreservasModel();
		$tabela = new TabelaModel();
		$status = new StatusModel();
        
        $json = $this->getstatus();
		
		if($json['status_mercado'] == 2){
		    
		    $laststatus = $status->search();
            $validspin = $laststatus['currentround']-24;
            $jogos = $tabela->listing($validspin);
            
            $tabela_data['tabela_id'] = $jogos[$limite]->id;
            $tabela_data['tabela_rodada'] = $jogos[$limite]->rodada;
            $tabela_data['tabela_equipea'] = $jogos[$limite]->aid;
            $tabela_data['tabela_equipea_pontos'] = 0;
            $tabela_data['tabela_equipeb'] = $jogos[$limite]->bid;
            $tabela_data['tabela_equipeb_pontos'] = 0;
            $tabela_data['tabela_status'] = 2;
            
            $l1 = $te->searchequipe($jogos[$limite]->aid);
            $l2 = $te->searchequipe($jogos[$limite]->bid);
            
            if($l1){
                foreach($l1 as $unid1){
                    $peqa = $peq_atletas->getsquad($unid1->te_time);
                    
                    if(count($peqa) == 12){
                        foreach($peqa as $peqatleta){
                            $getatleta = $atletas->search($peqatleta->partialeq_atleta);
                            if($peqatleta->partialeq_capitao == 1){
			                    $tabela_data['tabela_equipea_pontos'] += 2*($getatleta['atletaspontos']);
			                } else {
			                    $tabela_data['tabela_equipea_pontos'] += $getatleta['atletaspontos'];
			                }
                        }
                    }
                }
            }
            if($l2){
                foreach($l2 as $unid2){
                    $peqa = $peq_atletas->getsquad($unid2->te_time);
			        
			        if(count($peqa) == 12){
			            foreach($peqa as $peqatleta){
			                $getatleta = $atletas->search($peqatleta->partialeq_atleta);
			                if($peqatleta->partialeq_capitao == 1){
			                    $tabela_data['tabela_equipeb_pontos'] += 2*($getatleta['atletaspontos']);
			                } else {
			                    $tabela_data['tabela_equipeb_pontos'] += $getatleta['atletaspontos'];
			                }
			            }
			        }
                }
            }
            if($tabela->update($tabela_data)){}
		}
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
	
	public function getathletes() {
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
	
	public function getmatches() {
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
}