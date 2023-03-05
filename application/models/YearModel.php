<?php
class YearModel extends CI_Model{
    
    protected $yearid;
    protected $yeardesc;
    protected $yearclassic;
    protected $yearcontest;
    protected $yearplayoff;
    protected $yearsquad;
    
    function __construct() {
        parent::__construct();
        $this->setYearid(null);
        $this->setYeardesc(null);
        $this->setYearclassic(null);
        $this->setYearcontest(null);
        $this->setYearplayoff(null);
        $this->setYearsquad(null);
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("yearid", $data['yearid']);
            if ($this->db->update('year', $data)) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("yearid", "asc");
        return $this->db->get("year")->result();
    }
    
    function getYearid() {
        return $this->yearid;
    }

    function getYeardesc() {
        return $this->yeardesc;
    }

    function getYearclassic() {
        return $this->yearclassic;
    }

    function getYearcontest() {
        return $this->yearcontest;
    }

    function getYearplayoff() {
        return $this->yearplayoff;
    }

    function getYearsquad() {
        return $this->yearsquad;
    }

    function setYearid($yearid) {
        $this->yearid = $yearid;
    }

    function setYeardesc($yeardesc) {
        $this->yeardesc = $yeardesc;
    }

    function setYearclassic($yearclassic) {
        $this->yearclassic = $yearclassic;
    }

    function setYearcontest($yearcontest) {
        $this->yearcontest = $yearcontest;
    }

    function setYearplayoff($yearplayoff) {
        $this->yearplayoff = $yearplayoff;
    }

    function setYearsquad($yearsquad) {
        $this->yearsquad = $yearsquad;
    }


}