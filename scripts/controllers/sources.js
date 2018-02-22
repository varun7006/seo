(function () {
    'use strict';
    angular
            .module('app')
            .controller('sourcesCtrl', sourcesCtrl);
    sourcesCtrl.$inject = ['$scope', '$http', '$state', '$sce'];
    function sourcesCtrl($scope, $http, $state, $sce) {
        $scope.tags = [];
        $scope.linkTypes = [];
        $scope.linkTypesCount = 0;
        $scope.tag = {
            selected: ''
        };

        $scope.$watch('tag.selected', function (newVal, oldVal) {
            if (newVal !== oldVal) {
                if ($scope.tags.indexOf(newVal) === -1) {
                    $scope.tags.unshift(newVal);
                }
            }
        });

        $scope.getTags = function (search) {
            var newSupes = $scope.tags.slice();
            if (search && newSupes.indexOf(search) === -1) {
                newSupes.unshift(search);
            }
            return newSupes;
        }
        $scope.getTagList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/sources/gettaglist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.tags = jsondata.data.value;
                }

            });
        }

        $scope.getTagList();

        $scope.tags.sort();

        $scope.source = {'name': '', 'user_id': '', 'email': '', 'source_link': '', 'mobile_no': '', 'topics': '', 'link_status': '','link_type':'','project_id':[]};
        $scope.sourceList = [];
        $scope.alertArr = {'name': 'Source Name', 'user_id': 'Source User', 'email': 'Source Email', 'source_link': 'Source Link', 'mobile_no': 'Mobile No', 'topics': 'Topics', 'link_status': 'Link Status'};
        $scope.userList = [];
        $scope.projectList = [];
        $scope.showNewSource = false;
        $scope.sourceCount = 0;
        $scope.updateId = 0;
        $scope.index = 0;
        $scope.saveType = "SAVE";
        $scope.searchfield = "";
        $scope.orderByField = '';
        $scope.reverseSort = false;
        $scope.form = [];
        $scope.files = [];
        $scope.iframeLink = "";
        $scope.getSourceList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/sources/getsourcelist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.sourceList = jsondata.data.value.list;
                    angular.forEach($scope.sourceList, function (value, key) {
                        $scope.sourceList[key].editMode = false;
                    });
                    $scope.sourceCount = jsondata.data.value.count;
                }

            });
        }

        $scope.getSourceList();

        $scope.getIframeSrc = function (link) {
            $scope.iframeLink = $sce.trustAsResourceUrl(link);
        }

        $scope.saveNewSourceDetails = function () {
            var keepGoing = true;
            var emptyField = '';
            angular.forEach($scope.source, function (value, key) {
                if (keepGoing) {
                    if (value == null || value == '') {
                        keepGoing = false;
                        emptyField = $scope.alertArr[key];
                    }
                }
            });
            $scope.source.topics = $scope.tag.selected;
            $http({
                method: 'POST',
                url: baseURL + '/sources/savenewsource',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.source)),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                alert(jsondata.data.msg)
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.source = {};
                    $scope.showNewSource = false;
                    $scope.getSourceList();
                } else {

                }
            });
//            
        }


        $scope.addNewSource = function () {
            $scope.showNewSource = true;
            $scope.saveType = "SAVE";
        }

        $scope.editSource = function (sourceObj, index) {
            sourceObj.editMode = true;

//            $scope.showNewSource = true;
            $scope.saveType = "UPDATE";
            $scope.updateId = sourceObj.id;
            $scope.index = index;

        }

        $scope.updateSourceDetails = function (sourceObj) {
            $scope.isAjax = true;
            $scope.source.name = sourceObj.name;
            $scope.source.email = sourceObj.email;
            $scope.source.source_link = sourceObj.source_link;
            $scope.source.topics = sourceObj.topics;
            $scope.source.mobile_no = sourceObj.mobile_no;
            $scope.source.link_text = sourceObj.link_text;
            $scope.source.link_type = sourceObj.link_type;
            $scope.source.link_target = sourceObj.link_target;
            $scope.source.link_status = sourceObj.link_status;
            $scope.source.comment = sourceObj.comment;

            $http({
                method: 'POST',
                url: baseURL + '/sources/updatesource',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.source)) + "&id=" + $scope.updateId,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = false;
                alert(jsondata.data.msg)
                $scope.showNewSource = false;
                sourceObj.editMode = false;
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.showNewSource = false;
                    $scope.sourceList[$scope.index].name = $scope.source.name;
                    $scope.sourceList[$scope.index].email = $scope.source.email;
                    $scope.sourceList[$scope.index].mobile_no = $scope.source.mobile_no;
                    $scope.sourceList[$scope.index].source_link = $scope.source.source_link;
                    $scope.sourceList[$scope.index].link_text = $scope.source.link_text;
                    $scope.sourceList[$scope.index].link_type = $scope.source.link_type;
                    $scope.sourceList[$scope.index].link_target = $scope.source.link_target;
                    $scope.sourceList[$scope.index].link_status = $scope.source.link_status;
                    $scope.sourceList[$scope.index].comment = $scope.source.comment;
                    $scope.sourceList[$scope.index].editMode = false;
                    $scope.source = {};
                }
            });
        }

        $scope.cancelSource = function (source) {
            $scope.showNewSource = false;

            source.editMode = false;

            $scope.source = {};
        }

        $scope.deleteSource = function (id, index) {
            $scope.updateId = id;
            if (confirm("Are you sure you want to delete this Source?")) {
                $scope.isAjax = false;
                $http({
                    method: 'POST',
                    url: baseURL + '/sources/deletesource',
                    dataType: "JSON",
                    data: "id=" + encodeURIComponent($scope.updateId),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = true;
                    alert(jsondata.data.msg)
                    if (jsondata.data.status == 'SUCCESS') {
                        $scope.sourceList.splice(index, 1);
                    }
                });
            }
        }

        $scope.getUserList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/user/getuserlist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.userList = jsondata.data.value.list;
                } else {
                    $scope.userList = [];
                }

            });
        }


        $scope.projectList = function () {
            $http({
                method: 'GET',
                url: baseURL + '/project/getprojectlist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.projectList = jsondata.data.value.list;
                } else {
                    $scope.projectList = [];
                }

            });
        }

        $scope.projectList();

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

        $scope.uploadedFile = function (element) {
//            $scope.currentFile = element.files[0];

            var reader = new FileReader();
            reader.onload = function (event) {
                $scope.excelFile = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.files = element.files;
                });
            }
            reader.readAsDataURL(element.files[0]);
        }

        $scope.saveExcelData = function () {

            if ($scope.files.length > 0) {
                $scope.form.file = $scope.files[0];
            }
            $http({
                method: 'POST',
                url: baseURL + '/sources/saveexcel',
                processData: false,
                transformRequest: function (data) {
                    var formData = new FormData();
                    if ($scope.files.length > 0) {
                        formData.append("file", $scope.form.file);
                    } else {
                        alert("Please select file to upload.")
                    }
                    return formData;
                },
                data: $scope.form,
                headers: {
                    'Content-Type': undefined
                }

            }).then(function (jsondata) {
                alert(jsondata.data.msg);
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.getSourceList();
                }
            });
        }

        $scope.viewSourceReport = function (sourceid) {
            $state.go('viewsourcereport', {'id': btoa(sourceid)});
        }

        $scope.sendSourceEmailToClient = function (sourceObj, index) {
            if (confirm("Are you sure you want to send mail ?")) {
                $scope.isAjax = true;
                $http({
                    method: 'POST',
                    url: baseURL + '/sources/sendmail',
                    dataType: "JSON",
                    data: "data=" + encodeURIComponent(angular.toJson(sourceObj)),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function (jsondata) {
                    $scope.isAjax = false;
                    alert(jsondata.data.msg)

                });
            }
        }


    }
})();