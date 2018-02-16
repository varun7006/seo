<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once APPPATH . '/core/PHPExcel.php';

class Bucket extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("bucket/bucketModel", "modelObj");
        $this->load->model("core/coreModel", "coreObj");
    }

    public function index() {
        $this->load->view('navigation/header');
        $this->load->view('navigation/navigation');
        $this->load->view('user/user_view');
    }

    public function getBucketList() {
        $userList = $this->modelObj->getBucketList();
        echo json_encode($userList);
    }

    public function addNewTaskView() {

        $this->load->view('navigation/header');
        $this->load->view('navigation/navigation');
        $this->load->view('bucket/add_task_view');
    }

    public function saveTask() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
        $dataArr['date'] = isset($dataArr['date']) ? date("Y-m-d",  strtotime($dataArr['date'])) : date("Y-m-d");
        $saveResult = $this->modelObj->saveNewTaskDetails($dataArr);
        echo json_encode($saveResult);
    }

    public function updateBucket() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
       
        if (count($dataArr) > 0) {
            $updateResult = array("status" => "ERR", "value" => "-1", "msg" => "unable to update task details.");
            foreach ($dataArr as $key => $value) {
                if($value['task_status']=='COMPLETED'){
                    $updateArr = array("task_status"=>"COMPLETED");
                    $updateResult = $this->modelObj->updateBucketList($updateArr, $value['id']);
                }
            }
            echo json_encode($updateResult);
        }
    }

    public function deleteTask() {
        $deleteId = $this->input->post("id");
        if ($deleteId != null && $deleteId != '') {
            $deleteResult = $this->modelObj->deleteUser($deleteId);
            echo json_encode($deleteResult);
        }
    }

}
