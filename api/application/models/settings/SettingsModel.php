<?php

class SettingsModel extends CI_Model {

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

    public function getLinkTypesList() {
        $this->db->select("a.*");
        $this->db->from("link_types as a");
        $this->db->where("a.status", "TRUE");
        $result = $this->db->get()->result_array();
        $linkCount = count($result);
        if ($linkCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $linkCount), "message" => "Source List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No Source Found");
        }
    }

    public function getTopicsList() {
        $this->db->select("a.*");
        $this->db->from("tags as a");
        $this->db->where("a.status", "TRUE");
        $result = $this->db->get()->result_array();
        $topicsCount = count($result);
        if ($topicsCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $topicsCount), "message" => "Topics List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No Topics Found");
        }
    }
    
    public function saveNewLinkType($dataArr) {
        $result = $this->db->insert("link_types", $dataArr);
        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "Link Type saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save new Link Type.");
        }
    }
 
    public function updateLinkType($dataArr, $updateId) {
        $this->db->where('id', $updateId);
        $updateResult = $this->db->update('link_types', $dataArr);
        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "Link Type saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to update Link Type.");
        }
    }
    
    public function deleteLinkType($deleteId) {
        $this->db->where('id', $deleteId);
        $deleteResult = $this->db->update('link_types', array("status"=>'FALSE'));
        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "Link Type deleted successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to delete Link Type.");
        }
    }
    
    public function deleteTopic($deleteId) {
        $this->db->where('id', $deleteId);
        $deleteResult = $this->db->update('tags', array("status"=>'FALSE'));
        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "Topic deleted successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to delete Topic.");
        }
    }
    
    
}
