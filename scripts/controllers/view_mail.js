// code style: https://github.com/johnpapa/angular-styleguide 

(function () {
    'use strict';
    angular
            .module('app')

            .controller('viewMailCtrl', mailCtrl);

    mailCtrl.$inject = ['$scope', '$http', '$rootScope', '$state', '$stateParams'];
    function mailCtrl($scope, $http, $rootScope, $state, $stateParams) {
        $scope.message = "";
        $scope.mailList = [];
        $scope.mailCount = 0;
        $scope.parent_mail_id = $stateParams.parent_mail_id;
        $scope.user_id = $stateParams.user_id;
        $scope.reply = false;
        $scope.oneAtATime = true;
        $scope.replyMailId = "";
        $scope.groups = [
            {
                title: "Dynamic Group Header - 1",
                content: "Dynamic Group Body - 1"
            }
        ];

        $scope.getAllMails = function () {
            $http({
                method: 'POST',
                url: baseURL + '/mail/getclientmaillist',
                data: "parent_mail_id=" + encodeURIComponent($scope.parent_mail_id) + "&user_id=" + encodeURIComponent($scope.user_id),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                contentType: "application/json; charset=utf-8"
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.mailList = jsondata.data.value.list;
                    $scope.mailCount = jsondata.data.value.count;
                    $scope.replyMailId = jsondata.data.value.replyid;
                }

            });
        }
        if (($scope.client_id != '' || $scope.client_id != undefined || $scope.client_id != null)) {
            $scope.getAllMails();
        }

        $scope.sendNewMail = function (type) {

            if ($scope.mail.email == '') {
                alert("Please Enter Atleast one Email Id");
                return false;
            }
            if ($scope.mail.message == '') {
                alert("Please Enter Message");
                return false;
            }
            $http({
                method: 'POST',
                data: 'data=' + encodeURIComponent(angular.toJson($scope.mail)) + '&type=' + type,
                url: baseURL + '/mail/sendnewmail',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = false;
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.mailList = jsondata.data.value.list;
                    $scope.mailCount = jsondata.data.value.count;
                }
                $state.go('inbox');

            }).finally(function () {
                $scope.isAjax = false;
            });
        }

        $scope.sendReplyMail = function () {
            $scope.isAjax = true;
            var data = {
                mail_to: $scope.user_id,
                email: $scope.replyMailId,
                message: $scope.message,
                subject:'',
            }
            if (($scope.message != '' || $scope.message != undefined || $scope.message != null)) {
                $http({
                    method: 'POST',
                    data: 'data=' + encodeURIComponent(angular.toJson(data)) + '&type=REPLYMAIL&parent_mail_id='+encodeURIComponent($scope.parent_mail_id),
                    url: baseURL + '/mail/sendnewmail',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = false;
                    alert(jsondata.data.msg);
                    $state.go('inbox');
                }).finally(function(){
                    $scope.isAjax = false;
                });
            } else {
                alert("Please Enter Message ");
            }
        }

        $scope.sendReply = function () {
            $scope.reply = true;
        }
        
        $scope.hideReply = function () {
            $scope.reply = false;
            $scope.message = ''; 
        }

    }

})();
