<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('memory_limit', '-1');
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
        $fromLimit = $this->input->post("from_limit");
        $toLimit = $this->input->post("to_limit");
        $sourceList = $this->modelObj->getSourceList($fromLimit, $toLimit);
        if ($sourceList["status"] == "SUCCESS") {
            $sourceLiveStatusResult = $this->modelObj->getsourceLiveStatus();
            foreach ($sourceList['value']['list'] as $key => $value) {
                $sourceList['value']['list'][$key]['exact_link'] = $value['source_link'];
                $sourceList['value']['list'][$key]['live_status'] = isset($sourceLiveStatusResult[$value['id']]) ? $sourceLiveStatusResult[$value['id']] : 'ONLINE';
                $projectArr = explode(",", $value['project_id']);
                if (count($projectArr) > 0) {
                    $projectStr = "";
                    $projectStr = $this->modelObj->getSourceProjectList($projectArr);
                    $sourceList['value']['list'][$key]['project_list'] = $projectStr;
                    $sourceList['value']['list'][$key]['project_id'] = $projectArr;
                } else {
                    $sourceList['value']['list'][$key]['project_list'] = "";
                    $sourceList['value']['list'][$key]['project_id'] = [];
                }
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

    public function saveNewSource() {
        $projectArr = array();
        $dataArr = json_decode($this->input->post("data"), TRUE);
        if (isset($dataArr['project_id'])) {
            $projectArr = $dataArr['project_id'];
            if (count($dataArr['project_id']) > 1) {
                $projectArrStr = implode(",", $dataArr['project_id']);
            } else {
                $projectArrStr = isset($dataArr['project_id'][0]) ? $dataArr['project_id'][0] : 0;
            }
            $dataArr['project_id'] = $projectArrStr;
        }
        $saveResult = $this->modelObj->saveNewSource($dataArr);
        $insertId = $saveResult["insert_id"];
        if ($saveResult["status"] == "SUCCESS") {
            $checkStatus = $this->checkSourceStatus($insertId, $dataArr['source_link']);
        }
        if (isset($dataArr['project_id']) && $saveResult["status"] == "SUCCESS" && isset($saveResult["insert_id"])) {
            $backLinkInsertArr = array();
            foreach ($projectArr as $key => $projectId) {
                $backLinkInsertArr[] = array("backlink" => $dataArr['source_link'], "source_id" => $insertId, "project_id" => $projectId, "date" => date("Y-m-d"));
            }
            if (count($backLinkInsertArr) > 0) {
                $this->db->insert_batch("link_status_report", $backLinkInsertArr);
            }
        }
        if (isset($dataArr['topics'])) {
            $tagList = array();
            $tagList = $this->modelObj->getTagList();
            if (!in_array($dataArr['topics'], $tagList['value'])) {
                if ($dataArr['topics'] != '' && $dataArr['topics'] != null) {
                    $saveTagResult = $this->modelObj->saveNewTag(array("tag" => $dataArr['topics']));
                }
            }
        }
        echo json_encode($saveResult);
    }

    public function updateSource() {
        $projectArr = array();
        $dataArr = json_decode($this->input->post("data"), TRUE);
        $updateId = $this->input->post("id");
        unset($dataArr['repassword']);
        if (isset($dataArr['project_id']) && is_array($dataArr['project_id'])) {
            $projectArr = $dataArr['project_id'];
            $projectArrStr = implode(",", $dataArr['project_id']);
            $dataArr['project_id'] = $projectArrStr;
            $updateSourceProject = $this->updateSourceProjectDetails($updateId, $projectArr, $dataArr['source_link'],$dataArr);
        }
        if ($updateId != null && $updateId != '') {
            $updateResult = $this->modelObj->updateSourceDetails($dataArr, $updateId);
            if (isset($dataArr['topics'])) {
                $tagList = array();
                $tagList = $this->modelObj->getTagList();
                if (!in_array($dataArr['topics'], $tagList['value'])) {
                    if ($dataArr['topics'] != '' && $dataArr['topics'] != null) {
                        $saveTagResult = $this->modelObj->saveNewTag(array("tag" => $dataArr['topics']));
                    }
                }
            }
            echo json_encode($updateResult);
        }
    }

    public function checkSourceStatus($source_id, $source_link) {
        $insertArr = array();
        $checkStatus = $this->url_test($source_link);
        if (!$checkStatus) {
            $insertArr[] = array("source_id" => $source_id, "last_checked_date" => date("Y-m-d"), "type" => "OFFLINE");
        } else {
            $insertArr[] = array("source_id" => $source_id, "last_checked_date" => date("Y-m-d"), "type" => "ONLINE");
        }
        if (count($insertArr) > 0) {
            $this->db->insert_batch("broken_source_details", $insertArr);
        }
        return true;
    }

    public function updateSourceProjectDetails($source_id, $projectArr, $sourceLink,$dataArr) {
        $this->db->select("*");
        $this->db->from("link_status_report");
        $this->db->where("status", "TRUE");
        $this->db->where("source_id", $source_id);
        $result = $this->db->get()->result_array();
        if (count($result) > 0) {
            $previousProjectArr = array();
            foreach ($result as $key => $value) {
                $previousProjectArr[] = $value['project_id'];
            }

            $backLinkInsertArr = array();
            foreach ($projectArr as $projectId) {
                if (!in_array($projectId, $previousProjectArr)) {
                    $backLinkInsertArr[] = array("backlink" => $sourceLink, "source_id" => $source_id, "project_id" => $projectId,"name"=>$dataArr['name'],"email"=>$dataArr['email'] , "date" => date("Y-m-d"));
                }
            }
            foreach ($previousProjectArr as $projectId) {
                if (!in_array($projectId, $projectArr)) {
                    $this->db->where('project_id', $projectId);
                    $this->db->where('source_id', $source_id);
                    $updateResult = $this->db->update('link_status_report', array("status" => "FALSE"));
                }
            }
            if (count($backLinkInsertArr) > 0) {
                $this->db->insert_batch("link_status_report", $backLinkInsertArr);
            }
        } else {
            $backLinkInsertArr = array();
            foreach ($projectArr as $key => $projectId) {
                $backLinkInsertArr[] = array("backlink" => $sourceLink, "source_id" => $source_id, "project_id" => $projectId,"name"=>$dataArr['name'],"email"=>$dataArr['email'] ,"date" => date("Y-m-d"));
            }
            if (count($backLinkInsertArr) > 0) {
                $this->db->insert_batch("link_status_report", $backLinkInsertArr);
            }
        }
    }

    public function deleteSource() {
        $deleteId = $this->input->post("id");
        if ($deleteId != null && $deleteId != '') {
            $deleteResult = $this->modelObj->deleteSource($deleteId);
            $this->db->where('source_id', $deleteId);
            $updateResult = $this->db->update('link_status_report', array("status" => "FALSE"));

            echo json_encode($deleteResult);
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
            // return $http_code;, possible too
            return false;
        }
        curl_close($ch);
    }

    public function generateSourceExcel() {
        $sourceList = $this->modelObj->getSourceListExcel();
        if ($sourceList["status"] == "SUCCESS") {
            foreach ($sourceList['value']['list'] as $key => $value) {
                $sourceList['value']['list'][$key]['exact_link'] = $value['source_link'];
                $projectArr = explode(",", $value['project_id']);
                if (count($projectArr) > 0) {
                    $projectStr = "";
                    $projectStr = $this->modelObj->getSourceProjectList($projectArr);
                    $sourceList['value']['list'][$key]['project_list'] = $projectStr;
                } else {
                    $sourceList['value']['list'][$key]['project_list'] = "";
                }
                $sourceList['value']['list'][$key]['source_link'] = $this->getDomainName($value['source_link']);
            }
        }
        if ($sourceList['status'] == 'SUCCESS' && $sourceList['value']['count'] > 0) {
            $objPHPExcel = new PHPExcel();

            $objWorkSheet = $objPHPExcel->createSheet(0);
            $row = 1;
            $col = 0;
            $headingArr = array("S.No", "Source", "Email", "Name", "Topics", "PA", "DA", "Moz Rank", "Project", "Link Type", "Note");
            foreach ($headingArr as $key => $value) {
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value);
                $col++;
            }
            $row++;
            foreach ($sourceList['value']['list'] as $key => $value) {
                $col = 0;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, ($key + 1));
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['source_link']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['email']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['name']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['topics']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['pa']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['da']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['moz_rank']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['link_type']);
                $col++;
                $objWorkSheet->setCellValueByColumnAndRow($col, $row, $value['comment']);
                $row++;
            }


            $objPHPExcel->setActiveSheetIndex(0);
            $fileName = 'exported_sources.xlsx';
            if (ob_get_contents())
                ob_end_clean();
            header('Content-type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=$fileName");
            header("Cache-Control: max-age=0");
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
        } else {
            echo "There are no sources present";
        }
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


        $urlMetricData = $this->getUrlMetricData($sourceLink);

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
        $objectURL = $sourceLink;

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

    public function saveExcel() {

        $excelResult = array();
        if (!empty($_FILES)) {
            $excelResult = $this->coreObj->excelUpload();
            $objPHPExcel = PHPExcel_IOFactory::load($excelResult['value']);
            $sheetData = $objPHPExcel->getActiveSheet(0)->rangeToArray('A1:H10000');
            $headercolArr = array("SOURCE", "NAME", "EMAIL", "TOPICS", "MOBILE NO.", "LINK TYPE", "COMMENT");

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
                    $tmpArr['comment'] = $sheetData[$i][6];
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
