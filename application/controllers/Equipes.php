<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equipes extends CI_Controller {

    public function index(){
        $this->load->model('RankingModel');
        $this->load->model('TabelaModel');
        $ranking = new RankingModel();
        $tabela = new TabelaModel();
        
        $ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
        
        $json = $this->getstatus();
        
        $grupo1 = $ranking->listgroup(1);
        $grupo2 = $ranking->listgroup(2);
        
        $jogos = $tabela->listing($json['rodada_atual']-24);

        $content = array(
            "grupo1" => $grupo1,
            "grupo2" => $grupo2,
            "jogos" => $jogos,
            "rodada" => $json['rodada_atual']-24);
        
        $this->load->view('template/header', $pagedata);
        $this->load->view('equipes', $content);
        $this->load->view('template/footer');
    }
    
    public function rodada($round = null){
        $this->load->model('RankingModel');
        $this->load->model('TabelaModel');
        $ranking = new RankingModel();
        $tabela = new TabelaModel();
        
        $ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
        
        $json = $this->getstatus();
        
        $grupo1 = $ranking->listgroup(1);
        $grupo2 = $ranking->listgroup(2);
        $grupo3 = $ranking->listgroup(3);
        $grupo4 = $ranking->listgroup(4);
        
        $jogos = $tabela->listing($round);

        $content = array(
            "grupo1" => $grupo1,
            "grupo2" => $grupo2,
            "grupo3" => $grupo3,
            "grupo4" => $grupo4,
            "jogos" => $jogos,
            "rodada" => $round);
        
        $this->load->view('template/header', $pagedata);
        $this->load->view('equipes', $content);
        $this->load->view('template/footer');
    }
    
    public function equipe($equipe_id){
        $this->load->model('TabelaModel');
        $this->load->model('RankingModel');
        $this->load->model('EquipesModel');
        $this->load->model('TEModel');
        $tabela = new TabelaModel();
        $ranking = new RankingModel();
        $equipes = new EquipesModel();
        $te = new TEModel();
        
        $ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
        
        $json = $this->getstatus();
        
        $rk = $ranking->listing();
        $equipe = $equipes->search($equipe_id);
        $times = $te->detail($equipe_id);

        $content = array(
            "times" => $times,
            "equipe" => $equipe,
            "ranking" => $rk);
        
        $this->load->view('template/header', $pagedata);
        $this->load->view('equipe', $content);
        $this->load->view('template/footer');
    }
    
    public function codigo($equipe_id) {
        $this->load->model('TabelaModel');
        $this->load->model('RankingModel');
        $this->load->model('EquipesModel');
        $this->load->model('TEModel');
        $tabela = new TabelaModel();
        $ranking = new RankingModel();
        $equipes = new EquipesModel();
        $te = new TEModel();
        
        $ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
        
        $json = $this->getstatus();

        $times = $te->searchequipe($equipe_id);
        
        $c = 0;
        foreach ($times as $time) {
		    if($c == 0){
		        $finalcode = $time->te_time;
			} else {
			    $finalcode .= ";".$time->te_time;
			}
			$c++;
		}
        
        $rk = $ranking->listing();
        $equipe = $equipes->search($equipe_id);
        $times = $te->detail($equipe_id);

        $content = array(
            "times" => $times,
            "equipe" => $equipe,
            "finalcode" => $finalcode);
        
        $this->load->view('template/header', $pagedata);
        $this->load->view('equipecode', $content);
        $this->load->view('template/footer');
    }
    
    public function search() {
        
        $json = $this->getstatus();
        $spin = $this->input->post("spin");

        $this->load->model('RegistryModel');
        $this->load->model('SpinModel');
        $reg = new RegistryModel();
        $spinmdl = new SpinModel();

        $name = $this->input->post("searchtxt");

        $data = $reg->spin($name, $spin);
        $spindata = $spinmdl->search($spin);
        $comp = $spinmdl->completed();
        $msg = array("teams" => $data, "spin" => $spin, "spn" => $spindata, "status" => $json['status_mercado'], "comp" => $comp);

        $this->load->view('template/header');
        $this->load->view('contest', $msg);
        $this->load->view('template/footer');
    }
    
    public function detail($equipe_id = null) {
        
        $json = $this->getstatus();
        
        $this->load->model('RankingModel');
        $this->load->model('EquipesModel');
        $this->load->model('TEModel');
        $ranking = new RankingModel();
        $equipes = new EquipesModel();
        $te = new TEModel();
        
        $rk = $ranking->listing();
        $equipe = $equipes->search($equipe_id);
        $times = $te->detail($equipe_id);

        $msg = array("times" => $times, "equipe" => $equipe, "ranking" => $rk);
        
        $this->load->view('template/header');
        $this->load->view('detail', $msg);
        $this->load->view('template/footer');
    }
    
    public function topaward($info = null) {
        $json = $this->getstatus();
        
        $exp = explode("-", $info);
        $desc = $exp[0];
        $type = $exp[1];

        $this->load->model('YtopModel');
        $ytop = new YtopModel();

        $data = $ytop->listing($desc, $type);
        
        $msg = array("top" => $data, "status" => $json['status_mercado'], "desc" => $desc);

        $this->load->view('template/header');
        $this->load->view('topawardcontest', $msg);
        $this->load->view('template/footer');
    }
    
    public function getOgdata() {
		$current = array(
			"id" => 6, 
			"title" => "Liga de equipes", 
			"description" => "Liga em equipes mais disputada e divertida do cartola", 
			"url" => "https://www.acretinos.com.br/equipes", 
			"image" => "https://www.acretinos.com.br/assets/img/logomail.png", 
			"imagealt" => "Liga em equipes mais disputada e divertida do cartola", 
			"keywords" => "cartola, cartola fc, futebol, brasileirão, campeonato brasileiro, acretinos, bolão, liga, mata-mata, dinheiro, dinheiro com futebol", 
		);
        return array("current" => $current);
    }
}