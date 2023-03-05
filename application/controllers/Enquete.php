<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Enquete extends CI_Controller {

    public function index() {
        $this->load->view('enquete');
    }
	
	public function enviar(){
        $this->load->model('EnqueteModel');
        $enquete = new EnqueteModel();
		
		$nomeparticipante = $this->input->post('nomeparticipante');
		$cpfparticipante = $this->input->post('cpfparticipante');
		$opcao = $this->input->post('opcao');
				
		if($enquete->existingcpf($cpfparticipante)){
			$message = array(
				"class" => "danger",
				"message" => "Já foi registrado um voto para o CPF digitado! Agradecemos a sua participação.");

			$msg = array("message" => $message);
			
            $this->load->view('enquete', $msg);
			
			return false;
		} else {
			
			$enquetedata['enqueteid'] = null;
			$enquetedata['enquetenome'] = $nomeparticipante;
			$enquetedata['enquetecpf'] = $cpfparticipante;
			$enquetedata['enqueteopcao'] = $opcao;
			$enquetedata['enquetestatus'] = 1;
			
			if($enquete->save($enquetedata)){
				$message = array(
					"class" => "success",
					"message" => "Voto computado com sucesso! Agradecemos a sua participação.");

				$msg = array("message" => $message);
				
				$this->load->view('enquete', $msg);
				
				return true;
			}
		}
	}
}