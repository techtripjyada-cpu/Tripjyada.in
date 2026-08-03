//blank line is required
app.controller('ctrl_reviews',function($scope,$http){
	$http.get('login/check_valid_session').success (function(data) {if(data!=1){window.location.assign('<?=site_url("login")?>');}});
	
	$http.get("reviews/view_data").success(function(data){
		$scope.datadb=data;
	})
	$scope.update=function(rid,st){
		$http.get("reviews/save?id="+rid+"&status="+st).success(function(data){
			console.log(data);
			messages("success", "Success!","Review Updated Successfully", 3000);
		})
	}
	
});