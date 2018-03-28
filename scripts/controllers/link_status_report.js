(function () {
    'use strict';
    angular
            .module('app')
            .controller('linkStatusReportCtrl', linkStatusReportCtrl);
    linkStatusReportCtrl.$inject = ['$scope', '$http', '$state', '$stateParams'];
    function linkStatusReportCtrl($scope, $http, $state, $stateParams) {
        $scope.project_id = atob($stateParams.project_id);
        $scope.source_type = $stateParams.source_type
        $scope.linkTypes = [];
        $scope.projectList = [];
        $scope.linkTypesCount = 0;
        $scope.sourceReport = [];
        $scope.mainProject = "";
        $scope.searchfield = "";
        $scope.updateId = 0;
        $scope.index = 0;
        $scope.isAjax = false;
        $scope.orderByField = '';
        $scope.reverseSort = false;
        $scope.showNew = false;
        $scope.saveType = "SAVE";
        $scope.showAlert = false;
        $scope.alertText = "";
        $scope.alertIcon = "";
        $scope.alertClass = "";
        $scope.project = [];
        $scope.source = {'project_id': $scope.project_id, 'backlink': '', 'date': '', 'email': '', 'anchor': '', 'name': '', 'target_page': '', 'link_status': '', 'remarks': '', 'link_type': ''};
        $scope.sourceList = [];
        
        $scope.disabled = undefined;
        $scope.searchEnabled = undefined;

        $scope.enable = function () {
            $scope.disabled = false;
        };

        $scope.disable = function () {
            $scope.disabled = true;
        };

        $scope.enableSearch = function () {
            $scope.searchEnabled = true;
        }

        $scope.disableSearch = function () {
            $scope.searchEnabled = false;
        }

        $scope.clear = function () {
            $scope.person.selected = undefined;
            $scope.address.selected = undefined;
            $scope.country.selected = undefined;
        };

        $scope.counter = 0;

//        $scope.availableColors = ['Red', 'Green', 'Blue', 'Yellow', 'Magenta', 'Maroon', 'Umbra', 'Turquoise'];


        $scope.selectedProject = {};
        
        $scope.projectList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/project/getprojectlist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.projectList = jsondata.data.value.list;
                } else {
                    $scope.projectList = [];
                }

            });
        }

        $scope.projectList();

        $scope.changeProject = function(source){
            $scope.project_id = source.id
            $scope.getLinkReport();
        }
        $scope.getLinkReport = function () {
            $scope.isAjax = true;
            $http({
                method: 'POST',
                url: baseURL + '/reports/getlinkstatusreport',
                data: "project_id=" + encodeURIComponent($scope.project_id) + "&source_type=" + encodeURIComponent($scope.source_type),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = false;
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.sourceReport = jsondata.data.value.list;
                    angular.forEach($scope.sourceList, function (value, key) {
                        $scope.sourceReport[key].editMode = false;
                    });
                    $scope.mainProject = jsondata.data.value.project_name;
                } else {
                    $scope.sourceReport = [];
                }
            }).catch(function () {
                $scope.isAjax = false;
            }).finally(function () {
                $scope.isAjax = false;
            });
        }
        if (($scope.project_id != '' || $scope.project_id != undefined || $scope.project_id != null)) {
            $scope.getLinkReport();
        }
        $scope.addNewSource = function () {
            $scope.showNew = true;
            $scope.saveType = "SAVE";
        }

        $scope.editSource = function (sourceObj, index) {
            sourceObj.editMode = true;
            $scope.saveType = "UPDATE";
            $scope.updateId = sourceObj.id;
            $scope.index = index;

        }

        $scope.getLinkTypesList = function () {
            $http({
                method: 'POST',
                url: baseURL + '/settings/getlinktypeslist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.linkTypes = jsondata.data.value.list;
                    $scope.linkTypesCount = jsondata.data.value.count;
                    angular.forEach($scope.linkTypes, function (value, key) {
                        $scope.linkTypes[key].editMode = false;
                    });
                } else {
                    $scope.sourceReport = [];
                }
            });
        }

        $scope.getLinkTypesList();

        $scope.saveNewLinkReportDetails = function () {
            $scope.source.project_id = $scope.project_id;
            $http({
                method: 'POST',
                url: baseURL + '/reports/savenewlinkreport',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.source)),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-check";
                    $scope.alertClass = "alert-success";
                    $scope.source = {};
                    $scope.showNew = false;
                    $scope.getLinkReport();
                } else {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-times-circle";
                    $scope.alertClass = "alert-danger";
                }
            });
//            
        }

        $scope.hideAlert = function () {
            $scope.showAlert = false;
            $scope.alertText = "";
            $scope.alertIcon = "";
            $scope.alertClass = "";
        }

        $scope.updateSourceDetails = function (source) {
            $scope.isAjax = true;
            $scope.source.backlink = source.backlink;
            $scope.source.email = source.email;
            $scope.source.name = source.name;
            $scope.source.date = source.date;
            $scope.source.completed_date = source.completed_date;
            $scope.source.link_status = source.link_status;
            $scope.source.link_type = source.link_type;
            $scope.source.anchor = source.anchor;
            $scope.source.target_page = source.target_page;
            $scope.source.remarks = source.remarks;
            $http({
                method: 'POST',
                url: baseURL + '/reports/updatelinkreport',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.source)) + "&id=" + $scope.updateId,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = false;
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-check";
                    $scope.alertClass = "alert-success";
                    $scope.source = {};
                    $scope.getLinkReport();
                } else {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-times-circle";
                    $scope.alertClass = "alert-danger";
                }
            }).finally(function(){
                $scope.isAjax = false;
            });
        }

        $scope.cancelLinkReport = function (source) {
            $scope.showNew = false;
            source.editMode = false;
            $scope.source = {};
        }

        $scope.deleteSourceBacklink = function (id, index) {
            $scope.updateId = id;
            if (confirm("Are you sure you want to delete this BackLink?")) {
                $scope.isAjax = true;
                $http({
                    method: 'POST',
                    url: baseURL + '/reports/deletebacklink',
                    dataType: "JSON",
                    data: "id=" + encodeURIComponent($scope.updateId),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = false;
//                    alert(jsondata.data.msg)
                    if (jsondata.data.status == 'SUCCESS') {
                        $scope.showAlert = true;
                        $scope.alertText = jsondata.data.msg;
                        $scope.alertIcon = "fa-check";
                        $scope.alertClass = "alert-success";
                        $scope.sourceReport.splice(index, 1);
                    } else {
                        $scope.showAlert = true;
                        $scope.alertText = jsondata.data.msg;
                        $scope.alertIcon = "fa-times-circle";
                        $scope.alertClass = "alert-danger";
                    }
                });
            }
        }



    }
})();
