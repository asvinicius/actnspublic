<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );

class Updatedatabase extends CI_Controller {

    function index(){
		
        //$this->updatingcontest();
        //$this->updatingleague();
        //$this->updatingstatus();
        
        /*

         /opt/cpanel/ea-php71/root/usr/bin/php /home3/acreti22/public_html/index.php updatedatabase updatingcontest
         /opt/cpanel/ea-php71/root/usr/bin/php /home3/acreti22/public_html/index.php updatedatabase updatingleague
         /opt/cpanel/ea-php71/root/usr/bin/php /home3/acreti22/public_html/index.php updatedatabase updatingstatus

        */
    }

    function updatingcontest() {
        set_time_limit(6000);
        ini_set('default_socket_timeout', 6000);
		
        $this->load->model('StatusModel');
        $this->load->model('PartialModel');
        $this->load->model('AtletasModel');
        $this->load->model('PartidasModel');
        $this->load->model('ReservaModel');
        $this->load->model('PartialatletasModel');
        
        $status = new StatusModel();
        $partial = new PartialModel();
        $atletas = new AtletasModel();
        $partidas = new PartidasModel();
        $reservas = new ReservaModel();
        $pa_model = new PartialatletasModel();
        
        $laststatus = $status->search();
        $json = $this->getstatus();
		   	
        if($json['status_mercado'] == 4){
		} else {
			
            if($json['rodada_atual'] == $laststatus['currentround']){
                if($json['status_mercado'] == $laststatus['marketstatus']){
                }
                else{
                    if($this->updatestatus($json)){
						
                    }
                }
            }else{
                if($this->updatesquad($laststatus)){
                    if($this->updatecontest($array, $json, $laststatus)){
                        
    				}
                }
                $this->updatetop10yearcontest($array, $json, $laststatus);
                $this->updatetop10historycontest($array, $json, $laststatus);
                $partial->truncate();
                $atletas->truncate();
                $partidas->truncate();
                $reservas->truncate();
                $pa_model->truncate();
            }
        }
    }
    
    function updatecontest($array, $json, $status) {
		$this->load->model('FTRModel');
        $this->load->model('UserModel');
        $this->load->model('TeamModel');
		$this->load->model('PaidModel');
        $this->load->model('WalletModel');
		$this->load->model('PartialModel');
        $this->load->model('ContestrkModel');
		$ftr = new FTRModel();
        $user = new UserModel();
        $team = new TeamModel();
		$paid = new PaidModel();
        $wallet = new WalletModel();
		$partial = new PartialModel();
        $ctrk = new ContestrkModel();
        
        $paiddata = $paid->searchproduct($status['currentround']);
        $taxa = 8.5;
        
        $json = $this->getstatus();
        $instant = $partial->listupdate();
		
		$i = 0;
		foreach($instant as $instapartial){
		    $data['ctrkid'] = null;
            $data['year'] = $json['temporada'];
            $data['round'] = $status['currentround'];
            $data['ctrkcoach'] = $instapartial->teamcoach;
            $data['ctrkteamid'] = $instapartial->partialteam;
            $data['ctrkteam'] = $instapartial->teamname;
            $data['ctrkaward'] = $instapartial->partialpoints;
            
            if($ctrk->save($data)){
                $useraux = $user->searchid($instapartial->teamuser);
                $walletaux = $wallet->search($instapartial->teamuser);
                
                $walletdata['wallet_id'] = $walletaux['wallet_id'];
    		    $walletdata['wallet_user'] = $walletaux['wallet_user'];
    		    
    		    date_default_timezone_set('America/Sao_Paulo');
    		    
    		    $ftrdata['ftr_id'] = null;
                $ftrdata['ftr_type'] = 4; // 1-deposito # 2-saque # 3-inscrição # 4-premiação
    	        $ftrdata['ftr_mode'] = 0; // 0-cash # 1-bonus
    	        $ftrdata['ftr_date'] = date('Y-m-d H:i:s');
    	        $ftrdata['ftr_user'] = $instapartial->teamuser;
    	        $ftrdata['ftr_super'] = null;
                
                if($i < 10){
                    switch ($i) {
                        case 0:
                            $premio = (($paiddata['paidteams']*$taxa)*0.5)-50;
                            break;
                        case 1:
                            $premio = (($paiddata['paidteams']*$taxa)*0.17)-17;
                            break;
                        case 2:
                            $premio = (($paiddata['paidteams']*$taxa)*0.12)-12;
                            break;
                        case 3:
                            $premio = (($paiddata['paidteams']*$taxa)*0.07)-7;
                            break;
                        case 4:
                            $premio = (($paiddata['paidteams']*$taxa)*0.04)-4;
                            break;
                        case 5:
                            $premio = (($paiddata['paidteams']*$taxa)*0.02)-2;
                            break;
                        case 6:
                            $premio = (($paiddata['paidteams']*$taxa)*0.02)-2;
                            break;
                        case 7:
                            $premio = (($paiddata['paidteams']*$taxa)*0.02)-2;
                            break;
                        case 8:
                            $premio = (($paiddata['paidteams']*$taxa)*0.02)-2;
                            break;
                        case 9:
                            $premio = (($paiddata['paidteams']*$taxa)*0.02)-2;
                            break;
                    }
                    
                    $walletdata['wallet_balance'] = $walletaux['wallet_balance'] + $premio;
        		    $walletdata['wallet_free'] = $walletaux['wallet_free'] + $premio;
        		    $walletdata['wallet_gift'] = $walletaux['wallet_gift'];
        		    
                } else {
                    $premio = 10;
                    
                    $walletdata['wallet_balance'] = $walletaux['wallet_balance'] + $premio;
        		    $walletdata['wallet_free'] = $walletaux['wallet_free'];
        		    $walletdata['wallet_gift'] = $walletaux['wallet_gift'] + $premio;
        		    
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
        
		return true;
    }
	
	function updatingleague() {
        set_time_limit(6000);
        ini_set('default_socket_timeout', 6000);
		
        $this->load->model('StatusModel');
        $this->load->model('AdmteamModel');
        $status = new StatusModel();
        $at = new AdmteamModel();
        
        $laststatus = $status->search();
        $json = $this->getstatus();
   	
        if($json['status_mercado'] == 4){
        } else {
            if($json['rodada_atual'] == $laststatus['currentround']){
                if($json['status_mercado'] == $laststatus['marketstatus']){
                }
                else{
                    if($this->updatestatus($json)){
                    }
                }
            }else{
                $this->token();
                
                $leagueround = $this->getleague(1, "rodada");
                
                $this->updatetop10yearclassic($leagueround, $json, $laststatus);
                $this->updatetop10historyclassic($leagueround, $json, $laststatus);

				if($json['fechamento']['mes'] != $laststatus['currentmonth']){
					$league2 = $this->getleague(2, "rodada");
					$league3 = $this->getleague(3, "rodada");
					$this->cup_month($leagueround, $league2, $league3, $json, $laststatus);
				}
				if($json['rodada_atual'] > 19){
					
				}
				
				$teamsat = $at->raiz();
				foreach($teamsat as $admteam){
				    $aux = $this->getAward($admteam->at_id, $laststatus['currentround']);
				    
				    $capitao = $aux['capitao_id'];
        		    $cpontos = 0;
        		     
        		     foreach($aux['atletas'] as $atleta){
        		         if($atleta['atleta_id'] == $capitao){
        		             $cpontos = $atleta['pontos_num'];
        		         }
        		     }
        		     
        		     $atdata['at_id'] = $admteam->at_id;
        		     $atdata['at_name'] = $admteam->at_name;
        		     $atdata['at_coach'] = $admteam->at_coach;
        		     $atdata['at_shield'] = $admteam->at_shield;
        		     $atdata['at_pontosraiz'] = $admteam->at_pontosraiz + $aux['pontos']-$cpontos;
        		     $atdata['at_pontoscap'] = $admteam->at_pontoscap + $aux['pontos'];
        		     
        		     if($at->update($atdata)){
        		         
        		     }
				}
				
            }
        }
    }
	
	
    
    function updatingstatus() {
        $this->load->model('StatusModel');
        $this->load->model('AtletasModel');
        $this->load->model('ParciaisModel');
        $this->load->model('PAModel');
        $this->load->model('PRModel');
        $this->load->model('PartialequipeModel');
        $this->load->model('PEQatletasModel');
        $this->load->model('PEQreservasModel');
        
        $status = new StatusModel();
        $atletas = new AtletasModel();
        $parciais = new ParciaisModel();
        $parciais_atletas = new PAModel();
        $parciais_reservas = new PRModel();
        $peq = new PartialequipeModel();
        $peq_atletas = new PEQatletasModel();
        $peq_reservas = new PEQreservasModel();
        
        $laststatus = $status->search();
        $json = $this->getstatus();
       
   	
        if($json['status_mercado'] == 4){
        }
        else{
            if($json['rodada_atual'] == $laststatus['currentround']){
                $parciais->truncate();
                $parciais_atletas->truncate();
                $parciais_reservas->truncate();
                $peq->truncate();
                $peq_atletas->truncate();
                $peq_reservas->truncate();
                $atletas->truncate();
                
                echo "Status igual. Tabelas truncadas";
            }else{
                $this->closeround($laststatus);

                if($this->updatestatus($json)){
                    if($this->end()){
                        $parciais->truncate();
                        $parciais_atletas->truncate();
                        $parciais_reservas->truncate();
                        $peq->truncate();
                        $peq_atletas->truncate();
                        $peq_reservas->truncate();
                        $atletas->truncate();
                                
                        echo "Parciais bolão atualizadas.<br /> 
				        Bolão atualizado.<br /> 
				        Parciais equipes atualizadas.<br /> 
    					Equipes atualizadas.<br /> 
    					Status atualizado.<hr />
    					ATUALIZAÇÃO CONCLUÍDA";
                    }
                }
            }
        }
    }

    function updatetop10yearcontest($array, $json, $status) {
		
        $this->load->model('YtopModel');
		$this->load->model('PartialModel');
        $ytop = new YtopModel();
		$partial = new PartialModel();
        
        $toplist = $ytop->reverse($json['temporada'], 1, 2);
        $instant = $partial->listhistory();
        
        if($toplist){
            $aux = 0;
            foreach ($toplist as $topunit) {
                $bux = 0;
                foreach ($instant as $instunit) {
                    if($aux == $bux){
                        if($topunit->topaward < $instunit->partialpoints){
                            
                            $data['topid'] = $topunit->topid;
                            $data['topyear'] = $topunit->topyear;
                            $data['topround'] = $status['currentround'];
                            $data['topdesc'] = $topunit->topdesc;
                            $data['toptype'] = $topunit->toptype;
                            $data['topcoach'] = $instunit->teamcoach;
                            $data['topteam'] = $instunit->teamname;
                            $data['topaward'] = $instunit->partialpoints;
                            
                            $ytop->update($data);
                            
                        }
                    }
                    $bux++;
                }
                $aux++;
            }
        }else{
            foreach ($instant as $instunit) {
                $data['topid'] = null;
                $data['topyear'] = $json['temporada'];
                $data['topround'] = $status['currentround'];
                $data['topdesc'] = 1;
                $data['toptype'] = 2;
                $data['topcoach'] = $instunit->teamcoach;
                $data['topteam'] = $instunit->teamname;
                $data['topaward'] = $instunit->partialpoints;

                $ytop->save($data);
            }
        }
    }    
	
	function updatetop10historycontest($array, $json, $status) {
		
        $this->load->model('YtopModel');
		$this->load->model('PartialModel');
        $ytop = new YtopModel();
		$partial = new PartialModel();
        
        $toplist = $ytop->hreverse(2, 2);
        $instant = $partial->listhistory();
        
        if($toplist){
            $aux = 0;
            foreach ($toplist as $topunit) {
                $bux = 0;
                foreach ($instant as $instunit) {
                    if($aux == $bux){
                        if($topunit->topaward < $instunit->partialpoints){
                            $data['topid'] = $topunit->topid;
                            $data['topyear'] = $json['temporada'];
                            $data['topround'] = $status['currentround'];
                            $data['topdesc'] = $topunit->topdesc;
                            $data['toptype'] = $topunit->toptype;
                            $data['topcoach'] = $instunit->teamcoach;
                            $data['topteam'] = $instunit->teamname;
                            $data['topaward'] = $instunit->partialpoints;
                            
                            $ytop->update($data);
                            
                        }
                    }
                    $bux++;
                }
                $aux++;
            }
        }else{
            foreach ($instant as $instunit) {
                $data['topid'] = null;
                $data['topyear'] = $json['temporada'];
                $data['topround'] = $status['currentround'];
                $data['topdesc'] = 2;
                $data['toptype'] = 2;
                $data['topcoach'] = $instunit->teamcoach;
                $data['topteam'] = $instunit->teamname;
                $data['topaward'] = $instunit->partialpoints;

                $ytop->save($data);
            }
        }
    }
	
	function cup_month($league, $league2, $league3, $json, $status) {
        set_time_limit(6000);
        $this->load->model('ClassicrkModel');
        $clrk = new ClassicrkModel();
        
        foreach ($league['times'] as $leagueteam) { 
			$data['clrkid'] = null;
			$data['year'] = $json['fechamento']['ano'];
			$data['description'] = $status['currentmonth'];
			$data['clrkteamid'] = $leagueteam['time_id'];
			$data['clrkcoach'] = $leagueteam['nome_cartola'];
			$data['clrkteam'] = $leagueteam['nome'];
			$data['clrkaward'] = $leagueteam['pontos']['mes'];

			$clrk->save($data);
        }
        foreach ($league2['times'] as $leagueteam) {
			$data['clrkid'] = null;
			$data['year'] = $json['fechamento']['ano'];
			$data['description'] = $status['currentmonth'];
			$data['clrkteamid'] = $leagueteam['time_id'];
			$data['clrkcoach'] = $leagueteam['nome_cartola'];
			$data['clrkteam'] = $leagueteam['nome'];
			$data['clrkaward'] = $leagueteam['pontos']['mes'];

			$clrk->save($data);
        }
        foreach ($league3['times'] as $leagueteam) {
			$data['clrkid'] = null;
			$data['year'] = $json['fechamento']['ano'];
			$data['description'] = $status['currentmonth'];
			$data['clrkteamid'] = $leagueteam['time_id'];
			$data['clrkcoach'] = $leagueteam['nome_cartola'];
			$data['clrkteam'] = $leagueteam['nome'];
			$data['clrkaward'] = $leagueteam['pontos']['mes'];

			$clrk->save($data);
        }
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
	
    function closeround($laststatus) {
		
        $this->load->model('SpinModel');
        $this->load->model('CompletedspinModel');
        $spin = new SpinModel();
        $complspin = new CompletedspinModel();
        
        $aux = $spin->search($laststatus['currentround']);
        
        $data['spinid'] = $aux['spinid'];
        $data['numteams'] = $aux['numteams'];
        $data['status'] = 0;

        if($spin->update($data)){
            $scdata['sc_id'] = null;
            $scdata['sc_year'] = 2022;
            $scdata['sc_spin'] = $laststatus['currentround'];
            $scdata['sc_teams'] = 0;
            $scdata['sc_status'] = 0;
            
            if($complspin->save($scdata)){
                return true;
            }
        }
    }
    
    public function updatesquad($status){ 
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
		
		
		
		if($json['status_mercado'] == 1){
		    
		    /*
			$instant = $partial->listing();
			
			$farm = null;
			
			foreach($instant as $instapartial){
			    
			    if($farm == null){
			        $farm = $instapartial->partialteam;
			    } else {
			        if($farm == $instapartial->partialteam){
			            if($partial->delete($instapartial->partialid)){
    						$farm = null;
    					}
			        }
			    }
				
                $finalaux = $this->getAward($instapartial->registryteam, $status['currentround']);
				
				if($finalaux){
					$partialdata['partialid'] = null;
					$partialdata['partialteam'] = $instapartial->registryteam;
					$partialdata['partialpoints'] = $finalaux['pontos'];
					
					if($partial->save($partialdata)){
						echo "[O]";
					}
				}
			}
			*/
			return true;
		}
		
	}
	
    function getcontest($json, $status) {
		
        $this->load->model('RegistryModel');
        $reg = new RegistryModel();
        
        $list = $reg->codelistfree($status['currentround']);
        
        $cont = 0;
        foreach ($list as $team) {
            
            $aux = $this->getAward($team->teamid, $status['currentround']);
            
            $data['ctrkid'] = null;
            $data['year'] = $json['temporada'];
            $data['round'] = $status['currentround'];
            $data['ctrkteamid'] = $aux['time']['time_id'];
            $data['ctrkcoach'] = $aux['time']['nome_cartola'];
            $data['ctrkteamid'] = $team->teamid;
            $data['ctrkteam'] = $aux['time']['nome'];
            $data['ctrkaward'] = $aux['pontos'];
            
            $array[$cont] = $data;
            $cont++;
        }
        for($i=0; $i<$cont-1; $i++){
            for($j=$i+1; $j<$cont; $j++){
                if($array[$i]['ctrkaward'] < $array[$j]['ctrkaward']){
                    $help = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $help;
                }
            }
        }
        return $array;
    }
    
    public function getAward($teamid, $spin) {
        
        $url = 'https://api.cartola.globo.com/time/id/'.$teamid.'/'.$spin;
        
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
	
	public function getleague($page, $order) {
        
        $url = "https://api.cartola.globo.com/auth/liga/acretinos2022?page=".$page."&orderBy=".$order;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
          'X-GLB-Token: '.$this->session->userdata('glbId'),
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die(curl_error($ch));
        }
        
        curl_close($ch);
        
        $json = json_decode($result, true);
        
        return $json;
    }
	
    function updatetop10yearclassic($league, $json, $laststatus) {
		
        $this->load->model('YtopModel');
        $ytop = new YtopModel();
        
        $toplist = $ytop->reverse($json['temporada'], 1, 1);
        if($toplist){
            $aux = 0;
            foreach ($toplist as $topunit) {
                foreach (array_slice($league['times'], $aux, 1) as $leagueteam) {
                    if($topunit->topaward < $leagueteam['pontos']['rodada']){
                        $data['topid'] = $topunit->topid;
                        $data['topyear'] = $topunit->topyear;
                        $data['topround'] = $laststatus['currentround'];
                        $data['topdesc'] = $topunit->topdesc;
                        $data['toptype'] = $topunit->toptype;
                        $data['topcoach'] = $leagueteam['nome_cartola'];
                        $data['topteam'] = $leagueteam['nome'];
                        $data['topaward'] = $leagueteam['pontos']['rodada'];
                        
                        $ytop->update($data);
                    }
                }
                $aux++;
            }
        }else{
			foreach (array_slice($league['times'], 0, 10) as $leagueteam) {
				$data['topid'] = null;
                $data['topyear'] = $json['temporada'];
                $data['topround'] = $laststatus['currentround'];
                $data['topdesc'] = 1;
                $data['toptype'] = 1;
                $data['topcoach'] = $leagueteam['nome_cartola'];
                $data['topteam'] = $leagueteam['nome'];
                $data['topaward'] = $leagueteam['pontos']['rodada'];
				
				$ytop->save($data);
			}
        }
    }
	
	function updatetop10historyclassic($league, $json, $laststatus) {
		
        $this->load->model('YtopModel');
        $ytop = new YtopModel();
        
        $toplist = $ytop->hreverse(2, 1);
        if($toplist){
            $aux = 0;
            foreach ($toplist as $topunit) {
                foreach (array_slice($league['times'], $aux, 1) as $leagueteam) {
                    if($topunit->topaward < $leagueteam['pontos']['rodada']){
                        $data['topid'] = $topunit->topid;
                        $data['topyear'] = $topunit->topyear;
                        $data['topround'] = $laststatus['currentround'];
                        $data['topdesc'] = $topunit->topdesc;
                        $data['toptype'] = $topunit->toptype;
                        $data['topcoach'] = $leagueteam['nome_cartola'];
                        $data['topteam'] = $leagueteam['nome'];
                        $data['topaward'] = $leagueteam['pontos']['rodada'];
                        
                        // $ytop->update($data);
                    }
                }
                $aux++;
            }
        }else{
			foreach (array_slice($league['times'], 0, 10) as $leagueteam) {
				$data['topid'] = null;
                $data['topyear'] = $json['temporada'];
                $data['topround'] = $laststatus['currentround'];
                $data['topdesc'] = 2;
                $data['toptype'] = 1;
                $data['topcoach'] = $leagueteam['nome_cartola'];
                $data['topteam'] = $leagueteam['nome'];
                $data['topaward'] = $leagueteam['pontos']['rodada'];
				
				$ytop->save($data);
			}
        }
    }
	
	public function token(){
        
        header('Content-type: application/json');
        
        $email = "asviniciuz@gmail.com";
        $password = "#asv930815";
        $serviceId = 4728;
        
        $url = 'https://login.globo.com/api/authentication';
        
        $jsonAuth = array(
          'captcha' => '',
          'payload' => array(
            'email' => $email,
            'password' => $password,
            'serviceId' => $serviceId
          )
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonAuth));
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
          die(curl_error($ch));
        }
        curl_close($ch);
        
        $parseJson = json_decode($result, TRUE);
        
        if($parseJson['id'] == "Authenticated"){            
            $session = array('glbId' => $parseJson['glbId']);
            if($this->session->set_userdata($session)){
                return true;
            }
        }else{            
            redirect(base_url('fail'));
        }      
    }
	
	public function end() {
        
        $url = 'https://login.globo.com/logout';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
          'X-GLB-Token: '.$this->session->userdata('glbId'),
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
          die(curl_error($ch));
        }
        curl_close($ch);
        
        $this->session->sess_destroy();
        return true;
    }
    
    function validgen($ftrdata){
        $partialone = md5($ftrdata['ftr_type']."!".$ftrdata['ftr_mode']);
        $partialtwo = md5($ftrdata['ftr_date']."@".$ftrdata['ftr_user']);
        $validator = md5($partialone."#".$ftrdata['ftr_value']."$".$partialtwo);
        
        return $validator;
    }
}