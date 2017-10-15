angular.module('chartService', [])
    .factory('Chart', function($http) {
        return {
            get : function() {
                return $http.get('laravel/public/api/bet/chart.html');
                //die('sd444ds');
                //return  [
                //    [65, 59, 80, 81, 56, 55, 40],
                //    [28, 48, -1, 19, 86, 27, 90]
                //];
            }
        }
    });