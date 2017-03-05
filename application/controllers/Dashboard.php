<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('AuthModel');
    }

    public function index() {
        $data['page_title'] = "Login";
        $data['page_name'] = "index";
        $this->load->view('index', $data);
    }

}
