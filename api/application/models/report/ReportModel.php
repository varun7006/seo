<?php

class ReportModel extends CI_Model {

    public function getSourceList() {
        $this->db->select("a.*,b.name as username");
        $this->db->from("source as a");
        $this->db->join("users as b","a.user_id = b.id","LEFT");
        $this->db->where("a.status", "TRUE");
        $result = $this->db->get()->result_array();
        $sourceCount = count($result);
        if ($sourceCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $sourceCount), "message" => "Source List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No Source Found");
        }
    }

    public function getLinkStatusReport($project_id) {
        $this->db->select("a.*,b.project_name");
        $this->db->from("link_status_report as a");
        $this->db->join("project_details as b","a.project_id = b.id");
        $this->db->where("a.status", "TRUE");
        $this->db->where("b.status", "TRUE");
        $this->db->where("a.project_id", $project_id);
        $result = $this->db->get()->result_array();
        
        $sourceCount = count($result);
        if ($sourceCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $sourceCount,"project_name"=>$result[0]['project_name']), "message" => "Source List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No Source Found");
        }
    }
    
    public function saveNewLinkReport($dataArr) {
        $result = $this->db->insert("link_status_report", $dataArr);
        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "Back Link details saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save new Back Link.");
        }
    }
    
    public function saveSourceReportData($dataArr) {
        $result = $this->db->insert("seo_data", $dataArr);
        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "report data saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save new source.");
        }
    }

    public function updateLinkReport($dataArr, $updateId) {
        $this->db->where('id', $updateId);
        $updateResult = $this->db->update('link_status_report', $dataArr);
        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "report  details saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to update report details.");
        }
    }
    
    public function deleteBackLink($deleteId) {
        $this->db->where('id', $deleteId);
        $deleteResult = $this->db->update('link_status_report', array("status"=>'FALSE'));
        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "Backlink deleted successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to delete Backlink.");
        }
    }

    public function saveSourceByExcel($dataArr) {
        $result = $this->db->insert_batch('source',$dataArr);
        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "sources details saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save sources by excel.");
        }
    }
    
    
}
