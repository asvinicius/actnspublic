<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre extends CI_Controller {

    public function index(){
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('aboutus');
        $this->load->view('template/footer');
    }
	
	public function getOgdata() {
		$current = array(
			"id" => 1, 
			"title" => "Sobre", 
			"description" => "História da Liga Acretinos", 
			"url" => "https://www.acretinos.com.br/sobre", 
			"image" => "https://www.acretinos.com.br/assets/img/logo2.png", 
			"imagealt" => "História da Liga Acretinos", 
			"keywords" => "cartola, cartola fc, futebol, brasileirão, campeonato brasileiro, acretinos, bolão, liga, mata-mata, dinheiro, dinheiro com futebol", 
		);
        return array("current" => $current);
    }
}