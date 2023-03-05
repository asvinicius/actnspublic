<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );

class Updatedb extends CI_Controller {
    
    public function index(){  
        echo "<a href='https://acretinos.com.br/updatedb/updatingcontest'>Iniciar atualização</a>";
    }
	
	public function updatingcontest(){
        set_time_limit(9000);
        ini_set('default_socket_timeout', 9000);
		
        $this->load->model('StatusModel');
        $this->load->model('ParciaisModel');
        $status = new StatusModel();
        $partial = new ParciaisModel();
		
		$json = $this->getstatus();
		$laststatus = $status->search();
		
		if($json['status_mercado'] != 4){
			if($json['rodada_atual'] == $laststatus['currentround']){
			    if($this->contestpartial()){
				    if($this->elimpartial()){
    				    echo "Parciais em andamento...<br />
    				        Parciais Eliminatório atualizadas.<br /> 
    				        Parciais bolão atualizadas.<br /> 
    				        <a href='https://acretinos.com.br/updatedb/finishcontest'>Clique para continuar</a>";
				    }
				    
				}
				/*
				if($json['status_mercado'] != $laststatus['marketstatus']){
					$this->updatestatus($json);
				}
				*/
			}else{
				
				if($this->contestpartial()){
				    if($this->elimpartial()){
    				    echo "Parciais em andamento...<br />
    				        Parciais Eliminatório atualizadas.<br /> 
    				        Parciais bolão atualizadas.<br /> 
    				        <a href='https://acretinos.com.br/updatedb/finishcontest'>Clique para continuar</a>";
				    }
				    
				}
			    /*
				$firsts = $partial->fisrts();
				if($this->contestfinal($firsts, $json, $laststatus)){
				    echo "Atualização bolão finalizada";
			    }
				*/
			}
		}
	}
	
	public function finishcontest(){
        set_time_limit(9000);
        ini_set('default_socket_timeout', 9000);
		
        $this->load->model('StatusModel');
        $this->load->model('ParciaisModel');
        $status = new StatusModel();
        $partial = new ParciaisModel();
		
		$json = $this->getstatus();
		$laststatus = $status->search();
		
		if($json['status_mercado'] != 4){
			if($json['rodada_atual'] == $laststatus['currentround']){
			    $firsts = $partial->fisrts();
				if($this->contestfinal($firsts, $json, $laststatus)){
				    echo "Parciais em andamento...<br />
				        Parciais Eliminatório atualizadas.<br /> 
				        Parciais bolão atualizadas.<br /> 
				        Bolão atualizado.<br /> 
				       <a href='https://acretinos.com.br/updatedatabase/updatingstatus'>Clique para continuar</a>";
			    }
				/*
				if($json['status_mercado'] != $laststatus['marketstatus']){
					$this->updatestatus($json);
				}
				*/
			}else{
				$firsts = $partial->fisrts();
				if($this->contestfinal($firsts, $json, $laststatus)){
				    echo "Parciais em andamento...<br />
				        Parciais Eliminatório atualizadas.<br /> 
				        Parciais bolão atualizadas.<br /> 
				        Bolão atualizado.<br /> 
				       <a href='https://acretinos.com.br/updatedatabase/updatingstatus'>Clique para continuar</a>";
			    }
			}
		}
	}
	
	public function updatingequipes(){
        set_time_limit(9000);
        ini_set('default_socket_timeout', 9000);
        ob_implicit_flush(true);
        
        $this->load->model('StatusModel');
        $status = new StatusModel();
        
        $json = $this->getstatus();
		$laststatus = $status->search();
        $validspin = $laststatus['currentround']-24;
        
        if($json['status_mercado'] != 4){
			if($json['rodada_atual'] == $laststatus['currentround']){
			    if($this->equipespartial()){
					if($this->equipesfinal($validspin, $json, $laststatus)){
    					echo "<hr />Atualização concluída";
    			    }
				}
				/*
				if($json['status_mercado'] != $laststatus['marketstatus']){
					$this->updatestatus($json);
				}
				*/
			}else{
				if($this->equipespartial()){
				    echo "Parciais em andamento...<br />
				        Parciais Eliminatório atualizadas.<br /> 
				        Parciais bolão atualizadas.<br /> 
				        Bolão atualizado.<br /> 
				        Parciais equipes atualizadas.<br /> 
				        <a href='https://acretinos.com.br/updatedb/finishequipes'>Clique para continuar</a>";
				}
			    /*
				if($this->equipesfinal($validspin, $json, $laststatus)){
					echo "Atualização equipes concluída";
			    }
			    */
			}
		}
	}
	
	public function finishequipes(){
        set_time_limit(9000);
        ini_set('default_socket_timeout', 9000);
        ob_implicit_flush(true);
        
        $this->load->model('StatusModel');
        $status = new StatusModel();
        
        $json = $this->getstatus();
		$laststatus = $status->search();
        $validspin = $laststatus['currentround']-24;
        
        if($json['status_mercado'] != 4){
			if($json['rodada_atual'] == $laststatus['currentround']){
			    if($this->equipespartial()){
					if($this->equipesfinal($validspin, $json, $laststatus)){
    					echo "<hr />Atualização concluída";
    			    }
				}
				/*
				if($json['status_mercado'] != $laststatus['marketstatus']){
					$this->updatestatus($json);
				}
				*/
			}else{
			    /*
				if($this->equipespartial()){
				    echo "Parciais equipes atualizadas.<br /> <a href='https://acretinos.com.br/updatedb/finishequipes'>Clique para continuar</a>";
				}
			    */
				if($this->equipesfinal($validspin, $json, $laststatus)){
				    echo "Parciais em andamento...<br />
				        Parciais Eliminatório atualizadas.<br /> 
				        Parciais bolão atualizadas.<br /> 
				        Bolão atualizado.<br /> 
				        Parciais equipes atualizadas.<br /> 
    					Equipes atualizadas.<br /> 
    					<a href='https://acretinos.com.br/updatedatabase/updatingstatus'>Clique para continuar</a>";
			    }
			}
		}
	}
	
	function contestpartial(){
        set_time_limit(6000);
        ini_set('default_socket_timeout', 6000);
		
		$this->load->model('StatusModel');
        $this->load->model('ParciaisModel');
        $status = new StatusModel();
        $partial = new ParciaisModel();
		
		$listpartial = $partial->updatelist();
		
		//$start = round(microtime(true) * 1000);
		//$time_elapsed_secs = (round(microtime(true) * 1000)) - $start;
		
		$aux = 0;
		
		foreach($listpartial as $item){
		    
			$final = $this->getAward($item->partialteam);
			
			if($final){
			    $pontos = $item->partialpoints;
				$partialdata['partialid'] = $item->partialid;
				$partialdata['partialteam'] = $item->partialteam;
				$partialdata['partialcap'] = $item->partialcap;
				$partialdata['partialpoints'] = $final['pontos'];
				
				
				if($partial->update($partialdata)){
				} else {
				    $aux = 1;
				}
			}
		}
		if($aux == 0){
		    return true;
		} else {
		    return false;
		}
	}
	
	function equipespartial(){
        set_time_limit(6000);
        ini_set('default_socket_timeout', 6000);
		
		$this->load->model('StatusModel');
        $this->load->model('PartialequipeModel');
        $status = new StatusModel();
        $peq = new PartialequipeModel();
		
		$listpartial = $peq->updatelist();
		
		foreach($listpartial as $item){
		    
			$final = $this->getAward($item->peq_time);
			
			if($final){
			    $pontos = $item->peq_points;
				$partialdata['peq_id'] = $item->peq_id;
				$partialdata['peq_time'] = $item->peq_time;
				$partialdata['peq_points'] = $final['pontos'];
				
				if($peq->update($partialdata)){
				}
			}
		}
		
		return true;
	}
	
	function elimpartial(){
        set_time_limit(6000);
        ini_set('default_socket_timeout', 6000);
		
		$this->load->model('StatusModel');
        $this->load->model('EliminatorioModel');
        $status = new StatusModel();
        $partial = new EliminatorioModel();
		
		$listpartial = $partial->listing();
		
		//$start = round(microtime(true) * 1000);
		//$time_elapsed_secs = (round(microtime(true) * 1000)) - $start;
		
		$aux = 0;
		
		foreach($listpartial as $item){
		    
			$final = $this->getAward($item->et_id);
			
			if($final){
				$et_data['et_id'] = $item->et_id;
    			$et_data['et_name'] = $item->et_name;
    			$et_data['et_coach'] = $item->et_coach;
    			$et_data['et_slug'] = $item->et_slug;
    			$et_data['et_shield'] = $item->et_shield;
    			$et_data['et_cap'] = $item->et_cap;
    			$et_data['et_rank'] = $item->et_rank;
    			$et_data['et_point'] = $final['pontos'];
    			$et_data['et_status'] = $item->et_status;
				
				
				if($partial->update($et_data)){
				} else {
				    $aux = 1;
				}
			}
		}
		if($aux == 0){
		    return true;
		} else {
		    return false;
		}
	}
	
	function contestfinal($firsts, $json, $status) {
		$this->load->model('FTRModel');
        $this->load->model('UserModel');
        $this->load->model('TeamModel');
		$this->load->model('PaidModel');
        $this->load->model('WalletModel');
		$this->load->model('ParciaisModel');
        $this->load->model('ContestrkModel');
		$ftr = new FTRModel();
        $user = new UserModel();
        $team = new TeamModel();
		$paid = new PaidModel();
        $wallet = new WalletModel();
		$partial = new ParciaisModel();
        $ctrk = new ContestrkModel();
        
        $paiddata = $paid->searchproduct($status['currentround']);
        $taxa = 8.5;
        
        $i = 0;
        foreach($firsts as $instapartial){
            $contestdata['ctrkid'] = null;
            $contestdata['year'] = $json['temporada'];
            $contestdata['round'] = $status['currentround'];
            $contestdata['ctrkcoach'] = $instapartial->teamcoach;
            $contestdata['ctrkteamid'] = $instapartial->partialteam;
            $contestdata['ctrkteam'] = $instapartial->teamname;
            $contestdata['ctrkaward'] = $instapartial->partialpoints;
            
            $lockeditem = $ctrk->getlock($instapartial->partialteam, $json['temporada'], $status['currentround']);
            
            if($lockeditem == null){
                if($ctrk->save($contestdata)){
                    if($i < 20){
                        $useraux = $user->searchid($instapartial->teamuser);
                        $walletaux = $wallet->search($instapartial->teamuser);
                        
                        $walletdata['wallet_id'] = $walletaux['wallet_id'];
            		    $walletdata['wallet_user'] = $walletaux['wallet_user'];
            		    
            		    date_default_timezone_set('America/Sao_Paulo');
            		    
            		    $ftrdata['ftr_id'] = null;
                        $ftrdata['ftr_type'] = 4; // 1-deposito # 2-saque # 3-inscrição # 4-premiação
                        if($i < 10){
            	            $ftrdata['ftr_mode'] = 0; // 0-cash # 1-bonus
                        } else {
                            $ftrdata['ftr_mode'] = 1; // 0-cash # 1-bonus
                        }
            	        
            	        $ftrdata['ftr_date'] = date('Y-m-d H:i:s');
            	        $ftrdata['ftr_user'] = $instapartial->teamuser;
            	        $ftrdata['ftr_super'] = null;
            	        
            	        if($status['currentround'] < 38){
                            if($i < 10){
                                switch ($i) {
                                    case 0:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.5)-50, 2, '.', '');
                                        break;
                                    case 1:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.17)-17, 2, '.', '');
                                        break;
                                    case 2:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.12)-12, 2, '.', '');
                                        break;
                                    case 3:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.07)-7, 2, '.', '');
                                        break;
                                    case 4:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.04)-4, 2, '.', '');
                                        break;
                                    case 5:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.02)-2, 2, '.', '');
                                        break;
                                    case 6:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.02)-2, 2, '.', '');
                                        break;
                                    case 7:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.02)-2, 2, '.', '');
                                        break;
                                    case 8:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.02)-2, 2, '.', '');
                                        break;
                                    case 9:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.02)-2, 2, '.', '');
                                        break;
                                }
                                
                                if($this->contestytop($instapartial, $json, $status)){
                                    $walletdata['wallet_balance'] = $walletaux['wallet_balance'] + $premio;
                        		    $walletdata['wallet_free'] = $walletaux['wallet_free'] + $premio;
                        		    $walletdata['wallet_gift'] = $walletaux['wallet_gift'];
                                }
                    		    
                            } else {
                                
                                $premio = 10;
                                
                                if($this->contestytop($instapartial, $json, $status)){
                                    $walletdata['wallet_balance'] = $walletaux['wallet_balance'] + $premio;
                        		    $walletdata['wallet_free'] = $walletaux['wallet_free'];
                        		    $walletdata['wallet_gift'] = $walletaux['wallet_gift'] + $premio;
                                }
                            }
                    		    
                    		if($wallet->update($walletdata)){
                    		    $ftrdata['ftr_value'] = $premio;
                    	        $ftrdata['ftr_attachment'] = null;
                    	        $ftrdata['ftr_validator'] = $this->validgen($ftrdata);
                        		    
                        		if($ftr->save($ftrdata)){
                        		    $i++;
                        		}
                    		}
            	        } else {
            	            if($i < 10){
                                switch ($i) {
                                    case 0:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.5), 2, '.', '');
                                        break;
                                    case 1:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.17), 2, '.', '');
                                        break;
                                    case 2:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.12), 2, '.', '');
                                        break;
                                    case 3:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.07), 2, '.', '');
                                        break;
                                    case 4:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.04), 2, '.', '');
                                        break;
                                    case 5:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.02), 2, '.', '');
                                        break;
                                    case 6:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.02), 2, '.', '');
                                        break;
                                    case 7:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.02), 2, '.', '');
                                        break;
                                    case 8:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.02), 2, '.', '');
                                        break;
                                    case 9:
                                        $premio = number_format((($paiddata['paidteams']*$taxa)*0.02), 2, '.', '');
                                        break;
                                }
                                
                                if($this->contestytop($instapartial, $json, $status)){
                                    $walletdata['wallet_balance'] = $walletaux['wallet_balance'] + $premio;
                        		    $walletdata['wallet_free'] = $walletaux['wallet_free'] + $premio;
                        		    $walletdata['wallet_gift'] = $walletaux['wallet_gift'];
                                }
                    		    
                            } else {
                                
                                $premio = 0;
                                
                                if($this->contestytop($instapartial, $json, $status)){
                                    $walletdata['wallet_balance'] = $walletaux['wallet_balance'];
                        		    $walletdata['wallet_free'] = $walletaux['wallet_free'];
                        		    $walletdata['wallet_gift'] = $walletaux['wallet_gift'];
                                }
                            }
                    		    
                    		if($wallet->update($walletdata)){
                    		    $ftrdata['ftr_value'] = $premio;
                    	        $ftrdata['ftr_attachment'] = null;
                    	        $ftrdata['ftr_validator'] = $this->validgen($ftrdata);
                        		    
                        		if($ftr->save($ftrdata)){
                        		    $i++;
                        		}
                    		}
            	        }
                    }
                }
            }
        }
        return true;
	}
	
	function equipesfinal($validspin, $json, $status) {
        $this->load->model('TEModel');
        $this->load->model('TabelaModel');
        $this->load->model('PartialequipeModel');
        $this->load->model('EquipesModel');
        $this->load->model('RankingModel');
        $this->load->model('TimesModel');
        $te = new TEModel();
        $tabela = new TabelaModel();
        $peq = new PartialequipeModel();
        $equipes = new EquipesModel();
        $ranking = new RankingModel();
        $times = new TimesModel();
        
        $jogos = $tabela->listing($validspin);
        
	    foreach ($jogos as $jogo){
	        if($jogo->status != 0){
	            $tabela_data['tabela_id'] = $jogo->id;
                $tabela_data['tabela_rodada'] = $jogo->rodada;
                $tabela_data['tabela_equipea'] = $jogo->aid;
                $tabela_data['tabela_equipea_pontos'] = 0;
                $tabela_data['tabela_equipeb'] = $jogo->bid;
                $tabela_data['tabela_equipeb_pontos'] = 0;
                $tabela_data['tabela_status'] = 0;
                
                $l1 = $te->searchequipe($jogo->aid);
                $l2 = $te->searchequipe($jogo->bid);
                
                if($jogo->aid != 0){
                    if($l1){
                        foreach($l1 as $unid1){
                            $time = $times->search($unid1->te_time);
                            $data = $peq->search($unid1->te_time);
                            
                            $time_data['time_id'] = $time['time_id'];
                            $time_data['time_nome'] = $time['time_nome'];
                            $time_data['time_cartoleiro'] = $time['time_cartoleiro'];
                            $time_data['time_slug'] = $time['time_slug'];
                            $time_data['time_escudo'] = $time['time_escudo'];
                            $time_data['time_pontos'] = $time['time_pontos'] + $data['peq_points'];
                            $time_data['time_status'] = $time['time_status'];
                            
                            if($times->update($time_data)){
                                $tabela_data['tabela_equipea_pontos'] = $tabela_data['tabela_equipea_pontos'] + $data['peq_points'];
                            }
                            
                        }
                        
                        $equipea = $equipes->search($jogo->aid);
                                
                        $equipe_data['equipe_id'] = $equipea['equipe_id'];
                        $equipe_data['equipe_nome'] = $equipea['equipe_nome'];
                        $equipe_data['equipe_escudo'] = $equipea['equipe_escudo'];
                        $equipe_data['equipe_pontos'] = $equipea['equipe_pontos'] + $tabela_data['tabela_equipea_pontos'];
                        $equipe_data['equipe_status'] = $equipea['equipe_status'];
                        
                        if($equipes->update($equipe_data)){
                        }
                    }
                }
                if($jogo->bid != 0){
                    if($l2){
                        foreach($l2 as $unid2){
                            $time = $times->search($unid2->te_time);
                            $data = $peq->search($unid2->te_time);
                            
                            $time_data['time_id'] = $time['time_id'];
                            $time_data['time_nome'] = $time['time_nome'];
                            $time_data['time_cartoleiro'] = $time['time_cartoleiro'];
                            $time_data['time_slug'] = $time['time_slug'];
                            $time_data['time_escudo'] = $time['time_escudo'];
                            $time_data['time_pontos'] = $time['time_pontos'] + $data['peq_points'];
                            $time_data['time_status'] = $time['time_status'];
                            
                            if($times->update($time_data)){
                                $tabela_data['tabela_equipeb_pontos'] = $tabela_data['tabela_equipeb_pontos'] + $data['peq_points'];
                            }
                        }
                        
                        $equipeb = $equipes->search($jogo->bid);
                            
                        $equipe_data['equipe_id'] = $equipeb['equipe_id'];
                        $equipe_data['equipe_nome'] = $equipeb['equipe_nome'];
                        $equipe_data['equipe_escudo'] = $equipeb['equipe_escudo'];
                        $equipe_data['equipe_pontos'] = $equipeb['equipe_pontos'] + $tabela_data['tabela_equipeb_pontos'];
                        $equipe_data['equipe_status'] = $equipeb['equipe_status'];
                        
                        if($equipes->update($equipe_data)){
                        }
                    }
                }
                
                if($tabela->update($tabela_data)){
                    if($jogo->aid != 0){
                        if($jogo->bid != 0){
                            if($tabela_data['tabela_equipea_pontos'] >= ($tabela_data['tabela_equipeb_pontos'])+10){
                                $rk = $ranking->search($jogo->aid);
                                
                                $ranking_data['ranking_id'] = $rk['ranking_id'];
                                $ranking_data['ranking_grupo'] = $rk['ranking_grupo'];
                                $ranking_data['ranking_equipe'] = $rk['ranking_equipe'];
                                $ranking_data['ranking_pontos'] = $rk['ranking_pontos'] + 3;
                                
                                if($ranking->update($ranking_data)){
                                }
                            } else {
                                if($tabela_data['tabela_equipeb_pontos'] >= ($tabela_data['tabela_equipea_pontos'])+10){
                                    $rk = $ranking->search($jogo->bid);
                                
                                    $ranking_data['ranking_id'] = $rk['ranking_id'];
                                    $ranking_data['ranking_grupo'] = $rk['ranking_grupo'];
                                    $ranking_data['ranking_equipe'] = $rk['ranking_equipe'];
                                    $ranking_data['ranking_pontos'] = $rk['ranking_pontos'] + 3;
                                    
                                    if($ranking->update($ranking_data)){
                                    }
                                } else {
                                    $rk1 = $ranking->search($jogo->aid);
                                    $rk2 = $ranking->search($jogo->bid);
                                
                                    $ranking_data1['ranking_id'] = $rk1['ranking_id'];
                                    $ranking_data1['ranking_grupo'] = $rk1['ranking_grupo'];
                                    $ranking_data1['ranking_equipe'] = $rk1['ranking_equipe'];
                                    $ranking_data1['ranking_pontos'] = $rk1['ranking_pontos'] + 1;
                                    
                                    $ranking_data2['ranking_id'] = $rk2['ranking_id'];
                                    $ranking_data2['ranking_grupo'] = $rk2['ranking_grupo'];
                                    $ranking_data2['ranking_equipe'] = $rk2['ranking_equipe'];
                                    $ranking_data2['ranking_pontos'] = $rk2['ranking_pontos'] + 1;
                
                                    if($ranking->update($ranking_data1)){
                                        if($ranking->update($ranking_data2)){
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
	        }
	    }
	    return true;
	}
	
	function contestytop($instunit, $json, $status) {
        $this->load->model('YtopModel');
        $ytop = new YtopModel();
        
        $toplist = $ytop->reverse($json['temporada'], 1, 2);
        $tophlist = $ytop->hreverse(2, 2);
        
        if($toplist){
            if($toplist[0]->topaward < $instunit->partialpoints){
                            
                $data['topid'] = $toplist[0]->topid;
                $data['topyear'] = $toplist[0]->topyear;
                $data['topround'] = $status['currentround'];
                $data['topdesc'] = $toplist[0]->topdesc;
                $data['toptype'] = $toplist[0]->toptype;
                $data['topcoach'] = $instunit->teamcoach;
                $data['topteam'] = $instunit->teamname;
                $data['topaward'] = $instunit->partialpoints;
                
                if($ytop->update($data)){
                }
                
            }
        } else {
            $data['topid'] = null;
            $data['topyear'] = $json['temporada'];
            $data['topround'] = $status['currentround'];
            $data['topdesc'] = 1;
            $data['toptype'] = 2;
            $data['topcoach'] = $instunit->teamcoach;
            $data['topteam'] = $instunit->teamname;
            $data['topaward'] = $instunit->partialpoints;

            if($ytop->save($data)){
            }
        }
        
        if($tophlist){
            if($tophlist[0]->topaward < $instunit->partialpoints){
                            
                $data['topid'] = $tophlist[0]->topid;
                $data['topyear'] = $tophlist[0]->topyear;
                $data['topround'] = $status['currentround'];
                $data['topdesc'] = $tophlist[0]->topdesc;
                $data['toptype'] = $tophlist[0]->toptype;
                $data['topcoach'] = $instunit->teamcoach;
                $data['topteam'] = $instunit->teamname;
                $data['topaward'] = $instunit->partialpoints;
                
                if($ytop->update($data)){
                }
                
            }
        } else {
            $data['topid'] = null;
            $data['topyear'] = $json['temporada'];
            $data['topround'] = $status['currentround'];
            $data['topdesc'] = 2;
            $data['toptype'] = 2;
            $data['topcoach'] = $instunit->teamcoach;
            $data['topteam'] = $instunit->teamname;
            $data['topaward'] = $instunit->partialpoints;

            if($ytop->save($data)){
            }
        }
        return true;
	}
	
	function updatestatus($json) {
        $this->load->model('StatusModel');
        $status = new StatusModel();
        
        $laststatus = $status->search();
        
        $desc = $laststatus['currentshift'];
        if($json['rodada_atual'] > 19){
            $desc = 3;
        }
        
        $lsdata['statusid'] = $laststatus['statusid'];
        $lsdata['currentround'] = $json['rodada_atual'];
        $lsdata['currentmonth'] = $json['fechamento']['mes'];
        $lsdata['currentshift'] = $desc;
        $lsdata['marketstatus'] = $json['status_mercado'];

        if($status->update($lsdata)){
            return true;
        }
    }
    
    function validgen($ftrdata){
        $partialone = md5($ftrdata['ftr_type']."!".$ftrdata['ftr_mode']);
        $partialtwo = md5($ftrdata['ftr_date']."@".$ftrdata['ftr_user']);
        $validator = md5($partialone."#".$ftrdata['ftr_value']."$".$partialtwo);
        
        return $validator;
    }
	
	public function getAward($teamid) {
        
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