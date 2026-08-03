//blank line is required
app.controller('ctrl_package_details',function($scope,$http){
	$http.get('login/check_valid_session').success(function(data){if(data!=1){window.location.assign('<?=site_url("login")?>');}});

	$scope.categories = [];
	$scope.filter_category = '';
	$scope.isSavingDetails = false;
	$scope.saveFeedback = null;

	function normaliseResponse(response){
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

	$scope.load_categories = function(callback){
		$http.get("packages/get_categories").success(function(data){
			$scope.categories = data;
			if (angular.isFunction(callback)) {
				callback(data);
			}
		});
	};
	$scope.load_categories();

	$scope.new_category_name = '';

	$scope.save_category = function(){
		if(!$scope.new_category_name){ return; }
		$http.post("packages/save_category",
			"name=" + encodeURIComponent($scope.new_category_name),
			{headers:{'Content-Type':'application/x-www-form-urlencoded'}}
		).success(function(data){
			if(data=="1"){
				messages("success","Success!","Category added",3000);
				$scope.new_category_name = '';
				$scope.load_categories();
			} else {
				try{ var r=JSON.parse(data); messages("danger","Error!",r.error,4000); }
				catch(e){ messages("danger","Error!",data,4000); }
			}
		});
	};

	$scope.delete_category = function(id){
		if(confirm("Remove this category?\n\nPackages assigned to it will remain but won't appear in tabs until reassigned.")){
			$http.get("packages/delete_category?id="+id).success(function(data){
				if(data=="1"){ messages("success","Deleted!","Category removed",3000); $scope.load_categories(); }
				else { messages("danger","Error!","Could not remove category",4000); }
			});
		}
	};

	$scope.start_rename = function(cat){ cat._editing=true; cat._new_name=cat.name; };
	$scope.cancel_rename = function(cat){ cat._editing=false; cat._new_name=''; };
	$scope.save_rename = function(cat){
		var name=(cat._new_name||'').trim();
		if(!name){ messages("warning","Warning!","Name cannot be empty",3000); return; }
		$http.post("packages/rename_category",
			"id="+cat.cat_id+"&name="+encodeURIComponent(name),
			{headers:{'Content-Type':'application/x-www-form-urlencoded'}}
		).success(function(data){
			if(data=="1"){ cat.name=name; cat._editing=false; messages("success","Saved!","Category renamed",3000); $scope.load_categories(); }
			else { messages("danger","Error!","Could not rename",4000); }
		});
	};

	$scope.categoryFilter = function(item){
		if(!$scope.filter_category) return true;
		return item.category === $scope.filter_category || item.category_slug === $scope.filter_category;
	};

	$scope.getCatCount = function(slug){
		if(!$scope.datadb) return 0;
		return $scope.datadb.filter(function(p){ return p.category === slug || p.category_slug === slug; }).length;
	};

	$scope.getCatName = function(slug){
		var cat = ($scope.categories || []).find(function(c){ return c.slug === slug; });
		return cat ? cat.name : slug;
	};

	var _catColors = ['#5b8dd9','#e07b39','#6aab6a','#9b59b6','#e74c3c','#1abc9c','#f39c12','#2980b9'];
	$scope.getCatColor = function(slug){
		var idx = ($scope.categories || []).findIndex(function(c){ return c.slug === slug; });
		return idx >= 0 ? _catColors[idx % _catColors.length] : '#777';
	};

	$scope.loader=function(callback){
		$http.get("packages/view_data").success(function(data){
			$scope.datadb=data;
			if (angular.isFunction(callback)) {
				callback(data);
			}
		});
	}

	$scope.loader();
	$scope.x={};
	$scope.is_new = false;

	$scope.new_package = function(){
		$scope.x = { itinerary: [], inclusions: [], exclusions: [], faqs: [] };
		$scope.is_new = true;
		$scope.saveFeedback = null;
		document.getElementById('details_image').value='';
		var prev=document.getElementById('new_image_preview');
		if(prev){ prev.style.display='none'; }
	};

	$scope.cancel_new = function(){
		$scope.x = {};
		$scope.is_new = false;
		$scope.saveFeedback = null;
		document.getElementById('details_image').value='';
		var prev=document.getElementById('new_image_preview');
		if(prev){ prev.style.display='none'; }
	};

	function parseJsonField(val){ try{ return val ? JSON.parse(val) : []; }catch(e){ return []; } }

	$scope.options = {
		height: 250,
		toolbar: [
			['style', ['style','bold', 'italic', 'underline']],
			['fontname', ['fontname']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['table',['table']],
			['insert', ['link']],
			['view', ['codeview']]
		]
	};

	$scope.update_call=function(y){
		$scope.x=angular.copy(y);
		$scope.saveFeedback = null;
		$scope.x.remove_details_image='0';
		$scope.x.itinerary  = parseJsonField(y.itinerary_json);
		$scope.x.inclusions = parseJsonField(y.inclusions_json);
		$scope.x.exclusions = parseJsonField(y.exclusions_json);
		$scope.x.faqs       = parseJsonField(y.faqs_json);
		$scope.is_new = false;
		document.getElementById('details_image').value='';
		var prev=document.getElementById('new_image_preview');
		if(prev){ prev.style.display='none'; }
	}

	$scope.focusPackage = function(packageId){
		if (!packageId || !$scope.datadb) {
			return;
		}
		var selected = null;
		for (var i = 0; i < $scope.datadb.length; i++) {
			if (parseInt($scope.datadb[i].p_id, 10) === parseInt(packageId, 10)) {
				selected = $scope.datadb[i];
				break;
			}
		}
		if (selected) {
			$scope.update_call(selected);
		}
	};

	$scope.addItineraryDay = function(){
		if(!$scope.x.itinerary) $scope.x.itinerary = [];
		var num = $scope.x.itinerary.length + 1;
		$scope.x.itinerary.push({ day: 'Day ' + num, title: '', desc: '', stay: '', meals: '' });
	};

	$scope.clear_details=function(){
		if($scope.x && $scope.x.p_id){
			$scope.x.details='';
			$scope.saveFeedback = null;
		}
	}

	$scope.remove_details_image=function(){
		if($scope.x && $scope.x.p_id){
			$scope.x.remove_details_image='1';
			document.getElementById('details_image').value='';
		}
	}

	$scope.delete_data=function(id){
		if(confirm("Deleting this package will remove it from the frontend.")){
			if(confirm("Are you sure to DELETE?")){
				$http.get("packages/delete_data?id="+id).success(function(data){
					if(data=="1"){
						messages("success","Success!","Package Deleted Successfully",3000);
					} else {
						messages("danger","Warning!","Package not Deleted",4000);
					}
					$scope.loader();
					$scope.x={};
				});
			}
		}
	}

	$scope.save_details=function($event){
		if ($event && angular.isFunction($event.preventDefault)) {
			$event.preventDefault();
		}
		if ($scope.isSavingDetails || (!$scope.x.p_id && !$scope.is_new)) {
			return false;
		}
		if ($scope.is_new && !($scope.x.title || '').trim()) {
			$scope.saveFeedback = { type: 'danger', message: 'Title is required before posting a new package.' };
			messages("warning", "Warning!", "Title is required before posting a new package.", 3000);
			return false;
		}

		document.getElementById('itinerary_json_input').value  = JSON.stringify($scope.x.itinerary  || []);
		document.getElementById('inclusions_json_input').value = JSON.stringify($scope.x.inclusions || []);
		document.getElementById('exclusions_json_input').value = JSON.stringify($scope.x.exclusions || []);
		document.getElementById('faqs_json_input').value       = JSON.stringify($scope.x.faqs       || []);
		$('#packageDetailsForm textarea[name="details"]').val($scope.x.details || '');
		$('#packageDetailsForm').ajaxSubmit({
			type: "POST",
			url: "packages/save_details",
			dataType: "json",
			beforeSend: function()
			{
				$scope.isSavingDetails = true;
				$scope.saveFeedback = null;
				$('#detailssubmitbtn').attr('disabled',true);
				$('#detailsprogress').css('display','inline');
			},
			success: function(response){
				var data = normaliseResponse(response);
				$scope.$applyAsync(function(){
					if (data.status === 'success') {
						$scope.is_new = false;
						$scope.saveFeedback = { type: 'success', message: data.message || "Package saved successfully." };
						$scope.loader(function(){
							$scope.focusPackage(data.package_id);
						});
						messages("success", "Success!", $scope.saveFeedback.message, 3000);
					} else if (data.status === 'noop') {
						$scope.saveFeedback = { type: 'warning', message: data.message || "No changes were detected." };
						if (data.package_id) {
							$scope.loader(function(){
								$scope.focusPackage(data.package_id);
							});
						}
						messages("warning", "Info!", $scope.saveFeedback.message, 3000);
					} else {
						$scope.saveFeedback = { type: 'danger', message: data.message || "Could not save package details." };
						messages("danger", "Warning!", $scope.saveFeedback.message, 4000);
					}
				});
			},
			error: function(xhr){
				var data = normaliseResponse(xhr && xhr.responseText ? xhr.responseText : '');
				$scope.$applyAsync(function(){
					$scope.saveFeedback = { type: 'danger', message: data.message || "The save request failed. Please try again." };
				});
				messages("danger", "Warning!", data.message || "The save request failed. Please try again.", 4000);
			},
			complete: function(){
				$('#detailsprogress').css('display','none');
				$('#detailssubmitbtn').attr('disabled',false);
				$scope.$applyAsync(function(){
					$scope.isSavingDetails = false;
				});
			}
		});
		return false;
	}
});
