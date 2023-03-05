<?php
class DTModel extends CI_Model{
    
    protected $te_id;
    protected $te_time;
    protected $te_equipe;
            
    function __construct() {
        parent::__construct();
        $this->setTe_id(null);
        $this->setTe_time(null);
        $this->setTe_equipe(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('double_teams', $data)) {
                return true;
            }
        }
    }
    
    public function searchid($te_id) {
        $this->db->where("te_id", $te_id);
        return $this->db->get("double_teams")->row_array();
    }
    
    public function searchtime($time) {
        $this->db->where("te_time", $time);
        return $this->db->get("double_teams")->row_array();
    }
    
    public function searchequipe($equipe) {
        $this->db->where("te_equipe", $equipe);
        return $this->db->get("double_teams")->result();
    }
    
    public function listing() {
        $this->db->select('*');
        return $this->db->get("double_teams")->result();
    }
    
    public function detail($equipe) {
        $this->db->where("te_equipe", $equipe);
        $this->db->select('ti.time_id AS tid, ti.time_nome AS tinome, ti.time_cartoleiro AS ticartoleiro, ti.time_escudo AS tiescudo, ti.time_pontos AS tipontos');
        $this->db->join('times as ti', 'ti.time_id=te_time', 'inner');
        $this->db->order_by("ti.time_pontos", "desc");
        return $this->db->get("double_teams")->result();
    }
    
    function getTe_id() {
        return $this->te_id;
    }

    function getTe_time() {
        return $this->te_time;
    }

    function getTe_equipe() {
        return $this->te_equipe;
    }

    function setTe_id($te_id) {
        $this->te_id = $te_id;
    }

    function setTe_time($te_time) {
        $this->te_time = $te_time;
    }

    function setTe_equipe($te_equipe) {
        $this->te_equipe = $te_equipe;
    }


}