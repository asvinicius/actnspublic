<?php
class DoubleModel extends CI_Model{
    
    protected $equipe_id;
    protected $equipe_nome;
    protected $equipe_escudo;
    protected $equipe_pontos;
    protected $equipe_status;
    
    function __construct() {
        parent::__construct();
        $this->setEquipe_id(null);
        $this->setEquipe_nome(null);
        $this->setEquipe_escudo(null);
        $this->setEquipe_pontos(null);
        $this->setEquipe_status(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('double', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("equipe_id", $data['equipe_id']);
            if ($this->db->update('double', $data)) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*');
        return $this->db->get("double")->result();
    }
    
    function getEquipe_id() {
        return $this->equipe_id;
    }

    function getEquipe_nome() {
        return $this->equipe_nome;
    }

    function getEquipe_escudo() {
        return $this->equipe_escudo;
    }

    function getEquipe_pontos() {
        return $this->equipe_pontos;
    }

    function getEquipe_status() {
        return $this->equipe_status;
    }

    function setEquipe_id($equipe_id) {
        $this->equipe_id = $equipe_id;
    }

    function setEquipe_nome($equipe_nome) {
        $this->equipe_nome = $equipe_nome;
    }

    function setEquipe_escudo($equipe_escudo) {
        $this->equipe_escudo = $equipe_escudo;
    }

    function setEquipe_pontos($equipe_pontos) {
        $this->equipe_pontos = $equipe_pontos;
    }

    function setEquipe_status($equipe_status) {
        $this->equipe_status = $equipe_status;
    }


}