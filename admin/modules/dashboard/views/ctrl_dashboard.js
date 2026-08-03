//blank line is required
app.controller('ctrl_dashboard',function($scope,$http)
{
	$http.get('login/check_valid_session').success (function(data) {if(data!=1){window.location.assign('<?=site_url("login")?>');}});

	$http.get("dashboard/fetch_cards_data").success(function(data)
	{
		$scope.logs=data['logs'];
		$scope.blog=data['blog'];
		$scope.bookings=data['bookings'];
		$scope.contact=data['contact'];
		$scope.branches=data['branches'];
		$scope.gallery=data['gallery'];
		$scope.newsletter=data['newsletter'];
		$scope.reviews=data['reviews'];
		$scope.cards=data['cards'];
//		$scope.video_row=data['video'];
//		$scope.album_row=data['album'];
//		$scope.admin_row=data['admin_profile'];
//		$scope.news_row=data['news'];
//		$scope.member_row=data['member'];
	})


});
