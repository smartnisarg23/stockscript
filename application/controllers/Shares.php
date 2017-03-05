<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shares extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('AuthModel');
        $this->load->model('ShareModel');
    }

    public function index() {
        $shares = $this->ShareModel->getAllShares();
        $data['shares'] = $shares;
        $data['page_title'] = "Shares";
        $data['page_name'] = "shares/index";
        $this->load->view('index', $data);
    }

    public function create() {
        $post_data = $this->input->post();
        if (count($post_data) > 0) {
            $post_data = $this->input->post();
            $this->form_validation->set_rules('name', 'Share Name', 'trim|required');
            if ($this->form_validation->run($this) === TRUE) {
                $share_id = $this->ShareModel->createShare($post_data);
                if ($share_id != '') {
                    $this->session->set_flashdata("success", "Share has been sucessfully created.");
                    redirect(base_url('shares/index'));
                }
            }
        }
        $data['page_title'] = "Create Share";
        $data['page_name'] = "shares/create";
        $this->load->view('index', $data);
    }

    public function edit($id) {
        $data = $this->ShareModel->getShare($id);
        if ($data == "" || count($data) == 0) {
            $this->session->set_flashdata("error", "Share not found.");
            redirect(base_url('shares/index'));
        }
        $post_data = $this->input->post();
        if (count($post_data) > 0) {
            $post_data = $this->input->post();
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            if ($this->form_validation->run($this) === TRUE) {
                $updated_data = $this->ShareModel->updateShare($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Share has been successfully updated.");
                    redirect(base_url('shares/index'));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }
        $data['page_title'] = "Edit Share";
        $data['page_name'] = "shares/update";
        $this->load->view('index', $data);
    }

}
