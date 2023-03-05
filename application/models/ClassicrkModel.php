<?php
class ClassicrkModel extends CI_Model{
    
    protected $clrkid;
    protected $year;
    protected $description;
    protected $clrkteamid;
    protected $clrkcoach;
    protected $clrkteam;
    protected $clrkaward;
            
    function __construct() {
        parent::__construct();
        $this->setClrkid(null);
        $this->setYear(null);
        $this->setDescription(null);
        $this->setClrkteamid(null);
        $this->setClrkcoach(null);
        $this->setClrkteam(null);
        $this->setClrkaward(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('classicrk', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("clrkid", $data['clrkid']);
            if ($this->db->update('classicrk', $data)) {
                return true;
            }
        }
    }
    
    public function listing($year, $description) {
        $this->db->where("year", $year);
        $this->db->where("description", $description);
        $this->db->order_by("clrkaward", "desc");
        $this->db->order_by("clrkteam", "asc");
        return $this->db->get("classicrk")->result();
    }
    
    public function getlist($year, $description, $teamid) {
        $this->db->where("year", $year);
        $this->db->where("description", $description);
        $this->db->where("clrkteamid", $teamid);
        return $this->db->get("classicrk")->row_array();
    }
    
    public function listall($year) {
        $this->db->where("year", $year);
        return $this->db->get("classicrk")->result();
    }
    
    public function sleep() {
        sleep(1);
        $this->db->reconnect();
    }
    
    function getClrkid() {
        return $this->clrkid;
    }

    function getYear() {
        return $this->year;
    }

    function getDescription() {
        return $this->description;
    }

    function getClrkteamid() {
        return $this->clrkteamid;
    }

    function getClrkcoach() {
        return $this->clrkcoach;
    }

    function getClrkteam() {
        return $this->clrkteam;
    }

    function getClrkaward() {
        return $this->clrkaward;
    }

    function setClrkid($clrkid) {
        $this->clrkid = $clrkid;
    }

    function setYear($year) {
        $this->year = $year;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setClrkteamid($clrkteamid) {
        $this->clrkteamid = $clrkteamid;
    }

    function setClrkcoach($clrkcoach) {
        $this->clrkcoach = $clrkcoach;
    }

    function setClrkteam($clrkteam) {
        $this->clrkteam = $clrkteam;
    }

    function setClrkaward($clrkaward) {
        $this->clrkaward = $clrkaward;
    }


}