//blank line is required
app.controller('ctrl_album',function($scope,$http,$filter){
	$http.get('login/check_valid_session').success (function(data) {if(data!=1){window.location.assign('<?=site_url("login")?>');}});
	
	$scope.htmlToPlaintext=function(text){
		text=text ? String(text).replace(/<[^>]+>/gm, '') : '';
		text=text.substr(0,90);
		return text;
	}
	
	$http.get("album/view_data").success(function(data){
		$scope.albums=data;
	})
	
	$scope.update_call=function(z){
		$scope.x=z;
	}
	$scope.options = {
		    height: 200,
		    toolbar: [
		               ['style', ['style','bold', 'italic', 'underline']],
      		           ['fontname', ['fontname']],
      		           ['fontsize', ['fontsize']],
      		           ['color', ['color']],
      		           ['table',['table']],
      		           [ 'insert', [ 'link' ]],
      	               ["view", ["codeview"]]
		        ]
		  };
	
	$scope.filter_new=function(){
		$scope.x={};
	}
	$scope.save_data=function(x){
		$('#submitbtn2').attr('disabled',true);
		$.ajax({
			type: "POST",
			url: "album/save_data",
			data: $("#form2").serialize(),
			beforeSend: function()
			{
				$('#webprogress2').css('display','inline');
			},
			success: function(data){
				if(data=="1")
				{
					$("#result2").html("<div class='alert alert-success'>Data Saved Successfully</div>");
					$http.get("album/view_data").success(function(data){
						$scope.albums=data;
					})
					$scope.x={};
					$("#validation2").html("");
				}
				else if(data=="0")
				{
					$("#result2").html("<div class='alert alert-info'>No Data Affected</div>");
					$("#validation2").html("");
				}
				else
				{
					$("#validation2").html("<div class='alert alert-danger'>"+data+"</div>");
					$("#result2").html("");
				}
				$('#webprogress2').css('display','none');
			}
		});
		$('#submitbtn2').attr('disabled',false);
	}
	$scope.delete_data=function(x)
	{
//		console.log(x);
		if(confirm("Are you Sure to DELETE ??"))
		{
			$http.get("album/delete_data?id="+x).success(function(data)
			{
				console.log(data);
				if(data=="1")
				{
					$("#result2").html("<div class='alert alert-success'>Data Deleted Successfully</div>");
				}
				else
				{
					$("#result2").html("<div class='alert alert-danger'>Data not Deleted</div>");
				}
				$http.get("album/view_data").success(function(data){
					$scope.albums=data;
				})
			})
		}
	}
});