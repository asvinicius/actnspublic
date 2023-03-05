<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jogos extends CI_Controller {

    public function index(){
        
        $json = $this->getstatus();
        
        $this->load->model('SpinModel');
        $this->load->model('RegistryModel');
        $this->load->model('TabelaModel');
        $tabela = new TabelaModel();
        $reg = new RegistryModel();
        $spin = new SpinModel();
        
        $data = $tabela->listing($json['rodada_atual']-9);
        $spindata = $spin->search($json['rodada_atual']);
        $comp = $spin->completed();
        $msg = array("jogos" => $data, "spin" => $json['rodada_atual']-9, "spn" => $spindata, "status" => $json['status_mercado'], "comp" => $comp);
        
        $this->load->view('template/header');
        $this->load->view('tabela', $msg);
        $this->load->view('template/footer');
    }
    
    public function rodada($round = null){
        $json = $this->getstatus();
        
        $this->load->model('SpinModel');
        $this->load->model('RegistryModel');
        $this->load->model('TabelaModel');
        $tabela = new TabelaModel();
        $reg = new RegistryModel();
        $spin = new SpinModel();
        
        $data = $tabela->listing($round);
        $spindata = $spin->search($json['rodada_atual']);
        $comp = $spin->completed();
        $msg = array("jogos" => $data, "spin" => $round, "spn" => $spindata, "status" => $json['status_mercado'], "comp" => $comp);
        
        $this->load->view('template/header');
        $this->load->view('tabela', $msg);
        $this->load->view('template/footer');
    }
    
    public function codigo($info = null) {
        $json = $this->getstatus();
        
        $exp = explode("-", $info);
        $aid = $exp[0];
        $bid = $exp[1];

        $this->load->model('TEModel');
        $this->load->model('EquipesModel');
        $te = new TEModel();
        $equipes = new EquipesModel();
        
        $equipea = $equipes->search($aid);
        $equipeb = $equipes->search($bid);
                
        $eqa = $te->searchequipe($aid);
        $eqb = $te->searchequipe($bid);
        
        $regdata = null;        
                
        if($eqb){
            if($eqa){
                $regdata = array_merge($eqa, $eqb);
            }else{
                $regdata = $eqb;
            }
        }
        
        $msg = array("regdata" => $regdata, "equipea" => $equipea, "equipeb" => $equipeb, "status" => $json['status_mercado']);

        $this->load->view('template/header');
        $this->load->view('codigos', $msg);
        $this->load->view('template/footer');
    }
}