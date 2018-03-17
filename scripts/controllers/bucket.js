(function () {

    'use strict';
    angular
            .module('app')
            .controller('bucketCtrl', appCtrl);
    appCtrl.$inject = ['$scope', '$http', '$state'];
    function appCtrl($scope, $http, $state) {
        $scope.task = {task_name:'',date:''};
        $scope.bucketList = [];
        $scope.countryList = [];
        $scope.showNewUser = false;
        $scope.userCount = 0;
        $scope.updateId = 0;
        $scope.index = 0;
        $scope.searchfield = "";
        $scope.saveType = "SAVE";
        $scope.isAjax = false;
        $scope.form = [];
        $scope.files = [];
        $scope.showModal = false;
        $scope.orderByField = '';
        $scope.reverseSort = false;
        $scope.showModal = function () {
            $scope.showModal = true;
        }

        $scope.getBucketList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/bucket/getbucketlist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.bucketList = jsondata.data.value.list;
                    $scope.bucketCount = jsondata.data.value.count;

//                    angular.forEach($scope.userList, function (value, key) {
//                        $scope.userList[key].editMode = false;
//                    });
//                    
                }else{
                    $scope.bucketList = [];
                }

            });
        }

        $scope.getBucketList();


        $scope.saveNewTask = function () {
            var keepGoing = true;
            var emptyField = '';
            angular.forEach($scope.user, function (value, key) {
                if (keepGoing) {
                    if (value == null || value == '') {
                        keepGoing = false;
                        emptyField = key;
                    }
                }
            });

            $scope.isAjax = true;
            $http({
                method: 'POST',
                url: baseURL + '/bucket/savenewtask',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.task)),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = false;
                $scope.showNewUser = false;
                alert(jsondata.data.msg);
                $state.go('dashboard');
            });
//            
        }


        $scope.addNewUser = function () {
            $scope.showNewUser = true;
            $scope.saveType = "SAVE";
        }

        $scope.editUser = function (user, index) {
            user.editMode = true;
//            $scope.showNewUser = true;
            $scope.saveType = "UPDATE";
            $scope.updateId = user.id;
            $scope.index = index;

        }

        $scope.updateTaskDetails = function () {
            $http({
                method: 'POST',
                url: baseURL + '/bucket/updatetask',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.bucketList)),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = true;
                alert(jsondata.data.msg)
                $scope.getBucketList();
            });
        }

        $scope.cancelUser = function (user) {
            $scope.showNewUser = false;
            user.editMode = false;
            $scope.user = {};
        }

        $scope.deleteUser = function (id, index) {
            $scope.updateId = id;
            if (confirm("Are you sure you want to delete this user?")) {
                $scope.isAjax = true;
                $http({
                    method: 'POST',
                    url: baseURL + '/user/deleteuser',
                    dataType: "JSON",
                    data: "id=" + encodeURIComponent($scope.updateId),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = false;
                    if (jsondata.data.status == 'SUCCESS') {
                        $scope.userList.splice(index, 1);
                    }
                });
            }
        }

        $scope.getCountryList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/core/getcountrylist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.countryList = jsondata.data.value;
                } else {
                    $scope.countryList = [];
                }

            });
        }



        $scope.getCountryList();

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
                url: baseURL + '/user/saveexcel',
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
                    $scope.getUserList();
                }
            });
        }

    }


})();
