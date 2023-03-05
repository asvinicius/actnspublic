<?php
class TeamModel extends CI_Model{
    
    protected $teamid;
    protected $name;
    protected $coach;
    protected $slug;
    protected $shield;
    protected $status;
    
    function __construct() {
        parent::__construct();
        $this->setTeamid(null);
        $this->setName(null);
        $this->setCoach(null);
        $this->setSlug(null);
        $this->setShield(null);
        $this->setStatus(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('team', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("teamid", $data['teamid']);
            if ($this->db->update('team', $data)) {
                return true;
            }
        }
    }
    public function delete($teamid) {
        if ($teamid != null) {
            $this->db->where("teamid", $teamid);
            if ($this->db->delete("team")) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("name", "asc");
        return $this->db->get("team", 20)->result();
    }
    
    public function search($teamid) {
        $this->db->where("teamid", $teamid);
        return $this->db->get("team")->row_array();
    }
    
    public function specific($name) {
        $this->db->like("name", $name);
        $this->db->or_like("coach", $name);
        return $this->db->get("team")->result();
    }
    
    public function sleep() {
        sleep(1);
        $this->db->reconnect();
    }

    function getTeamid() {
        return $this->teamid;
    }

    function getName() {
        return $this->name;
    }

    function getCoach() {
        return $this->coach;
    }

    function getSlug() {
        return $this->slug;
    }

    function getShield() {
        return $this->shield;
    }

    function getStatus() {
        return $this->status;
    }

    function setTeamid($teamid) {
        $this->teamid = $teamid;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setCoach($coach) {
        $this->coach = $coach;
    }

    function setSlug($slug) {
        $this->slug = $slug;
    }

    function setShield($shield) {
        $this->shield = $shield;
    }

    function setStatus($status) {
        $this->status = $status;
    }


}