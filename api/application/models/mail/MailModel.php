<?php

class MailModel extends CI_Model {

    public function getMailList() {
        $query = "SELECT * FROM ((SELECT `a`.id,`a`.`message_to`,`a`.`message_by`, `b`.`name` as username,`a`.`email`,`a`.message,`a`.`date`,`a`.`timestamp` FROM `message_details` as `a` JOIN `users` as `b` ON `a`.`message_by` = `b`.`id` WHERE `a`.`message_to` = '" . $this->session->user_id . "' group by `a`.`message_by`)As t1 RIGHT JOIN `users` as `b` on `t1`.`message_by` = `b`.`id`) WHERE `b`.`id` != '" . $this->session->user_id . "' ";
        $result = $this->db->query($query)->result_array();

        $mailCount = count($result);
        if ($mailCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $mailCount), "message" => "Message List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No Message Found");
        }
    }

    public function getBrokenSourceList() {
        $query = "SELECT `a`.*, `b`.`source_link` as `source_link` FROM `broken_source_details` as `a` LEFT JOIN `source` as `b` ON `a`.`source_id` = `b`.`id` WHERE DATEDIFF(CURDATE(),`a`.`last_online_date`) > '31' AND `a`.`type`='OFFLINE' AND `b`.`status`='TRUE'";
        $result = $this->db->query($query)->result_array();

        $sourceCount = count($result);
        if ($sourceCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $sourceCount), "message" => "Source List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No Source Found");
        }
    }

    public function sendNewMail($dataArr) {
        $result = $this->db->insert("message_details", $dataArr);
        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "msg" => "message send successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save new source.");
        }
    }

    public function getAllClientMails($clientId) {
        $query = "SELECT `a`.id,`a`.`message_to`,`a`.`message_by`, `b`.`name` as username,`a`.`email`,`a`.message,`a`.`date`,`a`.`timestamp` FROM `message_details` as `a` JOIN `users` as `b` ON `a`.`message_by` = `b`.`id` WHERE (`a`.`message_to` = '" . $this->session->user_id . "' AND `a`.`message_by` = '" . $clientId . "') OR (`a`.`message_by` = '" . $this->session->user_id . "' AND `a`.`message_to` = '" . $clientId . "') group by `a`.`id` order by a.`timestamp` ";
        $result = $this->db->query($query)->result_array();

        $mailCount = count($result);
        if ($mailCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $mailCount), "message" => "Message List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No Message Found");
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

}
