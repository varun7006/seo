<?php

class SourceModel extends CI_Model {

    public function getSourceList($fromLimit, $toLimit) {
        if ($this->session->user_type == 'CLIENT') {
            $query = "SELECT `a`.*, `b`.`name` as `username`, `c`.`pa`, `c`.`da`, `c`.`moz_rank`, `c`.`citation_flow`, `c`.`trust_flow`, `c`.`category`,`e`.`name` as link_type FROM `source` as `a` LEFT JOIN `users` as `b` ON `a`.`user_id` = `b`.`id` LEFT JOIN `seo_data` as `c` ON `a`.`id` = `c`.`source_id`  LEFT JOIN `link_types` as `e` ON `a`.`link_type` = `e`.`id` WHERE `a`.`status` = 'TRUE' AND (`c`.`status`='TRUE' OR `c`.`status` is null) AND (`e`.`status`='TRUE' OR `e`.`status` is null) AND `a`.`user_id`='" . $this->session->user_id . "' LIMIT $fromLimit,$toLimit";
        } else {
            $query = "SELECT `a`.*, `b`.`name` as `username`, `c`.`pa`, `c`.`da`, `c`.`moz_rank`, `c`.`citation_flow`, `c`.`trust_flow`, `c`.`category`,`e`.`name` as link_type FROM `source` as `a` LEFT JOIN `users` as `b` ON `a`.`user_id` = `b`.`id` LEFT JOIN `seo_data` as `c` ON `a`.`id` = `c`.`source_id`  LEFT JOIN `link_types` as `e` ON `a`.`link_type` = `e`.`id` WHERE `a`.`status` = 'TRUE' AND (`c`.`status`='TRUE' OR `c`.`status` is null) AND (`e`.`status`='TRUE' OR `e`.`status` is null) LIMIT $fromLimit,$toLimit";
        }
        $result = $this->db->query($query)->result_array();

        if ($this->session->user_type == 'CLIENT') {
            $countQuery = "SELECT `a`.*, `b`.`name` as `username`, `c`.`pa`, `c`.`da`, `c`.`moz_rank`, `c`.`citation_flow`, `c`.`trust_flow`, `c`.`category`,`e`.`name` as link_type FROM `source` as `a` LEFT JOIN `users` as `b` ON `a`.`user_id` = `b`.`id` LEFT JOIN `seo_data` as `c` ON `a`.`id` = `c`.`source_id`  LEFT JOIN `link_types` as `e` ON `a`.`link_type` = `e`.`id` WHERE `a`.`status` = 'TRUE' AND (`c`.`status`='TRUE' OR `c`.`status` is null) AND (`e`.`status`='TRUE' OR `e`.`status` is null) AND `a`.`user_id`='" . $this->session->user_id . "' ";
        } else {
            $countQuery = "SELECT `a`.*, `b`.`name` as `username`, `c`.`pa`, `c`.`da`, `c`.`moz_rank`, `c`.`citation_flow`, `c`.`trust_flow`, `c`.`category`,`e`.`name` as link_type FROM `source` as `a` LEFT JOIN `users` as `b` ON `a`.`user_id` = `b`.`id` LEFT JOIN `seo_data` as `c` ON `a`.`id` = `c`.`source_id`  LEFT JOIN `link_types` as `e` ON `a`.`link_type` = `e`.`id` WHERE `a`.`status` = 'TRUE' AND (`c`.`status`='TRUE' OR `c`.`status` is null) AND (`e`.`status`='TRUE' OR `e`.`status` is null)";
        }
        $countResult = $this->db->query($countQuery)->result_array();
        $sourceCount = count($countResult);
        if ($sourceCount > 0) {
            $i = $fromLimit + 1;
            foreach ($result as $key => $value) {
                $result[$key]['sn'] = $i;
                $i++;
            }
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $sourceCount), "message" => "Source List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No Source Found");
        }
    }
    
    public function getSourceListExcel() {
        if ($this->session->user_type == 'CLIENT') {
            $query = "SELECT `a`.*, `b`.`name` as `username`, `c`.`pa`, `c`.`da`, `c`.`moz_rank`, `c`.`citation_flow`, `c`.`trust_flow`, `c`.`category`,`e`.`name` as link_type FROM `source` as `a` LEFT JOIN `users` as `b` ON `a`.`user_id` = `b`.`id` LEFT JOIN `seo_data` as `c` ON `a`.`id` = `c`.`source_id`  LEFT JOIN `link_types` as `e` ON `a`.`link_type` = `e`.`id` WHERE `a`.`status` = 'TRUE' AND (`c`.`status`='TRUE' OR `c`.`status` is null) AND (`e`.`status`='TRUE' OR `e`.`status` is null) AND `a`.`user_id`='" . $this->session->user_id . "'";
        } else {
            $query = "SELECT `a`.*, `b`.`name` as `username`, `c`.`pa`, `c`.`da`, `c`.`moz_rank`, `c`.`citation_flow`, `c`.`trust_flow`, `c`.`category`,`e`.`name` as link_type FROM `source` as `a` LEFT JOIN `users` as `b` ON `a`.`user_id` = `b`.`id` LEFT JOIN `seo_data` as `c` ON `a`.`id` = `c`.`source_id`  LEFT JOIN `link_types` as `e` ON `a`.`link_type` = `e`.`id` WHERE `a`.`status` = 'TRUE' AND (`c`.`status`='TRUE' OR `c`.`status` is null) AND (`e`.`status`='TRUE' OR `e`.`status` is null)";
        }
        $result = $this->db->query($query)->result_array();
        $sourceCount = count($result);
        if ($sourceCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $sourceCount), "message" => "Source List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No Source Found");
        }
    }
    
    public function getSourceProjectList($projectArr) {
        $this->db->select("a.*");
        $this->db->from("project_details as a");
        $this->db->where_in("id", $projectArr);
        $result = $this->db->get()->result_array();
        $str = "";
        if (count($result) > 0) {
            foreach ($result as $key => $value) {
                $str .= $value['project_name'] . ", ";
            }
            $str = substr($str, 0, -2);
            return $str;
        } else {
            return $str;
        }
    }

    public function getTagList() {
        $this->db->select("a.*");
        $this->db->from("tags as a");
        $result = $this->db->get()->result_array();
        if ($result > 0) {
            $finalArr = array();
            foreach ($result as $key => $value) {
                $finalArr[] = $value['tag'];
            }
            return array("status" => "SUCCESS", "value" => $finalArr, "message" => "Tag List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "Tag List Not Found");
        }
    }

    public function saveNewTag($dataArr) {
        $result = $this->db->insert("tags", $dataArr);

        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "Tag saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save new Tag.");
        }
    }

    public function getBrokenSourceList() {
        $query = "SELECT `a`.*, `b`.`source_link` as `source_link` FROM `broken_source_details` as `a` LEFT JOIN `source` as `b` ON `a`.`source_id` = `b`.`id` WHERE `a`.`type`='OFFLINE' AND `b`.`status`='TRUE' AND a.`last_checked_date`='" . date('Y-m-d') . "'";
        $result = $this->db->query($query)->result_array();

        $sourceCount = count($result);
        if ($sourceCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $sourceCount), "message" => "Source List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No Source Found");
        }
    }

    public function saveNewSource($dataArr) {
        $result = $this->db->insert("source", $dataArr);
        $insertId = $this->db->insert_id();
        if ($insertId > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "source details saved successfully.", "insert_id" => $insertId);
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save new source.", "insert_id" => "-1");
        }
    }

    public function saveSourceReportData($dataArr) {

        $this->db->where('source_id', $dataArr['source_id']);
        $updateResult = $this->db->update('seo_data', array('status' => 'FALSE'));

        $result = $this->db->insert("seo_data", $dataArr);
        $insertId = $this->db->insert_id();
        if ($insertId > 0) {
            return array("status" => "SUCCESS", "value" => $dataArr, "msg" => "report data saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save new source.");
        }
    }

    public function updateSourceDetails($dataArr, $updateId) {
        $this->db->where('id', $updateId);
        $updateResult = $this->db->update('source', $dataArr);
        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "source details saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to updae source details.");
        }
    }

    public function deleteSource($deleteId) {
        $this->db->where('id', $deleteId);
        $deleteResult = $this->db->update('source', array("status" => 'FALSE'));
        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "source deleted successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to delete source.");
        }
    }

    public function saveSourceByExcel($dataArr) {
        $result = $this->db->insert_batch('source', $dataArr);

        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "sources details saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save sources by excel.");
        }
    }

    public function getSourceReportDetails($sourceId) {
        $this->db->select("a.*,b.source_link as source_link,b.comment");
        $this->db->from("seo_data as a");
        $this->db->join("source as b", "a.source_id = b.id");
        $this->db->where("a.status", "TRUE");
        $this->db->where("b.id", $sourceId);
        $result = $this->db->get()->result_array();
        if ($result > 0) {
            return array("status" => "SUCCESS", "value" => $result, "message" => "Source Report is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "Source Report Not Found");
        }
    }

}
