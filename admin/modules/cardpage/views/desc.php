<style>
.cp-bar{display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap;margin-bottom:22px;}
.cp-bar .form-group{margin-bottom:0;min-width:200px;}
.cp-section-title{font-size:15px;font-weight:700;color:#344054;padding-bottom:10px;border-bottom:2px solid #f0f2f5;margin-bottom:18px;}
</style>

<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li>Page Content</li>
	</ol>
</div>

<div class="col-sm-12 well">

	<div class="cp-bar">
		<div class="form-group">
			<label>Page</label>
			<select ng-model="current_slug" ng-change="load_desc()" class="form-control">
				<option value="all">All Packages (Default)</option>
				<option value="group-tour">Group Tour</option>
				<option value="family-tour">Family Tour</option>
				<option value="honeymoon-tour">Honeymoon Tour</option>
				<option value="luxury-tour">Luxury Tour</option>
			</select>
		</div>
	</div>

	<div class="cp-section-title">Page Description / SEO Content &mdash; <small class="text-muted">{{current_slug}}</small></div>

	<div class="row">
		<div class="col-sm-8">
			<div class="form-group">
				<label>Heading</label>
				<input type="text" ng-model="desc.heading" class="form-control" placeholder="e.g. Explore Bhutan Tour Packages from India">
			</div>
			<div class="form-group">
				<label>Body <small class="text-muted">(HTML supported)</small></label>
				<textarea ng-model="desc.body" class="form-control" rows="10" placeholder="Write your page description content here..."></textarea>
			</div>
			<div class="form-group">
				<label>
					<input type="checkbox" ng-model="desc.active" ng-true-value="1" ng-false-value="0"> Active (show on frontend)
				</label>
			</div>
			<button class="btn btn-success" ng-click="save_desc()">
				<i class="fa fa-save"></i> Save Content
			</button>
		</div>
		<div class="col-sm-4">
			<div class="alert alert-info" style="font-size:13px;line-height:1.7;">
				<strong>How it works</strong><br>
				This content appears below the package cards on the listing page.<br><br>
				<strong>Tips:</strong><br>
				&bull; Use separate content per page (e.g. Group Tour has its own description).<br>
				&bull; HTML tags like <code>&lt;b&gt;</code>, <code>&lt;ul&gt;&lt;li&gt;</code>, <code>&lt;h3&gt;</code> are supported in the body.<br>
				&bull; Toggle <em>Active</em> off to hide it without deleting.
			</div>
			<div ng-if="desc.id" class="alert alert-success" style="font-size:13px;">
				<i class="fa fa-check-circle"></i> Content saved for <strong>{{current_slug}}</strong>
			</div>
			<div ng-if="!desc.id" class="alert alert-warning" style="font-size:13px;">
				<i class="fa fa-info-circle"></i> No content saved for <strong>{{current_slug}}</strong> yet.
			</div>
		</div>
	</div>

</div>
