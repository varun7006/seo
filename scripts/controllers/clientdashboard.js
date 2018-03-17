(function () {

    'use strict';
    angular
            .module('app')
            .controller('clientDashboardCtrl', dashboardCtrl);
    dashboardCtrl.$inject = ['$rootScope', '$scope', '$http', '$state'];
    function dashboardCtrl($rootScope, $scope, $http, $state) {
        $scope.projectList = [];
        $scope.projectCount = 0;
        $scope.sourceList = [];
        $scope.sourceCount = 0;
        $scope.getSourceList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/sources/getsourcelist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.sourceList = jsondata.data.value.list;
                    $scope.sourceCount = jsondata.data.value.count;
                }
            });
        }

        $scope.getSourceList();

        $scope.getProjectList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/project/getprojectlist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.projectList = jsondata.data.value.list;
                    $scope.projectCount = jsondata.data.value.count;
                }
            });
        }

        $scope.getProjectList();


    }
})();