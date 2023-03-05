<?php
class StatusModel extends CI_Model{
    protected $statusid;
    protected $currentround;
    protected $currentmonth;
    protected $currentshift;
    protected $marketstatus;
            
    function __construct() {
        parent::__construct();
        $this->setStatusid(null);
        $this->setCurrentround(null);
        $this->setCurrentmonth(null);
        $this->setCurrentshift(null);
        $this->setMarketstatus(null);
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("statusid", $data['statusid']);
            if ($this->db->update('status', $data)) {
                return true;
            }
        }
    }
    
    public function search() {
        $this->db->where("statusid", 1);
        return $this->db->get("status")->row_array();
    }
    
    function getStatusid() {
        return $this->statusid;
    }

    function getCurrentround() {
        return $this->currentround;
    }

    function getCurrentmonth() {
        return $this->currentmonth;
    }

    function getCurrentshift() {
        return $this->currentshift;
    }

    function getMarketstatus() {
        return $this->marketstatus;
    }

    function setStatusid($statusid) {
        $this->statusid = $statusid;
    }

    function setCurrentround($currentround) {
        $this->currentround = $currentround;
    }

    function setCurrentmonth($currentmonth) {
        $this->currentmonth = $currentmonth;
    }

    function setCurrentshift($currentshift) {
        $this->currentshift = $currentshift;
    }

    function setMarketstatus($marketstatus) {
        $this->marketstatus = $marketstatus;
    }


}