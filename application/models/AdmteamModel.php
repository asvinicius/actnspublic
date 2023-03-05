<?php
class AdmteamModel extends CI_Model{
    protected $at_id;
    protected $at_name;
    protected $at_coach;
    protected $at_shield;
    protected $at_pontosraiz;
    protected $at_pontoscap;
	
	function __construct() {
        parent::__construct();
        $this->setAt_id(null);
		$this->setAt_name(null);
		$this->setAt_coach(null);
		$this->setAt_shield(null);
		$this->setAt_pontosraiz(null);
		$this->setAt_pontoscap(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('admteam', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("at_id", $data['at_id']);
            if ($this->db->update('admteam', $data)) {
                return true;
            }
        }
    }
	
    public function search($at_id) {
        if ($at_id != null) {
            $this->db->where("at_id", $at_id);
			return $this->db->get("admteam")->row_array();
        }
    }
    
    public function raiz() {
        $this->db->select('*');
        $this->db->order_by("at_pontosraiz", "asc");
        return $this->db->get("admteam")->result();
    }
    
    public function nutella() {
        $this->db->select('*');
        $this->db->order_by("at_pontoscap", "asc");
        return $this->db->get("admteam")->result();
    }
    
    function getAt_id() {
        return $this->at_id;
    }
    
    function getAt_name() {
        return $this->at_name;
    }
    
    function getAt_coach() {
        return $this->at_coach;
    }
    
    function getAt_shield() {
        return $this->at_shield;
    }
    
    function getAt_pontosraiz() {
        return $this->at_pontosraiz;
    }
    
    function getAt_pontoscap() {
        return $this->at_pontoscap;
    }

    function setAt_id($at_id) {
        $this->at_id = $at_id;
    }

    function setAt_name($at_name) {
        $this->at_name = $at_name;
    }

    function setAt_coach($at_coach) {
        $this->at_coach = $at_coach;
    }

    function setAt_shield($at_shield) {
        $this->at_shield = $at_shield;
    }

    function setAt_pontosraiz($at_pontosraiz) {
        $this->at_pontosraiz = $at_pontosraiz;
    }

    function setAt_pontoscap($at_pontoscap) {
        $this->at_pontoscap = $at_pontoscap;
    }


}