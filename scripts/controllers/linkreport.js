(function () {
    'use strict';
    angular
            .module('app')
            .controller('linkReportCtrl', linkReportCtrl);
    linkReportCtrl.$inject = ['$scope', '$http', '$state'];
    function linkReportCtrl($scope, $http, $state) {
        $scope.source = {'name': '', 'user_id': '', 'email': '', 'source_link': '', 'mobile_no': '', 'topics': '', 'link_status': ''};
        $scope.sourceList = [];
        $scope.alertArr = {'name': 'Source Name', 'user_id': 'Source User', 'email': 'Source Email', 'source_link': 'Source Link', 'mobile_no': 'Mobile No', 'topics': 'Topics', 'link_status': 'Link Status'};
        $scope.userList = [];
       

    }
})();