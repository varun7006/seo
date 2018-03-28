(function () {

    'use strict';
    angular
            .module('app')
            .controller('settingsCtrl', settingsCtrl);
    settingsCtrl.$inject = ['$scope', '$http', '$state', '$stateParams'];
    function settingsCtrl($scope, $http, $state, $stateParams) {

        $scope.linkTypes = [];
        $scope.linkTypesCount = 0;
        $scope.topicsList = [];
        $scope.topicsCount = 0;
        $scope.link = {'name': $scope.project_id};
        $scope.showAlert = false;
        $scope.alertText = "";
        $scope.alertIcon = "";
        $scope.alertClass = "";

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
                    $scope.linkTypes = [];
                }
            });
        }

        $scope.getLinkTypesList();

        $scope.hideAlert = function () {
            $scope.showAlert = false;
            $scope.alertText = "";
            $scope.alertIcon = "";
            $scope.alertClass = "";
        }

        $scope.getTopicsList = function () {
            $http({
                method: 'POST',
                url: baseURL + '/settings/gettopicslist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.topicsList = jsondata.data.value.list;
                    $scope.topicsCount = jsondata.data.value.count;
//                    angular.forEach($scope.linkTypes, function (value, key) {
//                        $scope.linkTypes[key].editMode = false;
//                    });
                } else {
                    $scope.topicsList = [];
                }
            });
        }

        $scope.getTopicsList();

        $scope.addNewLinkType = function () {
            $scope.showNew = true;
            $scope.saveType = "SAVE";
        }

        $scope.editLinkType = function (linkObj, index) {
            linkObj.editMode = true;
            $scope.saveType = "UPDATE";
            $scope.updateId = linkObj.id;
            $scope.index = index;

        }

        $scope.saveNewLinkType = function () {
            $http({
                method: 'POST',
                url: baseURL + '/settings/savenewlinktype',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.link)),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-check";
                    $scope.alertClass = "alert-success";
                    $scope.link = {};
                    $scope.showNew = false;
                    $scope.getLinkTypesList();
                } else {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-times-circle";
                    $scope.alertClass = "alert-danger";
                }
            });
//            
        }

        $scope.updateLinkType = function (link) {
            $scope.isAjax = true;
            $scope.link.name = link.name;
            $http({
                method: 'POST',
                url: baseURL + '/settings/updatelinktype',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.link)) + "&id=" + $scope.updateId,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = true;
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-check";
                    $scope.alertClass = "alert-success";
                    $scope.link = {};
                    $scope.getLinkTypesList();
                } else {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-times-circle";
                    $scope.alertClass = "alert-danger";
                }
            });
        }

        $scope.cancelLinkType = function (link) {
            $scope.showNew = false;
            link.editMode = false;
            $scope.link = {};
        }

        $scope.deleteLinkType = function (id, index) {
            $scope.updateId = id;
            if (confirm("Are you sure you want to delete this Link Type?")) {
                $scope.isAjax = true;
                $http({
                    method: 'POST',
                    url: baseURL + '/settings/deletelinktype',
                    dataType: "JSON",
                    data: "id=" + encodeURIComponent($scope.updateId),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = false;
                    if (jsondata.data.status == 'SUCCESS') {
                        $scope.showAlert = true;
                        $scope.alertText = jsondata.data.msg;
                        $scope.alertIcon = "fa-check";
                        $scope.alertClass = "alert-success";
                        $scope.linkTypes.splice(index, 1);
                        $scope.linkTypesCount = $scope.linkTypesCount - 1;
                    } else {
                        $scope.showAlert = true;
                        $scope.alertText = jsondata.data.msg;
                        $scope.alertIcon = "fa-times-circle";
                        $scope.alertClass = "alert-danger";
                    }
                });
            }
        }

        $scope.deleteTopic = function (id, index) {
            $scope.updateId = id;
            if (confirm("Are you sure you want to delete this Topic?")) {
                $scope.isAjax = true;
                $http({
                    method: 'POST',
                    url: baseURL + '/settings/deletetopic',
                    dataType: "JSON",
                    data: "id=" + encodeURIComponent($scope.updateId),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = false;
                    if (jsondata.data.status == 'SUCCESS') {
                        $scope.showAlert = true;
                        $scope.alertText = jsondata.data.msg;
                        $scope.alertIcon = "fa-check";
                        $scope.alertClass = "alert-success";
                        $scope.topicsList.splice(index, 1);
                        $scope.topicsCount = $scope.topicsCount - 1;
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