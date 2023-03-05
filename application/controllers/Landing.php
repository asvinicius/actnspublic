<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    public function index(){
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
        $this->load->view('landing', $pagedata);
    }
	
	public function getOgdata() {
		$current = array(
			"id" => 0, 
			"title" => "Liga Acretinos", 
			"description" => "A melhor liga de cartola da regi達o", 
			"url" => "https://www.acretinos.com.br", 
			"image" => "https://www.acretinos.com.br/assets/img/logo2.png", 
			"imagealt" => "A melhor liga de cartola da regi達o", 
			"keywords" => "cartola, cartola fc, futebol, brasileir達o, campeonato brasileiro, acretinos, bol達o, liga, mata-mata, dinheiro, dinheiro com futebol", 
		);
        return array("current" => $current);
    }
}