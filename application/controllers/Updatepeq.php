<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );

class Updatepeq extends CI_Controller {

    public function uptodate(){ 
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
			$laststatus = $status->search();
            $validspin = $laststatus['currentround']-9;
            $jogos = $tabela->listing($validspin);
            
            foreach ($jogos as $jogo){
                $tabela_data['tabela_id'] = $jogo->id;
                $tabela_data['tabela_rodada'] = $jogo->rodada;
                $tabela_data['tabela_equipea'] = $jogo->aid;
                $tabela_data['tabela_equipea_pontos'] = 0;
                $tabela_data['tabela_equipeb'] = $jogo->bid;
                $tabela_data['tabela_equipeb_pontos'] = 0;
                $tabela_data['tabela_status'] = 2;
                
                $l1 = $te->searchequipe($jogo->aid);
                $l2 = $te->searchequipe($jogo->bid);
                
                if($l1){
                    foreach($l1 as $unid1){
                        $peqa = $peq_atletas->getsquad($unid1->te_time);
				        $timepontos = 0;
				        
				        if(count($peqa) == 12){
				            foreach($peqa as $peqatleta){
				                $getatleta = $atletas->search($peqatleta->partialeq_atleta);
				                if($peqatleta->partialeq_capitao == 1){
				                    $timepontos += 2*($getatleta['atletaspontos']);
				                    $tabela_data['tabela_equipea_pontos'] += 2*($getatleta['atletaspontos']);
				                } else {
				                    $timepontos += $getatleta['atletaspontos'];
				                    $tabela_data['tabela_equipea_pontos'] += $getatleta['atletaspontos'];
				                }
				            }
				            
				            $partialitem = $peq->search($unid1->te_time);
				            if($partialitem){
				                $peqdata['peq_id'] = $partialitem['peq_id'];
                    			$peqdata['peq_time'] = $partialitem['peq_time'];
                    			$peqdata['peq_points'] = $timepontos;
                    			
                    			if($peq->update($peqdata)){
							
						        }
				            }
				        } else {
				            $this->addpartial($unid1->te_time);
				        }
                    }
                }
                
                if($l2){
                    foreach($l2 as $unid2){
                        $peqa = $peq_atletas->getsquad($unid2->te_time);
				        $timepontos = 0;
				        
				        if(count($peqa) == 12){
				            foreach($peqa as $peqatleta){
				                $getatleta = $atletas->search($peqatleta->partialeq_atleta);
				                if($peqatleta->partialeq_capitao == 1){
				                    $timepontos += 2*($getatleta['atletaspontos']);
				                    $tabela_data['tabela_equipeb_pontos'] += 2*($getatleta['atletaspontos']);
				                } else {
				                    $timepontos += $getatleta['atletaspontos'];
				                    $tabela_data['tabela_equipeb_pontos'] += $getatleta['atletaspontos'];
				                }
				            }
				            
				            $partialitem = $peq->search($unid2->te_time);
				            if($partialitem){
				                $peqdata['peq_id'] = $partialitem['peq_id'];
                    			$peqdata['peq_time'] = $partialitem['peq_time'];
                    			$peqdata['peq_points'] = $timepontos;
                    			
                    			if($peq->update($peqdata)){
							
						        }
				            }
				        } else {
				            $this->addpartial($unid2->te_time);
				        }
                    }
                }
                
                if($tabela->update($tabela_data)){}
            }
		}
	}
	
	public function addpartial($time_id){ 
		$this->load->model('AtletasModel');
		$this->load->model('PartialequipeModel');
		$this->load->model('PEQatletasModel');
		$atletas = new AtletasModel();
		$peq = new PartialequipeModel();
		$peq_atletas = new PEQatletasModel();
		
		// cria uma instancia de parcial para cada time da lista
		
		$partialaux = $peq->search($time_id);
		
		if($partialaux){
			$team = $this->getsquad($time_id);
				
			foreach($team['atletas'] as $teamatletas){
				$atletaitem = $atletas->search($teamatletas['atleta_id']);
				
				if($atletaitem){
					$peqadata['partialeq_id'] = null;
					$peqadata['partialeq_time'] = $time_id;
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
    					$peqadata['partialeq_time'] = $time_id;
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
			
		} else {
			$peqdata['peq_id'] = null;
			$peqdata['peq_time'] = $time_id;
			$peqdata['peq_points'] = 0;
			
			if($peq->save($peqdata)){
				$team = $this->getsquad($time_id);
				
				foreach($team['atletas'] as $teamatletas){
					$atletaitem = $atletas->search($teamatletas['atleta_id']);
					
					if($atletaitem){
						$peqadata['partialeq_id'] = null;
    					$peqadata['partialeq_time'] = $time_id;
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
        					$peqadata['partialeq_time'] = $time_id;
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
			}
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
}