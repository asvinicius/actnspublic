<?php
class DescriptionModel extends CI_Model{
    
    protected $descid;
    protected $descdefine;
    
    function __construct() {
        parent::__construct();
        $this->setDescid(null);
        $this->setDescdefine(null);
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("descid", "asc");
        return $this->db->get("description")->result();
    }
    
    public function search($descid) {
        $this->db->where("descid", $descid);
        return $this->db->get("description")->row_array();
    }
    
    public function sleep() {
        sleep(1);
        $this->db->reconnect();
    }
    
    function getDescid() {
        return $this->descid;
    }

    function getDescdefine() {
        return $this->descdefine;
    }

    function setDescid($descid) {
        $this->descid = $descid;
    }

    function setDescdefine($descdefine) {
        $this->descdefine = $descdefine;
    }


}