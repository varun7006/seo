(function () {
   
    'use strict';
    angular
            .module('app')
            .controller('settingsCtrl', settingsCtrl);
    settingsCtrl.$inject = ['$scope', '$http', '$state', '$stateParams'];
    function settingsCtrl($scope, $http, $state, $stateParams) {
        
        $scope.linkTypes = [];
        $scope.linkTypesCount = 0;       
        $scope.link = {'name': $scope.project_id};
        

        $scope.getLinkTypesList = function () {
            $http({
                method: 'POST',
                url: baseURL + '/settings/getlinktypeslist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                   $scope.linkTypes = jsondata.data.value.list;
                   $scope.linkTypesCount = jsondata.data.value.count;
                   angular.forEach($scope.linkTypes, function (value, key) {
                        $scope.linkTypes[key].editMode = false;
                    });
                } else {
                    $scope.sourceReport = [];
                }
            });
        }
        
            $scope.getLinkTypesList();
        
        $scope.addNewLinkType = function () {
            $scope.showNew = true;
            $scope.saveType = "SAVE";
        }
        
        $scope.editLinkType = function (linkObj, index) {
            linkObj.editMode = true;
            $scope.saveType = "UPDATE";
            $scope.updateId = linkObj.id;
            $scope.index = index;

        }

        $scope.saveNewLinkType = function () {
            $http({
                method: 'POST',
                url: baseURL + '/settings/savenewlinktype',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.link)),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                alert(jsondata.data.msg)
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.link = {};
                    $scope.showNew = false;
                   $scope.getLinkTypesList();
                } else {

                }
            });
//            
        }
        
        $scope.updateLinkType = function (link) {
            $scope.isAjax = true;
            $scope.link.name = link.name;
            $http({
                method: 'POST',
                url: baseURL + '/settings/updatelinktype',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.link)) + "&id=" + $scope.updateId,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = true;
                alert(jsondata.data.msg)
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.link = {};
                    $scope.getLinkTypesList();
                } else {

                }
            });
        }

        $scope.cancelLinkType = function (link) {
            $scope.showNew = false;
            link.editMode = false;
            $scope.link = {};
        }
        
        $scope.deleteLinkType = function (id, index) {
            $scope.updateId = id;
            if (confirm("Are you sure you want to delete this Link Type?")) {
                $scope.isAjax = true;
                $http({
                    method: 'POST',
                    url: baseURL + '/settings/deletelinktype',
                    dataType: "JSON",
                    data: "id=" + encodeURIComponent($scope.updateId),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = false;
                    alert(jsondata.data.msg)
                    if (jsondata.data.status == 'SUCCESS') {
                        $scope.linkTypes.splice(index, 1);
                    }
                });
            }
        }



    }
})();