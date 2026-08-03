//blank line is required
app.controller('ctrl_offers',function($scope,$http){
	$http.get('login/check_valid_session').success(function(data){ if(data!=1){ window.location.assign('<?=site_url("login")?>'); } });
	$scope.x = {};
	$scope.selectedPackages = {};
	$scope.packages = [];

	// Date pickers
	$('#DOB1').datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true });
	$('#DOB2').datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true });

	// Load existing offers
	$scope.loader = function() {
		$http.get('offers/view_data').success(function(data) {
			$scope.datadb = data;
		});
	};
	$scope.loader();

	// Load packages list for multi-select
	$http.get('offers/get_packages').success(function(data) {
		$scope.packages = data;
	});

	// Populate form for editing
	$scope.update_call = function(y) {
		$scope.x = angular.copy(y);
		// Rebuild selectedPackages from stored package_ids string
		$scope.selectedPackages = {};
		if (y.package_ids) {
			y.package_ids.toString().split(',').forEach(function(id) {
				id = id.trim();
				if (id) $scope.selectedPackages[id] = true;
			});
		}
	};

	// Clear form
	$scope.filter_new = function() {
		$scope.x = {};
		$scope.selectedPackages = {};
	};

	// Save
	$scope.save_data = function(x) {
		var ids = Object.keys($scope.selectedPackages).filter(function(k) {
			return $scope.selectedPackages[k];
		});
		$('#package_ids_field').val(ids.join(','));

		$('#submitbtn').prop('disabled', true);
		$('#webprogress').css('display', 'inline');

		$.ajax({
			type: 'POST',
			url: 'offers/save_data',
			data: $('#form1').serialize(),
			success: function(data) {
				data = $.trim(data);
				if (data == '1') {
					messages('success', 'Success!', 'Coupon saved successfully', 3000);
					$scope.$apply(function() { $scope.loader(); $scope.filter_new(); });
				} else if (data == '0') {
					messages('warning', 'Info!', 'No data affected', 3000);
				} else {
					messages('danger', 'Warning!', data, 4000);
				}
			},
			error: function() {
				messages('danger', 'Error!', 'Could not save. Please try again.', 4000);
			},
			complete: function() {
				$('#submitbtn').prop('disabled', false);
				$('#webprogress').css('display', 'none');
			}
		});
	};

	// Toggle active / inactive
	$scope.toggle_status = function(y) {
		var newStatus = (y.status == 1) ? 0 : 1;
		$http.get('offers/toggle_status?id=' + y.id + '&status=' + newStatus).success(function(data) {
			if (data == '1') {
				y.status = newStatus;
			} else {
				messages('danger', 'Error!', 'Could not update status', 3000);
			}
		});
	};

	// Delete
	$scope.delete_data = function(id) {
		if (confirm('Deleting this coupon will make the code invalid for future bookings.')) {
			if (confirm('Are you sure you want to DELETE this coupon?')) {
				$http.get('offers/delete_data?id=' + id).success(function(data) {
					if (data == '1') {
						messages('success', 'Success!', 'Coupon deleted successfully', 3000);
					} else {
						messages('danger', 'Warning!', 'Could not delete coupon', 4000);
					}
					$scope.loader();
				});
			}
		}
	};

});
