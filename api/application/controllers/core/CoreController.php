<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class CoreController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("core/CoreModel", "modelObj");
    }

    public function imageUpload() {
        if (!empty($_FILES)) {

            $tempFile = $_FILES['image']['tmp_name'];
            $type = $this->input->post("Type");
            $fileType = explode("/", $_FILES['image']['type'])[1];

            $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/school_project";
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0777, true);
                @chmod($targetPath, 0777);
            }
            if (!is_dir($targetPath)) {
                die('{"status":"ERR","msg":"Unable to create directory"}');
            }
            $filePath = "files/" . $_FILES['image']['name'];
            $fileName = $targetPath . "/" . $filePath;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $fileName)) {
                $fileId = $this->modelObj->saveUploadedFilepath($filePath, $_FILES['image']['name'], $type);
                $result = array('status' => 'SUCCESS', 'msg' => 'File transfer completed', 'value' => $fileId, 'filepath' => $filePath);
                echo json_encode($result);
            } else {
                echo '{"status":"ERR","msg":"Files not written"}';
            }
        } else {
            echo '{"status":"ERR","msg":"Files not uploaded"}';
        }
    }

    
    
    public function getCountryList() {
       $countryList = $this->modelObj->getCountryList();
       echo json_encode($countryList);
    }

}
