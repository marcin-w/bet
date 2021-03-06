var betApp = angular.module('betApp', ['ui.router', 'ngMessages', 'ngStorage', 'toaster', 'betService', 'chart.js', 'chartService']);

(function() {

    'use strict';

    angular
        .module('betApp')
        .config(config)
        .run(run);

    function config($stateProvider, $urlRouterProvider) {
        // default route
        $urlRouterProvider.otherwise("/");

        // app routes
        $stateProvider
            .state('login', {
                url: '/login',
                templateUrl: 'login.html',
                controller: 'Login.IndexController',
                controllerAs: 'vm'
            })
            .state('chart', {
                url: '/chart',
                templateUrl: 'chart.html',
                controller: 'ChartCtrl',
                controllerAs: 'vm'
            })
            .state('home', {
                url: '/',
                templateUrl: 'home.html',
                controller: 'BetCtrl',
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