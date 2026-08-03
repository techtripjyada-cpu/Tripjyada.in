//blank line is required
app.controller('ctrl_gallery',function($scope,$http){
	$http.get('login/check_valid_session').success (function(data) {if(data!=1){window.location.assign('<?=site_url("login")?>');}});
	
	$http.get("album/view_data?data=album_id,title").success(function(data){
		$scope.albums=data;
	})
	$scope.refresh_albums=function(){
		$http.get("album/view_data?data=album_id,title").success(function(data){
			$scope.albums=data;
		})
		console.log("refreshed");
	}
	$scope.fetch_album_name=function(id){
		$http.get("album/view_data?id="+id+"&data=title").success(function(data){
			return data['0']['title'];
		})
	}
	$http.get("gallery/view_data").success(function(data){
		$scope.datadb=data;
	})
	$scope.filter_image=function(x){
		if(x=="0"){
			$scope.search_text="";
		}
		else{
			$scope.search_text=x;
		}
		$scope.refresh_albums();
	}
	
	$scope.insert_data=function(){
		$('#form').ajaxForm({
			type: "POST",
			url: "gallery/image_upload",
			beforeSend:function(){
				$("#btnsubmit").text('Please Wait Uploading the image...');
				$("#btnsubmit").prop('disabled',true);
				$('#webprogress').css('display','inline');
			},
			success:function(data){
				console.log(data);
				if(data=="1")
				{
					$("#result").html("<div class='alert alert-success'>Image Uploaded Successfully</div>");
					$http.get("gallery/view_data").success(function(data){
						$scope.datadb=data;
					})
					$scope.x={};
					$("#validation").html("");
				}
				else if(data=="0")
				{
					$("#result").html("<div class='alert alert-info'>No Data Affected</div>");
					$("#validation").html("");
				}
				else
				{
					$("#validation").html("<div class='alert alert-danger'>"+data+"</div>");
					$("#result").html("");
				}
				$('#webprogress').css('display','none');
				$("#btnsubmit").text('Upload');
				$("#btnsubmit").prop('disabled',false);
			}
		});
	};
	
	$scope.filter_new=function(){
		$scope.x={};
	}
	
	$scope.delete_data=function(x)
	{
		if(confirm("Are you Sure to DELETE ??"))
		{
			$http.get("gallery/delete_data?id="+x.auto_id).success(function(data){
				if(data=="1")
				{
					$("#result").html("<div class='alert alert-success'>Image Deleted Successfully</div>");
				}
				else
				{
					$("#result").html("<div class='alert alert-danger'>Image not Deleted</div>");
				}
				$http.get("gallery/view_data").success(function(data){
					$scope.datadb=data;
				})
			})
		}
	}

});