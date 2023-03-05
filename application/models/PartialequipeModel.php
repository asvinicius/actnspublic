<?php
class PartialequipeModel extends CI_Model{
    protected $peq_id;
    protected $peq_time;
    protected $peq_points;
	
	function __construct() {
        parent::__construct();
        $this->setPeq_id(null);
        $this->setPeq_time(null);
        $this->setPeq_points(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('partialequipe', $data)) {
                return true;
            }
        }
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("peq_id", $data['peq_id']);
            if ($this->db->update('partialequipe', $data)) {
                return true;
            }
        }
    }
	
    public function delete($peq_id) {
        if ($peq_id != null) {
            $this->db->where("peq_id", $peq_id);
            if ($this->db->delete("partialequipe")) {
                return true;
            }
        }
    }
	
    public function truncate() {
        if ($this->db->truncate("partialequipe")) {
            return true;
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->join('times', 'times.time_id=peq_time', 'inner');
        $this->db->order_by("peq_points", "desc");
        return $this->db->get("partialequipe")->result();
    }
    
    public function updatelist() {
        $this->db->select('*');
        return $this->db->get("partialequipe")->result();
    }
	
	public function search($peq_time) {
        $this->db->where("peq_time", $peq_time);
        return $this->db->get("partialequipe")->row_array();
    }
    
    function getPeq_id() {
        return $this->peq_id;
    }

    function getPeq_time() {
        return $this->peq_time;
    }

    function getPeq_points() {
        return $this->peq_points;
    }

    function setPeq_id($peq_id) {
        $this->peq_id = $peq_id;
    }

    function setPeq_time($peq_time) {
        $this->peq_time = $peq_time;
    }

    function setPeq_points($peq_points) {
        $this->peq_points = $peq_points;
    }
}