betApp.controller("ChartCtrl", function ($scope, $http, Chart) {
    $scope.series = ['Series A'];

    Chart.get()
        .success(function (data) {

            $scope.labels = Object.keys(data);
            $scope.data = [Object.values(data)];
            console.log($scope.labels);
            console.log($scope.data);
        })
        .error(function (data) {
            console.log(data);
        });

    $scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2'}];
    $scope.options = {
        scales: {
            yAxes: [
                {
                    id: 'y-axis-1',
                    type: 'linear',
                    display: true,
                    position: 'left'
                },
                {
                    id: 'y-axis-2',
                    type: 'linear',
                    display: true,
                    position: 'right'
                }
            ]
        }
    };
});