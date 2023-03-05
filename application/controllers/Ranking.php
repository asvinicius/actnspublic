<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking extends CI_Controller {

    public function index(){
        
        $json = $this->getstatus();
        
        $this->load->model('RankingModel');
        $ranking = new RankingModel();
        
        $rk = $ranking->listing();

        $msg = array("ranking" => $rk);
        
        $this->load->view('template/header');
        $this->load->view('equipes', $msg);
        $this->load->view('template/footer');
    }
    
    public function classic($yearid){
        
        $json = $this->getstatus();
        
        $this->load->model('ClassicrkModel');
        $this->load->model('DescriptionModel');
        $clrk = new ClassicrkModel();
        $desc = new DescriptionModel();
        
        $classic = $clrk->listing($yearid, 1);
        $clall = $clrk->listall($yearid);
        $datadesc = $desc->search(1);

        $msg = array("status" => $json['status_mercado'], "year" => $yearid, "ranking" => $classic, "rkall" => $clall, "desc" => $datadesc);
        
        $this->load->view('template/header');
        $this->load->view('tableclassic', $msg);
        $this->load->view('template/footer');
    }
    
    public function clvar($data=null){
        
        $json = $this->getstatus();
        
        $this->load->model('ClassicrkModel');
        $this->load->model('DescriptionModel');
        $clrk = new ClassicrkModel();
        $desc = new DescriptionModel();
        
        $exp = explode("-", $data);
        $auxdesc = $exp[0];
        $yearid = $exp[1];
        
        $classic = $clrk->listing($yearid, $auxdesc);
        $clall = $clrk->listall($yearid);
        $datadesc = $desc->search($auxdesc);

        $msg = array("status" => $json['status_mercado'], "year" => $yearid, "ranking" => $classic, "rkall" => $clall, "desc" => $datadesc);
        
        $this->load->view('template/header');
        $this->load->view('tableclassic', $msg);
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
        $this->load->view('topawardclassic', $msg);
        $this->load->view('template/footer');
    }
}