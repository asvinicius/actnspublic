<?php
class RankingModel extends CI_Model{
    
    protected $ranking_id;
    protected $ranking_grupo;
    protected $ranking_equipe;
    protected $ranking_pontos;
    
    function __construct() {
        parent::__construct();
        $this->setRanking_id(null);
        $this->setRanking_grupo(null);
        $this->setRanking_equipe(null);
        $this->setRanking_pontos(null);
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("ranking_id", $data['ranking_id']);
            if ($this->db->update('ranking', $data)) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*, ranking_pontos AS rkpontos, eq.equipe_id AS eqid, eq.equipe_nome AS eqnome, eq.equipe_escudo AS eqescudo, eq.equipe_pontos AS eqpontos');
        $this->db->join('equipes as eq', 'eq.equipe_id=ranking_equipe', 'inner');
        
        $this->db->order_by("ranking_pontos", "desc");
        $this->db->order_by("eq.equipe_pontos", "desc");
        return $this->db->get("ranking")->result();
    }
    
    public function listgroup($ranking_grupo) {
        $this->db->where("ranking_grupo", $ranking_grupo);
        $this->db->join('equipes', 'equipe_id=ranking_equipe', 'inner');
        $this->db->order_by("ranking_pontos", "desc");
        $this->db->order_by("equipe_pontos", "desc");
        return $this->db->get("ranking")->result();
    }
    
    public function search($ranking_equipe) {
        $this->db->where("ranking_equipe", $ranking_equipe);
        return $this->db->get("ranking")->row_array();
    }
    
    function getRanking_id() {
        return $this->ranking_id;
    }
    
    function getRanking_grupo() {
        return $this->ranking_grupo;
    }

    function getRanking_equipe() {
        return $this->ranking_equipe;
    }

    function getRanking_pontos() {
        return $this->ranking_pontos;
    }

    function setRanking_id($ranking_id) {
        $this->ranking_id = $ranking_id;
    }

    function setRanking_grupo($ranking_grupo) {
        $this->ranking_grupo = $ranking_grupo;
    }

    function setRanking_equipe($ranking_equipe) {
        $this->ranking_equipe = $ranking_equipe;
    }

    function setRanking_pontos($ranking_pontos) {
        $this->ranking_pontos = $ranking_pontos;
    }


}