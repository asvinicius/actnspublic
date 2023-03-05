<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fail extends CI_Controller {

    function index(){
        $this->load->view('template/header');
        $this->load->view('fail');
        $this->load->view('template/footer');
    }
}