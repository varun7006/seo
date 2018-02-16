<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once APPPATH . '/core/PHPExcel.php';

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("user/userModel", "modelObj");
        $this->load->model("core/coreModel", "coreObj");
    }

    public function index() {
        $this->load->view('navigation/header');
        $this->load->view('navigation/navigation');
        $this->load->view('user/user_view');
    }

    public function getUserList() {
        $userList = $this->modelObj->getUserList();
        echo json_encode($userList);
    }

    public function addNewUserView() {

        $this->load->view('navigation/header');
        $this->load->view('navigation/navigation');
        $this->load->view('user/add_user_view');
    }

    public function saveNewUser() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
        unset($dataArr['repassword']);
        $saveResult = $this->modelObj->saveNewUserDetails($dataArr);
        echo json_encode($saveResult);
    }

    public function updateUser() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
        $updateId = $this->input->post("id");
        unset($dataArr['repassword']);
        if ($updateId != null && $updateId != '') {
            $updateResult = $this->modelObj->updateUserDetails($dataArr, $updateId);
            echo json_encode($updateResult);
        }
    }

    public function deleteUser() {
        $deleteId = $this->input->post("id");
        if ($deleteId != null && $deleteId != '') {
            $deleteResult = $this->modelObj->deleteUser($deleteId);
            echo json_encode($deleteResult);
        }
    }

    public function saveExcel() {

        $excelResult = array();
        if (!empty($_FILES)) {
            $excelResult = $this->coreObj->excelUpload();
            $objPHPExcel = PHPExcel_IOFactory::load($excelResult['value']);
            $sheetData = $objPHPExcel->getActiveSheet()->rangeToArray('A1:F105');
            $headercolArr = array("NAME", "EMAIL", "WEBSITE", "MOBILE NO.", "ADDRESS", "COUNTRY");

            foreach ($headercolArr as $key => $value) {
                if ($sheetData[0][$key] != $value) {
                    echo json_encode(array("status" => "ERR", "value" => "-1", "msg" => "Invalid File Format"));
                    exit;
                }
            }
            $insertArr = array();
            for ($i = 1; $i < count($sheetData); $i++) {
                if (((isset($sheetData[$i][0])) && trim($sheetData[$i][0] != null) && trim($sheetData[$i][0]) != '')) {
                    $tmpArr = array();
                    $tmpArr['name'] = $sheetData[$i][0];
                    $tmpArr['email'] = $sheetData[$i][1];
                    $tmpArr['website'] = $sheetData[$i][2];
                    $tmpArr['mobile_no'] = $sheetData[$i][3];
                    $tmpArr['address'] = $sheetData[$i][4];
                    $insertArr[] = $tmpArr;
                } else {
                    break;
                }
            }
            if (count($insertArr) > 0) {
                $insertResult = $this->modelObj->saveUserByExcel($insertArr);
                echo json_encode($insertResult);
            } else {
                echo json_encode(array("status" => "ERR", "value" => "-1", "msg" => "unable to save new user."));
            }
        }
    }

}
