// code style: https://github.com/johnpapa/angular-styleguide 

(function () {
    'use strict';
    angular
            .module('app')

            .controller('mailCtrl', mailCtrl);

    mailCtrl.$inject = ['$scope', '$http', '$rootScope', '$state', '$stateParams'];
    function mailCtrl($scope, $http, $rootScope, $state, $stateParams) {
        $scope.mailList = [];
        $scope.mailCount = 0;
        $scope.mail = {'email': '', 'subject': '', "message": ''};
        $scope.oneAtATime = true;
        $scope.form = [];
        $scope.files = [];
        $scope.groups = [
            {
                title: "Dynamic Group Header - 1",
                content: "Dynamic Group Body - 1"
            }
        ];

        $scope.getMailList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/mail/getmaillist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.mailList = jsondata.data.value.list;
                    $scope.mailCount = jsondata.data.value.count;
                }

            });
        }

        $scope.getMailList();

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

        $scope.sendNewMail = function (type) {
            if ($scope.files.length > 0) {
                $scope.form.file = $scope.files[0];
            }
            if ($scope.mail.email == '') {
                alert("Please Enter Atleast one Email Id");
                $scope.isAjax = false;
                return false;
            }
            if ($scope.mail.message == '') {
                alert("Please Enter Message");
                $scope.isAjax = false;
                return false;
            }
            $scope.isAjax = true;
            $http({
                method: 'POST',
                url: baseURL + '/mail/sendnewmail',
                transformRequest: function (data) {
                    var formData = new FormData();
                    formData.append("data", angular.toJson($scope.mail));
                    formData.append("type", (type));
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
                $scope.isAjax = false;
                alert(jsondata.data.msg);
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.mailList = jsondata.data.value.list;
                    $scope.mailCount = jsondata.data.value.count;
                    $scope.form = [];
                    $scope.files = [];
                }
                $state.go('inbox');

            }).finally(function () {
                $scope.isAjax = false;
            });
        }

        $scope.viewMail = function (parent_mail_id, user_id) {
            $state.go('mail_view', {'parent_mail_id': parent_mail_id, 'user_id': user_id});
        }
    }

})();
