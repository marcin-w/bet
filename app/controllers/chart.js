chartApp.controller("ChartCtrl", function ($scope, $http, Chart) {
    $scope.series = ['Series A'];

    Chart.get()
        .success(function (data) {

            $scope.labels = Object.keys(data);
            $scope.data = [Object.values(data)];
            console.log($scope.labels);
            console.log($scope.data);
            //$scope.loading = false;
        })
        .error(function (data) {
            console.log(data);
        });
    //$scope.data = [
    //    [65, 59, 80, 81, 56, 55, 40],
    //    [28, 48, -1, 19, 86, 27, 90]
    //];


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