(function () {
    'use strict';
    angular
            .module('app')
            .controller('projectCtrl', appCtrl);
    appCtrl.$inject = ['$scope', '$http', '$state'];
    function appCtrl($scope, $http, $state) {
        $scope.project = {'project_name': '', 'client_id': ''};
        $scope.projectList = [];
        
        $scope.userList = [];
        $scope.showNewProject = false;
        $scope.projectCount = 0;
        $scope.updateId = 0;
        $scope.index = 0;
        $scope.saveType = "SAVE";
        $scope.searchfield = "";
        $scope.orderByField = '';
        $scope.reverseSort = false;
        $scope.form = [];
        $scope.files = [];
        $scope.getProjectList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/project/getprojectlist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.projectList = jsondata.data.value.list;
                    angular.forEach($scope.projectList, function (value, key) {
                        $scope.projectList[key].editMode = false;
                    });
                    $scope.projectCount = jsondata.data.value.count;
                }

            });
        }

        $scope.getProjectList();


        $scope.saveNewProjectDetails = function () {
            $http({
                method: 'POST',
                url: baseURL + '/project/savenewproject',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.project)),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                alert(jsondata.data.msg)
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.project = {};
                    $scope.showNewProject = false;
                    $state.go('project')
                } else {

                }
            });
//            
        }


        $scope.addNewProject = function () {
            $scope.showNewProject = true;
        }

        $scope.editProject = function (projectObj, index) {
            projectObj.editMode = true;
            
//            $scope.showNewProject = true;
            $scope.saveType = "UPDATE";
            $scope.updateId = projectObj.id;
            $scope.index = index;

        }

        $scope.updateProjectDetails = function (projectObj) {
            $scope.isAjax = true;
            
            $scope.project.project_name = projectObj.project_name;
            $scope.project.client_id = projectObj.client_id;
            $scope.project.comment = projectObj.comment;
            
            $http({
                method: 'POST',
                url: baseURL + '/project/updateproject',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.project)) + "&id=" + $scope.updateId,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = false;
                alert(jsondata.data.msg)
                $scope.showNewProject = false;
                projectObj.editMode = false;
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.showNewProject = false;
                    $scope.projectList[$scope.index].project_name = $scope.project.project_name;
                    $scope.projectList[$scope.index].client_id = $scope.project.client_id;
//                    $scope.projectList[$scope.index].client_name = 
                    $scope.projectList[$scope.index].editMode = false;
                    $scope.project = {};
                }
            });
        }

        $scope.cancelProject  = function (project) {
            $scope.showNewProject = false;
            project.editMode = false;
            $scope.project = {};
        }

        $scope.deleteProject  = function (id, index) {
            $scope.updateId = id;
            if (confirm("Are you sure you want to delete this Project?")) {
                $scope.isAjax = false;
                $http({
                    method: 'POST',
                    url: baseURL + '/project/deleteproject',
                    dataType: "JSON",
                    data: "id=" + encodeURIComponent($scope.updateId),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = true;
                    alert(jsondata.data.msg)
                    if (jsondata.data.status == 'SUCCESS') {
                        $scope.projectList.splice(index, 1);
                    }
                });
            }
        }

        $scope.getUserList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/user/getuserlist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.userList = jsondata.data.value.list;
                } else {
                    $scope.userList = [];
                }

            });
        }

        $scope.getUserList();

        $scope.viewLinkStatusReport = function (project) {
           $state.go('link_status_report', {'project_id': btoa(project.id)});
        }

    }
})();