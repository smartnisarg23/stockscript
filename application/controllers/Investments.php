<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Investments extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('AuthModel');
        $this->load->model('ClientModel');
        $this->load->model('InvestmentModel');
        $this->load->model('ShareModel');
    }

    public function index($client_id) {
        $client_details = $this->ClientModel->getClient($client_id);
        if ($client_id == '') {
            redirect(base_url('clients/index'));
        }
        $investments = $this->InvestmentModel->getInvestmentsByClientId($client_id);
        $client_shares = array();
        foreach ($investments as $k_i => $v_i) {
            if (!in_array($v_i['share_id'], $client_shares)) {
                array_push($client_shares, $v_i['share_id']);
            }
        }
        $investments_details = array();
        foreach ($client_shares as $v_c) {
            $temp_investment = array();
            $temp_investment = $this->ShareModel->getShare($v_c);
            $temp_investment['buy_average_price'] = 0;
            $temp_investment['total_buy_qty'] = 0;
            $temp_investment['total_buy_valuation'] = 0;
            $temp_investment['sell_average_price'] = 0;
            $temp_investment['total_sell_qty'] = 0;
            $temp_investment['total_sell_valuation'] = 0;
            $temp_investment['buy'] = array();
            $temp_investment['sell'] = array();

            foreach ($investments as $k_i => $v_i) {
                if ($v_i['share_id'] == $v_c) {
                    if ($v_i['action'] == 'B') {
                        $temp_investment['total_buy_valuation'] += intval($v_i['qty']) * floatval($v_i['price']);
                        $temp_investment['total_buy_qty'] += intval($v_i['qty']);
                        $temp_investment['buy_average_price'] += intval($v_i['qty']) * floatval($v_i['price']);
                        array_push($temp_investment['buy'], $v_i);
                    }
                    if ($v_i['action'] == 'S') {
                        $temp_investment['total_sell_valuation'] += intval($v_i['qty']) * floatval($v_i['price']);
                        $temp_investment['total_sell_qty'] += intval($v_i['qty']);
                        $temp_investment['sell_average_price'] += intval($v_i['qty']) * floatval($v_i['price']);
                        array_push($temp_investment['sell'], $v_i);
                    }
                }
            }
            if ($temp_investment['total_buy_qty'] > 0) {
                $temp_investment['buy_average_price'] = $temp_investment['buy_average_price'] / $temp_investment['total_buy_qty'];
            } else {
                $temp_investment['buy_average_price'] = 0;
            }
            if ($temp_investment['total_sell_qty'] > 0) {
                $temp_investment['sell_average_price'] = $temp_investment['sell_average_price'] / $temp_investment['total_sell_qty'];
            } else {
                
            }

            array_push($investments_details, $temp_investment);
        }
        $shares = $this->ShareModel->getAllShares();
        $data['client_details'] = $client_details;
        $data['shares'] = $shares;
        $data['investments_details'] = $investments_details;
        $data['client_id'] = $client_id;
        $data['page_title'] = "Investments";
        $data['page_name'] = "investments/index";
        $this->load->view('index', $data);
    }

    public function create($client_id) {
        if ($client_id == '') {
            redirect(base_url('clients/index'));
        }
        $post_data = $this->input->post();
        if (count($post_data) > 0) {
            $this->form_validation->set_rules('share_id', 'Share', 'trim|required');
            $this->form_validation->set_rules('action', 'Action', 'trim|required');
            $this->form_validation->set_rules('qty', 'Quantity', 'trim|required');
            $this->form_validation->set_rules('price', 'Price', 'trim|required');
            $this->form_validation->set_rules('action_date', 'Date', 'trim|required');
            if ($this->form_validation->run($this) === TRUE) {
                $post_data['client_id'] = $client_id;
                $post_data['action_date'] = date('Y-m-d H:i:s', strtotime($post_data['action_date']));
                $investment_id = $this->InvestmentModel->createInvestment($post_data);
                if ($investment_id != '') {
                    $this->session->set_flashdata("success", "Investment has been sucessfully created.");
                    redirect(base_url('investments/index/' . $client_id));
                }
            }
        }
    }

    public function edit($client_id, $investment_id) {
        $post_data = $this->input->post();
        if (count($post_data) > 0) {
            $post_data = $this->input->post();
            $this->form_validation->set_rules('edit_share_id', 'Share', 'trim|required');
            $this->form_validation->set_rules('action_edit', 'Action', 'trim|required');
            $this->form_validation->set_rules('qty_edit', 'Quantity', 'trim|required');
            $this->form_validation->set_rules('price_edit', 'Price', 'trim|required');
            $this->form_validation->set_rules('action_date_edit', 'Date', 'trim|required');
            if ($this->form_validation->run($this) === TRUE) {
                $update_data['action'] = $post_data['action_edit'];
                $update_data['qty'] = $post_data['qty_edit'];
                $update_data['price'] = $post_data['price_edit'];
                $update_data['action_date'] = date('Y-m-d H:i:s', strtotime($post_data['action_date_edit']));
                $investment_id = $this->InvestmentModel->updateInvestment($investment_id, $update_data);
                if ($investment_id != '') {
                    $this->session->set_flashdata("success", "Investment has been sucessfully updated.");
                    redirect(base_url('investments/index/' . $client_id));
                }
            }
        }
    }

    public function delete($client_id, $investment_id) {
        $this->InvestmentModel->deleteInvestment($investment_id);
        $this->session->set_flashdata("success", "Investment has been sucessfully deleted.");
        redirect(base_url('investments/index/' . $client_id));
    }

}