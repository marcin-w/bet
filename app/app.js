var betApp = angular.module('betApp', ['toaster', 'betService']);
var chartApp = angular.module('chartApp', ['chart.js', 'chartService']);

(function() {

    'use strict';

    angular
        //.module('authApp', ['ui.router', 'satellizer'])
        //.config(function($stateProvider, $urlRouterProvider, $authProvider) {
        .module('authApp', ['ui.router', 'ngMessages', 'ngStorage', 'ngMockE2E', 'betApp'])
        .config(config)
        .run(run);

            // Satellizer configuration that specifies which API
            // route the JWT should be retrieved from
            //$authProvider.loginUrl = '/api/authenticate';

            //// Redirect to the auth state if any other states
            //// are requested other than users
            //$urlRouterProvider.otherwise('/auth');

            //$stateProvider
            //    //.state('auth', {
            //    //    url: '/auth',
            //    //    templateUrl: '../laravel/views/authView.html',
            //    //    controller: 'AuthController as auth'
            //    //})
            //    .state('bets', {
            //        url: '/bet',
            //        templateUrl: '../../index.php',
            //        controller: 'BetController as bet'
            //    });

    function config($stateProvider, $urlRouterProvider) {
        // default route
        $urlRouterProvider.otherwise("/");

        // app routes
        $stateProvider
            .state('home', {
                url: '/',
                templateUrl: 'home.html',
                controller: 'BetCtrl',
                controllerAs: 'vm'
            })
            .state('login', {
                url: '/login',
                templateUrl: 'login.html',
                controller: 'Login.IndexController',
                controllerAs: 'vm'
            });
    }

    function run($rootScope, $http, $location, $localStorage) {
        // keep user logged in after page refresh
        if ($localStorage.currentUser) {
            $http.defaults.headers.common.Authorization = 'Bearer ' + $localStorage.currentUser.token;
        }

        // redirect to login page if not logged in and trying to access a restricted page
        $rootScope.$on('$locationChangeStart', function (event, next, current) {
            var publicPages = ['/login'];
            var restrictedPage = publicPages.indexOf($location.path()) === -1;
            if (restrictedPage && !$localStorage.currentUser) {
                $location.path('/login');
            }
        });
    }
})();