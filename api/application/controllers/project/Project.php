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
            $objPHPExcel = new PHPExcel();

            $objWorkSheet = $objPHPExcel->createSheet(0);
            $row = 1;
            $col = 0;
            $headingArr = array("S.No","Project","Client","Note","Completed Links","Broken Links");
            foreach ($headingArr as $key => $value) {
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value);
                $col++;
            }
            $row++;
            foreach ($projectList['value']['list'] as $key => $value) {
                $col = 0;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, ($key + 1));
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['project_name']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['client_name']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['comment']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['completed_links']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['broken_links']);
                $col++;
                $row++;
            }


            $objPHPExcel->setActiveSheetIndex(0);
            $fileName = 'projectlist.xlsx';
            if (ob_get_contents())
                ob_end_clean();
            header('Content-type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=$fileName");
            header("Cache-Control: max-age=0");
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
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
