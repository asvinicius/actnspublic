<?php
class CategoryModel extends CI_Model{
    protected $categoryid;
    protected $categoryname;
    protected $categoryslug;
    protected $categorystatus;
	
	function __construct() {
        parent::__construct();
        $this->setCategoryid(null);
        $this->setCategoryname(null);
        $this->setCategoryslug(null);
        $this->setCategorystatus(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('category', $data)) {
                return true;
            }
        }
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("categoryid", $data['categoryid']);
            if ($this->db->update('category', $data)) {
                return true;
            }
        }
    }
	
    public function delete($categoryid) {
        if ($categoryid != null) {
            $this->db->where("categoryid", $categoryid);
            if ($this->db->delete("category")) {
                return true;
            }
        }
    }
	
    public function search($categoryid) {
        if ($categoryid != null) {
            $this->db->where("categoryid", $categoryid);
			return $this->db->get("category")->row_array();
        }
    }
	
    public function categorynews($categoryid) {
        if ($categoryid != null) {
            $this->db->where("categoryid", $categoryid);
			return $this->db->get("category")->result();
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("categoryid", "asc");
        return $this->db->get("category")->result();
    }
    
    function getCategoryid() {
        return $this->categoryid;
    }

    function getCategoryname() {
        return $this->categoryname;
    }

    function getCategoryslug() {
        return $this->categoryslug;
    }

    function getCategorystatus() {
        return $this->categorystatus;
    }

    function setCategoryid($categoryid) {
        $this->categoryid = $categoryid;
    }

    function setCategoryname($categoryname) {
        $this->categoryname = $categoryname;
    }

    function setCategoryslug($categoryslug) {
        $this->categoryslug = $categoryslug;
    }

    function setCategorystatus($categorystatus) {
        $this->categorystatus = $categorystatus;
    }


}