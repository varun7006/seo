<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once APPPATH . '/core/PHPExcel.php';

class Report extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("report/ReportModel", "modelObj");
        $this->load->model("core/CoreModel", "coreObj");
    }

    public function getSourceList() {
        $sourceList = $this->modelObj->getSourceList();
        echo json_encode($sourceList);
    }

    public function linkStatusReportView() {
        $this->load->view('navigation/header');
        $this->load->view('navigation/navigation');
        $this->load->view('reports/link_status_report_view');
    }

    public function getLinkStatusReport() {
        $project_id = $this->input->post('project_id');
        $backLinkList = $this->modelObj->getLinkStatusReport($project_id);
        if ($backLinkList['status'] == 'SUCCESS' && $backLinkList['value']['count'] > 0) {
            $sourceLiveStatusResult = $this->modelObj->getsourceLiveStatus();
            foreach ($backLinkList['value']['list'] as $key => $value) {
                    $backLinkList['value']['list'][$key]['live_status'] = isset($sourceLiveStatusResult[$value['id']]) ? $sourceLiveStatusResult[$value['id']] : 'ONLINE';
            }
        }
        echo json_encode($backLinkList);
    }
    
    public function generateLinkStatusExcel($project_id) {
        $backLinkList = $this->modelObj->getLinkStatusReport($project_id);
        if ($backLinkList['status'] == 'SUCCESS' && $backLinkList['value']['count'] > 0) {
            $fileName = isset($backLinkList['value']['project_name']) ? "Project-".$backLinkList['value']['project_name']."_linkstatusreport.xlsx" : "link_status_report.xlsx";
            
            $objPHPExcel = new PHPExcel();

            $objWorkSheet = $objPHPExcel->createSheet(0);
            $row = 1;
            $col = 0;
            $headingArr = array("S.No","Date","Link Status","BackLink","Anchor","Target Page","Name","Email","Note");
            foreach ($headingArr as $key => $value) {
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value);
                $col++;
            }
            $row++;
            foreach ($backLinkList['value']['list'] as $key => $value) {
                $col = 0;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, ($key + 1));
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['date']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['link_status']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['backlink']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['anchor']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['target_page']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['name']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['email']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['remarks']);
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

    public function url_test($url) {
        $timeout = 30;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (( $http_code == "200" ) || ( $http_code == "302" )) {
            return true;
        } else {
            return false;
        }
        curl_close($ch);
    }

    public function saveNewLinkReport() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
        $dataArr['date'] = date("Y-m-d", strtotime($dataArr['date']));
        if (isset($dataArr['link_status']) && $dataArr['link_status'] == 'COMPLETED') {
            $dataArr['completed_date'] = isset($dataArr['date']) ? $dataArr['date'] : date("Y-m-d");
        }
        $saveResult = $this->modelObj->saveNewLinkReport($dataArr);
        $insertId = $saveResult["insert_id"];
        if($saveResult["status"] == "SUCCESS"){
           $checkStatus = $this->checkBackLinkStatus($insertId,$dataArr['project_id'],$dataArr['backlink']); 
        }
        echo json_encode($saveResult);
    }
    
    public function checkBackLinkStatus($backlink_id,$project_id,$source_link) {
        $insertArr = array();
        $checkStatus = $this->url_test($source_link);
        if (!$checkStatus) {
            $insertArr[] = array("backlink_id" => $backlink_id,"project_id"=>$project_id ,"last_checked_date" => date("Y-m-d"), "type" => "OFFLINE");
        } else {
            $insertArr[] = array("backlink_id" => $backlink_id,"project_id"=>$project_id , "last_checked_date" => date("Y-m-d"), "type" => "ONLINE");
        }
        if (count($insertArr) > 0) {
            $this->db->insert_batch("broken_links_details", $insertArr);
        }
        return true;
    }

    public function updateLinkReport() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
        $updateId = $this->input->post("id");
        unset($dataArr['repassword']);
        if ($updateId != null && $updateId != '') {
            $dataArr['date'] = isset($dataArr['date']) ? date("Y-m-d",strtotime($dataArr['date'])) : date("Y-m-d");
            if (isset($dataArr['link_status']) && $dataArr['link_status'] == 'COMPLETED') {
                $dataArr['completed_date'] = isset($dataArr['completed_date']) ? date("Y-m-d",strtotime($dataArr['completed_date'])) : date("Y-m-d");
            }
            $updateResult = $this->modelObj->updateLinkReport($dataArr, $updateId);
            echo json_encode($updateResult);
        }
    }

    public function deleteBackLink() {
        $deleteId = $this->input->post("id");
        if ($deleteId != null && $deleteId != '') {
            $deleteResult = $this->modelObj->deleteBackLink($deleteId);
            echo json_encode($deleteResult);
        }
    }

    public function sendMail() {

        require_once APPPATH . "core/mozapi/bootstrap.php";
        require_once APPPATH . 'core/phpmailer/class.phpmailer.php';
        $dataArr = json_decode($this->input->post("data"), TRUE);


        // Moz Api Code Starts Here
        $AccessID = 'mozscape-c3c9b9264';

        // Add your secretKey here
        $SecretKey = '57fd4ff492e9d3f6549382ce2879632c';

        // Set the rate limit
        $rateLimit = 10;

        $authenticator = new Authenticator();

        $authenticator->setAccessID($AccessID);
        $authenticator->setSecretKey($SecretKey);
        $authenticator->setRateLimit($rateLimit);

        // URL to query
        $objectURL = $dataArr['source_link'];

        // Metrics to retrieve (url_metrics_constants.php)
        $cols = URLMETRICS_COL_DEFAULT;

        $urlMetricsService = new URLMetricsService($authenticator);
        $response = $urlMetricsService->getUrlMetrics($objectURL, $cols);

        // Moz Api Code Ends Here
        if (count($response) > 0) {
            if (isset($response['pda']) && isset($response['upa'])) {
                $reportData = array("source_id" => $dataArr['id'], "pa" => $response['upa'], "da" => $response['pda']);
                $saveResult = $this->modelObj->saveSourceReportData($reportData);

                $mail = new PHPMailer();
                $EmailContact = $dataArr['email'];

                $subject = "Seo Report";
                $message = "Dear Sir,<br>Please have a look at the seo report for the link " . $dataArr['source_link'];
                $message .= "<table style='border:1px solid black;'><tr style='border:1px solid black;'><td style='border:1px solid black;'>#</td><td style='border:1px solid black;'>Domain Authority</td><td style='border:1px solid black;'>Page Authority</td></tr><tr style='border:1px solid black;'><td style='border:1px solid black;'>1.</td><td style='border:1px solid black;'>" . $response['pda'] . "</td><td style='border:1px solid black;'>" . $response['upa'] . "</td></tr></table>";
                $emailResult = $this->coreObj->sendEmailToClient(new PHPMailer(), array(), $EmailContact, array(), $subject, $message, $this->db, "SEO-REPORT");
                if ($emailResult == "true") {
                    echo json_encode(array("status" => "SUCCESS", "value" => "1", "msg" => "Mail Sent successfully."));
                } else {
                    return json_encode(array("status" => "ERR", "value" => "-1", "msg" => "unable to send mail."));
                }
            }
        }
    }

}
