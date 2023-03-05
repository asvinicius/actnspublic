<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parceiros extends CI_Controller {

    public function index(){        
        $this->load->view('template/header');
        $this->load->view('parceria');
        $this->load->view('template/footer');
    }
    
}