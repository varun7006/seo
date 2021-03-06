(function () {
    'use strict';
    angular
            .module('app')
            .controller('sourcesCtrl', sourcesCtrl);
    sourcesCtrl.$inject = ['$scope', '$http', '$state', '$sce', '$timeout'];
    function sourcesCtrl($scope, $http, $state, $sce, $timeout) {


        $scope.tags = [];
        $scope.linkTypes = [];
        $scope.linkTypesCount = 0;
        $scope.showAlert = false;
        $scope.alertText = "";
        $scope.alertIcon = "";
        $scope.alertClass = "";

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

        $scope.source = {'name': '', 'user_id': '', 'email': '', 'source_link': '', 'mobile_no': '', 'topics': '', 'link_status': '', 'link_type': '', 'project_id': []};
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

        $scope.from_limit = 0;
        $scope.selectedPage = 0;
        $scope.to_limit = 100;
        $scope.limitdifference = 100;
        $scope.totalItems = 0;
        $scope.currentPage = 0;
        $scope.pageArr = [];

        $scope.getSourceList = function () {
            $scope.pageArr = [];
            $scope.limitdifference = $scope.to_limit - $scope.from_limit;
            $http({
                method: 'POST',
                url: baseURL + '/sources/getsourcelist',
                data: 'from_limit=' + encodeURIComponent($scope.from_limit) + '&to_limit=' + encodeURIComponent($scope.limitdifference),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.sourceList = jsondata.data.value.list;
                    angular.forEach($scope.sourceList, function (value, key) {
                        $scope.sourceList[key].editMode = false;
                    });
                    $scope.sourceCount = jsondata.data.value.count;
                    $scope.totalItems = jsondata.data.value.count;
                    var i = 0;
                    var nextlimit = 0;
                    for (i = 0; i < $scope.totalItems; i = i + $scope.limitdifference) {
                        $scope.pageArr.push(nextlimit);
                        nextlimit = i + $scope.limitdifference;
                    }
                }
            });
        }

        $scope.getSourceList();

//        $scope.getIframeSrc = function (link) {
//            $scope.iframeLink = $sce.trustAsResourceUrl(link);
//        }
        $scope.changeLimit = function (fromlimit, index) {
            $scope.selectedPage = index;
            $scope.pageArr = [];
            $scope.from_limit = fromlimit;
            $scope.to_limit = fromlimit + $scope.limitdifference;

            $scope.getSourceList();

        }


        $scope.changeLimitWithButton = function (type) {
            if (type == 'previous') {
                if ($scope.from_limit > 0) {
                    $scope.from_limit = $scope.from_limit - $scope.limitdifference;
                } else {
                    $scope.from_limit = 0;
                }
                if ($scope.selectedPage > 0) {
                    $scope.selectedPage = $scope.selectedPage - 1;
                } else {
                    $scope.selectedPage = 0;
                }
            } else if (type == 'next') {
                var pageArrLength = $scope.pageArr.length;
                var max_limit = $scope.pageArr[pageArrLength - 1]
                if ($scope.from_limit < max_limit) {
                    $scope.from_limit = $scope.from_limit + $scope.limitdifference;
                } else {
                    $scope.from_limit = max_limit;

                }
                if ($scope.selectedPage < (pageArrLength - 1)) {
                    $scope.selectedPage = $scope.selectedPage + 1;
                } else {
                    $scope.selectedPage = pageArrLength - 1;
                }
            }
            $scope.changeLimit($scope.from_limit, $scope.selectedPage);
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
                $scope.tag.selected = "";
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-check";
                    $scope.alertClass = "alert-success";
                    $scope.source = {};
                    $scope.showNewSource = false;
                    $scope.getSourceList();
                } else {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-times-circle";
                    $scope.alertClass = "alert-danger";
                }
            });
//            
        }

        $scope.hideAlert = function () {
            $scope.showAlert = false;
            $scope.alertText = "";
            $scope.alertIcon = "";
            $scope.alertClass = "";
        }

        $scope.addNewSource = function () {
            $scope.showNewSource = true;
            $scope.saveType = "SAVE";
        }

        $scope.editSource = function (sourceObj, index) {
            sourceObj.editMode = true;
            var projectArr = sourceObj.project_id;
            $scope.sourceList[index].project_id = [];
            angular.forEach(projectArr, function (value, key) {
                angular.forEach($scope.projectList, function (v, k) {
                    if (value == v.id) {
                        $scope.sourceList[index].project_id.push(v);
                    } else if (value.id == v.id) {
                        $scope.sourceList[index].project_id.push(v);
                    }
                })
            });
            $scope.saveType = "UPDATE";
            $scope.updateId = sourceObj.id;
            $scope.index = index;

        }

        $scope.updateSourceDetails = function (sourceObj) {
            $scope.isAjax = true;
            $scope.source.name = sourceObj.name;
            $scope.source.email = sourceObj.email;
            $scope.source.source_link = sourceObj.exact_link;
            $scope.source.topics = sourceObj.topics;
            $scope.source.mobile_no = sourceObj.mobile_no;
            $scope.source.link_text = sourceObj.link_text;
            $scope.source.link_type = sourceObj.link_type;
            $scope.source.link_target = sourceObj.link_target;
            $scope.source.link_status = sourceObj.link_status;
            $scope.source.comment = sourceObj.comment;
            $scope.source.project_id = [];
            angular.forEach(sourceObj.project_id, function (value, key) {
                $scope.source.project_id.push(value.id)
            });
            $scope.source.topics = $scope.tag.selected;

            $http({
                method: 'POST',
                url: baseURL + '/sources/updatesource',
                dataType: "JSON",
                data: 'data=' + encodeURIComponent(angular.toJson($scope.source)) + "&id=" + $scope.updateId,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (jsondata) {
                $scope.isAjax = false;
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-check";
                    $scope.alertClass = "alert-success";
                } else {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-times-circle";
                    $scope.alertClass = "alert-danger";
                }
                $scope.showNewSource = false;
                sourceObj.editMode = false;
                $scope.getSourceList();
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
                    if (jsondata.data.status == 'SUCCESS') {
                        $scope.sourceList.splice(index, 1);
                        $scope.showAlert = true;
                        $scope.alertText = jsondata.data.msg;
                        $scope.alertIcon = "fa-check";
                        $scope.alertClass = "alert-success";
                    } else {
                        $scope.showAlert = true;
                        $scope.alertText = jsondata.data.msg;
                        $scope.alertIcon = "fa-times-circle";
                        $scope.alertClass = "alert-danger";
                    }
                    $scope.getSourceList();
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

        window.onscroll = function () {
            myFunction()
        };


        // Multiple Tagging 

        $scope.disabled = undefined;
        $scope.searchEnabled = undefined;

        $scope.enable = function () {
            $scope.disabled = false;
        };

        $scope.disable = function () {
            $scope.disabled = true;
        };

        $scope.enableSearch = function () {
            $scope.searchEnabled = true;
        }

        $scope.disableSearch = function () {
            $scope.searchEnabled = false;
        }

        $scope.clear = function () {
            $scope.person.selected = undefined;
            $scope.address.selected = undefined;
            $scope.country.selected = undefined;
        };

        $scope.counter = 0;

//        $scope.availableColors = ['Red', 'Green', 'Blue', 'Yellow', 'Magenta', 'Maroon', 'Umbra', 'Turquoise'];


        $scope.multipleDemo = {};
        $scope.multipleDemo.project = [];

        // Tagging Code Ends


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
        $scope.modalStyle = "none";
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
                    }
                    return formData;
                },
                data: $scope.form,
                headers: {
                    'Content-Type': undefined
                }

            }).then(function (jsondata) {
                document.getElementById("cancelmodal").click();
                if (jsondata.data.status == 'SUCCESS') {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-check";
                    $scope.alertClass = "alert-success";
                    $scope.getSourceList();
                } else {
                    $scope.showAlert = true;
                    $scope.alertText = jsondata.data.msg;
                    $scope.alertIcon = "fa-times-circle";
                    $scope.alertClass = "alert-danger";
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