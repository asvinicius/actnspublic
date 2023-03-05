<?php
class PEQatletasModel extends CI_Model{
    protected $partialeq_id;
    protected $partialeq_time;
    protected $partialeq_atleta;
    protected $partialeq_capitao;
	
	function __construct() {
        parent::__construct();
        $this->setPartialeq_id(null);
		$this->setPartialeq_time(null);
		$this->setPartialeq_atleta(null);
		$this->setPartialeq_capitao(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('peqatletas', $data)) {
                return true;
            }
        }
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("partialeq_id", $data['partialeq_id']);
            if ($this->db->update('peqatletas', $data)) {
                return true;
            }
        }
    }
	
    public function delete($partialeq_id) {
        if ($partialeq_id != null) {
            $this->db->where("partialeq_id", $partialeq_id);
            if ($this->db->delete("peqatletas")) {
                return true;
            }
        }
    }
	
    public function truncate() {
        if ($this->db->truncate("peqatletas")) {
            return true;
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->join('partialequipe', 'partialequipe.peq_time=partialeq_time', 'inner');
        $this->db->join('atletas', 'atletas.atletasid=partialeq_atleta', 'inner');
        return $this->db->get("peqatletas")->result();
    }
	
	public function search($partialeq_id) {
        $this->db->where("partialeq_id", $partialeq_id);
        return $this->db->get("peqatletas")->row_array();
    }
	
	public function isadd($partialeq_time, $partialeq_atleta) {
        $this->db->where("partialeq_time", $partialeq_time);
        $this->db->where("partialeq_atleta", $partialeq_atleta);
        return $this->db->get("peqatletas")->row_array();
    }
	
	public function forchange($partialeq_time, $partialeq_atleta) {
        $this->db->where("partialeq_time", $partialeq_time);
        $this->db->where("partialeq_atleta", $partialeq_atleta);
        return $this->db->get("peqatletas")->row_array();
    }
	
	public function getsquad($partialeq_time) {
        $this->db->where("partialeq_time", $partialeq_time);
        return $this->db->get("peqatletas")->result();
    }
	
	public function getsquadout($partialeq_time) {
        $this->db->where("partialeq_time", $partialeq_time);
        $this->db->join('times', 'times.time_id=partialeq_time', 'inner');
        $this->db->join('atletas', 'atletas.atletasid=partialeq_atleta', 'inner');
        $this->db->order_by("atletas.atletasposicao", "asc");
        return $this->db->get("peqatletas")->result();
    }
    
    function getPartialeq_id() {
        return $this->partialeq_id;
    }
    
    function getPartialeq_time() {
        return $this->partialeq_time;
    }
    
    function getPartialeq_atleta() {
        return $this->partialeq_atleta;
    }
    
    function getPartialeq_capitao() {
        return $this->partialeq_capitao;
    }

    function setPartialeq_id($partialeq_id) {
        $this->partialeq_id = $partialeq_id;
    }

    function setPartialeq_time($partialeq_time) {
        $this->partialeq_time = $partialeq_time;
    }

    function setPartialeq_atleta($partialeq_atleta) {
        $this->pa_rtialeqatleta = $partialeq_atleta;
    }

    function setPartialeq_capitao($partialeq_capitao) {
        $this->partialeq_capitao = $partialeq_capitao;
    }
}