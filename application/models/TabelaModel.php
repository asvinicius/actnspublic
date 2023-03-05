<?php
class TabelaModel extends CI_Model{
    
    protected $tabela_id;
    protected $tabela_rodada;
    protected $tabela_equipea;
    protected $tabela_equipea_pontos;
    protected $tabela_equipeb;
    protected $tabela_equipeb_pontos;
    protected $tabela_status;
    
    function __construct() {
        parent::__construct();
        $this->setTabela_id(null);
        $this->setTabela_rodada(null);
        $this->setTabela_equipea(null);
        $this->setTabela_equipea_pontos(null);
        $this->setTabela_equipeb(null);
        $this->setTabela_equipeb_pontos(null);
        $this->setTabela_status(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('tabela', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("tabela_id", $data['tabela_id']);
            if ($this->db->update('tabela', $data)) {
                return true;
            }
        }
    }
    public function delete($tabela_id) {
        if ($tabela_id != null) {
            $this->db->where("tabela_id", $tabela_id);
            if ($this->db->delete("tabela")) {
                return true;
            }
        }
    }
    
    public function listing($round) {
        $this->db->where("tabela_rodada", $round);
        $this->db->select('tabela_rodada AS rodada, tabela_id AS id, tabela_status AS status, tabela_equipea AS aid, tabela_equipea_pontos AS apontos, tabela_equipeb AS bid, tabela_equipeb_pontos AS bpontos, t1.equipe_nome AS tnamea,t1.equipe_escudo AS tescudoa, t2.equipe_nome AS tnameb, t2.equipe_escudo AS tescudob');
        $this->db->join('equipes as t1', 't1.equipe_id=tabela_equipea', 'inner');
        $this->db->join('equipes as t2', 't2.equipe_id=tabela_equipeb', 'inner');
        
        $this->db->order_by("id", "asc");
        return $this->db->get("tabela")->result();
    }
    
    public function search($tabela_id) {
        $this->db->where("tabela_id", $tabela_id);
        return $this->db->get("tabela")->row_array();
    }
    
    function getTabela_id() {
        return $this->tabela_id;
    }

    function getTabela_rodada() {
        return $this->tabela_rodada;
    }

    function getTabela_equipea() {
        return $this->tabela_equipea;
    }

    function getTabela_equipea_pontos() {
        return $this->tabela_equipea_pontos;
    }

    function getTabela_equipeb() {
        return $this->tabela_equipeb;
    }

    function getTabela_equipeb_pontos() {
        return $this->tabela_equipeb_pontos;
    }

    function getTabela_status() {
        return $this->tabela_status;
    }

    function setTabela_id($tabela_id) {
        $this->tabela_id = $tabela_id;
    }

    function setTabela_rodada($tabela_rodada) {
        $this->tabela_rodada = $tabela_rodada;
    }

    function setTabela_equipea($tabela_equipea) {
        $this->tabela_equipea = $tabela_equipea;
    }

    function setTabela_equipea_pontos($tabela_equipea_pontos) {
        $this->tabela_equipea_pontos = $tabela_equipea_pontos;
    }

    function setTabela_equipeb($tabela_equipeb) {
        $this->tabela_equipeb = $tabela_equipeb;
    }

    function setTabela_equipeb_pontos($tabela_equipeb_pontos) {
        $this->tabela_equipeb_pontos = $tabela_equipeb_pontos;
    }

    function setTabela_status($tabela_status) {
        $this->tabela_status = $tabela_status;
    }


}