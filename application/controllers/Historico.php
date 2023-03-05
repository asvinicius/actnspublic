<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Historico extends CI_Controller {
    public function index(){        
        $this->load->model('YearModel');
        $year = new YearModel();
        
        $ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
        $data = $year->listing();

        $msg = array("years" => $data);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('historic', $msg);
        $this->load->view('template/footer');
    }
    
    public function classica($yearid){
        $this->load->model('ClassicrkModel');
        $this->load->model('DescriptionModel');
        $classicrk = new ClassicrkModel();
        $desc = new DescriptionModel();
        
        $classic = $classicrk->listing($yearid, 1);
        $classicall = $classicrk->listall($yearid);
        $datadesc = $desc->search(1);

        $msg = array("year" => $yearid, "ranking" => $classic, "rkall" => $classicall, "desc" => $datadesc);
        
        $this->load->view('template/header');
        $this->load->view('classicdata', $msg);
        $this->load->view('template/footer');
    }
    
    public function classicavariacao($data = null){
        $this->load->model('ClassicrkModel');
        $this->load->model('DescriptionModel');
        $clrk = new ClassicrkModel();
        $desc = new DescriptionModel();
        
        $exp = explode("-", $data);
        $auxdesc = $exp[0];
        $yearid = $exp[1];
        
        $classic = $clrk->listing($yearid, $auxdesc);
        $classicall = $clrk->listall($yearid);
        $datadesc = $desc->search($auxdesc);

        $msg = array("year" => $yearid, "ranking" => $classic, "rkall" => $classicall, "desc" => $datadesc);
        
        $this->load->view('template/header');
        $this->load->view('classicdata', $msg);
        $this->load->view('template/footer');
    }
    
    public function bolao($yearid){
        $this->load->model('SpinModel');
        $this->load->model('ContestrkModel');
        $this->load->model('CompletedspinModel');
        $spin = new SpinModel();
        $contestrk = new ContestrkModel();
        $sc = new CompletedspinModel();
        
        $comp = $sc->completed($yearid);
        
        $lastspin = count($comp);
        
		$data = $contestrk->listing($yearid, $lastspin);
				
		$msg = array("pasteround" => $data, "spin" => $lastspin, "year" => $yearid, "comp" => $comp);
        
        $ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
        $this->load->view('template/header', $pagedata);
        $this->load->view('contestdata', $msg);
        $this->load->view('template/footer');
    }
    
    public function bolaovariacao($data = null){
        $this->load->model('SpinModel');
        $this->load->model('ContestrkModel');
        $this->load->model('CompletedspinModel');
        $spin = new SpinModel();
        $contestrk = new ContestrkModel();
        $sc = new CompletedspinModel();
        
        $exp = explode("-", $data);
        $auxdesc = $exp[0];
        $yearid = $exp[1];
        
		$data = $contestrk->listing($yearid, $auxdesc);
        $comp = $sc->completed($yearid);
				
		$msg = array("pasteround" => $data, "spin" => $auxdesc, "year" => $yearid, "comp" => $comp);
        
        $ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
        $this->load->view('template/header', $pagedata);
        $this->load->view('contestdata', $msg);
        $this->load->view('template/footer');
    }
    
    public function recordesbolao() {
        $this->load->model('YtopModel');
        $ytop = new YtopModel();

        $data = $ytop->listingcontest();
        
        $msg = array("top" => $data, "desc" => 2);

        $this->load->view('template/header');
        $this->load->view('contestrecords', $msg);
        $this->load->view('template/footer');
    }
    
    public function recordesbolaoano($year = null) {
        $this->load->model('YtopModel');
        $ytop = new YtopModel();

        $data = $ytop->listingcontestyear($year);
        
        $msg = array("top" => $data, "desc" => 1, "year" => $year);

        $this->load->view('template/header');
        $this->load->view('contestrecords', $msg);
        $this->load->view('template/footer');
    }
    
    public function recordesclassica() {
        $this->load->model('YtopModel');
        $ytop = new YtopModel();

        $data = $ytop->listingclassic();
        
        $msg = array("top" => $data, "desc" => 2);

        $this->load->view('template/header');
        $this->load->view('classicrecords', $msg);
        $this->load->view('template/footer');
    }
    
    public function recordesclassicaano($year = null) {
        $this->load->model('YtopModel');
        $ytop = new YtopModel();

        $data = $ytop->listingclassicyear($year);
        
        $msg = array("top" => $data, "desc" => 1, "year" => $year);

        $this->load->view('template/header');
        $this->load->view('classicrecords', $msg);
        $this->load->view('template/footer');
    }
	
	public function getOgdata() {
		$current = array(
			"id" => 2, 
			"title" => "Dados históricos", 
			"description" => "Os mitos da Liga Acretinos estão aqui", 
			"url" => "https://www.acretinos.com.br/historico", 
			"image" => "https://www.acretinos.com.br/assets/img/logo2.png", 
			"imagealt" => "Os mitos da Liga Acretinos estão aqui", 
			"keywords" => "cartola, cartola fc, futebol, brasileirão, campeonato brasileiro, acretinos, bolão, liga, mata-mata, dinheiro, dinheiro com futebol", 
		);
        return array("current" => $current);
    }
}