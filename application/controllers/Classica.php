<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Classica extends CI_Controller {

    public function index(){        
        redirect(base_url());
        /*
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$json = $this->getstatus();
		$league = $this->getleague(1, "campeonato");
		
		$itens = $league['liga']['total_times_liga'];
		
		if(($itens % 100) == 0) {
			$mult = true;
		} else {
			$mult = false;
		}
		
		$content = array(
			"status" => $json['status_mercado'], 
			"year" => $json['temporada'], 
			"description" => "campeonato",
			"cont" => 0,
			"ranking" => $league,
			"page" => 1, 
			"itens" => $itens, 
			"mult" => $mult);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('classic', $content);
        $this->load->view('template/footer');
        */
    }
	
	public function showleague() {
		$this->token();
        $url = "https://api.cartolafc.globo.com/auth/liga/acretinos2020?orderBy=turno";
        
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
        
        echo json_encode($json, true);;
        return false;
    }
	
    public function pagina($parameter){        
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$exp = explode("-", $parameter);
		$description = $exp[0];
		$page = $exp[1];
		
		$json = $this->getstatus();
		$league = $this->getleague($page, $description);
		
		$itens = $league['liga']['total_times_liga'];
		
		if(($itens % 100) == 0) {
			$mult = true;
		} else {
			$mult = false;
		}
		
		if($page == 1){
			$cont = 0;
		} else {
			$cont = (100*($page-1));
		}
		
		$content = array(
			"status" => $json['status_mercado'], 
			"year" => $json['temporada'], 
			"description" => $description,
			"cont" => $cont,
			"page" => $page,
			"ranking" => $league,
			"itens" => $itens, 
			"mult" => $mult);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('classic', $content);
        $this->load->view('template/footer');
    }

    public function order($orderby){
        $ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$json = $this->getstatus();
		$league = $this->getleague(1, $orderby);
		
		$itens = $league['liga']['total_times_liga'];
		
		if(($itens % 100) == 0) {
			$mult = true;
		} else {
			$mult = false;
		}
		
		$content = array(
			"status" => $json['status_mercado'], 
			"year" => $json['temporada'], 
			"description" => $orderby,
			"cont" => 0,
			"ranking" => $league,
			"page" => 1, 
			"itens" => $itens, 
			"mult" => $mult);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('classic', $content);
        $this->load->view('template/footer');
    }
	
	public function getleague($page, $orderby) {
	    
		$this->token();
        $url = "https://api.cartolafc.globo.com/auth/liga/acretinos2020?page=".$page."&orderBy=".$orderby;
        
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
	
	public function token(){
        //header('Content-type: application/json');
        
        $email = "asviniciuz@gmail.com";
        $password = "#asv930815";
        $serviceId = 4728;
        
        $url = 'https://login.globo.com/api/authentication';
        
        $jsonAuth = array(
          'captcha' => '6LdXAWUaAAAAADJYAkhrM64Fsy51wt8QC8fEdL7z',
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
            echo "LOL - ".$parseJson['id'];
            return false;
            //redirect(base_url('fail'));
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
	
	public function getOgdata() {
		$current = array(
			"id" => 3, 
			"title" => "Liga Clássica Acretinos", 
			"description" => "A melhor liga de cartola da região", 
			"url" => "https://www.acretinos.com.br/classica", 
			"image" => "https://www.acretinos.com.br/assets/img/logo2.png", 
			"imagealt" => "A melhor liga de cartola da região", 
			"keywords" => "cartola, cartola fc, futebol, brasileirão, campeonato brasileiro, acretinos, bolão, liga, mata-mata, dinheiro, dinheiro com futebol", 
		);
        return array("current" => $current);
    }
}