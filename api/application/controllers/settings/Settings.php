<?php

class Settings extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("settings/SettingsModel", "modelObj");
        $this->load->model("core/CoreModel", "coreObj");
    }

    public function viewLinkType() {
        $this->load->view('navigation/navigation');
        $this->load->view('settings/view_link_types');
    }

    public function getLinkTypesList() {
        $linkTypeList = $this->modelObj->getLinkTypesList();
        echo json_encode($linkTypeList);
    }

    public function topicsView() {
        $this->load->view('navigation/navigation');
        $this->load->view('settings/topics_view');
    }

    public function getTopicsList() {
        $topicList = $this->modelObj->getTopicsList();
        echo json_encode($topicList);
    }

    public function saveNewLinkType() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
        $saveResult = $this->modelObj->saveNewLinkType($dataArr);
        echo json_encode($saveResult);
    }

    public function updateLinkType() {
        $dataArr = json_decode($this->input->post("data"), TRUE);
        $updateId = $this->input->post("id");
        if ($updateId != null && $updateId != '') {
            $updateResult = $this->modelObj->updateLinkType($dataArr, $updateId);
            echo json_encode($updateResult);
        }
    }

    public function deleteLinkType() {
        $deleteId = $this->input->post("id");
        if ($deleteId != null && $deleteId != '') {
            $deleteResult = $this->modelObj->deleteLinkType($deleteId);
            echo json_encode($deleteResult);
        }
    }
    
    public function deleteTopic() {
        $deleteId = $this->input->post("id");
        if ($deleteId != null && $deleteId != '') {
            $deleteResult = $this->modelObj->deleteTopic($deleteId);
            echo json_encode($deleteResult);
        }
    }

}
