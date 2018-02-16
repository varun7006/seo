//var app = angular.module('app')
//        .config(
//                ['$httpProvider','$controllerProvider', '$compileProvider', '$filterProvider', '$provide',
//                    function ($httpProvider,$controllerProvider, $compileProvider, $filterProvider, $provide) {
//                        alert($httpProvider.interceptors)
//                        $httpProvider.interceptors.push('httpRequestInterceptor');
//                        // lazy controller, directive and service
//                        app.controller = $controllerProvider.register;
//                        app.directive = $compileProvider.directive;
//                        app.filter = $filterProvider.register;
//                        app.factory = $provide.factory;
//                        app.service = $provide.service;
//                        app.constant = $provide.constant;
//                        app.value = $provide.value;
//                    }
//                ]);



//var baseURLLogin = 'localhost/seo/'
//var baseURL = 'localhost/seo/api/index.php';

var domain = window.location.protocol + "//" + window.location.hostname;
var baseURL = domain + "/seo/api/index.php";
var baseURLLogin = domain + "/seo";