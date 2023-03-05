<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Playoff extends CI_Controller {

    public function index(){
        
        $json = $this->getstatus();
        
        $this->load->model('ClassicrkModel');
        $this->load->model('DescriptionModel');
        $clrk = new ClassicrkModel();
        $desc = new DescriptionModel();
        
        $yearid = $json['temporada'];
        
        $classic = $clrk->listing($yearid, 1);
        $clall = $clrk->listall($yearid);
        $datadesc = $desc->search(1);

        $msg = array("status" => $json['status_mercado'], "year" => $yearid, "ranking" => $classic, "rkall" => $clall, "desc" => $datadesc);
        
        $this->load->view('template/header');
        $this->load->view('playoffview', $msg);
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
        $this->load->view('classichist', $msg);
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
        $this->load->view('classichist', $msg);
        $this->load->view('template/footer');
    }
    
}