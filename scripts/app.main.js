/**
 * @ngdoc function
 * @name app.controller:AppCtrl
 * @description
 * # MainCtrl
 * Controller of the app
 */

(function () {
    'use strict';
    angular
            .module('app')
            .run(function ($rootScope) {
                $rootScope.menu_class = '';
            })
            .factory('httpRequestInterceptor', function ($q, $location) {
                return {
                    'responseError': function (rejection) {
                        if (rejection.status === 401) {
                            alert('Session Expired.Please login again');
                            window.location.href = baseURLLogin;
                        }

                        return $q.reject(rejection);
                    }
                };

            })
})();



(function () {
    'use strict';
    angular
            .module('app')
            .controller('AppCtrl', AppCtrl);

    AppCtrl.$inject = ['$scope', '$http'];

    function AppCtrl($rootScope, $scope, $http) {




    }

})();

