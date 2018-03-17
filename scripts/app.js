// app.js

//var app = angular.module('app', ['ui.router','ui.load', '720kb.datepicker']);


(function () {
    'use strict';
    angular
            .module('app', [
                'ui.router','ui.load', 'ui.select', 'ngSanitize','textAngular','720kb.datepicker', 'ui.bootstrap',
            ])
            .directive('numbersOnly', function () {
                return {
                    require: 'ngModel',
                    link: function (scope, element, attr, ngModelCtrl) {
                        function fromUser(text) {
                            if (text) {
                                var transformedInput = text.replace(/[^0-9]/g, '');

                                if (transformedInput !== text) {
                                    ngModelCtrl.$setViewValue(transformedInput);
                                    ngModelCtrl.$render();
                                }
                                return transformedInput;
                            }
                            return undefined;
                        }
                        ngModelCtrl.$parsers.push(fromUser);
                    }
                };
            }).directive('onedigit', function () {
        return {
            require: '?ngModel',
            link: function (scope, element, attrs, ngModelCtrl) {
                if (!ngModelCtrl) {
                    return;
                }

                ngModelCtrl.$parsers.push(function (val) {
                    if (angular.isUndefined(val)) {
                        var val = '';
                    }

                    var clean = val.replace(/[^-0-9\.]/g, '');
                    var negativeCheck = clean.split('-');
                    var decimalCheck = clean.split('.');
                    if (!angular.isUndefined(negativeCheck[1])) {
                        negativeCheck[1] = negativeCheck[1].slice(0, negativeCheck[1].length);
                        clean = negativeCheck[0] + '-' + negativeCheck[1];
                        if (negativeCheck[0].length > 0) {
                            clean = negativeCheck[0];
                        }

                    }

                    if (!angular.isUndefined(decimalCheck[1])) {
                        decimalCheck[1] = decimalCheck[1].slice(0, 1);
                        clean = decimalCheck[0] + '.' + decimalCheck[1];
                    }

                    if (val !== clean) {
                        ngModelCtrl.$setViewValue(clean);
                        ngModelCtrl.$render();
                    }
                    return clean;
                });

                element.bind('keypress', function (event) {
                    if (event.keyCode === 32) {
                        event.preventDefault();
                    }
                });
            }
        };
    })
    .directive('onlyDigits', function () {
        return {
            require: 'ngModel',
            restrict: 'A',
            link: function (scope, element, attr, ctrl) {
                function inputValue(val) {
                    if (val) {
                        var digits = val.replace(/[^0-9.]/g, '');

                        if (digits.split('.').length > 2) {
                            digits = digits.substring(0, digits.length - 1);
                        }

                        if (digits !== val) {
                            ctrl.$setViewValue(digits);
                            ctrl.$render();
                        }
                        return parseFloat(digits);
                    }
                    return undefined;
                }
                ctrl.$parsers.push(inputValue);
            }
        };
    })
            .directive('countTo', ['$timeout', function ($timeout) {
                    return {
                        replace: false,
                        scope: true,
                        link: function (scope, element, attrs) {

                            var e = element[0];
                            var num, refreshInterval, duration, steps, step, countTo, value, increment;

                            var calculate = function () {
                                refreshInterval = 30;
                                step = 0;
                                scope.timoutId = null;
                                countTo = parseFloat(Math.round(attrs.countTo * 100) / 100) || 0;
                                scope.value = parseFloat(Math.round(attrs.value * 100) / 100) || 0;
                                duration = (parseFloat(attrs.duration) * 200) || 0;
                                steps = Math.ceil(duration / refreshInterval);
                                increment = ((countTo - scope.value) / steps);
                                num = scope.value;
                            }

                            var tick = function () {
                                scope.timoutId = $timeout(function () {
                                    num += increment;
                                    step++;
                                    if (step >= steps) {
                                        $timeout.cancel(scope.timoutId);
                                        num = countTo;
                                        e.innerHTML = parseFloat(Math.round(countTo * 100) / 100).toFixed(2);
                                    } else {
                                        e.innerHTML = parseFloat(Math.round(num * 100) / 100).toFixed(2);
                                        tick();
                                    }
                                }, refreshInterval);

                            }

                            var start = function () {
                                if (scope.timoutId) {
                                    $timeout.cancel(scope.timoutId);
                                }
                                calculate();
                                tick();
                            }

                            attrs.$observe('countTo', function (val) {
                                if (val) {
                                    start();
                                }
                            });

                            attrs.$observe('value', function (val) {
                                start();
                            });

                            return true;
                        }
                    }

                }])
            .config(
                    ['$httpProvider',
                        function ($httpProvider) {
                            $httpProvider.interceptors.push('httpRequestInterceptor');
                        }
                    ]);



})();