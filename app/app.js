var betApp = angular.module('betApp', ['toaster', 'betService']);
var chartApp = angular.module('chartApp', ['chart.js', 'chartService']);

(function() {

    'use strict';

    angular
        .module('authApp', ['ui.router', 'satellizer'])
        .config(function($stateProvider, $urlRouterProvider, $authProvider) {

            // Satellizer configuration that specifies which API
            // route the JWT should be retrieved from
            $authProvider.loginUrl = '/api/authenticate';

            //// Redirect to the auth state if any other states
            //// are requested other than users
            //$urlRouterProvider.otherwise('/auth');

            $stateProvider
                //.state('auth', {
                //    url: '/auth',
                //    templateUrl: '../laravel/views/authView.html',
                //    controller: 'AuthController as auth'
                //})
                .state('bets', {
                    url: '/bet',
                    templateUrl: '../../index.html',
                    controller: 'BetController as bet'
                });
        });
})();