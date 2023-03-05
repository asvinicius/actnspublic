<?php
class CrontesteModel extends CI_Model{
    protected $ct_id;
    protected $ct_contador;
	
	function __construct() {
        parent::__construct();
        $this->setCt_id(null);
        $this->setCt_contador(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('cronteste', $data)) {
                return true;
            }
        }
    }
    
    function getCt_id() {
        return $this->ct_id;
    }

    function getCt_contador() {
        return $this->ct_contador;
    }

    function setCt_id($ct_id) {
        $this->ct_id = $ct_id;
    }

    function setCt_contador($ct_contador) {
        $this->ct_contador = $ct_contador;
    }


}