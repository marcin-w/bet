betApp.controller("BetCtrl", function ($scope, toaster, $http, Bet) {
    $scope.showFinished = true;
    $scope.showScheduled = true;

    //$scope.loading = true;
    //tuuuuuuu
    Bet.get()
        .success(function (data) {
            $scope.items = data;
            //console.log(data);
            //$scope.loading = false;
        })
        .error(function (data) {
            //console.log(data);
        });

    // function to handle submitting the form
    $scope.saveBet = function(match, teamId, teamNr) {
        //$scope.loading = true;

        // save the comment. pass in comment data from the form
        // use the function we created in our service
        Bet.save(match.id, teamId)
            .success(function() {
                var teamBet = null;
                if (match.team1Id == teamId) {
                    teamBet = match.team1;
                } else if (match.team2Id == teamId) {
                    teamBet = match.team2;
                }
                if (match.bet > 0) {
                    toaster.pop('success', 'Zakład zmieniony', 'Postawiłeś na zespół: ' + teamBet);
                } else {
                    toaster.pop('success', 'Zakład przyjęty', 'Postawiłeś na zespół: ' + teamBet);
                }
                match.bet = teamNr;
            })
            .error(function() {
                toaster.pop('error', 'Zakład nieprzyjęty', 'Nie udało się przyjąć zakładu');
            });
    };

    $scope.cancelBet = function(match) {
        Bet.save(match.id, 0)
            .success(function() {
                match.bet = 0;
                if (!match.finished) {
                    match.bet = 0;
                    toaster.pop('success', 'Zakład anulowany', '');
                } else {
                    toaster.pop('error', 'Nie możesz już anulować tego zakładu', '');
                }
            })
            .error(function() {
                toaster.pop('error', 'Zakład nie został anulowany', 'Nie udało się anulować zakładu');
            });
    };
    //=========================================

    $scope.betClicked = function(match, teamId, teamNr) {
        if (match.bet != teamId) {
            if (!match.finished) {
                $scope.saveBet(match, teamId, teamNr);
            } else {
                toaster.pop('error', 'Zakład nieprzyjęty', 'Nie możesz już stawiać w tym meczu');
            }
        }
    };

    $scope.scoreClass = function() {
        return $scope.score() >= 0 ? "label-success" : "label-danger";
    };

    $scope.score = function () {
        var score = 0;
        angular.forEach($scope.items, function(match) {
            if (!isNaN(match.won)) {
                score += match.won;
            }
        });
        return score;
    };
});
