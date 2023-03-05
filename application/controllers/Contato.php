<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {
    public function index(){
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('contact');
        $this->load->view('template/footer');
    }
	
	
	public function getOgdata() {
		$current = array(
			"id" => 8, 
			"title" => "Contato", 
			"description" => "Entre em contato com a Liga Acretinos", 
			"url" => "https://www.acretinos.com.br/contato", 
			"image" => "https://www.acretinos.com.br/assets/img/logo2.png", 
			"imagealt" => "Entre em contato com a Liga Acretinos", 
			"keywords" => "cartola, cartola fc, futebol, brasileirão, campeonato brasileiro, acretinos, bolão, liga, mata-mata, dinheiro, dinheiro com futebol", 
		);
        return array("current" => $current);
    }
}