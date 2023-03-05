<?php
class EnqueteModel extends CI_Model{
    
    protected $enqueteid;
    protected $enquetenome;
    protected $enquetecpf;
    protected $enqueteopcao;
    protected $enquetestatus;
            
    function __construct() {
        parent::__construct();
        $this->setEnqueteid(null);
        $this->setEnquetenome(null);
        $this->setEnquetecpf(null);
        $this->setEnqueteopcao(null);
        $this->setEnquetestatus(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('enquete', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("enqueteid", $data['enqueteid']);
            if ($this->db->update('enquete', $data)) {
                return true;
            }
        }
    }
    public function delete($enqueteid) {
        if ($enqueteid != null) {
            $this->db->where("enqueteid", $enqueteid);
            if ($this->db->delete("enquete")) {
                return true;
            }
        }
    }
    
    public function listzero() {
        $this->db->where("enqueteopcao", 0);
        return $this->db->get("enquete")->result();
    }
	
    public function listone() {
        $this->db->where("enqueteopcao", 1);
        return $this->db->get("enquete")->result();
    }
	
    public function listing() {
        $this->db->where("enquetestatus", 1);
        return $this->db->get("enquete")->result();
    }
    
    public function existingcpf($cpfparticipante) {
        $this->db->where("enquetecpf", $cpfparticipante);
        return $this->db->get("enquete")->row_array();
    }
    
    function getEnqueteid() {
        return $this->enqueteid;
    }
    function getEnquetenome() {
        return $this->enquetenome;
    }
    function getEnquetecpf() {
        return $this->enquetecpf;
    }
    function getEnqueteopcao() {
        return $this->enqueteopcao;
    }
    function getEnquetestatus() {
        return $this->enquetestatus;
    }

    function setEnqueteid($enqueteid) {
        $this->enqueteid = $enqueteid;
    }
    function setEnquetenome($enquetenome) {
        $this->enquetenome = $enquetenome;
    }
    function setEnquetecpf($enquetecpf) {
        $this->enquetecpf = $enquetecpf;
    }
    function setEnqueteopcao($enqueteopcao) {
        $this->enqueteopcao = $enqueteopcao;
    }
    function setEnquetestatus($enquetestatus) {
        $this->enquetestatus = $enquetestatus;
    }
}