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
            }
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $projectCount), "message" => "Project List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No project Found");
        }
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
