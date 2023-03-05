<?php
class TimesModel extends CI_Model{
    
    protected $time_id;
    protected $time_nome;
    protected $time_cartoleiro;
    protected $time_slug;
    protected $time_escudo;
    protected $time_pontos;
    protected $time_status;
    
    function __construct() {
        parent::__construct();
        $this->setTime_id(null);
        $this->setTime_nome(null);
        $this->setTime_cartoleiro(null);
        $this->setTime_slug(null);
        $this->setTime_escudo(null);
        $this->setTime_pontos(null);
        $this->setTime_status(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('times', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("time_id", $data['time_id']);
            if ($this->db->update('times', $data)) {
                return true;
            }
        }
    }
    public function delete($time_id) {
        if ($time_id != null) {
            $this->db->where("time_id", $time_id);
            if ($this->db->delete("times")) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("time_nome", "asc");
        return $this->db->get("times")->result();
    }
    
    public function search($time_id) {
        $this->db->where("time_id", $time_id);
        return $this->db->get("times")->row_array();
    }
    
    function getTime_id() {
        return $this->time_id;
    }

    function getTime_nome() {
        return $this->time_nome;
    }

    function getTime_cartoleiro() {
        return $this->time_cartoleiro;
    }

    function getTime_slug() {
        return $this->time_slug;
    }

    function getTime_escudo() {
        return $this->time_escudo;
    }

    function getTime_pontos() {
        return $this->time_pontos;
    }

    function getTime_status() {
        return $this->time_status;
    }

    function setTime_id($time_id) {
        $this->time_id = $time_id;
    }

    function setTime_nome($time_nome) {
        $this->time_nome = $time_nome;
    }

    function setTime_cartoleiro($time_cartoleiro) {
        $this->time_cartoleiro = $time_cartoleiro;
    }

    function setTime_slug($time_slug) {
        $this->time_slug = $time_slug;
    }

    function setTime_escudo($time_escudo) {
        $this->time_escudo = $time_escudo;
    }

    function setTime_pontos($time_pontos) {
        $this->time_pontos = $time_pontos;
    }

    function setTime_status($time_status) {
        $this->time_status = $time_status;
    }


}