//blank line is required
app.controller('ctrl_packages',function($scope,$http){
	$http.get('login/check_valid_session').success (function(data) {if(data!=1){window.location.assign('<?=site_url("login")?>');}});

	$scope.categories = [];
	$scope.new_category_name = '';
	$scope.filter_category = '';
	$scope.isSavingCard = false;

	function normaliseResponse(response) {
		if (angular.isObject(response)) {
			return response;
		}
		if (typeof response === 'string') {
			try {
				return JSON.parse(response);
			} catch (e) {
				return {status: 'error', message: response};
			}
		}
		return {status: 'error', message: 'Unexpected server response.'};
	}

	// Category filter function used in dir-paginate
	$scope.categoryFilter = function(item) {
		if (!$scope.filter_category) return true;
		return item.category === $scope.filter_category || item.category_slug === $scope.filter_category;
	};

	// Count packages per category
	$scope.getCatCount = function(slug) {
		if (!$scope.datadb) return 0;
		return $scope.datadb.filter(function(p) {
			return p.category === slug || p.category_slug === slug;
		}).length;
	};

	// Get display name for a category slug
	$scope.getCatName = function(slug) {
		var cat = ($scope.categories || []).find(function(c) { return c.slug === slug; });
		return cat ? cat.name : slug;
	};

	// Assign a stable colour per category index
	var _catColors = ['#5b8dd9','#e07b39','#6aab6a','#9b59b6','#e74c3c','#1abc9c','#f39c12','#2980b9'];
	$scope.getCatColor = function(slug) {
		var cats = $scope.categories || [];
		var idx = cats.findIndex(function(c) { return c.slug === slug; });
		return idx >= 0 ? _catColors[idx % _catColors.length] : '#777';
	};

	$scope.load_categories = function(){
		$http.get("packages/get_categories").success(function(data){
			$scope.categories = data;
		});
	};

	$scope.save_category = function(){
		if(!$scope.new_category_name){ return; }
		$http.post("packages/save_category",
			"name=" + encodeURIComponent($scope.new_category_name),
			{headers:{'Content-Type':'application/x-www-form-urlencoded'}}
		).success(function(data){
			if(data == "1"){
				messages("success","Success!","Category added successfully",3000);
				$scope.new_category_name = '';
				$scope.load_categories();
			} else {
				try{ var r=JSON.parse(data); messages("danger","Error!",r.error,4000); }
				catch(e){ messages("danger","Error!",data,4000); }
			}
		});
	};

	$scope.delete_category = function(id){
		if(confirm("Remove this category?\n\nPackages assigned to it will remain in the database but won't appear in frontend tabs until reassigned.")){
			$http.get("packages/delete_category?id="+id).success(function(data){
				if(data=="1"){
					messages("success","Deleted!","Category removed",3000);
					$scope.load_categories();
				} else {
					messages("danger","Error!","Could not remove category",4000);
				}
			});
		}
	};

	$scope.start_rename = function(cat){
		cat._editing = true;
		cat._new_name = cat.name;
	};

	$scope.cancel_rename = function(cat){
		cat._editing = false;
		cat._new_name = '';
	};

	$scope.save_rename = function(cat){
		var name = (cat._new_name || '').trim();
		if(!name){ messages("warning","Warning!","Name cannot be empty",3000); return; }
		$http.post("packages/rename_category",
			"id=" + cat.cat_id + "&name=" + encodeURIComponent(name),
			{headers:{'Content-Type':'application/x-www-form-urlencoded'}}
		).success(function(data){
			if(data=="1"){
				cat.name = name;
				cat._editing = false;
				messages("success","Saved!","Category renamed",3000);
				$scope.load_categories();
			} else {
				messages("danger","Error!","Could not rename",4000);
			}
		});
	};

	$scope.load_categories();

	$scope.loader=function(){
		$http.get("packages/view_data").success(function(data){
			$scope.datadb=data;
		})
	}

	$scope.loader();

	$scope.update_call=function(y){
		$scope.x=angular.copy(y);
		$scope.x.keep_amenity_icons=$scope.x.amenity_icons || '';
	}

	$scope.filter_new=function(){
		var default_cat = $scope.categories && $scope.categories.length > 0 ? $scope.categories[0].slug : 'group-tour';
		$scope.x={category: default_cat, status:'1', best_selling:'0', sort_order:'0', amenity_icons:'', keep_amenity_icons:''};
		document.getElementById('package_image').value='';
		angular.forEach(document.querySelectorAll('.amenity-icon-input'), function(input){
			input.value='';
		});
	}

	$scope.filter_new();

	$scope.remove_amenity_icon=function(icon){
		var icons=($scope.x.amenity_icons || '').split(',').filter(function(item){
			return item && item !== icon;
		});
		$scope.x.amenity_icons=icons.join(',');
		$scope.x.keep_amenity_icons=$scope.x.amenity_icons;
	}

	$scope.save_data=function($event){
		if ($event && angular.isFunction($event.preventDefault)) {
			$event.preventDefault();
		}
		if ($scope.isSavingCard) {
			return false;
		}

		$('#form1').ajaxSubmit({
			type: "POST",
			url: "packages/save_data",
			dataType: "json",
			beforeSend: function()
			{
				$scope.isSavingCard = true;
				$('#submitbtn').attr('disabled',true);
				$('#webprogress').css('display','inline');
			},
			success: function(response){
				var data = normaliseResponse(response);
				$scope.$applyAsync(function(){
					if(data.status === "success")
					{
						$scope.loader();
						messages("success", "Success!", data.message || "Card saved successfully.", 3000);
						$scope.filter_new();
					}
					else if(data.status === "noop")
					{
						messages("warning", "Info!", data.message || "No data was changed.", 3000);
					}
					else
					{
						messages("danger", "Warning!", data.message || "Could not save the card.", 4000);
					}
				});
			},
			error: function(xhr){
				var data = normaliseResponse(xhr && xhr.responseText ? xhr.responseText : '');
				messages("danger", "Warning!", data.message || "The save request failed. Please try again.", 4000);
			},
			complete: function(){
				$('#webprogress').css('display','none');
				$('#submitbtn').attr('disabled',false);
				$scope.$applyAsync(function(){
					$scope.isSavingCard = false;
				});
			}
		});
		return false;
	}

	$scope.delete_data=function(id)
	{
		if(confirm("Deleting card may remove the frontend card."))
		{
			if(confirm("Are you Sure to DELETE ??"))
			{
				$http.get("packages/delete_data?id="+id).success(function(data){
					console.log(data);
					if(data=="1")
					{
						messages("success", "Success!","Card Deleted Successfully", 3000);
					}
					else
					{
						messages("danger", "Warning!","Card not Deleted", 4000);
					}
					$scope.loader();
				})
			}
		}
	}
});
