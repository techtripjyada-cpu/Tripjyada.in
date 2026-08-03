
app.controller('ctrl_cardpage',function($scope,$http){
	$http.get('login/check_valid_session').success(function(data){if(data!=1){window.location.assign('<?=site_url("login")?>');}});

	$scope.current_slug='all';
	$scope.tabs=[];
	$scope.desc={page_slug:'all',active:1};
	$scope.tab_form={page_slug:'all',active:1,sort_order:0};

	$scope.load_page=function(){
		$scope.load_tabs();
		$scope.load_desc();
	};

	$scope.load_tabs=function(){
		$http.get('cardpage/get_tabs?slug='+$scope.current_slug).success(function(data){
			$scope.tabs=data;
		});
	};

	$scope.load_desc=function(){
		$http.get('cardpage/get_desc?slug='+$scope.current_slug).success(function(data){
			$scope.desc=(data&&data.id)?data:{page_slug:$scope.current_slug,active:1};
		});
	};

	$scope.days_array=[];

	$scope.new_tab=function(){
		$scope.tab_form={page_slug:$scope.current_slug,active:1,sort_order:$scope.tabs.length};
		$scope.days_array=[];
	};

	$scope.edit_tab=function(tab){
		$scope.tab_form=angular.copy(tab);
		try{ $scope.days_array=tab.day_data?JSON.parse(tab.day_data):[]; }
		catch(e){ $scope.days_array=[]; }
	};

	$scope.add_day=function(){
		$scope.days_array.push({day:'Day '+($scope.days_array.length+1),title:'',desc:''});
	};

	$scope.remove_day=function(idx){
		$scope.days_array.splice(idx,1);
	};

	$scope.save_tab=function(){
		var d=angular.copy($scope.tab_form);
		d.page_slug=$scope.current_slug;
		d.day_data=JSON.stringify($scope.days_array);
		$http.post('cardpage/save_tab',$.param(d),{headers:{'Content-Type':'application/x-www-form-urlencoded'}}).success(function(r){
			if(r*1>0){
				messages("success","Saved!","Tab saved successfully",3000);
				$scope.load_tabs();
				$('#cpTabModal').modal('hide');
			}else{
				messages("danger","Error!","Could not save tab",3000);
			}
		});
	};

	$scope.delete_tab=function(id){
		if(confirm("Delete this tab?")){
			$http.get('cardpage/delete_tab?id='+id).success(function(data){
				if(data=='1'){
					messages("success","Deleted!","Tab deleted",3000);
					$scope.load_tabs();
				}else{
					messages("danger","Error!","Could not delete tab",3000);
				}
			});
		}
	};

	$scope.save_desc=function(){
		$scope.desc.page_slug=$scope.current_slug;
		var d=angular.copy($scope.desc);
		$http.post('cardpage/save_desc',$.param(d),{headers:{'Content-Type':'application/x-www-form-urlencoded'}}).success(function(r){
			if(r=='1'){
				messages("success","Saved!","Description saved",3000);
				$scope.load_desc();
			}else{
				messages("danger","Error!","Could not save description",3000);
			}
		});
	};

	$scope.load_page();
});
