var app=angular.module('groveusCms',['ui.bootstrap','ui.router','summernote','angularUtils.directives.dirPagination']);
app.config(function($stateProvider, $urlRouterProvider)
{
    $urlRouterProvider.otherwise('/home');
    $stateProvider
    	.state
    	('home', {
	        url: '/home',
	        templateUrl: 'dashboard/admin',
	        controller: 'ctrl_dashboard'
    	})
    	.state
    	('contact', {
	        url: '/contact',
	        templateUrl: 'contact',
	        controller: 'ctrl_contact'
		})
		.state
    	('newsletter', {
	        url: '/newsletter',
	        templateUrl: 'newsletter',
	        controller: 'ctrl_newsletter'
		})
		.state
    	('city', {
	        url: '/city',
	        templateUrl: 'city',
	        controller: 'ctrl_city'
		})
		.state
    	('booking', {
	        url: '/booking',
	        templateUrl: 'contact/booking',
	        controller: 'ctrl_booking'
    	})
    	.state
    	('reviews', {
	        url: '/reviews',
	        templateUrl: 'reviews',
	        controller: 'ctrl_reviews'
    	})
    	.state
    	('offers', {
	        url: '/offers',
	        templateUrl: 'offers',
	        controller: 'ctrl_offers'
    	})
    	.state
    	('informations', {
	        url: '/informations',
	        templateUrl: 'informations',
	        controller: 'ctrl_informations'
		})
		.state
    	('organisation', {
	        url: '/organisation',
	        templateUrl: 'organisation',
	        controller: 'ctrl_organisation'
		})
		.state
    	('slider', {
	        url: '/slider',
	        templateUrl: 'slider',
	        controller: 'ctrl_slider'
    	})
    	   	.state
    	('sub_menu', {
	        url: '/sub_menu',
	        templateUrl: 'sub_menu',
	        controller: 'ctrl_sub_menu'
    	})
    	  	.state
    	('users', {
	        url: '/users',
	        templateUrl: 'users',
	        controller: 'ctrl_users'
    	})
    	  .state
    	('album', {
	        url: '/album',
	        templateUrl: 'album',
	        controller: 'ctrl_album'
    	})
    	   .state
    	('video', {
	        url: '/video',
	        templateUrl: 'video',
	        controller: 'ctrl_video'
    	})
    	.state
    	('blog', {
	        url: '/blog',
	        templateUrl: 'blog',
	        controller: 'ctrl_blog'
		})
    	.state
    	('card', {
	        url: '/card',
	        templateUrl: 'packages',
	        controller: 'ctrl_packages'
		})
		.state
    	('cardpage', {
	        url: '/cardpage',
	        templateUrl: 'cardpage',
	        controller: 'ctrl_cardpage'
		})
		.state
    	('cardpage_tabs', {
	        url: '/cardpage_tabs',
	        templateUrl: 'cardpage/tabs',
	        controller: 'ctrl_cardpage_tabs'
		})
		.state
    	('cardpage_desc', {
	        url: '/cardpage_desc',
	        templateUrl: 'cardpage/desc_page',
	        controller: 'ctrl_cardpage_desc'
		})
    	.state
    	('packages', {
	        url: '/packages',
	        templateUrl: 'packages/details',
	        controller: 'ctrl_package_details'
		})
    	.state
    	('branches', {
	        url: '/branches',
	        templateUrl: 'branches',
	        controller: 'ctrl_branches'
		})
		.state
    	('ship_main', {
	        url: '/ship_main',
	        templateUrl: 'ship_main',
	        controller: 'ctrl_ship_main'
		})
		.state
    	('ship_tracking', {
	        url: '/ship_tracking',
	        templateUrl: 'ship_tracking',
	        controller: 'ctrl_ship_tracking'
		})
		.state
    	('team', {
	        url: '/team',
	        templateUrl: 'team',
	        controller: 'ctrl_team'
    	})
    	.state
    	('page', {
	        url: '/page',
	        templateUrl: 'page',
	        controller: 'ctrl_page'
    	})
	   	   .state
    	('admin_profile', {
	        url: '/admin_profile',
	        templateUrl: 'admin_profile',
	        controller: 'ctrl_admin'
    	})
	    .state
		('gallery', {
	        url: '/gallery',
	        templateUrl: 'gallery',
	        controller: 'ctrl_gallery'
	    })
	      .state
    	('change_logo', {
	        url: '/change_logo',
	        templateUrl: 'change_logo',
	        controller: 'ctrl_change_logo'
	     })

	    .state
		('change_password', {
	        url: '/change_password',
	        templateUrl: 'login/change_password',
	        controller: 'ctrl_login'
	    })
	    .state
		('logs', {
	        url: '/logs',
	        templateUrl: 'logs',
	        controller: 'ctrl_logs'
	    })
	    .state
		('payments', {
	        url: '/payments',
	        templateUrl: 'payments',
	        controller: 'ctrl_payments'
	    })
});
