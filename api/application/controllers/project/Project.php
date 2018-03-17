<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once APPPATH . '/core/PHPExcel.php';

class Project extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("project/projectModel", "modelObj");
        $this->load->model("core/coreModel", "coreObj");
    }

    public function index() {
        if ($this->session->userdata("user_type") == 'ADMIN') {
            $this->load->view('navigation/navigation');
        } else {
            $this->load->view('navigation/clientnavigation');
        }
        $this->load->view('project/project_view');
    }

    public function getProjectList() {
        $userList = $this->modelObj->getProjectList();
        echo json_encode($userList);
    }

    public function addNewProjectView() {
        if ($this->session->userdata("user_type") == 'ADMIN') {
            $this->load->view('navigation/navigation');
        } else {
            $this->load->view('navigation/clientnavigation');
        }
        $this->load->view('project/add_project_view');
    }

    public function saveNewProject() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
//        unset($dataArr['repassword']);
        if ($this->session->userdata("user_type") == 'CLIENT') {
            $dataArr['client_id'] = $this->session->userdata("user_id");
        }
        $saveResult = $this->modelObj->saveNewProjectDetails($dataArr);
        echo json_encode($saveResult);
    }

    public function updateProject() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
        $updateId = $this->input->post("id");
        unset($dataArr['repassword']);
        if ($updateId != null && $updateId != '') {
            $updateResult = $this->modelObj->updateProjectDetails($dataArr, $updateId);
            echo json_encode($updateResult);
        }
    }

    public function deleteProject() {
        $deleteId = $this->input->post("id");
        if ($deleteId != null && $deleteId != '') {
            $deleteResult = $this->modelObj->deleteProject($deleteId);
            echo json_encode($deleteResult);
        }
    }

}
