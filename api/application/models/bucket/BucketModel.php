<?php

class BucketModel extends CI_Model {

    public function getBucketList() {
        $this->db->select("a.*,'' as task_class ,DATEDIFF(a.date,CURDATE()) as date_diff");
        $this->db->from("bucket_list as a");
        $this->db->where("a.task_status", "PENDING");
        $result = $this->db->get()->result_array();
        $bucketCount = count($result);
        if ($bucketCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $bucketCount), "message" => "user List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No user Found");
        }
    }

    public function saveNewTaskDetails($dataArr) {
        $result = $this->db->insert("bucket_list", $dataArr);
        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "New task saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save new Task.");
        }
    }

    public function updateBucketList($dataArr, $updateId) {
       
        $this->db->where('id', $updateId);
        $updateResult = $this->db->update('bucket_list', $dataArr);
        
        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "Task Updated successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to update task details.");
        }
    }
    
    public function deleteUser($deleteId) {
        $this->db->where('id', $deleteId);
        $deleteResult = $this->db->update('users', array("status"=>'FALSE'));
        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "user deleted successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to delete user.");
        }
    }
    
    public function saveUserByExcel($dataArr) {
        $result = $this->db->insert_batch('users',$dataArr);
       
        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "user details saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save user by excel.");
        }
    }

}
