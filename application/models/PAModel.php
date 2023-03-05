<?php
class PAModel extends CI_Model{
    protected $pa_id;
    protected $pa_team;
    protected $pa_atleta;
    protected $pa_capitao;
	
	function __construct() {
        parent::__construct();
        $this->setPa_id(null);
		$this->setPa_team(null);
		$this->setPa_atleta(null);
		$this->setPa_capitao(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('parciais_atletas', $data)) {
                return true;
            }
        }
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("pa_id", $data['pa_id']);
            if ($this->db->update('parciais_atletas', $data)) {
                return true;
            }
        }
    }
	
    public function delete($pa_id) {
        if ($pa_id != null) {
            $this->db->where("pa_id", $pa_id);
            if ($this->db->delete("parciais_atletas")) {
                return true;
            }
        }
    }
	
    public function truncate() {
        if ($this->db->truncate("parciais_atletas")) {
            return true;
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->join('parciais', 'parciais.partialteam=pa_team', 'inner');
        $this->db->join('atletas', 'atletas.atletasid=pa_atleta', 'inner');
        $this->db->order_by("partialpoints", "desc");
        return $this->db->get("parciais_atletas")->result();
    }
	
	public function search($pa_id) {
        $this->db->where("pa_id", $pa_id);
        return $this->db->get("parciais_atletas")->row_array();
    }
    
	public function getsquad($pa_team) {
        $this->db->where("pa_team", $pa_team);
        $this->db->order_by("pa_capitao", "desc");
        return $this->db->get("parciais_atletas")->result();
    }
	
	public function getsquadout($pa_team) {
        $this->db->where("pa_team", $pa_team);
        $this->db->join('team', 'team.teamid=pa_team', 'inner');
        $this->db->join('atletas', 'atletas.atletasid=pa_atleta', 'inner');
        $this->db->order_by("atletas.atletasposicao", "asc");
        return $this->db->get("parciais_atletas")->result();
    }
    
    public function forchange($pa_team, $pa_atleta) {
        $this->db->where("pa_team", $pa_team);
        $this->db->where("pa_atleta", $pa_atleta);
        return $this->db->get("parciais_atletas")->row_array();
    }
    
    function getPa_id() {
        return $this->pa_id;
    }
    
    function getPa_team() {
        return $this->pa_team;
    }
    
    function getPa_atleta() {
        return $this->pa_atleta;
    }
    
    function getPa_capitao() {
        return $this->pa_capitao;
    }

    function setPa_id($pa_id) {
        $this->pa_id = $pa_id;
    }

    function setPa_team($pa_team) {
        $this->pa_team = $pa_team;
    }

    function setPa_atleta($pa_atleta) {
        $this->pa_atleta = $pa_atleta;
    }

    function setPa_capitao($pa_capitao) {
        $this->pa_capitao = $pa_capitao;
    }
}