<?php

class InvestmentModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->shares = "shares";
        $this->client_investment = "client_investment";
    }

    function getInvestmentsByClientId($client_id) {
        $this->db->select();
        $this->db->from($this->client_investment);
        $this->db->where('client_id', $client_id);
        return $this->db->get()->result_array();
    }

    function getInvestment($id) {
        $this->db->select();
        $this->db->from($this->client_investment);
        $this->db->where("id", $id);
        return $this->db->get()->row_array();
    }

    function createInvestment($data) {
        $this->db->insert($this->client_investment, $data);
        return $this->db->insert_id();
    }

    function updateInvestment($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->client_investment, $data);
    }

    function deleteInvestment($id) {
        return $this->db->delete($this->client_investment, array("id" => $id));
    }

}
