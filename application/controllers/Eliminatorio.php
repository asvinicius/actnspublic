<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Eliminatorio extends CI_Controller {

    public function index(){
		$this->load->model('EliminatorioModel');
        $this->load->model('StatusModel');
		$partial = new EliminatorioModel();
        $status = new StatusModel();
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$json = $this->getstatus();
		$laststatus = $status->search();
		
		$showpt = 0;
		$showcode = 0;
		if($json['status_mercado'] == 1){
    		if($json['rodada_atual'] == $laststatus['currentround']){
    		    $showpt = 1;
    		} else {
		        $showcode = 1;
    		}
		}
		
		//$showpt = 0;
		
		if($json['status_mercado'] == 1){
		    $partialdata = $partial->listing();
		} else {
		    $partialdata = $partial->listing();
		    //$partialdata = $partial->listpage();
		}
		
		$content = array(
			"json" => $json,
			"partial" => $partialdata, 
			"showpt" => $showpt, 
			"showcode" => $showcode, 
			"spin" => $json['rodada_atual']);
			
        $this->load->view('template/header', $pagedata);
        $this->load->view('eliminatorio', $content);
        $this->load->view('template/footer');
    }
    
    public function escalacao($teamid) {		
		$this->load->model('EliminatorioModel');
		$this->load->model('EAModel');
		$this->load->model('ERModel');
		$this->load->model('AtletasModel');
		$atletas = new AtletasModel();
		$partial = new EliminatorioModel();
		$pa = new EAModel();
		$pr = new ERModel();
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$json = $this->getstatus();
		
		$partialdata = $partial->search($teamid);
		$pontuados = $pa->getsquadout($teamid);
		$reservas = $pr->getsquadout($teamid);
		$squad = $this->getpontuados();
		
		$content = array(
			"json" => $json,
			"partial" => $partialdata,
			"pontuados" => $pontuados,
			"reservas" => $reservas,
			"squad" => $squad);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('elimsquad', $content);
        $this->load->view('template/footer');
    }
	
	public function codigo() {
		$this->load->model('EliminatorioModel');
        $this->load->model('StatusModel');
		$reg = new EliminatorioModel();
        $status = new StatusModel();
        
        $ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
        
        $json = $this->getstatus();
		$laststatus = $status->search();
        
        if($json['status_mercado'] == 1){
    		if($json['rodada_atual'] != $laststatus['currentround']){
		        redirect(base_url('eliminatorio'));
    		}
		}

        $regdata = $reg->listing();
        
        $c = 0;
        foreach ($regdata as $simple) {
		    if($c == 0){
		        $finalcode = $simple->et_id;
			} else {
			    $finalcode .= ";".$simple->et_id;
			}
			$c++;
		}

        $content = array(
            "regdata" => $regdata, 
            "finalcode" => $finalcode, 
            "json" => $json);

        $this->load->view('template/header', $pagedata);
        $this->load->view('elimcode', $content);
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
			"id" => 9, 
			"title" => "Eliminatório Acretinos", 
			"description" => "Onde apenas os mitos sobrevivem", 
			"url" => "https://www.acretinos.com.br/eliminatorio", 
			"image" => "https://www.acretinos.com.br/assets/img/logomail.png", 
			"imagealt" => "Onde apenas os mitos sobrevivem", 
			"keywords" => "cartola, cartola fc, futebol, brasileirão, campeonato brasileiro, acretinos, bolão, liga, mata-mata, dinheiro, dinheiro com futebol", 
		);
        return array("current" => $current);
    }
}