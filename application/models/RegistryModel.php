<?php
class RegistryModel extends CI_Model{
    
    protected $registryid;
    protected $registryteam;
    protected $registryspin;
    protected $registrysuper;
    protected $registrypaid;
            
    function __construct() {
        parent::__construct();
        $this->setRegistryid(null);
        $this->setRegistryteam(null);
        $this->setRegistryspin(null);
        $this->setRegistrysuper(null);
        $this->setRegistrypaid(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('registry', $data)) {
                return true;
            }
        }
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("registryid", $data['registryid']);
            if ($this->db->update('registry', $data)) {
                return true;
            }
        }
    }
    public function delete($registryid) {
        if ($registryid != null) {
            $this->db->where("registryid", $registryid);
            if ($this->db->delete("registry")) {
                return true;
            }
        }
    }
    
    public function getreg($registryteam, $registryspin) {
        $this->db->where("registryteam", $registryteam);
        $this->db->where("registryspin", $registryspin);
        $this->db->join('team', 'team.teamid=registryteam', 'inner');
        return $this->db->get("registry")->row_array();
    }
    
    public function listreg($registryteam) {
        $this->db->where("registryteam", $registryteam);
        return $this->db->get("registry")->result();
    }
    
    public function listing($registryspin) {
        $this->db->where("registryspin", $registryspin);
        $this->db->join('team', 'team.teamid=registryteam', 'inner');
        $this->db->join('super', 'super.superid=registrysuper', 'inner');
        $this->db->order_by("registryid", "asc");
        return $this->db->get("registry", 50, 0)->result();
    }
    
    public function listfree($registryspin) {
        $this->db->where("registryspin", $registryspin);
        $this->db->join('team', 'team.teamid=registryteam', 'inner');
        $this->db->order_by("registryid", "asc");
        return $this->db->get("registry", 50, 0)->result();
    }
    
    public function mypaged($registryspin, $paged) {
        $this->db->where("registryspin", $registryspin);
        $this->db->join('team', 'team.teamid=registryteam', 'inner');
        $this->db->join('super', 'super.superid=registrysuper', 'inner');
        $this->db->order_by("registryid", "asc");
        return $this->db->get("registry", 50, ($paged*50))->result();
    }
    
    public function listingadm($registryspin, $registrysuper) {
        $this->db->where("registryspin", $registryspin);
        $this->db->where("registrysuper", $registrysuper);
        $this->db->join('team', 'team.teamid=registryteam', 'inner');
        $this->db->join('super', 'super.superid=registrysuper', 'inner');
        $this->db->order_by("registryid", "asc");
        return $this->db->get("registry")->result();
    }
    
    public function codelist($registryspin) {
        $this->db->where("registryspin", $registryspin);
        $this->db->join('team', 'team.teamid=registryteam', 'inner');
        $this->db->join('super', 'super.superid=registrysuper', 'inner');
        $this->db->order_by("registryid", "asc");
        return $this->db->get("registry")->result();
    }
    
    public function codelistfree($registryspin) {
        $this->db->where("registryspin", $registryspin);
        $this->db->join('team', 'team.teamid=registryteam', 'inner');
        $this->db->order_by("registryid", "asc");
        return $this->db->get("registry")->result();
    }
    
    public function balance($registryspin){
        $this->db->where("registryspin", $registryspin);
        $this->db->join('team', 'team.teamid=registryteam', 'inner');
        $this->db->join('super', 'super.superid=registrysuper', 'inner');
        $this->db->order_by("registryid", "asc");
        return $this->db->get("registry")->result();
    }
    
    public function spin($label, $registryspin) {
        $this->db->where("registryspin", $registryspin);
        $this->db->like("team.teamname", $label);
        $this->db->where("registryspin", $registryspin);
        $this->db->or_like("team.teamcoach", $label);
        $this->db->where("registryspin", $registryspin);
        $this->db->join('team', 'team.teamid=registryteam', 'inner');
        $this->db->join('super', 'super.superid=registrysuper', 'inner');
        return $this->db->get("registry")->result();
    }
    
    public function spinfree($label, $registryspin) {
        $this->db->where("registryspin", $registryspin);
        $this->db->like("team.teamname", $label);
        $this->db->where("registryspin", $registryspin);
        $this->db->or_like("team.teamcoach", $label);
        $this->db->where("registryspin", $registryspin);
        $this->db->join('team', 'team.teamid=registryteam', 'inner');
        return $this->db->get("registry")->result();
    }
    
    function getRegistryid() {
        return $this->registryid;
    }

    function getRegistryteam() {
        return $this->registryteam;
    }

    function getRegistryspin() {
        return $this->registryspin;
    }

    function getRegistrysuper() {
        return $this->registrysuper;
    }

    function getRegistrypaid() {
        return $this->registrypaid;
    }

    function setRegistryid($registryid) {
        $this->registryid = $registryid;
    }

    function setRegistryteam($registryteam) {
        $this->registryteam = $registryteam;
    }

    function setRegistryspin($registryspin) {
        $this->registryspin = $registryspin;
    }

    function setRegistrysuper($registrysuper) {
        $this->registrysuper = $registrysuper;
    }

    function setRegistrypaid($registrypaid) {
        $this->registrypaid = $registrypaid;
    }

}