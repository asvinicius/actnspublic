<?php
class NewstagModel extends CI_Model{
    protected $newstagid;
    protected $newstagnews;
    protected $newstagtag;
	
	function __construct() {
        parent::__construct();
        $this->setNewstagid(null);
        $this->setNewstagnews(null);
        $this->setNewstagtag(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('newstag', $data)) {
                return true;
            }
        }
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("newstagid", $data['newstagid']);
            if ($this->db->update('newstag', $data)) {
                return true;
            }
        }
    }
	
    public function delete($newstagid) {
        if ($newstagid != null) {
            $this->db->where("newstagid", $newstagid);
            if ($this->db->delete("newstag")) {
                return true;
            }
        }
    }
	
    public function search($newstagid) {
        if ($newstagid != null) {
            $this->db->where("newstagid", $newstagid);
			return $this->db->get("newstag")->row_array();
        }
    }
    
    public function listing($newsid) {
        $this->db->join('news', 'news.newsid=newstagnews', 'inner');
        $this->db->join('tag', 'tag.tagid=newstagtag', 'inner');
        $this->db->where("newstagnews", $newsid);
        return $this->db->get("newstag")->result();
    }
	
	public function listtag($tagid) {
        $this->db->join('news', 'news.newsid=newstagnews', 'inner');
        $this->db->join('tag', 'tag.tagid=newstagtag', 'inner');
        $this->db->where("newstagtag", $tagid);
        $this->db->where("news.newsstatus", 1);		
        $this->db->order_by("news.newsdate", "desc");
        return $this->db->get("newstag")->result();
    }

    function getNewstagid() {
        return $this->newstagid;
    }

    function getNewstagnews() {
        return $this->newstagnews;
    }

    function getNewstagtag() {
        return $this->newstagtag;
    }

    function setNewstagid($newstagid) {
        $this->newstagid = $newstagid;
    }

    function setNewstagnews($newstagnews) {
        $this->newstagnews = $newstagnews;
    }

    function setNewstagtag($newstagtag) {
        $this->newstagtag = $newstagtag;
    }


}