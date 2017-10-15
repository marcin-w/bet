<!DOCTYPE html>

<html ng-app="betApp" lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title></title>
        <link href="css/toaster.css" rel="stylesheet"/>
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-theme.css" rel="stylesheet"/>
        <script src="app/lib/angular/angular.js"></script>
        <script src="app/lib/toaster/toaster.js"></script>
        <script src="app/services/betService.js"></script>
        <script src="app/app.js"></script>
        <script src="app/controllers/bet.js"></script>
        <script src="app/filters/bet.js"></script>
    </head>
    <body ng-app="betApp" ng-controller="BetCtrl">
        <div class="container">
            <div class="page-header">
                <h3>
                    <span class="label label-success">Kliknij w zespół, aby postawić zakład</span>
                </h3>
            </div>
            <div class="checkbox-inline">
                <label><input type="checkbox" ng-model="showScheduled" />Przyszłe</label>
            </div>
            <div class="checkbox-inline">
                <label><input type="checkbox" ng-model="showFinished" />Zakończone</label>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-2">Data</th>
                        <th class="col-md-1"></th>
                        <th class="col-md-2"></th>
                        <th class="col-md-2"></th>
                        <th class="col-md-1"></th>
                        <th class="col-md-1">Wynik</th>
                        <th class="col-md-1">Wygrana</th>
                        <th class="col-md-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="match in items | matchFilter:showFinished:showScheduled | orderBy:'date'">
                        <td class="text-center">{{match.date}}</td>
                        <td ng-class="{success: hoverTeam1 || match.bet == 1}" ng-mouseover="hoverTeam1 = !match.finished" ng-mouseleave="hoverTeam1 = false" ng-click="betClicked(match, match.team1Id, 1)" class="text-right">
                            <input type="radio" ng-checked="1 == match.bet" ng-disabled="match.finished" name="{{match.id}}" id="team1_{{match.id}}" />
                        </td>
                        <td ng-class="{success: hoverTeam1 || match.bet == 1}" ng-mouseover="hoverTeam1 = !match.finished" ng-mouseleave="hoverTeam1 = false" ng-click="betClicked(match, match.team1Id, 1)" class="text-right">{{match.team1}}<img class="img-circle" alt="{{match.team1}}" src="img/{{match.team1Flag}}.png"></td>
                        <td ng-class="{success: hoverTeam2 || match.bet == 2}" ng-mouseover="hoverTeam2 = !match.finished" ng-mouseleave="hoverTeam2 = false" ng-click="betClicked(match, match.team2Id, 2)"><img class="img-circle" alt="{{match.team2}}" src="img/{{match.team2Flag}}.png">{{match.team2}}</td>
                        <td ng-class="{success: hoverTeam2 || match.bet == 2}" ng-mouseover="hoverTeam2 = !match.finished" ng-mouseleave="hoverTeam2 = false" ng-click="betClicked(match, match.team2Id, 2)">
                            <input type="radio" ng-checked="2 == match.bet" ng-disabled="match.finished" name="{{match.id}}" id="team2_{{match.id}}" />
                        </td>
                        <td></td>
                        <td>{{match.won|currency}}</td>
                        <td>
                            <div class="input-btn">
                                <button class="btn-xs btn-success" ng-click="cancelBet(match)" ng-if="match.bet > 0 && !match.finished">Anuluj</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h3>
                <span class="label pull-right" ng-class="scoreClass()">Twoja wygrana: {{score()}}</span>
            </h3>
            <toaster-container></toaster-container>
        </div>
    </body>
</html>