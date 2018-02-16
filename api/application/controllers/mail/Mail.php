<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once APPPATH . "core/mozapi/bootstrap.php";
require_once APPPATH . '/core/PHPExcel.php';

class Mail extends MY_Controller {

  
    public function __construct() {
        parent::__construct();
        $this->load->model("mail/mailModel", "modelObj");
        $this->load->model("core/CoreModel", "coreObj");
    }

    public function composeMailView() {
        $this->load->view('navigation/navigation');
        $this->load->view('mail/compose_mail_view');
    }

    public function inboxView() {
        $this->load->view('navigation/navigation');
        $this->load->view('mail/inbox_view');
    }

    public function viewMail() {
        $this->load->view('navigation/navigation');
        $this->load->view('mail/mail_view');
        
    }
    public function getMailList() {
        $mailList = $this->modelObj->getMailList();

        echo json_encode($mailList);
    }

    

    public function getClientMailList() {
        $clientId = $this->input->post("client_id");
        $mailDetails = $this->modelObj->getAllClientMails($clientId);
        
        echo json_encode($mailDetails);
    }

    public function sendNewMail() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
        $dataArr['message_by'] = $this->session->user_id;
        $dataArr['date'] = date("Y-m-d");
        $saveResult = $this->modelObj->sendNewMail($dataArr);
        echo json_encode($saveResult);
    }

    public function updateSource() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
        $updateId = $this->input->post("id");
        unset($dataArr['repassword']);
        if ($updateId != null && $updateId != '') {
            $updateResult = $this->modelObj->updateSourceDetails($dataArr, $updateId);
            echo json_encode($updateResult);
        }
    }

    public function deleteSource() {
        $deleteId = $this->input->post("id");
        if ($deleteId != null && $deleteId != '') {
            $deleteResult = $this->modelObj->deleteSource($deleteId);
            echo json_encode($deleteResult);
        }
    }

    public function saveExcel() {

        $excelResult = array();
        if (!empty($_FILES)) {
            $excelResult = $this->coreObj->excelUpload();
            $objPHPExcel = PHPExcel_IOFactory::load($excelResult['value']);
            $sheetData = $objPHPExcel->getActiveSheet()->rangeToArray('A1:F105');

            $headercolArr = array("SOURCE", "NAME", "EMAIL", "TOPICS", "MOBILE NO.", "LINK TYPE");

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
                    $tmpArr['source_link'] = $sheetData[$i][0];
                    $tmpArr['name'] = $sheetData[$i][1];
                    $tmpArr['email'] = $sheetData[$i][2];
                    $tmpArr['topics'] = $sheetData[$i][3];
                    $tmpArr['mobile_no'] = $sheetData[$i][4];
                    $tmpArr['link_type'] = $sheetData[$i][5];
                    $insertArr[] = $tmpArr;
                } else {
                    break;
                }
            }
            if (count($insertArr) > 0) {
                $insertResult = $this->modelObj->saveSourceByExcel($insertArr);
                echo json_encode($insertResult);
            } else {
                echo json_encode(array("status" => "ERR", "value" => "-1", "msg" => "unable to save new user."));
            }
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

        $this->objectURL = $dataArr['source_link'];
        // Metrics to retrieve (url_metrics_constants.php)
        $cols = URLMETRICS_COL_DEFAULT;

        $urlMetricsService = new URLMetricsService($authenticator);
        $response = $urlMetricsService->getUrlMetrics($cols);

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
