angular.module('betService', [])
    .factory('Bet', function($http) {
        return {
            get : function() {
                return $http.get('laravel/public/api/bet');
            },
            // save a bet
            save : function(matchId, teamId) {
                var data = { 'matchId': matchId, 'teamId': teamId };
                return $http({
                    method: 'POST',
                    url: 'laravel/public/api/bet/' + matchId + '/' + teamId,
                    //url: 'laravel/public/api/bet',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: data
                    //data: $.param(data)
                });
            }
        }
    });