(function() {

    'use strict';

    angular
        .module('authApp')
        .controller('AuthController', AuthController);


    function AuthController($auth, $state) {

        $state.go('bets', {});
        var vm = this;

        vm.login2 = function() {
            var credentials = {
                login: vm.login,
                password: vm.password
            };

            // Use Satellizer's $auth service to login
            $auth.login(credentials).then(function(data) {

                // If login is successful, redirect to the users state
                $state.go('bets', {});
            });
        }

    }

})();

//
//(function() {
//    alert('auth');
//})();