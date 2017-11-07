angular.module('chartService', [])
    .factory('Chart', function($http) {
        return {
            get : function() {
                return $http.get('laravel/public/api/bet/chart.html');
            }
        }
    });