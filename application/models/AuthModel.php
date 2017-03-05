<?php

class AuthModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->users = "users";
    }

    function getLoginData($data) {
        $this->db->select();
        $this->db->from($this->users);
        $this->db->where("username", $data['username']);
        $this->db->where("password", md5($data['password']));
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }

}
