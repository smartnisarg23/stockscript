<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('AuthModel');
        $this->load->model('ClientModel');
    }

    public function index() {
        $clients = $this->ClientModel->getAllClients();
        $data['clients'] = $clients;
        $data['page_title'] = "Clients";
        $data['page_name'] = "clients/index";
        $this->load->view('index', $data);
    }

    public function create() {
        $post_data = $this->input->post();
        if (count($post_data) > 0) {
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('middle_name', 'Middle Name', 'trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim');
            $this->form_validation->set_rules('username', 'Client Number', 'trim');
            if ($this->form_validation->run($this) === TRUE) {
                $post_data['role_id'] = 2;
                $post_data['password'] = md5($post_data['username']);
                $client_id = $this->ClientModel->createClient($post_data);
                if ($client_id != '') {
                    $this->session->set_flashdata("success", "Client has been sucessfully created.");
                    redirect(base_url('clients/index'));
                }
            }
        }
        $data['page_title'] = "Create Client";
        $data['page_name'] = "clients/create";
        $this->load->view('index', $data);
    }

    public function edit($id) {
        $data = $this->ClientModel->getClient($id);
        if ($data == "" || count($data) == 0) {
            $this->session->set_flashdata("error", "Client not found.");
            redirect(base_url('clients/index'));
        }
        $post_data = $this->input->post();
        if (count($post_data) > 0) {
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('middle_name', 'Middle Name', 'trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('username', 'Client Number', 'trim|required');
            if ($this->form_validation->run($this) === TRUE) {
                $updated_data = $this->ClientModel->updateClient($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Client has been successfully updated.");
                    redirect(base_url('clients/index'));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }
        $data['page_title'] = "Edit Client";
        $data['page_name'] = "clients/update";
        $this->load->view('index', $data);
    }

}
