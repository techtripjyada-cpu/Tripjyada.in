<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li><a href="javascript:void(0)">Card</a></li>
	</ol>
</div>

<div class="col-sm-12 well admin-module-panel admin-package-screen admin-package-card-screen">
	<div class="col-sm-5 admin-package-form-col">
		<form name="form1" id="form1" method="post" action="" autocomplete="off" ng-submit="save_data($event)" novalidate>
			<input name="p_id" ng-model="x.p_id" hidden>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Category</label></div>
			<div class="col-sm-9 admin-form-field">
				<select name="category" class="form-control" ng-model="x.category" required>
					<option value="">--Select--</option>
					<option ng-repeat="cat in categories" value="{{cat.slug}}">{{cat.name}}</option>
				</select>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Title</label></div>
			<div class="col-sm-9 admin-form-field">
				<input name="title" class="form-control" ng-model="x.title" required>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Days</label></div>
			<div class="col-sm-9 admin-form-field">
				<input name="days" class="form-control" ng-model="x.days" placeholder="5 Days 4 Nights" required>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Price</label></div>
			<div class="col-sm-9 admin-form-field">
				<input name="price" class="form-control" ng-model="x.price"
					ng-disabled="x.price_on_request == '1'"
					placeholder="e.g. 25000">
				<div style="margin-top:8px">
					<label style="font-weight:normal;cursor:pointer">
						<input type="checkbox" name="price_on_request"
							ng-model="x.price_on_request"
							ng-true-value="'1'" ng-false-value="'0'"
							style="width:16px;height:16px;vertical-align:middle;margin-right:6px">
						Show <strong>"Price On Request"</strong> on frontend
					</label>
				</div>
				<p class="help-block" style="font-size:12px;margin-top:4px">
					Group Tour shows actual price by default. All other categories always show "Price On Request" unless overridden here.
				</p>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Amenities-icon</label></div>
			<div class="col-sm-9 admin-form-field">
				<input type="file" name="amenity_icons[]" id="amenity_icons" class="amenity-icon-input" multiple accept="image/*,.svg">
				<input type="file" name="amenity_icons[]" class="amenity-icon-input" accept="image/*,.svg">
				<input type="file" name="amenity_icons[]" class="amenity-icon-input" accept="image/*,.svg">
				<input type="file" name="amenity_icons[]" class="amenity-icon-input" accept="image/*,.svg">
				<input type="file" name="amenity_icons[]" class="amenity-icon-input" accept="image/*,.svg">
				<input type="file" name="amenity_icons[]" class="amenity-icon-input" accept="image/*,.svg">
				<input ng-model="x.amenity_icons" name="old_amenity_icons" hidden>
				<input ng-model="x.keep_amenity_icons" name="keep_amenity_icons" hidden>
				<p class="help-block" style="font-size: 12px">Upload multiple amenity icons. Use the first field for multi-select, or use each row for one icon.</p>
				<div class="amenity-icon-preview" ng-if="x.amenity_icons">
					<span class="amenity-icon-item" ng-repeat="icon in x.amenity_icons.split(',')" ng-if="icon">
						<img ng-src="<?=base_url("assets/uploads/packages/icons")?>/{{icon}}" alt="Amenity icon" loading="lazy">
						<button type="button" ng-click="remove_amenity_icon(icon)" aria-label="Remove icon">&times;</button>
					</span>
				</div>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Highlights</label></div>
			<div class="col-sm-9 admin-form-field">
				<textarea name="highlights" class="form-control" ng-model="x.highlights" rows="4" placeholder="Grand Palace Bangkok, Coral Island"></textarea>
				<p class="help-block" style="font-size: 12px">Separate highlights by comma.</p>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Amenities</label></div>
			<div class="col-sm-9 admin-form-field">
				<textarea name="amenities" class="form-control" ng-model="x.amenities" rows="3" placeholder="Breakfast, Hotel, Transport"></textarea>
				<p class="help-block" style="font-size: 12px">Separate amenities by comma.</p>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Sort Order</label></div>
			<div class="col-sm-9 admin-form-field">
				<input name="sort_order" type="number" class="form-control" ng-model="x.sort_order">
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3"><label>Best Selling</label></div>
			<div class="col-sm-3">
				<input type="checkbox" class="form-check" name="best_selling" ng-model="x.best_selling" ng-true-value="'1'" ng-false-value="'0'">
			</div>
			<div class="col-sm-3"><label>Status</label></div>
			<div class="col-sm-3">
				<input type="checkbox" class="form-check" name="status" ng-model="x.status" ng-true-value="'1'" ng-false-value="'0'">
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-4">
				<input type="file" name="image" id="package_image">
				<input ng-model="x.image" name="old_image" hidden>
				<p class="help-block" style="font-size: 12px">Select card image. Leave blank to use the default frontend image.</p>
			</div>

			<div class="col-sm-5" ng-show="x.image">
				<img src="<?=base_url("assets/uploads/packages/thumb")?>/{{x.image}}" class="img-responsive" style="height: 120px;" alt="Package image" loading="lazy">
			</div>
			<div class="col-sm-5" ng-show="!x.image && x.default_image">
				<img src="<?=base_url("assets/images/product")?>/{{x.default_image}}" class="img-responsive" style="height: 120px;" alt="Package image" loading="lazy">
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-12">
				<div id="webprogress" style="display: none">
					<img src="<?=base_url()?>assets/images/progress/load1.gif" alt="Loading indicator" loading="lazy">
				</div>
				<button type="submit" id="submitbtn" accesskey="s" class="btn btn-info" ng-disabled="form1.$invalid || isSavingCard">
					{{isSavingCard ? 'Saving...' : 'Save'}}
				</button>
				<a class="btn btn-default" accesskey="c" ng-click="filter_new()"><u><b>C</b></u>lear</a>
				<br><br>
			</div>
		</form>
	</div>

	<?php include 'data.php';?>
</div>


<style>
.admin-package-screen .admin-package-form-col {
	padding-left: 10px;
	padding-right: 10px;
}

.admin-package-screen .admin-form-label label {
	display: block;
	padding-top: 10px;
	font-weight: 700;
	color: #344054;
}

.admin-package-screen .admin-form-field {
	margin-bottom: 12px;
}

.admin-package-screen .table-data table {
	min-width: 860px;
}

.form-check {
	display: block;
	width: 30px;
	height: 30px;
}
.amenity-icon-preview {
	display: flex;
	flex-wrap: wrap;
	gap: 8px;
	margin-top: 8px;
}
.amenity-icon-item {
	display: inline-block;
	position: relative;
}
.amenity-icon-item img {
	border: 1px solid #ddd;
	border-radius: 4px;
	height: 32px;
	object-fit: contain;
	padding: 4px;
	width: 32px;
}
.amenity-icon-item button {
	background: #d9534f;
	border: 0;
	border-radius: 50%;
	color: #fff;
	font-size: 14px;
	height: 18px;
	line-height: 16px;
	padding: 0;
	position: absolute;
	right: -7px;
	top: -7px;
	width: 18px;
}
.amenity-icon-input {
	display: block;
	margin-bottom: 6px;
}

@media (max-width: 1199px) {
	.admin-package-screen .admin-package-form-col {
		width: 100%;
		float: none;
	}
}

@media (max-width: 991px) {
	.admin-package-screen .admin-form-label,
	.admin-package-screen .admin-form-field {
		width: 100%;
		float: none;
	}

	.admin-package-screen .admin-form-label label {
		padding-top: 0;
		margin-bottom: 6px;
	}
}
</style>
