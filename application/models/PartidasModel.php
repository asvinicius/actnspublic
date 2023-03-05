<?php
class PartidasModel extends CI_Model{
    protected $partida_id;
    protected $clube_casa_id;
    protected $clube_visitante_id;
    protected $valida;
    protected $status_transmissao_tr;
	
	function __construct() {
        parent::__construct();
        $this->setPartida_id(null);
        $this->setClube_casa_id(null);
        $this->setClube_visitante_id(null);
        $this->setValida(null);
        $this->setStatus_transmissao_tr(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('partidas', $data)) {
                return true;
            }
        }
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("partida_id", $data['partida_id']);
            if ($this->db->update('partidas', $data)) {
                return true;
            }
        }
    }
	
    public function truncate() {
        if ($this->db->truncate("partidas")) {
            return true;
        }
    }
    
    public function listing() {
        $this->db->select('*');
        return $this->db->get("partidas")->result();
    }
	
	public function search($partida_id) {
        $this->db->where("partida_id", $partida_id);
        return $this->db->get("partidas")->row_array();
    }
	
	public function finished($time_id) {
        $this->db->where("clube_casa_id", $time_id);
        $this->db->or_where("clube_visitante_id", $time_id);
        return $this->db->get("partidas")->row_array();
    }
    
    function getPartida_id() {
        return $this->partida_id;
    }
	
    function getClube_casa_id() {
        return $this->clube_casa_id;
    }
	
    function getClube_visitante_id() {
        return $this->clube_visitante_id;
    }
	
    function getValida() {
        return $this->valida;
    }
	
    function getStatus_transmissao_tr() {
        return $this->status_transmissao_tr;
    }

    function setPartida_id($partida_id) {
        $this->partida_id = $partida_id;
    }

    function setClube_casa_id($clube_casa_id) {
        $this->clube_casa_id = $clube_casa_id;
    }

    function setClube_visitante_id($clube_visitante_id) {
        $this->clube_visitante_id = $clube_visitante_id;
    }

    function setValida($valida) {
        $this->valida = $valida;
    }

    function setStatus_transmissao_tr($status_transmissao_tr) {
        $this->status_transmissao_tr = $status_transmissao_tr;
    }
}