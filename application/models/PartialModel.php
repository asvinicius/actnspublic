<?php
class PartialModel extends CI_Model{
    protected $partialid;
    protected $partialteam;
    protected $partialcap;
    protected $partialpoints;
	
	function __construct() {
        parent::__construct();
        $this->setPartialid(null);
        $this->setPartialteam(null);
        $this->setPartialcap(null);
        $this->setPartialpoints(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('partial', $data)) {
                return true;
            }
        }
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("partialid", $data['partialid']);
            if ($this->db->update('partial', $data)) {
                return true;
            }
        }
    }
	
    public function delete($partialid) {
        if ($partialid != null) {
            $this->db->where("partialid", $partialid);
            if ($this->db->delete("partial")) {
                return true;
            }
        }
    }
	
    public function truncate() {
        if ($this->db->truncate("partial")) {
            return true;
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->join('team', 'team.teamid=partialteam', 'inner');
        $this->db->join('atletas', 'atletas.atletasid=partialcap', 'inner');
        $this->db->order_by("partialpoints", "desc");
        return $this->db->get("partial")->result();
        //return $this->db->get("partial", 20, 0)->result();
    }
    
    public function listupdate() {
        $this->db->select('*');
        $this->db->join('team', 'team.teamid=partialteam', 'inner');
        $this->db->order_by("partialpoints", "desc");
        return $this->db->get("partial", 20, 0)->result();
    }
    
    public function fisrts() {
        $this->db->select('*');
        $this->db->join('team', 'team.teamid=partialteam', 'inner');
        $this->db->order_by("partialpoints", "desc");
        return $this->db->get("partial", 50, 0)->result();
    }
    
    public function updatelist() {
        $this->db->select('*');
        return $this->db->get("partial")->result();
    }
    
    public function listhistory() {
        $this->db->select('*');
        $this->db->join('team', 'team.teamid=partialteam', 'inner');
        $this->db->order_by("partialpoints", "desc");
        return $this->db->get("partial", 10, 0)->result();
    }
	
    public function mypaged($paged) {
        $this->db->select('*');
        $this->db->join('team', 'team.teamid=partialteam', 'inner');
        $this->db->order_by("partialpoints", "desc");
        return $this->db->get("partial", 20, ($paged*20))->result();
    }
    
    public function getcount() {
        $this->db->select('*');
        return $this->db->get("partial")->result();
    }
	
	public function search($partialteam) {
        $this->db->where("partialteam", $partialteam);
        return $this->db->get("partial")->row_array();
    }
    
    function getPartialid() {
        return $this->partialid;
    }

    function getPartialteam() {
        return $this->partialteam;
    }

    function getPartialcap() {
        return $this->partialcap;
    }

    function getPartialpoints() {
        return $this->partialpoints;
    }

    function setPartialid($partialid) {
        $this->partialid = $partialid;
    }

    function setPartialteam($partialteam) {
        $this->partialteam = $partialteam;
    }

    function setPartialcap($partialcap) {
        $this->partialcap = $partialcap;
    }

    function setPartialpoints($partialpoints) {
        $this->partialpoints = $partialpoints;
    }
}