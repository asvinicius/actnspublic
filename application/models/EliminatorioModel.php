<?php
class EliminatorioModel extends CI_Model{
    
    protected $et_id;
    protected $et_name;
    protected $et_coach;
    protected $et_slug;
    protected $et_shield;
    protected $et_cap;
    protected $et_rank;
    protected $et_point;
    protected $et_status;
    
    function __construct() {
        parent::__construct();
        $this->setEt_id(null);
        $this->setEt_name(null);
        $this->setEt_coach(null);
        $this->setEt_slug(null);
        $this->setEt_shield(null);
        $this->setEt_cap(null);
        $this->setEt_rank(null);
        $this->setEt_point(null);
        $this->setEt_status(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('eliminatorio', $data)) {
                return true;
            }
        }
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("et_id", $data['et_id']);
            if ($this->db->update('eliminatorio', $data)) {
                return true;
            }
        }
    }
	
	public function search($et_id) {
        $this->db->where("et_id", $et_id);
        return $this->db->get("eliminatorio")->row_array();
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("et_point", "desc");
        return $this->db->get("eliminatorio")->result();
    }
    
    public function listpage() {
        $this->db->select('*');
        $this->db->join('atletas', 'atletas.atletasid=et_cap', 'inner');
        $this->db->order_by("et_point", "desc");
        return $this->db->get("eliminatorio")->result();
    }

    function getEt_id() {
        return $this->et_id;
    }

    function getEt_name() {
        return $this->et_name;
    }

    function getEt_coach() {
        return $this->et_coach;
    }

    function getEt_slug() {
        return $this->et_slug;
    }

    function getEt_shield() {
        return $this->et_shield;
    }

    function getEt_cap() {
        return $this->et_cap;
    }

    function getEt_rank() {
        return $this->et_rank;
    }

    function getEt_point() {
        return $this->et_point;
    }

    function getEt_status() {
        return $this->et_status;
    }

    function setEt_id($et_id) {
        $this->et_id = $et_id;
    }

    function setEt_name($et_name) {
        $this->et_name = $et_name;
    }

    function setEt_coach($et_coach) {
        $this->et_coach = $et_coach;
    }

    function setEt_slug($et_slug) {
        $this->et_slug = $et_slug;
    }

    function setEt_shield($et_shield) {
        $this->et_shield = $et_shield;
    }

    function setEt_cap($et_cap) {
        $this->et_cap = $et_cap;
    }

    function setEt_rank($et_rank) {
        $this->et_rank = $et_rank;
    }

    function setEt_point($et_point) {
        $this->et_point = $et_point;
    }

    function setEt_status($et_status) {
        $this->et_status = $et_status;
    }


}