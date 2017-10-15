betApp.filter("matchFilter", function() {
    return function (matches, showFinished, showScheduled) {
        var resultArr = [];
        angular.forEach(matches, function (match) {
            if (match.finished && showFinished || !match.finished && showScheduled) {
                resultArr.push(match);
            }
        });
        return resultArr;
    }
});