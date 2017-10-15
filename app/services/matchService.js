angular.module('matchService', [])
    .factory('Match', function($http) {
        return {
            get : function() {
                return $http.get('laravel/public/api/bet');
            }
        }
    }
);
