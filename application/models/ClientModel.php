<?php

class ClientModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->users = "users";
    }

    function getAllClients() {
        $this->db->select();
        $this->db->from($this->users);
        $this->db->where("role_id", '2');
        return $this->db->get()->result_array();
    }

    function getClient($id) {
        $this->db->select();
        $this->db->from($this->users);
        $this->db->where("id", $id);
        return $this->db->get()->row_array();
    }

    function createClient($data) {
        $data['created_date'] = date("Y-m-d H:i:s");
        $this->db->insert($this->users, $data);
        return $this->db->insert_id();
    }

    function updateClient($id, $data) {
        $data['updated_date'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        return $this->db->update($this->users, $data);
    }

    function deleteClient($id) {
        return $this->db->delete($this->users, array("id" => $id));
    }

}
