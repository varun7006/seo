<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

class Dashboard extends MY_Controller {

    public function index() {
        $this->load->view('navigation/header');
        $this->load->view('navigation/navigation');
        $this->load->view('dashboard/dashboard_view');
    }
    
    public function viewClientDashboard() {
        $this->load->view('navigation/clientnavigation');
        $this->load->view('dashboard/client_dashboard_view');
    }

}
