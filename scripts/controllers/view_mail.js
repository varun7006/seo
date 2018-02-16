// code style: https://github.com/johnpapa/angular-styleguide 

(function () {
    'use strict';
    angular
            .module('app')

            .controller('viewMailCtrl', mailCtrl);

    mailCtrl.$inject = ['$scope', '$http', '$rootScope', '$state','$stateParams'];
    function mailCtrl($scope, $http, $rootScope, $state,$stateParams) {
        $scope.message = "";
        $scope.mailList = [];
        $scope.mailCount = 0;
        $scope.client_id = $stateParams.client_id;
        
        $scope.getAllMails = function(){
            $http({
                method: 'POST',
                url: baseURL + '/mail/getclientmaillist',
                data : "client_id="+encodeURIComponent($scope.client_id),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.mailList = jsondata.data.value.list;
                    $scope.mailCount = jsondata.data.value.count;
                }

            });
        }
        if (($scope.client_id != '' || $scope.client_id != undefined || $scope.client_id != null)) {
            $scope.getAllMails();
        }
        
        $scope.sendNewMessage = function(){
            var data = {
                message_to : $scope.client_id,
                message :  $scope.message
            }
            if (($scope.message != '' || $scope.message != undefined || $scope.message != null)) {
                $http({
                method: 'POST',
                url: baseURL + '/mail/sendnewmail',
                data : "data="+encodeURIComponent(angular.toJson(data)),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.message = "";
                   $scope.getAllMails();
                }else{
                    alert("Messaage Not sent. Please Try again");
                }

            });
            }
        }
        
        
        
    }

})();
