// code style: https://github.com/johnpapa/angular-styleguide 

(function () {
    'use strict';
    angular
            .module('app')

            .controller('mailCtrl', mailCtrl);

    mailCtrl.$inject = ['$scope', '$http', '$rootScope', '$state','$stateParams'];
    function mailCtrl($scope, $http, $rootScope, $state,$stateParams) {
        $scope.mailList = [];
        $scope.mailCount = 0;
        
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
        
        $scope.viewMail = function(client_id){
            $state.go('mail_view',  {'client_id':client_id});
        }
    }

})();
