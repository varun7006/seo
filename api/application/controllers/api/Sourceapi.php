<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

class SourceApi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("report/ReportModel", "reportObj");
    }

    public function checkSourceStatus() {
        $sourceList = $this->reportObj->getSourceList();
        if ($sourceList['status'] == 'SUCCESS' && $sourceList['value']['count'] > 0) {
            foreach ($sourceList['value']['list'] as $key => $value) {
                if (!$checkStatus) {
                    echo $website . " is down!";
                } else {
                    echo $website . " is up!";
                }
            }
        }

        $checkStatus = $this->url_test($website);
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

}
