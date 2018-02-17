<?php

class ProjectModel extends CI_Model {

    public function getProjectList() {
        $this->db->select("a.*,b.name as client_name");
        $this->db->from("project_details as a");
        $this->db->join("users as b", "a.client_id = b.id", "LEFT");
        $this->db->where("a.status", "TRUE");
        if ($this->session->user_type == 'CLIENT') {
            $this->db->where("a.client_id", $this->session->user_id);
        }
        $result = $this->db->get()->result_array();
       
        $projectCount = count($result);
        if ($projectCount > 0) {
            foreach ($result as $key => $value) {
                $result[$key]['sourcedetails'] = $this->getTotalProjectSources($value['id']);
                $result[$key]['completed_links'] = $this->getTotalCompletedLinks($value['id']);
                $result[$key]['broken_links'] = $this->getTotalBrokenLinks($value['id']);
            }
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $projectCount), "message" => "Project List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No project Found");
        }
    }
    
     public function getTotalBrokenLinks($projectId) {
        $query= "SELECT count(`a`.`id`) as link_count FROM `broken_links_details` as `a` LEFT JOIN `project_details` as `b` ON `a`.`project_id` = `b`.`id` WHERE DATEDIFF(CURDATE(),`a`.`last_online_date`) > '31' AND `a`.`type`='OFFLINE' AND `b`.`status`='TRUE' AND `a`.project_id='$projectId'";     
        $result = $this->db->query($query)->row_array();
       
        return $result['link_count'];
    }

    public function getTotalProjectSources($projectId) {
        $this->db->select("a.*");
        $this->db->from("source as a");
        $this->db->where("a.project_id", $projectId);
        $this->db->where("a.status", "TRUE");
        $result = $this->db->get()->result_array();
        $sourceCount = count($result);
        if ($sourceCount > 0) {
            return array("count" => $sourceCount, "sourcelist" => $result);
        } else {
            return array("count" => 0, "sourcelist" => []);
        }
    }
    
    public function getTotalCompletedLinks($projectId) {
        $query ="SELECT count(a.id) as completed_count FROM `link_status_report` as `a` JOIN `project_details` as `b` ON `b`.`id`=`a`.`project_id` WHERE `a`.`project_id` = '$projectId' AND MONTH(a.completed_date) = MONTH(CURDATE()) AND `a`.`status` = 'TRUE' AND `a`.`link_status` = 'COMPLETED'";
       
        $result = $this->db->query($query)->row_array();
        return $result['completed_count'];
       
    }

    public function saveNewProjectDetails($dataArr) {
        $result = $this->db->insert("project_details", $dataArr);
        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "project details saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save new project.");
        }
    }

    public function updateProjectDetails($dataArr, $updateId) {
        $this->db->where('id', $updateId);
        $updateResult = $this->db->update('project_details', $dataArr);

        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "project details saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to updae project details.");
        }
    }

    public function deleteProject($deleteId) {
        $this->db->where('id', $deleteId);
        $deleteResult = $this->db->update('project_details', array("status" => 'FALSE'));
        if ($this->db->affected_rows() > 0) {
            return array("status" => "SUCCESS", "value" => "1", "msg" => "project deleted successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to delete project.");
        }
    }

    public function saveUserByExcel($dataArr) {
        $result = $this->db->insert_batch('users', $dataArr);

        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "user details saved successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save user by excel.");
        }
    }

}
