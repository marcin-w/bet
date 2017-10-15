(function() {

    'use strict';

    angular
        .module('authApp')
        .controller('BetController', BetController);

    function BetController($http) {

        var vm = this;

        vm.bets;
        vm.error;

        vm.getMatches = function() {

            // This request will hit the index method in the AuthenticateController
            // on the Laravel side and will return the list of users
            $http.get('api/authenticate').success(function(data) {
                vm.bets = data;
            }).error(function(error) {
                vm.error = error;
            });
        };
    }

})();


//(function() {
//    alert('hit');
//})();