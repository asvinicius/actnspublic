<?php
class TeamleagueModel extends CI_Model{
    
    protected $tlid;
    protected $tlname;
    protected $tlcoach;
    protected $tlslug;
    protected $tlshield;
    protected $tlstatus;
    
    function __construct() {
        parent::__construct();
        $this->setTlid(null);
        $this->setTlname(null);
        $this->setTlcoach(null);
        $this->setTlslug(null);
        $this->setTlshield(null);
        $this->setTlstatus(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('teamleague', $data)) {
                return true;
            }
        }
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("tlid", $data['tlid']);
            if ($this->db->update('teamleague', $data)) {
                return true;
            }
        }
    }
    
    public function delete($tlid) {
        if ($tlid != null) {
            $this->db->where("tlid", $tlid);
            if ($this->db->delete("teamleague")) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*');
        return $this->db->get("teamleague")->result();
    }
    
    public function search($tlid) {
        $this->db->where("tlid", $tlid);
        return $this->db->get("teamleague")->row_array();
    }
    
    public function specific($tlname) {
        $this->db->like("tlname", $tlname);
        $this->db->or_like("tlcoach", $tlname);
        return $this->db->get("teamleague")->result();
    }
    
    public function sleep() {
        sleep(1);
        $this->db->reconnect();
    }
    
    function getTlid() {
        return $this->tlid;
    }

    function getTlname() {
        return $this->tlname;
    }

    function getTlcoach() {
        return $this->tlcoach;
    }

    function getTlslug() {
        return $this->tlslug;
    }

    function getTlshield() {
        return $this->tlshield;
    }

    function getTlstatus() {
        return $this->tlstatus;
    }

    function setTlid($tlid) {
        $this->tlid = $tlid;
    }

    function setTlname($tlname) {
        $this->tlname = $tlname;
    }

    function setTlcoach($tlcoach) {
        $this->tlcoach = $tlcoach;
    }

    function setTlslug($tlslug) {
        $this->tlslug = $tlslug;
    }

    function setTlshield($tlshield) {
        $this->tlshield = $tlshield;
    }

    function setTlstatus($tlstatus) {
        $this->tlstatus = $tlstatus;
    }


}