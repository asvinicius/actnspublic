<?php
class AtletasModel extends CI_Model{
    protected $atletasid;
    protected $atletasnome;
    protected $atletasapelido;
    protected $atletasclube;
    protected $atletasposicao;
    protected $atletaspontos;
	
	function __construct() {
        parent::__construct();
        $this->setAtletasid(null);
        $this->setAtletasnome(null);
        $this->setAtletasapelido(null);
        $this->setAtletasclube(null);
        $this->setAtletasposicao(null);
        $this->setAtletaspontos(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('atletas', $data)) {
                return true;
            }
        }
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("atletasid", $data['atletasid']);
            if ($this->db->update('atletas', $data)) {
                return true;
            }
        }
    }
	
    public function delete($atletasid) {
        if ($atletasid != null) {
            $this->db->where("atletasid", $atletasid);
            if ($this->db->delete("atletas")) {
                return true;
            }
        }
    }
	
    public function truncate() {
        if ($this->db->truncate("atletas")) {
            return true;
        }
    }
    
    public function listing() {
        $this->db->select('*');
        return $this->db->get("atletas")->result();
    }
	
	public function search($atletasid) {
        $this->db->where("atletasid", $atletasid);
        return $this->db->get("atletas")->row_array();
    }
    
    function getAtletasid() {
        return $this->atletasid;
    }
	
    function getAtletasnome() {
        return $this->atletasnome;
    }
	
    function getAtletasapelido() {
        return $this->atletasapelido;
    }
	
    function getAtletasclube() {
        return $this->atletasclube;
    }
	
    function getAtletasposicao() {
        return $this->atletasposicao;
    }

	function getAtletaspontos() {
        return $this->atletaspontos;
    }

    function setAtletasid($atletasid) {
        $this->atletasid = $atletasid;
    }

    function setAtletasnome($atletasnome) {
        $this->atletasnome = $atletasnome;
    }

    function setAtletasapelido($atletasapelido) {
        $this->atletasapelido = $atletasapelido;
    }

    function setAtletasclube($atletasclube) {
        $this->atletasclube = $atletasclube;
    }

    function setAtletasposicao($atletasposicao) {
        $this->atletasposicao = $atletasposicao;
    }

    function setAtletaspontos($atletaspontos) {
        $this->atletaspontos = $atletaspontos;
    }
}