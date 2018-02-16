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
                $.toast({
                    heading: 'Please type email & password',
                    text: 'Login using your email address & password.',
                    position: 'top-right',
                    loaderBg: '#e69a2a',
                    icon: 'error',
                    hideAfter: 3500,
                    stack: 6
                });
            } else {
                $http({
                    method: 'POST',
                    url: baseURL + '/checklogin',
                    dataType: "JSON",
                    data: 'email=' + $scope.email + "&password=" + $scope.password,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    if (jsondata.data.status == 'SUCCESS') {
                        $state.go('dashboard');
                    } else {
                        $.toast({
                            heading: 'Invalid Credentials',
                            text: 'Login using your email address & password.',
                            position: 'top-right',
                            loaderBg: '#e69a2a',
                            icon: 'error',
                            hideAfter: 3500,
                            stack: 6
                        });
                    }
                });
            }

        }


    }
})();