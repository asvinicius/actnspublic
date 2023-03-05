<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function index(){      
		$this->load->model('NewsModel');
		$news = new NewsModel();
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$listingnews = $news->listfront();
		
		$content = array("notice" => $listingnews);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('welcome', $content);
        $this->load->view('template/footer');
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