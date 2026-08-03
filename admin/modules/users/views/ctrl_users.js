app.controller('ctrl_users', function ($scope, $http) {
    $scope.users       = [];
    $scope.otp_logs    = [];
    $scope.stats       = {};
    $scope.loading     = true;
    $scope.search_text = '';
    $scope.tab         = 'users';
    $scope.selected_phone = '';

    $http.get('login/check_valid_session').success(function(data) {
        if (data != 1) { window.location.href = 'login'; }
    });

    $scope.loadStats = function() {
        $http.get('users/stats').success(function(d) { $scope.stats = d || {}; });
    };

    $scope.loadUsers = function() {
        $scope.loading = true;
        var q = '?search=' + encodeURIComponent($scope.search_text || '');
        $http.get('users/view_data' + q).success(function(d) {
            $scope.users   = Array.isArray(d) ? d : [];
            $scope.loading = false;
        });
    };

    $scope.loadOtpLogs = function(phone) {
        $scope.selected_phone = phone || '';
        $scope.tab = 'otp';
        $http.get('users/otp_logs?phone=' + encodeURIComponent(phone || '')).success(function(d) {
            $scope.otp_logs = Array.isArray(d) ? d : [];
        });
    };

    $scope.showUsers = function() { $scope.tab = 'users'; $scope.loadUsers(); };

    $scope.clearSearch = function() { $scope.search_text = ''; $scope.loadUsers(); };

    // OTP status label
    $scope.otpLabel = function(row) {
        if (row.verified == 1) return 'Verified';
        if (row.verified == 2) return 'Invalidated';
        if (row.attempts >= 3) return 'Max Attempts';
        if (new Date(row.expires_at) < new Date()) return 'Expired';
        return 'Pending';
    };

    $scope.otpClass = function(row) {
        var l = $scope.otpLabel(row);
        if (l === 'Verified')    return 'label-success';
        if (l === 'Pending')     return 'label-warning';
        return 'label-danger';
    };

    $scope.loadStats();
    $scope.loadUsers();
});
