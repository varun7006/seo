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
        $projectList = $this->modelObj->getProjectList();
        echo json_encode($projectList);
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
    
    public function generateProjectExcel() {
        $projectList = $this->modelObj->getProjectList();
        if ($projectList['status'] == 'SUCCESS' && $projectList['value']['count'] > 0) {
            
          $table = "<table><tr><th>#</th><th>Project Name</th><th>Client Name</th><th>Comment</th><th>Completed Links</th><th>Broken Links</th></tr>";
          
          foreach ($projectList['value']['list'] as $key => $value) {
                $table .= "<tr><td>".($key+1)."</td>";
                $table .= "<td>".$value['project_name']."</td>";
                $table .= "<td>".$value['client_name']."</td>";
                $table .= "<td>".$value['comment']."</td>";
                $table .= "<td>".$value['completed_links']."</td>";
                $table .= "<td>".$value['broken_links']."</td>";
                $table .= "</tr>";
            }
            $table .= "</table>";
            $excelResult = $this->coreObj->getReportDataTypeWiseExcel($table, "projectlist.xlsx");
        }else{
            echo "No Client Found";
            exit;
        }
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
