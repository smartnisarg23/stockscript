<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('AuthModel');
    }

    public function index() {
        $this->load->library('session');
        if (!empty($this->session->userdata['user_data'])) {
            redirect(base_url('clients/index'));
        }
        $data['page_title'] = "Login";
        $this->load->view('auth/login', $data);
    }

    public function login() {
        $post_data = $this->input->post();
        if (count($post_data) > 0) {
            $post_data = $this->input->post();
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run($this) === TRUE) {

                $login_data = $this->AuthModel->getLoginData($post_data);
                if (count($login_data) > 0) {
                    unset($login_data['password']);
                    $this->session->set_userdata('user_data', $login_data);
                    redirect(base_url('clients/index'));
                }
            }
            $this->session->set_flashdata("error", "Please enter correct Username and Password.");
            redirect(base_url('auth/index'));
        } else {
            redirect(base_url('auth/index'));
        }
    }

    function logout() {
        $this->session->unset_userdata('user_data');
        redirect(base_url('auth/index'));
    }

}
