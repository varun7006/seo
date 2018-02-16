<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once APPPATH . "core/mozapi/bootstrap.php";
require_once APPPATH . '/core/PHPExcel.php';

class Source extends MY_Controller {

    private $AccessID;
    private $SecretKey;
    private $rateLimit;
    private $objectURL;

    public function __construct() {
        parent::__construct();
        $this->load->model("sources/SourceModel", "modelObj");
        $this->load->model("core/CoreModel", "coreObj");
    }

    public function index() {
        if ($this->session->userdata("user_type") == 'ADMIN') {
            $this->load->view('navigation/navigation');
        } else {
            $this->load->view('navigation/clientnavigation');
        }
        $this->load->view('sources/sources_view');
    }

    public function addNewSourceView() {
        if ($this->session->userdata("user_type") == 'ADMIN') {
            $this->load->view('navigation/navigation');
        } else {
            $this->load->view('navigation/clientnavigation');
        }
        $this->load->view('sources/add_sources_view');
    }

    public function getBrokenSourceView() {
        if ($this->session->userdata("user_type") == 'ADMIN') {
            $this->load->view('navigation/navigation');
        } else {
            $this->load->view('navigation/clientnavigation');
        }
        $this->load->view('sources/broken_sources_view');
    }

    public function getSourceList() {
        $sourceList = $this->modelObj->getSourceList();
        if ($sourceList["status"] == "SUCCESS") {
            foreach ($sourceList['value']['list'] as $key => $value) {
                $sourceList['value']['list'][$key]['exact_link'] = $value['source_link'];
                $sourceList['value']['list'][$key]['source_link'] = $this->getDomainName($value['source_link']);
            }
        }
        echo json_encode($sourceList);
    }

    public function getTagList() {
        $tagList = $this->modelObj->getTagList();
        echo json_encode($tagList);
    }

    public function getBrokenSourceList() {
        $sourceList = $this->modelObj->getBrokenSourceList();
        if ($sourceList["status"] == "SUCCESS") {
            foreach ($sourceList['value']['list'] as $key => $value) {
                $sourceList['value']['list'][$key]['exact_link'] = $value['source_link'];
                $sourceList['value']['list'][$key]['source_link'] = $this->getDomainName($value['source_link']);
            }
        }
        echo json_encode($sourceList);
    }

    public function viewSourceReport() {
        $this->load->view('navigation/header');
        $this->load->view('navigation/navigation');
        $this->load->view('sources/view_sources_report');
    }

    public function getSourceReport() {
        $sourceId = $this->input->post("id");
        $sourceDetails = $this->modelObj->getSourceReportDetails($sourceId);
        if ($sourceDetails['status'] == 'SUCCESS') {
            foreach ($sourceDetails['value'] as $key => $value) {
                $sourceDetails['value'][$key]['exact_link'] = $value['source_link'];
                $sourceDetails['value'][$key]['source_link'] = $this->getDomainName($value['source_link']);
            }
        }
        echo json_encode($sourceDetails);
    }

    public function getDomainName($url) {

// in case scheme relative URI is passed, e.g., //www.google.com/
        $url = trim($url, '/');

// If scheme not included, prepend it
        if (!preg_match('#^http(s)?://#', $url)) {
            $url = 'http://' . $url;
        }

        $urlParts = parse_url($url);

// remove www
        $domain = preg_replace('/^www\./', '', $urlParts['host']);
        return $domain;
    }

    public function generateSourceReportManually() {
        $sourceData = json_decode($this->input->post("data"), TRUE);
        $sourceLink = preg_replace('~^(?:\w+://)?(?:www\.)?~', "http://www.", $sourceData['source_link']);
        if ($sourceLink != NULL || $sourceLink != '') {
            $mozData = $this->getMozAPiData($sourceLink);
        }
    }

    public function getMozAPiData($sourceLink) {

        $dataArr = json_decode($this->input->post("data"), TRUE);


        // Moz Api Code Starts Here
        $this->AccessID = 'mozscape-c3c9b9264';
//        $this->AccessID = 'mozscape-52aa25c665';
        // Add your secretKey here
        $this->SecretKey = '57fd4ff492e9d3f6549382ce2879632c';
//        $this->SecretKey = '8fd4c8750b0125468bcd3da130cae7e9';
        // Set the rate limit
        $this->rateLimit = 10;


        $urlMetricData = $this->getUrlMetricData();

//        $anchorTextData = $this->getAnchorData();
        // Moz Api Code Ends Here
        if (count($urlMetricData) > 0) {
            if (isset($urlMetricData['da']) && isset($urlMetricData['pa'])) {
                $reportData = array("source_id" => $dataArr['id'], "date" => date("Y-m-d"), "moz_rank" => $urlMetricData['moz_rank'], "pa" => $urlMetricData['pa'], "da" => $urlMetricData['da']);
                $saveResult = $this->modelObj->saveSourceReportData($reportData);
                echo json_encode($saveResult);
            }
        } else {
            json_encode(array("status" => "ERR", "value" => "-1", "msg" => "Unable to get data from moz api."));
        }
    }

    private function getUrlMetricData() {

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
        $objectURL = "http://www.hestabit.com";

        // Metrics to retrieve (url_metrics_constants.php)
        $cols = URLMETRICS_COL_DEFAULT;
        $mozRankCol = URLMETRICS_COL_MOZRANK;
        $urlMetricsService = new URLMetricsService($authenticator);
        $response = $urlMetricsService->getUrlMetrics($objectURL, $cols);
        sleep(11);
        $mozRank = $urlMetricsService->getUrlMetrics($objectURL, $mozRankCol);
        return array("moz_rank" => $mozRank['umrp'], "pa" => $response['upa'], "da" => $response['pda']);
    }

    public function getAnchorData() {
        $AccessID = 'mozscape-52aa25c665';

        // Add your secretKey here
        $SecretKey = '8fd4c8750b0125468bcd3da130cae7e9';

        // Set the rate limit
        $rateLimit = 10;

        $authenticator = new Authenticator();
        $authenticator->setAccessID($AccessID);
        $authenticator->setSecretKey($SecretKey);
        $authenticator->setRateLimit($rateLimit);

        // URL to query
        $objectURL = "www.seomoz.org";

        // Metrics to retrieve (anchor_text_constants.php)
        $options = array(
            'cols' => ANCHOR_COL_TERM_OR_PHRASE,
            'scope' => ANCHOR_SCOPE_TERM_TO_SUBDOMAIN,
            'sort' => ANCHOR_SORT_DOMAINS_LINKING_PAGE,
            'limit' => 10
        );

        $anchorTextService = new AnchorTextService($authenticator);
        $response = $anchorTextService->getAnchorText($objectURL, $options);
        echo '<pre>';
        print_r($response);
        exit;
    }

    public function saveNewSource() {
        $dataArr = json_decode($this->input->post("data"), TRUE);

        $saveResult = $this->modelObj->saveNewSource($dataArr);
        if (isset($dataArr['topics'])) {
            $tagList = array();
            $tagList = $this->modelObj->getTagList();
            if (!in_array($dataArr['topics'], $tagList['value'])) {
                $saveTagResult = $this->modelObj->saveNewTag(array("tag" => $dataArr['topics']));
            }
        }
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
