(function () {

    'use strict';

    angular.module('arkControl', ['ngAnimate','ui.router', 'satellizer', 'ngStorage', 'ngSanitize', 'ui.bootstrap', 'ui.bootstrap.datetimepicker'])

        .config(function ($stateProvider, $urlRouterProvider, $authProvider, $httpProvider) {
            // Satellizer configuration that specifies which API
            // route the JWT should be retrieved from
            $authProvider.loginUrl = '/api/user/login';

            $urlRouterProvider.otherwise('/');

            $httpProvider.interceptors.push(['$q', '$location', '$localStorage', function ($q, $location, $localStorage) {
                return {
                    'request': function (config) {
                        config.headers = config.headers || {};
                        if ($localStorage && $localStorage.token) {
                            config.headers.Authorization = 'Bearer ' + $localStorage.token;
                        }
                        return config;
                    },
                    'responseError': function (response) {
                        if (response.status === 401 || response.status === 403) {

                            if ($localStorage && $localStorage.token) {
                                delete $localStorage.token;
                            }
                            $location.path('/login');
                        }
                        return $q.reject(response);
                    }
                };
            }]);
        })
        .run(function ($rootScope, $location, $localStorage) {
            $rootScope.$on("$locationChangeStart", function (event, next) {
                console.log('route change start');
                console.log($localStorage.token);
                var publicPages = ['/login'];
                var restricted = publicPages.indexOf($location.path());
                console.log('location   ' + $location.path());

                if ($localStorage.token == null && restricted === -1) {
                    console.log('go here');
                    $location.path('/login');
                    // $location.path('/login');
                }

            });

        });

})();