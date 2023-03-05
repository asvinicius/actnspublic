<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Desafio extends CI_Controller {

    public function index(){
        
        $json = $this->getstatus();
        
        $this->load->model('ClassicrkModel');
        $this->load->model('DescriptionModel');
        $clrk = new ClassicrkModel();
        $desc = new DescriptionModel();
                
        $classic = $clrk->listing(2019, 3);
        $clall = $clrk->listall(2019);
        $datadesc = $desc->search(3);

        $msg = array("status" => $json['status_mercado'], "year" => 2019, "ranking" => $classic, "rkall" => $clall, "desc" => $datadesc);
        
        $this->load->view('template/header');
        $this->load->view('desafio', $msg);
        $this->load->view('template/footer');
    }
}