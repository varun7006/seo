<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once APPPATH . "core/mozapi/bootstrap.php";

class SourceApi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("report/ReportModel", "reportObj");
    }

    public function checkSourceStatus() {
        $sourceList = $this->reportObj->getSourceList();
        $checkedSourcesResult = $this->getCheckedSourceList();
        $checkedSourcesIdArr = array();
        if (count($checkedSourcesResult) > 0) {
            foreach ($checkedSourcesResult as $key => $value) {
                $checkedSourcesIdArr[] = $value['source_id'];
            }
        }
        $insertArr = array();
        if ($sourceList['status'] == 'SUCCESS' && $sourceList['value']['count'] > 0) {
            $currentList = array();
            foreach ($sourceList['value']['list'] as $key => $value) {
                if (count($currentList) > 9){
                    break;
                }
                if (!in_array($value['id'], $checkedSourcesIdArr)) {
                    $currentList[] = $value;
                    $checkedSourcesIdArr[] = $value['id'];
                }
            }
            foreach ($currentList as $key => $value) {
                $checkStatus = $this->url_test($value['source_link']);
                if (!$checkStatus) {
                    $insertArr[] = array("source_id" => $value['id'], "last_checked_date" => date("Y-m-d"), "type" => "OFFLINE");
                } else {
                    $insertArr[] = array("source_id" => $value['id'], "last_checked_date" => date("Y-m-d"), "type" => "ONLINE");
                }
            }
        }
        if (count($insertArr) > 0) {
            $this->db->where_not_in('source_id', $checkedSourcesIdArr);
            $this->db->delete("broken_source_details", array("last_checked_date" => date("Y-m-d")));
            $result = $this->db->insert_batch("broken_source_details", $insertArr);
            if ($result > 0) {
                echo json_encode(array("status" => "SUCCESS", "value" => $result, "msg" => "Source Link Status Saved Successfully"));
            } else {
                echo json_encode(array("status" => "ERR", "value" => "-1", "msg" => "Source Link Status Not Saved."));
            }
        }
    }

    public function getCheckedSourceList() {
        $result = $this->db->query("SELECT `a`.* FROM `broken_source_details` as `a` WHERE  `a`.`last_checked_date` = '" . date("Y-m-d") . "'")->result_array();
        if (count($result) > 0) {
            return $result;
        } else {
            return [];
        }
    }
    

    public function checkSourceSeoReport() {
        $sourceList = $this->reportObj->getSourceList();
        $checkedSourcesResult = $this->getCheckedSourceSeoReport();
        
        $checkedSourcesIdArr = array();
        if (count($checkedSourcesResult) > 0) {
            foreach ($checkedSourcesResult as $key => $value) {
                $checkedSourcesIdArr[] = $value['source_id'];
            }
        }
        $insertArr = array();
        if ($sourceList['status'] == 'SUCCESS' && $sourceList['value']['count'] > 0) {
            $currentList = array();
            foreach ($sourceList['value']['list'] as $key => $value) {
                if (count($currentList) > 10){
                    break;
                }
                if (!in_array($value['id'], $checkedSourcesIdArr)) {
                    $currentList[] = $value;
                }
            }
            
            if (count($currentList) > 0) {
                foreach ($currentList as $key => $value) {
                    $insertArr[] = $this->getMozAPiData($value['source_link'], $value);
                }
            }
        }
        if (count($insertArr) > 0) {
            $this->db->where_not_in('source_id', $checkedSourcesIdArr);
            $updateResult = $this->db->update('seo_data', array('status' => 'FALSE'));
            $result = $this->db->insert_batch("seo_data", $insertArr);
            if ($result > 0) {
                echo json_encode(array("status" => "SUCCESS", "value" => $result, "msg" => "Source Link Status Saved Successfully"));
            } else {
                echo json_encode(array("status" => "ERR", "value" => "-1", "msg" => "Source Link Status Not Saved."));
            }
        }else {
                echo json_encode(array("status" => "ERR", "value" => "-1", "msg" => "Nothing to save."));
            }
    }

    public function getCheckedSourceSeoReport() {
        $result = $this->db->query("SELECT `a`.* FROM `seo_data` as `a` WHERE  DATE_FORMAT(`a`.`date`,'%Y-%m') = '" . date("Y-m") . "' AND `a`.`status` = 'TRUE' ")->result_array();
        if (count($result) > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function getMozAPiData($sourceLink, $dataArr) {
        
        // Moz Api Code Starts Here
        $this->AccessID = 'mozscape-52aa25c665';
        // Add your secretKey here
        $this->SecretKey = '8fd4c8750b0125468bcd3da130cae7e9';
        // Set the rate limit
        $this->rateLimit = 10;


        $urlMetricData = $this->getUrlMetricData($sourceLink);

//        $anchorTextData = $this->getAnchorData();
        // Moz Api Code Ends Here
        $reportData = array();
        if (count($urlMetricData) > 0) {
            if (isset($urlMetricData['da']) && isset($urlMetricData['pa'])) {
                $reportData = array("source_id" => $dataArr['id'], "date" => date("Y-m-d"), "moz_rank" => $urlMetricData['moz_rank'], "pa" => $urlMetricData['pa'], "da" => $urlMetricData['da']);
            } else {
                $reportData = array("source_id" => $dataArr['id'], "date" => date("Y-m-d"), "moz_rank" => $urlMetricData['moz_rank'], "pa" => 0, "da" => 0);
            }
        } else {
            $reportData = array("source_id" => $dataArr['id'], "date" => date("Y-m-d"), "moz_rank" => $urlMetricData['moz_rank'], "pa" => 0, "da" => 0);
        }
        return $reportData;
    }

    private function getUrlMetricData($sourceLink) {

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
        sleep(10);
        $mozRank = $urlMetricsService->getUrlMetrics($objectURL, $mozRankCol);
        return array("moz_rank" => $mozRank['umrp'], "pa" => $response['upa'], "da" => $response['pda']);
    }

    public function checkBackLinkStatus() {
        $sourceList = $this->reportObj->getBackLinkList();
        $insertArr = array();
        $checkedSourcesResult = $this->getCheckedBackLinkList();
        $checkedSourcesIdArr = array();
        if (count($checkedSourcesResult) > 0) {
            foreach ($checkedSourcesResult as $key => $value) {
                $checkedSourcesIdArr[] = $value['backlink_id'];
            }
        }
        
        if ($sourceList['status'] == 'SUCCESS' && $sourceList['value']['count'] > 0) {
            $currentList = array();
            foreach ($sourceList['value']['list'] as $key => $value) {
                if (count($currentList) > 9){
                    break;
                }
                if (!in_array($value['id'], $checkedSourcesIdArr)) {
                    $currentList[] = $value;
                    $checkedSourcesIdArr[] = $value['id'];
                }
            }
            
            foreach ($currentList as $key => $value) {
                $checkStatus = $this->url_test($value['backlink']);
                if (!$checkStatus) {
                    $insertArr[] = array("project_id" => $value['project_id'], "backlink_id" => $value['id'], "last_checked_date" => date("Y-m-d"), "type" => "OFFLINE");
                } else {
                    $insertArr[] = array("project_id" => $value['project_id'], "backlink_id" => $value['id'], "last_checked_date" => date("Y-m-d"), "type" => "ONLINE");
                }
            }
        }
        if (count($insertArr) > 0) {
            $this->db->where_not_in('backlink_id', $checkedSourcesIdArr);
            $this->db->delete("broken_links_details", array("last_checked_date" => date("Y-m-d")));
            $result = $this->db->insert_batch("broken_links_details", $insertArr);
            if ($result > 0) {
                echo json_encode(array("status" => "SUCCESS", "value" => $result, "msg" => "Back Link Status Saved Successfully"));
            } else {
                echo json_encode(array("status" => "ERR", "value" => "-1", "msg" => "Back Link Status Not Saved."));
            }
        }  else {
            echo json_encode(array("status" => "ERR", "value" => "-1", "msg" => "Nothing to Saved."));
        }
    }
    
    public function getCheckedBackLinkList() {
        $result = $this->db->query("SELECT `a`.* FROM `broken_links_details` as `a` WHERE  `a`.`last_checked_date` = '" . date("Y-m-d") . "'")->result_array();
        if (count($result) > 0) {
            return $result;
        } else {
            return [];
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

    public function check_back_link($mainUrl, $backLinkUrl) {
        $a = file_get_contents("http://" . trim($mainUrl));
        if (strpos($a, $backLinkUrl)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function url_test($url) {
        $domainUrl = $this->getDomainName($url);
        $firstUrl = "http://www." . $domainUrl;
        $secondUrl = "https://www." . $domainUrl;
        $thirdUrl = "http://" . $domainUrl;
        $fourthUrl = "https://" . $domainUrl;
        $timeout = 10;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $firstUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_setopt($ch, CURLOPT_URL, $secondUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code1 = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_setopt($ch, CURLOPT_URL, $thirdUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code2 = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_setopt($ch, CURLOPT_URL, $fourthUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code3 = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (( $http_code == "200" ) || ( $http_code == "302" ) || ( $http_code1 == "200" ) || ( $http_code1 == "302" ) || ( $http_code2 == "200" ) || ( $http_code2 == "302" ) || ( $http_code3 == "200" ) || ( $http_code3 == "302" )) {
            return true;
        } else {
            return false;
        }
        curl_close($ch);
    }

}
