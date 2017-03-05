<?php

class ShareModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->shares = "shares";
    }

    function getAllShares() {
        $this->db->select();
        $this->db->from($this->shares);
        return $this->db->get()->result_array();
    }

    function getShare($id) {
        $this->db->select();
        $this->db->from($this->shares);
        $this->db->where("id", $id);
        return $this->db->get()->row_array();
    }

    function createShare($data) {
        $this->db->insert($this->shares, $data);
        return $this->db->insert_id();
    }

    function updateShare($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->shares, $data);
    }

    function deleteShare($id) {
        return $this->db->delete($this->shares, array("id" => $id));
    }

}
