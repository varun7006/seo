'use strict';

/**
 * Config for the router
 */

angular.module('app')
        .config(
                ['$stateProvider', '$urlRouterProvider',
                    function ($stateProvider, $urlRouterProvider) {
                        $urlRouterProvider.otherwise('/login');
                        $stateProvider

                                // HOME STATES AND NESTED VIEWS ========================================
                                .state('login', {
                                    url: '/login',
                                    templateUrl: baseURL + '/login',
                                    controller: "loginCtrl",
                                })
                                .state('dashboard', {
                                    url: '/dashboard',
                                    templateUrl: baseURL + '/dashboard',
                                    controller: "dashboardCtrl",
                                })
                                .state('clientdashboard', {
                                    url: '/clientdashboard',
                                    templateUrl: baseURL + '/clientdashboard',
                                    controller: "clientDashboardCtrl",
                                })
                                .state('users', {
                                    url: '/users',
                                    templateUrl: baseURL + '/users',
                                    controller: "userCtrl",
                                })
                                .state('addusers', {
                                    url: '/addusers',
                                    templateUrl: baseURL + '/users/addusers',
                                    controller: "userCtrl",
                                })
                                .state('sources', {
                                    url: '/sources',
                                    templateUrl: baseURL + '/sources',
                                    controller: "sourcesCtrl",
                                })
                                .state('addsources', {
                                    url: '/addsources',
                                    templateUrl: baseURL + '/sources/addsources',
                                    controller: "sourcesCtrl",
                                })
                                .state('brokenlinks', {
                                    url: '/brokenlinks',
                                    templateUrl: baseURL + '/reports/brokenlinks',
                                    controller: "sourcesCtrl",
                                })
                                .state('brokensources', {
                                    url: '/brokensources',
                                    templateUrl: baseURL + '/sources/brokensources',
                                    controller: "brokenSourcesCtrl",
                                })
                                .state('viewsourcereport', {
                                    url: '/viewsourcereport/:id',
                                    templateUrl: baseURL + '/sources/viewsourcereport',
                                    controller: "sourceReportCtrl",
                                })
                                .state('addtask', {
                                    url: '/addtask',
                                    templateUrl: baseURL + '/bucket/addtask',
                                    controller: "bucketCtrl",
                                })
                                .state('project', {
                                    url: '/project',
                                    templateUrl: baseURL + '/project',
                                    controller: "projectCtrl",
                                })
                                .state('addprojectview', {
                                    url: '/addprojectview',
                                    templateUrl: baseURL + '/project/addnewproject',
                                    controller: "projectCtrl",
                                })
                                .state('composemail', {
                                    url: '/mail/composemail',
                                    templateUrl: baseURL + '/mail/composemail',
                                    controller: "mailCtrl",
                                })
                                .state('inbox', {
                                    url: '/mail/inbox',
                                    templateUrl: baseURL + '/mail/inbox',
                                    controller: "mailCtrl",
                                })
                                .state('mail_view', {
                                    url: '/mail/mail_view/:client_id',
                                    templateUrl: baseURL + '/mail/mail_view',
                                    controller: "viewMailCtrl",
                                })
                                .state('link_status_report', {
                                    url: '/reports/link_status_report/:project_id',
                                    templateUrl: baseURL + '/reports/link_status_report_view',
                                    controller: "linkStatusReportCtrl",
                                })
                                .state('viewlinktype', {
                                    url: '/settings/viewlinktypes',
                                    templateUrl: baseURL + '/settings/viewlinktypes',
                                    controller: "settingsCtrl",
                                })
                                 .state('topics', {
                                    url: '/settings/topics',
                                    templateUrl: baseURL + '/settings/topicsview',
                                    controller: "settingsCtrl",
                                })



                                // ABOUT PAGE AND MULTIPLE NAMED VIEWS =================================
                                .state('about', {
                                    // we'll get to this in a bit       
                                });
                    }
                ]
                );

