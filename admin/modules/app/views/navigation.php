<style>
.panel-list li ul li {
	padding: 5px 20px 5px 20px;
}

#hoe-left-panel.admin-sidebar {
	background: #ffffff;
	border-right: 1px solid #edf0f5;
	box-shadow: 4px 0 24px rgba(17, 24, 39, 0.06);
	overflow-x: hidden !important;
	overflow-y: auto !important;
	position: fixed !important;
	top: 50px !important;
	height: calc(100vh - 50px) !important;
}

#hoe-left-panel.admin-sidebar .profile-box {
	padding: 20px 16px 18px;
	background: linear-gradient(180deg, #fff7ef 0%, #ffffff 100%);
	border-bottom: 1px solid #f0f2f5;
}

.admin-sidebar-brand {
	display: flex;
	align-items: center;
	gap: 12px;
	text-decoration: none !important;
}

.admin-sidebar-logo {
	width: 44px;
	height: 44px;
	padding: 5px;
	border-radius: 8px;
	background: #ffffff;
	box-shadow: 0 8px 18px rgba(255, 122, 0, 0.18);
	object-fit: contain;
}

.admin-sidebar-user {
	min-width: 0;
}

.admin-sidebar-welcome {
	margin: 0 0 3px;
	color: #667085;
	font-size: 12px;
	font-weight: 600;
	line-height: 1.2;
}

.admin-sidebar-name {
	display: block;
	color: #111827;
	font-size: 14px;
	font-weight: 700;
	line-height: 1.25;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

.admin-sidebar-role {
	display: inline-block;
	margin-top: 6px;
	padding: 3px 9px;
	border-radius: 999px;
	background: #fff0df;
	color: #f97316;
	font-size: 11px;
	font-weight: 700;
}

#hoe-left-panel.admin-sidebar .panel-list {
	padding: 12px 10px 22px;
}

#hoe-left-panel.admin-sidebar .panel-list > li {
	margin: 4px 0;
}

#hoe-left-panel.admin-sidebar .panel-list > li > a {
	position: relative;
	display: flex;
	align-items: center;
	gap: 11px;
	min-height: 42px;
	padding: 10px 12px;
	border-radius: 7px;
	border: 0;
	color: #344054;
	font-weight: 600;
	transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
}

#hoe-left-panel.admin-sidebar .panel-list > li > a:before {
	content: "";
	position: absolute;
	left: 0;
	top: 10px;
	bottom: 10px;
	width: 3px;
	border-radius: 999px;
	background: transparent;
}

#hoe-left-panel.admin-sidebar .panel-list > li > a .fa {
	width: 30px;
	height: 30px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	border-radius: 7px;
	background: #f3f6fb;
	color: #667085;
	font-size: 14px;
	transition: background 0.2s ease, color 0.2s ease;
}

#hoe-left-panel.admin-sidebar .panel-list > li > a span.menu-text {
	line-height: 1.2;
}

#hoe-left-panel.admin-sidebar .panel-list > li > a:hover,
#hoe-left-panel.admin-sidebar .panel-list > li > a:focus,
#hoe-left-panel.admin-sidebar .panel-list > li.active > a {
	background: #fff4e8;
	color: #f97316;
	transform: translateX(2px);
}

#hoe-left-panel.admin-sidebar .panel-list > li > a:hover:before,
#hoe-left-panel.admin-sidebar .panel-list > li > a:focus:before,
#hoe-left-panel.admin-sidebar .panel-list > li.active > a:before {
	background: #f97316;
}

#hoe-left-panel.admin-sidebar .panel-list > li > a:hover .fa,
#hoe-left-panel.admin-sidebar .panel-list > li > a:focus .fa,
#hoe-left-panel.admin-sidebar .panel-list > li.active > a .fa {
	background: #f97316;
	color: #ffffff;
}

#hoe-left-panel.admin-sidebar .panel-list > li.admin-menu-child {
	margin: -1px 0 6px 18px;
}

#hoe-left-panel.admin-sidebar .panel-list > li.admin-menu-child > a {
	min-height: 36px;
	padding: 8px 10px;
	color: #667085;
	font-size: 13px;
}

#hoe-left-panel.admin-sidebar .panel-list > li.admin-menu-child > a .fa {
	height: 24px;
	width: 24px;
	font-size: 12px;
}

.hoe-minimized-lpanel #hoe-left-panel.admin-sidebar .profile-box {
	padding: 10px 7px;
	justify-content: center;
}

.hoe-minimized-lpanel #hoe-left-panel.admin-sidebar .admin-sidebar-user {
	display: none;
}

.hoe-minimized-lpanel #hoe-left-panel.admin-sidebar .admin-sidebar-logo {
	width: 34px;
	height: 34px;
}

.hoe-minimized-lpanel #hoe-left-panel.admin-sidebar .panel-list {
	padding: 10px 5px 18px;
}

.hoe-minimized-lpanel #hoe-left-panel.admin-sidebar .panel-list > li > a {
	padding: 7px 0;
	justify-content: center;
	gap: 0;
	min-height: 40px;
}

.hoe-minimized-lpanel #hoe-left-panel.admin-sidebar .panel-list > li > a .fa {
	width: 32px;
	height: 32px;
	flex-shrink: 0;
}

.hoe-minimized-lpanel #hoe-left-panel.admin-sidebar .panel-list > li > a:before {
	display: none;
}

/* ── Mobile: sidebar as fixed overlay, content full-width ── */
@media (max-width: 767px) {
	/* Sidebar slides off-canvas by default */
	#hoe-left-panel {
		position: fixed !important;
		top: 50px !important;
		left: 0 !important;
		height: calc(100vh - 50px) !important;
		width: 265px !important;
		z-index: 1025 !important;
		overflow-y: auto !important;
		overflow-x: hidden !important;
		transform: translateX(-100%);
		transition: transform 0.26s ease;
		box-shadow: none !important;
	}
	/* Sidebar visible when toggled (hoe-hide-lpanel removed) */
	#hoeapp-wrapper:not(.hoe-hide-lpanel) #hoe-left-panel {
		transform: translateX(0) !important;
		box-shadow: 4px 0 24px rgba(0,0,0,.18) !important;
	}
	/* Dim backdrop behind open sidebar */
	#hoeapp-wrapper:not(.hoe-hide-lpanel)::after {
		content: '';
		position: fixed;
		inset: 0;
		top: 50px;
		background: rgba(0,0,0,.45);
		z-index: 1024;
	}
	/* Content always full width — no left margin */
	#main-content {
		margin-left: 0 !important;
	}
	/* Ensure inner content padding is readable */
	.inner-content { padding: 12px !important; }
	.db-wrap { padding: 12px 10px 24px !important; }
}
</style>
<div id="hoeapp-container" hoe-lpanel-effect="default">
	<aside id="hoe-left-panel" class="admin-sidebar" hoe-position-type="absolute">
		<div class="profile-box">
			<a class="admin-sidebar-brand" href="#/home">
				<img src="<?=base_url()?>assets/img/logo/logo.png" class="admin-sidebar-logo" alt="Tripjyada logo" loading="lazy">
				<span class="admin-sidebar-user">
					<span class="admin-sidebar-welcome">Welcome back</span>
					<span class="admin-sidebar-name"><?=$this->session->userdata('name');?></span>
					<span class="admin-sidebar-role">Administrator</span>
				</span>
			</a>
		</div>
		<ul class="nav panel-list">

			<li><a accesskey="h" href="#/home"><i class="fa fa-dashboard"></i>
				<span class="menu-text">Dashboard
				</span><span class="selected"></span></a>
			</li>
			<li class="sidepadding"><a accesskey="m" href="#/blog"><i
			class="fa fa-bullhorn"></i><span class="menu-text">Blog</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/card"><i
			class="fa fa-suitcase"></i><span class="menu-text">Card</span><span
			class="selected"></span></a></li>
			<li class="sidepadding admin-menu-child"><a accesskey="p" href="#/packages"><i
			class="fa fa-briefcase"></i><span class="menu-text">Packages</span><span
			class="selected"></span></a></li>
			<li class="sidepadding admin-menu-child"><a accesskey="t" href="#/cardpage_tabs"><i
			class="fa fa-list-ol"></i><span class="menu-text">Tab Content</span><span
			class="selected"></span></a></li>
			<li class="sidepadding admin-menu-child"><a accesskey="e" href="#/cardpage_desc"><i
			class="fa fa-file-text-o"></i><span class="menu-text">Page Content</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/booking"><i
			class="fa fa-list"></i><span class="menu-text">Bookings</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/payments"><i
			class="fa fa-credit-card"></i><span class="menu-text">Payments</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/contact"><i
			class="fa fa-list"></i><span class="menu-text">Contacts</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/newsletter"><i
			class="fa fa-list"></i><span class="menu-text">Newsletter</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/reviews"><i
			class="fa fa-photo"></i><span class="menu-text">Reviews</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/city"><i
			class="fa fa-photo"></i><span class="menu-text">City</span><span
			class="selected"></span></a></li>
			 
			<li class="sidepadding"><a accesskey="m" href="#/offers"><i
			class="fa fa-bullhorn"></i><span class="menu-text">Offers</span><span
			class="selected"></span></a></li>
			<!--<li class="sidepadding"><a accesskey="m" href="#/ship_main"><i
			class="fa fa-truck"></i><span class="menu-text">Shipment Orders</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/ship_tracking"><i
			class="fa fa-arrows-alt"></i><span class="menu-text">Shipment Tracking</span><span
			class="selected"></span></a></li>  -->
			<li class="sidepadding"><a accesskey="m" href="#/gallery"><i
			class="fa fa-photo"></i><span class="menu-text">Gallery</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="u" href="#/users"><i
			class="fa fa-users"></i><span class="menu-text">Users &amp; OTP</span><span
			class="selected"></span></a></li>
		</ul>
	</aside>
	<section id="main-content">
