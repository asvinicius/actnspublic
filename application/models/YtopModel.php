<?php
class YtopModel extends CI_Model{
    
    protected $topid;
    protected $topyear;
    protected $topround;
    protected $topdesc;
    protected $toptype;
    protected $topcoach;
    protected $topteam;
    protected $topaward;
            
    function __construct() {
        parent::__construct();
        $this->setTopid(null);
        $this->setTopyear(null);
        $this->setTopround(null);
        $this->setToptype(null);
        $this->setTopcoach(null);
        $this->setTopteam(null);
        $this->setTopaward(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('ytop', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("topid", $data['topid']);
            if ($this->db->update('ytop', $data)) {
                return true;
            }
        }
    }
    
    public function listing($desc, $type) {
        $this->db->where("topdesc", $desc);
        $this->db->where("toptype", $type);
        $this->db->order_by("topaward", "desc");
        $this->db->order_by("topteam", "asc");
        return $this->db->get("ytop")->result();
    }
    
    public function listingcontest() {
        $this->db->where("toptype", 2);
        $this->db->where("topdesc", 2);
        $this->db->order_by("topaward", "desc");
        $this->db->order_by("topteam", "asc");
        return $this->db->get("ytop")->result();
    }
    
    public function listingcontestyear($year) {
        $this->db->where("toptype", 2);
        $this->db->where("topdesc", 1);
        $this->db->where("topyear", $year);
        $this->db->order_by("topaward", "desc");
        $this->db->order_by("topteam", "asc");
        return $this->db->get("ytop")->result();
    }
    
    public function listingclassic() {
        $this->db->where("toptype", 1);
        $this->db->where("topdesc", 2);
        $this->db->order_by("topaward", "desc");
        $this->db->order_by("topteam", "asc");
        return $this->db->get("ytop")->result();
    }
    
    public function listingclassicyear($year) {
        $this->db->where("toptype", 1);
        $this->db->where("topdesc", 1);
        $this->db->where("topyear", $year);
        $this->db->order_by("topaward", "desc");
        $this->db->order_by("topteam", "asc");
        return $this->db->get("ytop")->result();
    }
    
    public function reverse($year, $desc, $type) {
        $this->db->where("topyear", $year);
        $this->db->where("topdesc", $desc);
        $this->db->where("toptype", $type);
        $this->db->order_by("topaward", "asc");
        $this->db->order_by("topteam", "asc");
        return $this->db->get("ytop")->result();
    }
    
    public function hreverse($desc, $type) {
        $this->db->where("topdesc", $desc);
        $this->db->where("toptype", $type);
        $this->db->order_by("topaward", "asc");
        $this->db->order_by("topteam", "asc");
        return $this->db->get("ytop")->result();
    }
    
    function getTopid() {
        return $this->topid;
    }

    function getTopyear() {
        return $this->topyear;
    }

    function getTopround() {
        return $this->topround;
    }

    function getTopdesc() {
        return $this->topdesc;
    }

    function getToptype() {
        return $this->toptype;
    }

    function getTopcoach() {
        return $this->topcoach;
    }

    function getTopteam() {
        return $this->topteam;
    }

    function getTopaward() {
        return $this->topaward;
    }

    function setTopid($topid) {
        $this->topid = $topid;
    }

    function setTopyear($topyear) {
        $this->topyear = $topyear;
    }

    function setTopround($topround) {
        $this->topround = $topround;
    }

    function setTopdesc($topdesc) {
        $this->topdesc = $topdesc;
    }

    function setToptype($toptype) {
        $this->toptype = $toptype;
    }

    function setTopcoach($topcoach) {
        $this->topcoach = $topcoach;
    }

    function setTopteam($topteam) {
        $this->topteam = $topteam;
    }

    function setTopaward($topaward) {
        $this->topaward = $topaward;
    }

    
}
