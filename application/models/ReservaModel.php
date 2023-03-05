<?php
class ReservaModel extends CI_Model{
    protected $pr_id;
    protected $pr_team;
    protected $pr_atleta;
	
	function __construct() {
        parent::__construct();
        $this->setPr_id(null);
		$this->setPr_team(null);
		$this->setPr_atleta(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('reservatletas', $data)) {
                return true;
            }
        }
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("pr_id", $data['pr_id']);
            if ($this->db->update('reservatletas', $data)) {
                return true;
            }
        }
    }
	
    public function delete($pr_id) {
        if ($pr_id != null) {
            $this->db->where("pr_id", $pr_id);
            if ($this->db->delete("reservatletas")) {
                return true;
            }
        }
    }
	
    public function truncate() {
        if ($this->db->truncate("reservatletas")) {
            return true;
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->join('partial', 'partial.partialteam=pr_team', 'inner');
        $this->db->join('atletas', 'atletas.atletasid=pr_atleta', 'inner');
        $this->db->order_by("partialpoints", "desc");
        return $this->db->get("reservatletas")->result();
    }
	
	public function search($pr_id) {
        $this->db->where("pr_id", $pr_id);
        return $this->db->get("reservatletas")->row_array();
    }
	
	public function getsquad($pr_team) {
        $this->db->where("pr_team", $pr_team);
        return $this->db->get("reservatletas")->result();
    }
	
	public function getsquadout($pr_team) {
        $this->db->where("pr_team", $pr_team);
        $this->db->join('team', 'team.teamid=pr_team', 'inner');
        $this->db->join('atletas', 'atletas.atletasid=pr_atleta', 'inner');
        $this->db->order_by("atletas.atletasposicao", "asc");
        return $this->db->get("reservatletas")->result();
    }
    
    function getPr_id() {
        return $this->pr_id;
    }
    
    function getPr_team() {
        return $this->pr_team;
    }
    
    function getPr_atleta() {
        return $this->pr_atleta;
    }

    function setPr_id($pr_id) {
        $this->pr_id = $pr_id;
    }

    function setPr_team($pr_team) {
        $this->pr_team = $pr_team;
    }

    function setPr_atleta($pr_atleta) {
        $this->pr_atleta = $pr_atleta;
    }
}