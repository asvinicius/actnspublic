<?php
class CompletedspinModel extends CI_Model{
    
    protected $sc_id;
    protected $sc_year;
    protected $sc_spin;
    protected $sc_teams;
    protected $sc_status;
    
    function __construct() {
        parent::__construct();
        $this->setSc_id(null);
        $this->setSc_year(null);
        $this->setSc_spin(null);
        $this->setSc_teams(null);
        $this->setSc_status(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('completedspin', $data)) {
                return true;
            }
        }
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("sc_id", $data['sc_id']);
            if ($this->db->update('completedspin', $data)) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("sc_spin", "asc");
        return $this->db->get("completedspin")->result();
    }
    
    public function completed($sc_year) {
        $this->db->where("sc_year", $sc_year);
        $this->db->where("sc_status", 0);
        $this->db->order_by("sc_spin", "asc");
        return $this->db->get("completedspin")->result();
    }
    
    public function search($sc_id) {
        $this->db->where("sc_id", $sc_id);
        return $this->db->get("completedspin")->row_array();
    }
    
    function getSc_id() {
        return $this->sc_id;
    }

    function getSc_year() {
        return $this->sc_year;
    }

    function getSc_spin() {
        return $this->sc_spin;
    }

    function getSc_teams() {
        return $this->sc_teams;
    }

    function getSc_status() {
        return $this->sc_status;
    }

    function setSc_id($sc_id) {
        $this->sc_id = $sc_id;
    }

    function setSc_year($sc_year) {
        $this->sc_year = $sc_year;
    }

    function setSc_spin($sc_spin) {
        $this->sc_spin = $sc_spin;
    }

    function setSc_teams($sc_teams) {
        $this->sc_teams = $sc_teams;
    }

    function setSc_status($sc_status) {
        $this->sc_status = $sc_status;
    }


}