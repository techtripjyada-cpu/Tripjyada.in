
app.controller('ctrl_cardpage_desc',function($scope,$http){
	$http.get('login/check_valid_session').success(function(data){if(data!=1){window.location.assign('<?=site_url("login")?>');}});

	$scope.current_slug='all';
	$scope.desc={page_slug:'all',active:1};

	$scope.load_desc=function(){
		$http.get('cardpage/get_desc?slug='+$scope.current_slug).success(function(data){
			$scope.desc=(data&&data.id)?data:{page_slug:$scope.current_slug,active:1};
		});
	};

	$scope.save_desc=function(){
		$scope.desc.page_slug=$scope.current_slug;
		var d=angular.copy($scope.desc);
		$http.post('cardpage/save_desc',$.param(d),{headers:{'Content-Type':'application/x-www-form-urlencoded'}}).success(function(r){
			if(r=='1'){
				messages("success","Saved!","Content saved",3000);
				$scope.load_desc();
			}else{
				messages("danger","Error!","Could not save content",3000);
			}
		});
	};

	$scope.load_desc();
});
