<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parcial extends CI_Controller {

    public function index() {
        $this->load->model('EnqueteModel');
        $enquete = new EnqueteModel();
		
		$totalzero = count($enquete->listzero());
		$totalone = count($enquete->listone());
		$total = count($enquete->listing());
		$percentzero = null;
		$percentone = null;
		if($totalzero>0){
			$percentzero = number_format(($totalzero/$total)*100, 2, '.', '');
		} else {
			$percentzero = 0;
		}
		if($totalone>0){
			$percentone = number_format(($totalone/$total)*100, 2, '.', '');
		} else {
			$percentone = 0;
		}
		
		$content = array(
			"total" => $total, 
			"totalzero" => $totalzero, 
			"totalone" => $totalone, 
			"percentzero" => $percentzero, 
			"percentone" => $percentone
		);
		
		$this->load->view('parcial', $content);
	}
}