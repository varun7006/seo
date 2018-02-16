(function () {
    'use strict';
    angular
            .module('app')
            .controller('brokenSourcesCtrl', brokenSourcesCtrl);
    brokenSourcesCtrl.$inject = ['$scope', '$http', '$state','$sce'];
    function brokenSourcesCtrl($scope, $http, $state,$sce) {
        $scope.source = {'name': '', 'user_id': '', 'email': '', 'source_link': '', 'mobile_no': '', 'topics': '', 'link_status': ''};
        $scope.sourceList = [];
        $scope.alertArr = {'name': 'Source Name', 'user_id': 'Source User', 'email': 'Source Email', 'source_link': 'Source Link', 'mobile_no': 'Mobile No', 'topics': 'Topics', 'link_status': 'Link Status'};
        $scope.userList = [];
        $scope.showNewSource = false;
        $scope.sourceCount = 0;
       
        $scope.updateId = 0;
        $scope.index = 0;
        $scope.saveType = "SAVE";
        $scope.searchfield = "";
        $scope.orderByField = '';
        $scope.reverseSort = false;
        $scope.form = [];
        $scope.files = [];
        $scope.iframeLink = "";
        $scope.getBrokenSourceList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/sources/getbrokensourcelist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.sourceList = jsondata.data.value.list;
                    
                    $scope.sourceCount = jsondata.data.value.count;
                }

            });
        }

        $scope.getBrokenSourceList();


        $scope.deleteSource = function (id, index) {
            $scope.updateId = id;
            if (confirm("Are you sure you want to delete this Source?")) {
                $scope.isAjax = false;
                $http({
                    method: 'POST',
                    url: baseURL + '/sources/deletesource',
                    dataType: "JSON",
                    data: "id=" + encodeURIComponent($scope.updateId),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = true;
                    alert(jsondata.data.msg)
                    if (jsondata.data.status == 'SUCCESS') {
                        $scope.sourceList.splice(index, 1);
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

        $scope.uploadedFile = function (element) {
//            $scope.currentFile = element.files[0];

            var reader = new FileReader();
            reader.onload = function (event) {
                $scope.excelFile = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.files = element.files;
                });
            }
            reader.readAsDataURL(element.files[0]);
        }

        $scope.saveExcelData = function () {

            if ($scope.files.length > 0) {
                $scope.form.file = $scope.files[0];
            }
            $http({
                method: 'POST',
                url: baseURL + '/sources/saveexcel',
                processData: false,
                transformRequest: function (data) {
                    var formData = new FormData();
                    if ($scope.files.length > 0) {
                        formData.append("file", $scope.form.file);
                    } else {
                        alert("Please select file to upload.")
                    }
                    return formData;
                },
                data: $scope.form,
                headers: {
                    'Content-Type': undefined
                }

            }).then(function (jsondata) {
                alert(jsondata.data.msg);
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.getSourceList();
                }
            });
        }

        $scope.viewSourceReport = function (sourceid) {
            $state.go('viewsourcereport', {'id': btoa(sourceid)});
        }

        $scope.sendSourceEmailToClient = function (sourceObj, index) {
            if (confirm("Are you sure you want to send mail ?")) {
                $scope.isAjax = true;
                $http({
                    method: 'POST',
                    url: baseURL + '/sources/sendmail',
                    dataType: "JSON",
                    data: "data=" + encodeURIComponent(angular.toJson(sourceObj)),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = false;
                    alert(jsondata.data.msg)

                });
            }
        }


    }
})();