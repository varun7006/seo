<?php

class CoreModel extends CI_Model {

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function excelUpload() {
        if (!empty($_FILES)) {

            $tempFile = $_FILES['file']['tmp_name'];

            $fileType = explode("/", $_FILES['file']['type'])[1];
            
            $targetPath = APPPATH;
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0777, true);
                @chmod($targetPath, 0777);
            }
            if (!is_dir($targetPath)) {
                die('{"status":"ERR","msg":"Unable to create directory"}');
            }
            $filePath = "files/uploadedexcels/" . $_FILES['file']['name'];
            $fileName = $targetPath . $filePath;
            if(file_exists($fileName)){
                unlink($fileName);
            }
            
            if (move_uploaded_file($_FILES['file']['tmp_name'], $fileName)) {
                chmod($fileName,0777);
                $result = array('status' => 'SUCCESS', 'msg' => 'File transfer completed', 'value' => "$fileName", 'filepath' => $filePath);
                return $result;
            } else {
                echo '{"status":"ERR","msg":"Files not written"}';
            }
        } else {
            echo '{"status":"ERR","msg":"Files not uploaded"}';
        }
    }

    public function getCountryList() {
        $this->db->select("id,name");
        $this->db->from("country");
        $this->db->where("status", "TRUE");
        $result = $this->db->get()->result_array();
        if (count($result) > 0) {
            return array("status" => "SUCCESS", "value" => $result, "message" => "country List is present");
        } else {
            return array("status" => "ERR", "value" => array(), "message" => "No country Found");
        }
    }

    

    public function logFunction($log, $module, $log_time, $user_id) {
        if ($this->db->insert('logs', array('log_detail' => $log, 'module' => $module, 'user_id' => $user_id, 'log_on' => $log_time))) {
            return true;
        } else {
            return false;
        }
    }

    public function compareArrayBeforeUpdate($array1, $array2) {

        $differences = array();
        foreach ($array1 as $key => $value) {
            if ($array2[$key] != $value) {
                if ($value == "") {
                    $value = "-";
                }
                $differences[] = $key . ": " . $value . " to " . $array2[$key];
            }
        }
        return $differences;
    }

    public function sendEmailToClient($mail, $attachFile, $EmailContactJson,$ccEmailContactJson, $subject, $msgContent, $dbobj, $traderName) {

        if ($traderName == "NA") {
            return "false";
        } else {

            $mail->IsSMTP();
            $mylink = "<br/>If you do not wish to receive any further emails from us, you may unsubscribe yourself or your group by clicking&nbsp;<a href='#'>here</a>";
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            //$mail->SMTPDebug = 2;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'varunsharma831@gmail.com';
            $mail->Password = 'varunsharma9960';
            $mail->Subject = $subject;
            $msgContent = $msgContent . "<br/><br/><br/><br/>Disclaimer The information contained in this electronic communication is intended solely for the individual(s) or entity to which it is addressed. It may contain proprietary, confidential and/or legally privileged information. Any review, retransmission, dissemination, printing, copying or other use of, or taking any action in reliance on the contents of this information by person(s) or entities other than the intended recipient is strictly prohibited and may be unlawful. If you have received this communication in error, please notify us by responding to this email  immediately and permanently delete all copies of this message and any attachments from your system(s). The contents of this message do not necessarily represent the views or policies of XYZ Solutions.
Computer viruses can be transmitted via email. XYZ Solutions attempts to sweep e-mails and attachments for viruses, it does not guarantee that either are virus free. The recipient should check this email and any attachments for the presence of viruses.  XYZ Solutions does not accept any liability for any damage sustained as a result of viruses." . $mylink;
            $msgContent.="<br/><br/><b>This is an automatically generated email, please do not reply.</b>";
            $mail->MsgHTML($msgContent);

            $mail->SetFrom('varunsharma831@gmail.com', $traderName);
            $mail->AddReplyTo('varunsharma831@gmail.com', $traderName);
            $mail->ClearAddresses();
            $mail->ClearAllRecipients();

            foreach ($EmailContactJson as $val) {
                $mail->AddAddress(trim($val), '');
            }
            foreach ($ccEmailContactJson as $val1) {
                $mail->AddCC(trim($val1), '');
            }
            $mail->AltBody = 'This is a plain-text message body';
            if (count($attachFile) > 0) {
                for ($i = 0; isset($attachFile[$i]); $i++) {
                    if (file_exists(trim($attachFile[$i]))) {
                        $mail->AddAttachment(trim($attachFile[$i]));
                    }
                }
            }
            if (!$mail->Send()) {
                return "false" . $mail->ErrorInfo;
            } else {
                return "true";
            }
        }
    }

}
