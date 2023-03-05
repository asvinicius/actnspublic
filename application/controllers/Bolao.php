<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bolao extends CI_Controller {

    public function index(){
		$this->load->model('SpinModel');
		$this->load->model('PaidModel');
		$this->load->model('RegistryModel');
		$this->load->model('ParciaisModel');
		$registry = new RegistryModel();
		$partial = new ParciaisModel();
		$spin = new SpinModel();
		$paid = new PaidModel();
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$json = $this->getstatus();
		
		if($json['status_mercado'] == 1){
		
    		$reglisting = $registry->listfree($json['rodada_atual']);
    		$spindata = $spin->search($json['rodada_atual']);
    		$paiddata = $paid->searchproduct($json['rodada_atual']);
    		
    		$itens = $spindata['numteams'];
    			
    		if(($itens % 50) == 0) {
    			$mult = true;
    		} else {
    			$mult = false;
    		}
    				
    		$content = array(
    			"json" => $json,
    			"teams" => $reglisting,
    			"spin" => $json['rodada_atual'], 
    			"spindata" => $spindata,
    			"paiddata" => $paiddata, 
    			"page" => 0, 
    			"itens" => $itens, 
    			"mult" => $mult);
		} else {
			$partialdata = $partial->listing();
			$spindata = $spin->search($json['rodada_atual']);
			$paiddata = $paid->searchproduct($json['rodada_atual']);
			
			$content = array(
				"json" => $json,
				"partial" => $partialdata, 
				"spindata" => $spindata,
				"paiddata" => $paiddata, 
				"spin" => $json['rodada_atual']);
		}
			
        $this->load->view('template/header', $pagedata);
        $this->load->view('contest', $content);
        $this->load->view('template/footer');
    }

    public function pagina($paged){        
		$this->load->model('SpinModel');
		$this->load->model('PaidModel');
		$this->load->model('RegistryModel');
		$registry = new RegistryModel();
		$spin = new SpinModel();
		$paid = new PaidModel();
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$json = $this->getstatus();
		$reglisting = $registry->mypaged($json['rodada_atual'], $paged);
		$spindata = $spin->search($json['rodada_atual']);
		$paiddata = $paid->searchproduct($json['rodada_atual']);
		
		$itens = $spindata['numteams'];
			
		if(($itens % 20) == 0) {
			$mult = true;
		} else {
			$mult = false;
		}
				
		$content = array(
			"json" => $json,
			"teams" => $reglisting,
			"spin" => $json['rodada_atual'], 
			"spindata" => $spindata,
			"paiddata" => $paiddata, 
			"page" => $paged, 
			"itens" => $itens, 
			"mult" => $mult);
				
        $this->load->view('template/header', $pagedata);
        $this->load->view('contest', $content);
        $this->load->view('template/footer');
    }
	
	public function pesquisar() {
		$this->load->model('SpinModel');
		$this->load->model('PaidModel');
		$this->load->model('RegistryModel');
		$registry = new RegistryModel();
		$spin = new SpinModel();
		$paid = new PaidModel();
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
			
		$json = $this->getstatus();
		$searchlabel = $this->input->post("searchlabel");
		
		$reglisting = $registry->spinfree($searchlabel, $json['rodada_atual']);
		$spindata = $spin->search($json['rodada_atual']);
		$paiddata = $paid->searchproduct($json['rodada_atual']);
		
		$content = array(
			"json" => $json,
			"teams" => $reglisting,
			"spin" => $json['rodada_atual'], 
			"spindata" => $spindata,
			"paiddata" => $paiddata);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('contest', $content);
        $this->load->view('template/footer');
    }
    
    public function codigo($spinid) {
        $this->load->model('RegistryModel');
        $reg = new RegistryModel();
        
        $ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
        
        $json = $this->getstatus();

        $regdata = $reg->codelistfree($spinid);
        
        $c = 0;
        foreach ($regdata as $simple) {
		    if($c == 0){
		        $finalcode = $simple->teamid;
			} else {
			    $finalcode .= ";".$simple->teamid;
			}
			$c++;
		}

        $content = array(
            "spin" => $spinid, 
            "regdata" => $regdata, 
            "finalcode" => $finalcode, 
            "status" => $json['status_mercado']);

        $this->load->view('template/header', $pagedata);
        $this->load->view('code', $content);
        $this->load->view('template/footer');
    }
    
    public function escalacao($teamid) {		
		$this->load->model('ParciaisModel');
		$this->load->model('PAModel');
		$this->load->model('PRModel');
		$this->load->model('AtletasModel');
		$this->load->model('RegistryModel');
		$this->load->model('TeamModel');
		$atletas = new AtletasModel();
		$partial = new ParciaisModel();
		$pa = new PAModel();
		$pr = new PRModel();
		$registry = new RegistryModel();
		$team = new TeamModel();
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$json = $this->getstatus();
		
		$teamdata = $team->search($teamid);
		$partialdata = $partial->search($teamid);
		$pontuados = $pa->getsquadout($teamid);
		$reservas = $pr->getsquadout($teamid);
		$squad = $this->getpontuados();
		
		$content = array(
			"json" => $json,
			"team" => $teamdata,
			"partial" => $partialdata,
			"pontuados" => $pontuados,
			"reservas" => $reservas,
			"squad" => $squad);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('squad', $content);
        $this->load->view('template/footer');
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
	
	public function getOgdata() {
		$current = array(
			"id" => 4, 
			"title" => "Bolão Acretinos", 
			"description" => "Bolão tiro curto mais disputado da região", 
			"url" => "https://www.acretinos.com.br/bolao", 
			"image" => "https://www.acretinos.com.br/assets/img/logomail.png", 
			"imagealt" => "Bolão tiro curto mais disputado da região", 
			"keywords" => "cartola, cartola fc, futebol, brasileirão, campeonato brasileiro, acretinos, bolão, liga, mata-mata, dinheiro, dinheiro com futebol", 
		);
        return array("current" => $current);
    }
}