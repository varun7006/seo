(function () {
    'use strict';
    angular
            .module('app')
            .controller('loginCtrl', loginCtrl);
    loginCtrl.$inject = ['$scope', '$http', '$state'];
    function loginCtrl($scope, $http, $state) {
        $scope.email = "";
        $scope.password = "";

        $scope.checkUserLogin = function () {
            if ($scope.email == '' || $scope.password == '') {

            } else {
                $http({
                    method: 'POST',
                    url: baseURL + '/checklogin',
                    dataType: "JSON",
                    data: 'email=' + $scope.email + "&password=" + $scope.password,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    if (jsondata.data.status == 'SUCCESS') {
                        if (jsondata.data.value.user_type == 'ADMIN') {
                            $state.go('dashboard');
                        } else {
                            $state.go('clientdashboard');
                        }
                    } else {

                    }
                });
            }

        }


    }
})();