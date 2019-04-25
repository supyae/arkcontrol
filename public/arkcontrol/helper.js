var app = angular.module('arkControl');

app.filter('datetimeFilter', ['$filter', function ($filter) {
    function changeDateFormat(input, format) {
        var date, f = format;
        if (input == null) return "";
        if (f == null) f = 'HH:mm';
        if (typeof (input) == 'string') // input is string type
            date = new Date(input.replace(/-/gi, "/"));
        else date = input; // input is date type

        return $filter('date')(date, f);
    }

    return changeDateFormat;
}]);
app.filter('trustedAsHtml', ['$sce', function ($sce) {
    return function(myHtml) {
        return $sce.trustAsHtml(myHtml);
    };
}]);