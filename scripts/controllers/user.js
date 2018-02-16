(function () {

    'use strict';
    angular
            .module('app')
            .controller('userCtrl', userCtrl);
    userCtrl.$inject = ['$scope', '$http', '$state'];
    function userCtrl($scope, $http, $state) {
        $scope.user = {'name': '', 'email': '', 'website': '', 'mobile_no': '', 'address': '', 'password': '', 'repassword': '', 'country_id': ''};
        $scope.userList = [];
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

        $scope.getUserList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/user/getuserlist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.userList = jsondata.data.value.list;
                    $scope.userCount = jsondata.data.value.count;
                    
                    angular.forEach($scope.userList, function (value, key) {
                        $scope.userList[key].editMode = false;
                    });
                    
                } else {
                    $scope.countryList = [];
                }

            });
        }

        $scope.getUserList();


        $scope.saveNewUserDetails = function () {
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
//            if (emptyField != '' && keepGoing == false) {
//                $.toast({
//                    heading: 'Please Fill User Details',
//                    text: emptyField,
//                    position: 'top-right',
//                    loaderBg: '#e69a2a',
//                    icon: 'error',
//                    hideAfter: 3500,
//                    stack: 6
//                });
//                return false;
//            }
            $scope.isAjax = true;
            $http({
                method: 'POST',
                url: baseURL + '/user/savenewuser',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.user)),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = false;
                $scope.showNewUser = false;
                alert(jsondata.data.msg);
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.user = {};
                    $scope.getUserList();
                } else {

                }
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

        $scope.updateUserDetails = function (user) {
            $scope.isAjax = true;
            $scope.user.name = user.name;
            $scope.user.email = user.email;
            $scope.user.mobile_no = user.mobile_no;
            $scope.user.address = user.address;
            $scope.user.website = user.website;
            $scope.user.password = user.password;
            $scope.user.repassword = user.password;
            $scope.user.comment = user.comment;
            $http({
                method: 'POST',
                url: baseURL + '/user/updateuser',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.user)) + "&id=" + $scope.updateId,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = true;
                alert(jsondata.data.msg)
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.showNewUser = false;
                    $scope.userList[$scope.index].name = $scope.user.name;
                    $scope.userList[$scope.index].email = $scope.user.email;
                    $scope.userList[$scope.index].mobile_no = $scope.user.mobile_no;
                    $scope.userList[$scope.index].address = $scope.user.address;
                    $scope.userList[$scope.index].website = $scope.user.website;
                    $scope.userList[$scope.index].password = $scope.user.password;
                    $scope.userList[$scope.index].comment = $scope.user.comment;
                    $scope.userList[$scope.index].editMode = false;
                    $scope.user = {};
                } else {

                }
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
