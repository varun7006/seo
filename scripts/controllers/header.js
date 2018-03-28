// code style: https://github.com/johnpapa/angular-styleguide 

(function () {
    'use strict';
    angular
            .module('app')

            .controller('headerCtrl', headerCtrl);

    headerCtrl.$inject = ['$scope', '$http', '$rootScope', '$state','$localStorage'];
    function headerCtrl($scope, $http, $rootScope, $state,$localStorage) {
        $scope.loginName = localStorage.loginName;
        $scope.loginEmail = localStorage.loginEmail;
        $scope.logout = function () {
            $http({
                method: 'POST',
                url: baseURL + '/login/logoutuser',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $state.go('login');
                } else {
                    $scope.errorMsg = jsondata.data.message;

                }
            });
        }

        $scope.addCustomClass = function () {
            if ($rootScope.menu_class != 'menu-open') {
                $rootScope.menu_class = 'menu-open';
                angular.element(document.querySelector("#body-main")).addClass("menu-open");
            } else {
                $rootScope.menu_class = '';
                angular.element(document.querySelector("#body-main")).removeClass("menu-open");
            }
        };
    }

})();
