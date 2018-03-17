<?php

class MailModel extends CI_Model {

    public function getMailList() {
        $query = "SELECT `a`.*,DATE_FORMAT(`a`.`date`,'%d-%m-%Y') as `print_date`,`c`.`id` as `user_id` ,`t2`.`message`,`t2`.`filepath`,`t2`.`parent_mail_id`,`c`.`name` FROM (SELECT * FROM (SELECT * FROM message_details ORDER BY id DESC) AS t1 GROUP BY parent_mail_id) As t2 JOIN `mail_list` as `a` ON `a`.`id` = `t2`.`id` LEFT JOIN `users`as `c` on `a`.`mail_by` = `c`.`id`  WHERE `a`.`mail_to` = '" . $this->session->user_id . "'";
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
        $result = $this->db->insert("mail_list", $dataArr);
        $insertId = $this->db->insert_id();
        if (count($insertId) > 0) {
            return array("status" => "SUCCESS", "value" => $insertId, "msg" => "Mail send successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to send new Mail.");
        }
    }

    public function saveMailTrail($dataArr) {
        $result = $this->db->insert("message_details", $dataArr);
        $insertId = $this->db->insert_id();
        if (count($insertId) > 0) {
            return array("status" => "SUCCESS", "value" => $insertId, "msg" => "Mail send successfully.");
        } else {
            return array("status" => "ERR", "value" => "-1", "msg" => "unable to save new Mail.");
        }
    }

    public function getAllTrailMails($parentMailId, $userId) {
        $query = "SELECT `a`.id,`a`.`mail_to`,`a`.`mail_by`, `b`.`name` as username,`a`.`email`,`a`.message,`a`.`date`,`a`.`timestamp` FROM `mail_list` as `a` JOIN `users` as `b` ON `a`.`mail_by` = `b`.`id` JOIN `message_details` as `c` on `a`.`id` = `c`.`mail_id`   WHERE `c`.`parent_mail_id` = '$parentMailId'";
        $result = $this->db->query($query)->result_array();
        $this->db->select("email");
        $this->db->from("users");
        $this->db->where("id", $userId);
        $replyId = "";
        $replyMaildId = $this->db->get()->row_array();
        if (count($replyMaildId) > 0) {
            $replyId = $replyMaildId['email'];
        } else {
            $replyId = "";
        }
        $mailCount = count($result);
        foreach ($result as $key => $value) {
            $result[$key]['message'] = strip_tags($value['message']);
        }
        if ($mailCount > 0) {
            return array("status" => "SUCCESS", "value" => array("list" => $result, "count" => $mailCount,"replyid"=>$replyId), "message" => "Message List is present");
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
