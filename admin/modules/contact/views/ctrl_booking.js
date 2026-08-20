//blank line is required
app.controller('ctrl_booking',function($scope,$http){
	$http.get('login/check_valid_session').success (function(data) {if(data!=1){window.location.assign('<?=site_url("login")?>');}});

	$scope.filters = {
		date_from: null,
		date_to: null
	};

	$scope.formatDateParam=function(value){
		if(!value){
			return '';
		}
		if(Object.prototype.toString.call(value)==='[object Date]' && !isNaN(value.getTime())){
			var y = value.getFullYear();
			var m = ('0' + (value.getMonth() + 1)).slice(-2);
			var d = ('0' + value.getDate()).slice(-2);
			return y + '-' + m + '-' + d;
		}
		if(typeof value === 'string'){
			var trimmed = value.trim();
			if(/^\d{4}-\d{2}-\d{2}$/.test(trimmed)){
				return trimmed;
			}
			if(/^\d{4}-\d{2}-\d{2}T/.test(trimmed)){
				return trimmed.substring(0, 10);
			}
			var parsed = new Date(trimmed);
			if(!isNaN(parsed.getTime())){
				var py = parsed.getFullYear();
				var pm = ('0' + (parsed.getMonth() + 1)).slice(-2);
				var pd = ('0' + parsed.getDate()).slice(-2);
				return py + '-' + pm + '-' + pd;
			}
		}
		return '';
	}
	
	$scope.loader=function(){
		var params = {};
		var dateFrom = $scope.formatDateParam($scope.filters.date_from);
		var dateTo = $scope.formatDateParam($scope.filters.date_to);
		if(dateFrom){
			params.date_from = dateFrom;
		}
		if(dateTo){
			params.date_to = dateTo;
		}
		$http({
			method: "GET",
			url: "contact/view_booking",
			params: params
		}).success(function(data){
			$scope.datadb=data;
		})
	}
	$scope.loader();

	$scope.applyFilters=function(){
		$scope.loader();
	}

	$scope.resetFilters=function(){
		$scope.filters.date_from = null;
		$scope.filters.date_to = null;
		$scope.loader();
	}

	$scope.exportBookings=function(){
		var url = "contact/export_booking";
		var query = [];
		var dateFrom = $scope.formatDateParam($scope.filters.date_from);
		var dateTo = $scope.formatDateParam($scope.filters.date_to);
		if(dateFrom){
			query.push("date_from=" + encodeURIComponent(dateFrom));
		}
		if(dateTo){
			query.push("date_to=" + encodeURIComponent(dateTo));
		}
		if($scope.search_text && $scope.search_text.trim()!==""){
			query.push("search=" + encodeURIComponent($scope.search_text.trim()));
		}
		if(query.length){
			url += "?" + query.join("&");
		}
		window.location.assign(url);
	}
	
	$scope.update_call=function(y){
		$scope.x=y;
	}

	$scope.delete_booking=function(id){
		if(confirm("Delete this lead? This cannot be undone."))
		{
			$http.get("contact/delete_booking?id="+id).success(function(data){
				if(data=="1")
				{
					messages("success", "Success!","Lead Deleted Successfully", 3000);
				}
				else
				{
					messages("danger", "Warning!","Lead not Deleted", 4000);
				}
				$scope.loader();
			})
		}
	}

});
