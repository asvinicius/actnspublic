<?php
class CommentModel extends CI_Model{
    
    protected $commentid;
    protected $commentnews;
    protected $commentauthor;
    protected $commentemailauthor;
    protected $commentmessage;
    protected $commentdate;
    protected $commentstatus;
    
    function __construct() {
        parent::__construct();
        $this->setCommentid(null);
        $this->setCommentnews(null);
        $this->setCommentauthor(null);
        $this->setCommentemailauthor(null);
        $this->setCommentmessage(null);
        $this->setCommentdate(null);
        $this->setCommentstatus(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('comment', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("commentid", $data['commentid']);
            if ($this->db->update('comment', $data)) {
                return true;
            }
        }
    }
    public function delete($commentid) {
        if ($commentid != null) {
            $this->db->where("commentid", $commentid);
            if ($this->db->delete("comment")) {
                return true;
            }
        }
    }
    
    public function listing($commentnews) {
        $this->db->where("commentnews", $commentnews);
        $this->db->where("commentstatus", 1);
        $this->db->order_by("commentdate", "desc");
        return $this->db->get("comment")->result();
    }
    
    public function search($commentid) {
        $this->db->where("commentid", $commentid);
        return $this->db->get("comment")->row_array();
    }
    
    function getCommentid() {
        return $this->commentid;
    }

    function getCommentnews() {
        return $this->commentnews;
    }

    function getCommentauthor() {
        return $this->commentauthor;
    }

    function getCommentemailauthor() {
        return $this->commentemailauthor;
    }

    function getCommentmessage() {
        return $this->commentmessage;
    }

    function getCommentdate() {
        return $this->commentdate;
    }

    function getCommentstatus() {
        return $this->commentstatus;
    }

    function setCommentid($commentid) {
        $this->commentid = $commentid;
    }

    function setCommentnews($commentnews) {
        $this->commentnews = $commentnews;
    }

    function setCommentauthor($commentauthor) {
        $this->commentauthor = $commentauthor;
    }

    function setCommentemailauthor($commentemailauthor) {
        $this->commentemailauthor = $commentemailauthor;
    }

    function setCommentmessage($commentmessage) {
        $this->commentmessage = $commentmessage;
    }

    function setCommentdate($commentdate) {
        $this->commentdate = $commentdate;
    }

    function setCommentstatus($commentstatus) {
        $this->commentstatus = $commentstatus;
    }


}