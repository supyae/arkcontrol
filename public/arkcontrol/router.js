angular.module('arkControl').config(function ($stateProvider) {

    var prefix = "views";
    $stateProvider
        .state('/', {
            url: '/',
            templateUrl: prefix + '/client/index.html',
            controller: 'ClientCtrl'
        })
        .state('login', {
            url: '/login',
            templateUrl: prefix + '/auth/login.html',
            controller: 'UserCtrl as user'
        })
        .state('get-client', {
            url: '/get-client',
            templateUrl: prefix + '/client/detail.html',
            controller: 'ClientCtrl'
        })

});