<?php
class TagModel extends CI_Model{
    protected $tagid;
    protected $tagname;
    protected $tagslug;
    protected $tagstatus;
	
	function __construct() {
        parent::__construct();
        $this->setTagid(null);
        $this->setTagname(null);
        $this->setTagslug(null);
        $this->setTagstatus(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('tag', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("tagid", $data['tagid']);
            if ($this->db->update('tag', $data)) {
                return true;
            }
        }
    }
    public function delete($tagid) {
        if ($tagid != null) {
            $this->db->where("tagid", $tagid);
            if ($this->db->delete("tag")) {
                return true;
            }
        }
    }
	
    public function search($tagid) {
        if ($tagid != null) {
            $this->db->where("tagid", $tagid);
			return $this->db->get("tag")->row_array();
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("tagname", "asc");
        return $this->db->get("tag")->result();
    }
    
    function getTagid() {
        return $this->tagid;
    }

    function getTagname() {
        return $this->tagname;
    }

    function getTagslug() {
        return $this->tagslug;
    }

    function getTagstatus() {
        return $this->tagstatus;
    }

    function setTagid($tagid) {
        $this->tagid = $tagid;
    }

    function setTagname($tagname) {
        $this->tagname = $tagname;
    }

    function setTagslug($tagslug) {
        $this->tagslug = $tagslug;
    }

    function setTagstatus($tagstatus) {
        $this->tagstatus = $tagstatus;
    }


}