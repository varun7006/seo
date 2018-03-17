(function () {
    'use strict';
    angular
            .module('app')
            .controller('sourceReportCtrl', sourceReportCtrl);
    sourceReportCtrl.$inject = ['$scope', '$http', '$state', '$stateParams'];
    function sourceReportCtrl($scope, $http, $state, $stateParams) {
        $scope.sourceId = atob($stateParams.id)
        $scope.sourceReport = [];
        $scope.isAjax = false;
        $scope.source = {'name': '', 'user_id': '', 'email': '', 'source_link': '', 'mobile_no': '', 'topics': '', 'link_status': ''};
        $scope.sourceList = [];
        if (($scope.sourceId != '' || $scope.sourceId != undefined || $scope.sourceId != null)) {
            $http({
                method: 'POST',
                url: baseURL + '/sources/getsourcereport',
                data: "id=" + encodeURIComponent($scope.sourceId),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.sourceReport = jsondata.data.value;
                } else {
                    $scope.sourceReport = [];
                }
            });
        }





        $scope.generateManualSourceReport = function (sourceObj,index) {

            $scope.isAjax = true;
            $http({
                method: 'POST',
                url: baseURL + '/sources/generate_source_report_manually',
                dataType: "JSON",
                data: "data=" + encodeURIComponent(angular.toJson(sourceObj)),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = false;
                alert(jsondata.data.msg)
                if(jsondata.data.status=='SUCCESS'){
                    $scope.sourceReport[index].pa = jsondata.data.value.pa;
                    $scope.sourceReport[index].da = jsondata.data.value.da;
                    $scope.sourceReport[index].moz_rank = jsondata.data.value.moz_rank;
                }

            }).catch(function (err) {
                $scope.isAjax = false;
                alert("Problem in Deleting BIll. Please contact to Admin")
            }).finally(function (jsondata) {
                $scope.isAjax = false;
            });

        }


    }
})();