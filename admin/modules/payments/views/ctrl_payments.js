app.controller('ctrl_payments', function ($scope, $http) {
    $scope.datadb    = [];
    $scope.loading   = true;
    $scope.search_text = '';
    $scope.date_from = '';
    $scope.date_to   = '';

    $http.get('login/check_valid_session').success(function(data) {
        if (data != 1) { window.location.href = 'login'; }
    });

    $scope.loadData = function () {
        $scope.loading = true;
        var params = '?search=' + encodeURIComponent($scope.search_text || '')
            + '&date_from=' + encodeURIComponent($scope.date_from || '')
            + '&date_to='   + encodeURIComponent($scope.date_to   || '');

        $http.get('payments/view_data' + params).then(function (res) {
            $scope.datadb  = Array.isArray(res.data) ? res.data : [];
            $scope.loading = false;
        }, function () {
            $scope.datadb  = [];
            $scope.loading = false;
        });
    };

    $scope.clearFilters = function () {
        $scope.search_text = '';
        $scope.date_from   = '';
        $scope.date_to     = '';
        $scope.loadData();
    };

    $scope.loadData();
});
