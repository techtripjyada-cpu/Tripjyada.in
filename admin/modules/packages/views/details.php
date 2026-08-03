<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li><a href="javascript:void(0)">Packages</a></li>
	</ol>
</div>

<div class="col-sm-12 well admin-module-panel admin-package-screen admin-package-details-screen">
	<div class="col-sm-5 admin-package-form-col">
		<!-- Mode toggle -->
		<div class="admin-package-toolbar" style="margin-bottom:10px;display:flex;gap:8px;align-items:center;">
			<button type="button" class="btn btn-success btn-sm" ng-click="new_package()"
				ng-if="!is_new">
				<i class="fa fa-plus"></i> New Package
			</button>
			<button type="button" class="btn btn-default btn-sm" ng-click="cancel_new()"
				ng-if="is_new">
				<i class="fa fa-times"></i> Cancel New
			</button>
			<span ng-if="is_new" style="color:#5cb85c;font-size:13px;font-weight:600;">
				<i class="fa fa-pencil"></i> Creating new package
			</span>
			<span ng-if="x.p_id && !is_new" style="color:#337ab7;font-size:13px;">
				<i class="fa fa-edit"></i> Editing: <strong>{{x.title}}</strong>
			</span>
		</div>

		<form name="packageDetailsForm" id="packageDetailsForm" method="post" action="" autocomplete="off" ng-submit="save_details($event)" novalidate>
			<input name="p_id" ng-model="x.p_id" hidden>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Title <span ng-if="is_new" style="color:red">*</span></label></div>
			<div class="col-sm-9 admin-form-field">
				<!-- New package: editable -->
				<input ng-if="is_new" name="title" class="form-control" ng-model="x.title"
					placeholder="Package title (required)" required>
				<!-- Existing package: readonly -->
				<input ng-if="!is_new" class="form-control" ng-model="x.title" readonly
					placeholder="← Click a package from the list to edit">
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Category</label></div>
			<div class="col-sm-9 admin-form-field">
				<select name="category" class="form-control" ng-model="x.category">
					<option value="">-- {{is_new ? 'No Category (shows in All)' : 'No Change'}} --</option>
					<option ng-repeat="cat in categories" value="{{cat.slug}}">{{cat.name}}</option>
				</select>
				<p class="help-block" style="font-size:12px">
					{{is_new ? 'Select the category for this package.' : 'Change the category this package belongs to.'}}
				</p>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Price (&#8377;)</label></div>
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
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Days</label></div>
			<div class="col-sm-9 admin-form-field">
				<input name="days" class="form-control" ng-model="x.days" placeholder="5 Days 4 Nights">
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Highlights</label></div>
			<div class="col-sm-9 admin-form-field">
				<textarea name="highlights" class="form-control" ng-model="x.highlights" rows="3" placeholder="Grand Palace Bangkok, Coral Island"></textarea>
				<p class="help-block" style="font-size:12px">Separate highlights by comma.</p>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Amenities</label></div>
			<div class="col-sm-9 admin-form-field">
				<textarea name="amenities" class="form-control" ng-model="x.amenities" rows="3" placeholder="Breakfast, Hotel, Transport"></textarea>
				<p class="help-block" style="font-size:12px">Separate amenities by comma.</p>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Description</label></div>
			<div class="col-sm-9 admin-form-field">
				<textarea name="description" class="form-control" ng-model="x.description" rows="3"
					placeholder="Short description shown on the package detail page..."></textarea>
				<p class="help-block" style="font-size:12px">Visible description shown on the package page.</p>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Meta Description</label></div>
			<div class="col-sm-9 admin-form-field">
				<textarea name="meta_description" class="form-control" ng-model="x.meta_description" rows="2"
					placeholder="SEO meta description (max 160 characters)" maxlength="320"></textarea>
				<p class="help-block" style="font-size:12px">
					For search engines only — <strong>not visible on the page.</strong>
					Keep under 160 characters.
					<span ng-if="x.meta_description" style="color:#888"> ({{x.meta_description.length}} chars)</span>
				</p>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Details</label></div>
			<div class="col-sm-9 admin-form-field">
				<summernote config="options" ng-model="x.details"></summernote>
				<textarea name="details" ng-model="x.details" hidden></textarea>
				<p class="help-block" style="font-size: 12px">This content will show on the frontend package details page. Clear this box and save to remove details.</p>
			</div>

			<!-- Itinerary -->
			<div class="clearfix"></div>
			<div class="col-sm-12" style="margin-top:14px">
				<h5 style="margin:0 0 8px;font-weight:600;border-top:1px solid #ddd;padding-top:10px">
					<i class="fa fa-map-marker"></i> Day-by-Day Itinerary
				</h5>
				<div ng-repeat="day in x.itinerary track by $index" style="background:#f9f9f9;border:1px solid #e3e3e3;border-radius:4px;padding:8px;margin-bottom:8px">
					<div style="display:flex;gap:6px;align-items:center;margin-bottom:6px">
						<input type="text" class="form-control input-sm" ng-model="day.day" placeholder="Day 1" style="width:70px;flex:0 0 70px">
						<input type="text" class="form-control input-sm" ng-model="day.title" placeholder="Day title" style="flex:1">
						<button type="button" class="btn btn-danger btn-xs" ng-click="x.itinerary.splice($index,1)" title="Remove day"><i class="fa fa-trash"></i></button>
					</div>
					<textarea class="form-control input-sm" ng-model="day.desc" rows="2" placeholder="What happens this day..." style="margin-bottom:6px"></textarea>
					<div style="display:flex;gap:6px">
						<input type="text" class="form-control input-sm" ng-model="day.stay" placeholder="Stay (e.g. Paro)">
						<input type="text" class="form-control input-sm" ng-model="day.meals" placeholder="Meals (e.g. Breakfast, Dinner)">
					</div>
				</div>
				<button type="button" class="btn btn-default btn-sm" ng-click="addItineraryDay()" ng-disabled="!x.p_id && !is_new">
					<i class="fa fa-plus"></i> Add Day
				</button>
				<input type="hidden" name="itinerary_json" id="itinerary_json_input" value="">
				<p class="help-block" style="font-size:12px;margin-top:4px">Days display as expandable sections on the tour page. First day opens by default.</p>
			</div>

			<!-- Inclusions & Exclusions -->
			<div class="clearfix"></div>
			<div class="col-sm-6" style="margin-top:14px">
				<h5 style="margin:0 0 8px;font-weight:600;border-top:1px solid #ddd;padding-top:10px">
					<i class="fa fa-check-circle" style="color:#5cb85c"></i> What's Included
				</h5>
				<div ng-repeat="item in x.inclusions track by $index" style="display:flex;gap:6px;margin-bottom:4px">
					<input type="text" class="form-control input-sm" ng-model="x.inclusions[$index]" placeholder="e.g. Accommodation">
					<button type="button" class="btn btn-danger btn-xs" ng-click="x.inclusions.splice($index,1)"><i class="fa fa-times"></i></button>
				</div>
				<button type="button" class="btn btn-default btn-sm" ng-click="x.inclusions.push('')" ng-disabled="!x.p_id && !is_new">
					<i class="fa fa-plus"></i> Add Item
				</button>
				<input type="hidden" name="inclusions_json" id="inclusions_json_input" value="">
			</div>
			<div class="col-sm-6" style="margin-top:14px">
				<h5 style="margin:0 0 8px;font-weight:600;border-top:1px solid #ddd;padding-top:10px">
					<i class="fa fa-times-circle" style="color:#d9534f"></i> Not Included
				</h5>
				<div ng-repeat="item in x.exclusions track by $index" style="display:flex;gap:6px;margin-bottom:4px">
					<input type="text" class="form-control input-sm" ng-model="x.exclusions[$index]" placeholder="e.g. International flights">
					<button type="button" class="btn btn-danger btn-xs" ng-click="x.exclusions.splice($index,1)"><i class="fa fa-times"></i></button>
				</div>
				<button type="button" class="btn btn-default btn-sm" ng-click="x.exclusions.push('')" ng-disabled="!x.p_id && !is_new">
					<i class="fa fa-plus"></i> Add Item
				</button>
				<input type="hidden" name="exclusions_json" id="exclusions_json_input" value="">
			</div>

			<!-- FAQs -->
			<div class="clearfix"></div>
			<div class="col-sm-12" style="margin-top:14px">
				<h5 style="margin:0 0 8px;font-weight:600;border-top:1px solid #ddd;padding-top:10px">
					<i class="fa fa-question-circle"></i> Frequently Asked Questions
				</h5>
				<div ng-repeat="faq in x.faqs track by $index" style="background:#f9f9f9;border:1px solid #e3e3e3;border-radius:4px;padding:8px;margin-bottom:8px">
					<div style="display:flex;gap:6px;align-items:center;margin-bottom:6px">
						<input type="text" class="form-control input-sm" ng-model="faq.q" placeholder="Question?" style="flex:1">
						<button type="button" class="btn btn-danger btn-xs" ng-click="x.faqs.splice($index,1)" title="Remove FAQ"><i class="fa fa-trash"></i></button>
					</div>
					<textarea class="form-control input-sm" ng-model="faq.a" rows="2" placeholder="Answer..."></textarea>
				</div>
				<button type="button" class="btn btn-default btn-sm" ng-click="x.faqs.push({q:'',a:''})" ng-disabled="!x.p_id && !is_new">
					<i class="fa fa-plus"></i> Add FAQ
				</button>
				<input type="hidden" name="faqs_json" id="faqs_json_input" value="">
				<p class="help-block" style="font-size:12px;margin-top:4px">FAQs display at the bottom of the tour detail page as toggle items.</p>
			</div>

			<!-- Card image -->
			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Card Image</label></div>
			<div class="col-sm-9 admin-form-field">
				<input type="file" name="image" id="package_card_image" accept="image/*,.webp,.jfif"
					onchange="(function(input){
						var prev=document.getElementById('card_image_preview');
						if(input.files&&input.files[0]){
							var r=new FileReader();
							r.onload=function(e){ prev.src=e.target.result; prev.style.display='block'; };
							r.readAsDataURL(input.files[0]);
						} else { prev.style.display='none'; }
					})(this)">
				<img id="card_image_preview" src="" alt="Preview"
					style="display:none;max-height:100px;margin-top:8px;border-radius:6px;border:1px solid #ddd;object-fit:cover;">
				<input ng-model="x.image" name="old_image" hidden>
				<p class="help-block" style="font-size:12px">Main image shown on listing cards and the tour page hero.</p>
				<div ng-if="x.image" style="margin-top:8px">
					<img ng-src="<?=base_url("assets/uploads/packages/thumb")?>/{{x.image}}"
						style="max-height:100px;border-radius:4px;border:1px solid #ddd;object-fit:cover;">
				</div>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-3 admin-form-label"><label>Details Image</label></div>
			<div class="col-sm-9 admin-form-field">
				<input type="file" name="details_image" id="details_image" accept="image/*,.svg,.webp,.jfif,.avif,.heic,.heif,.tif,.tiff,.bmp,.ico"
					onchange="(function(input){
						var prev=document.getElementById('new_image_preview');
						if(input.files&&input.files[0]){
							var r=new FileReader();
							r.onload=function(e){ prev.src=e.target.result; prev.style.display='block'; };
							r.readAsDataURL(input.files[0]);
						} else { prev.style.display='none'; }
					})(this)">
				<img id="new_image_preview" src="" alt="Preview"
					style="display:none;max-height:100px;margin-top:8px;border-radius:6px;border:1px solid #ddd;object-fit:cover;">
				<input ng-model="x.details_image" name="old_details_image" hidden>
				<input ng-model="x.remove_details_image" name="remove_details_image" hidden>
				<p class="help-block" style="font-size: 12px">Upload image to show under package details text.</p>
				<div ng-if="x.details_image && x.remove_details_image!='1'" class="details-image-preview">
					<img ng-src="<?=base_url("assets/uploads/packages/details")?>/{{x.details_image}}" class="img-responsive" alt="Package detail image" loading="lazy">
					<button type="button" class="btn btn-danger btn-xs" ng-click="remove_details_image()">Remove Image</button>
				</div>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-12">
				<div ng-if="!x.p_id && !is_new" class="alert alert-info" style="font-size:13px;padding:8px 12px;margin-bottom:8px;">
					<i class="fa fa-arrow-right"></i>
					<strong>Click a package from the table on the right</strong> to edit it — or click <strong>+ New Package</strong> above to create a new one.
				</div>
				<div ng-if="saveFeedback" class="alert admin-save-feedback"
					ng-class="{
						'alert-success': saveFeedback.type === 'success',
						'alert-warning': saveFeedback.type === 'warning',
						'alert-danger': saveFeedback.type === 'danger'
					}">
					{{saveFeedback.message}}
				</div>
				<div id="detailsprogress" style="display: none">
					<img src="<?=base_url()?>assets/images/progress/load1.gif" alt="Loading indicator" loading="lazy">
				</div>
				<button type="submit" id="detailssubmitbtn" class="btn btn-info"
					ng-disabled="isSavingDetails || (!x.p_id && !is_new) || (is_new && !x.title)">
					{{isSavingDetails ? 'Saving...' : (is_new ? 'Post Package' : 'Save Details')}}
				</button>
				<a class="btn btn-default" ng-click="cancel_new()" ng-if="is_new">Cancel</a>
				<a class="btn btn-default" ng-click="clear_details()" ng-if="!is_new" ng-disabled="!x.p_id">Clear Details</a>
				<br><br>
			</div>
		</form>
	</div>

	<div class="col-sm-7 admin-package-list-col">
		<div class="table_horizontal admin-table-toolbar" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
			<div class="input-group custom_addon" style="flex:1;min-width:160px;">
				<div class="input-group-addon" style="box-shadow:none;-webkit-box-shadow:none;"><i class="fa fa-search"></i></div>
				<input type="text" ng-model="search_text" placeholder="Search packages...">
			</div>
			<div style="flex:0 0 auto;">
				<select ng-model="filter_category" class="form-control" style="height:34px;font-size:13px;">
					<option value="">All Categories</option>
					<option ng-repeat="cat in categories" value="{{cat.slug}}">{{cat.name}}</option>
				</select>
			</div>
			<div style="flex:0 0 auto;" ng-if="filter_category">
				<button class="btn btn-xs btn-default" ng-click="filter_category=''" title="Clear filter">
					<i class="fa fa-times"></i> Clear
				</button>
			</div>
		</div>

		<!-- Category count badges -->
		<div class="admin-filter-badges" style="margin:6px 0 8px;display:flex;flex-wrap:wrap;gap:4px;">
			<span class="label label-default" style="cursor:pointer;font-size:11px;padding:4px 8px;"
				ng-click="filter_category=''"
				ng-style="{'background': !filter_category ? '#337ab7' : '#777'}">
				All ({{datadb.length}})
			</span>
			<span class="label label-default" style="cursor:pointer;font-size:11px;padding:4px 8px;"
				ng-repeat="cat in categories"
				ng-click="filter_category = cat.slug"
				ng-style="{'background': filter_category === cat.slug ? '#337ab7' : '#777'}">
				{{cat.name}} ({{getCatCount(cat.slug)}})
			</span>
		</div>

		<div class="table-data">
			<table class="table table-hover">
				<thead>
					<tr class="active">
						<th>Image</th>
						<th>Category</th>
						<th>Title</th>
						<th>Days</th>
						<th>Price</th>
						<th>Highlights</th>
						<th>Details</th>
						<th>Status</th>
						<th style="width:85px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr dir-paginate="y in datadb | filter: search_text | filter: categoryFilter | itemsPerPage: 8">
						<td>
							<img ng-if="y.image" ng-src="<?=base_url()?>assets/uploads/packages/thumb/{{y.image}}" style="height: 50px" alt="Package image" loading="lazy">
							<img ng-if="!y.image && y.default_image" ng-src="<?=base_url()?>assets/images/product/{{y.default_image}}" style="height: 50px" alt="Package image" loading="lazy">
							<i ng-if="!y.image && !y.default_image">-</i>
						</td>
						<td>
							<span class="label" style="font-size:11px;"
								ng-style="{'background': getCatColor(y.category)}">
								{{getCatName(y.category)}}
							</span>
						</td>
						<td>{{y.title}}</td>
						<td>{{y.days || '-'}}</td>
						<td>
							<span ng-if="y.price_on_request == '1'" style="color:#e05500;font-weight:600;font-size:12px">On Request</span>
							<span ng-if="y.price_on_request != '1' && y.price">&#8377;{{y.price}}</span>
							<i ng-if="y.price_on_request != '1' && !y.price">-</i>
						</td>
						<td>
							<span ng-if="y.highlights">{{y.highlights | limitTo: 60}}{{y.highlights.length > 60 ? '...' : ''}}</span>
							<i ng-if="!y.highlights">-</i>
						</td>
						<td>
							<span ng-if="y.details" style="color:green;font-weight:600;font-size:12px">
								<i class="fa fa-check-circle"></i> Added
							</span>
							<span ng-if="!y.details" style="color:#bbb;font-size:12px">
								<i class="fa fa-times-circle"></i> None
							</span>
						</td>
						<td>
							<div style="height:25px;width:25px;border-radius:50%;background:red" ng-if="y.status=='0'"></div>
							<div style="height:25px;width:25px;border-radius:50%;background:green" ng-if="y.status=='1'"></div>
						</td>
						<td>
							<a href="javascript:void(0)" ng-click="update_call(y)">
								<span class="fa fa-pencil fa-2x"></span></a>
							&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" style="color:red" ng-click="delete_data(y.p_id)">
								<span class="fa fa-trash fa-2x"></span></a>
						</td>
					</tr>
					<tr ng-if="(datadb | filter: search_text | filter: categoryFilter).length === 0">
						<td colspan="9" class="text-center text-muted" style="padding:20px;">
							No packages found for this filter.
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-12">
			<dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
		</div>
	</div>
</div>

<!-- Category Management Panel -->
<div class="col-sm-12 well admin-module-panel admin-package-screen admin-package-category-panel" style="margin-top:10px;">
	<h4 style="margin-top:0;border-bottom:1px solid #ddd;padding-bottom:8px;">
		<i class="fa fa-tags"></i> Manage Categories
	</h4>
	<div class="row">
		<div class="col-sm-12 col-md-5">
			<div class="input-group">
				<input type="text" class="form-control" ng-model="new_category_name"
					placeholder="e.g. Adventure Tour"
					ng-keyup="$event.keyCode==13 && save_category()">
				<span class="input-group-btn">
					<button class="btn btn-success" type="button" ng-click="save_category()"
						ng-disabled="!new_category_name">
						<i class="fa fa-plus"></i> Add
					</button>
				</span>
			</div>
			<p class="help-block" style="font-size:12px;margin-top:4px;">
				Type the category name and click Add. The URL slug is auto-generated.
			</p>
		</div>
		<div class="col-sm-12 col-md-7">
			<table class="table table-bordered table-condensed" style="margin:0;">
				<thead>
					<tr>
						<th>#</th>
						<th>Category Name</th>
						<th>URL Slug</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="cat in categories">
						<td>{{$index + 1}}</td>
						<td>
							<span ng-if="!cat._editing">{{cat.name}}</span>
							<div ng-if="cat._editing" class="input-group input-group-sm" style="min-width:160px;">
								<input type="text" class="form-control" ng-model="cat._new_name"
									ng-keyup="$event.keyCode==13 && save_rename(cat); $event.keyCode==27 && cancel_rename(cat)">
								<span class="input-group-btn">
									<button class="btn btn-success btn-sm" type="button" ng-click="save_rename(cat)" title="Save"><i class="fa fa-check"></i></button>
									<button class="btn btn-default btn-sm" type="button" ng-click="cancel_rename(cat)" title="Cancel"><i class="fa fa-times"></i></button>
								</span>
							</div>
						</td>
						<td><code>{{cat.slug}}</code></td>
						<td>
							<button class="btn btn-info btn-xs" type="button" ng-if="!cat._editing"
								ng-click="start_rename(cat)" style="margin-right:4px;">
								<i class="fa fa-pencil"></i> Rename
							</button>
							<button class="btn btn-danger btn-xs" type="button" ng-if="!cat._editing"
								ng-click="delete_category(cat.cat_id)">
								<i class="fa fa-trash"></i> Remove
							</button>
						</td>
					</tr>
					<tr ng-if="categories.length == 0">
						<td colspan="4" class="text-center text-muted">No categories yet.</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<style>
.admin-package-screen .admin-package-form-col,
.admin-package-screen .admin-package-list-col {
	padding-left: 10px;
	padding-right: 10px;
}

.admin-package-screen .admin-package-toolbar {
	margin-bottom: 18px;
	flex-wrap: wrap;
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

.admin-package-screen .admin-form-field .note-editor.note-frame,
.admin-package-screen .admin-form-field .note-editor.note-airframe {
	border-radius: 14px;
	border-color: #d0d5dd;
	overflow: hidden;
}

.admin-package-screen .admin-form-field .note-toolbar {
	background: #f8fafc;
	border-bottom-color: #e4e7ec;
}

.admin-package-screen .admin-form-field .note-editing-area .note-editable {
	min-height: 240px;
	padding: 16px 18px;
}

.admin-package-screen .admin-table-toolbar {
	margin-bottom: 12px;
}

.admin-package-screen .admin-filter-badges .label {
	border-radius: 999px;
	padding: 6px 10px !important;
	font-size: 11px !important;
	font-weight: 700;
}

.admin-package-screen .table-data table {
	min-width: 920px;
}

.admin-package-screen .table-data td img[style*="height: 50px"] {
	border-radius: 10px;
	height: 52px !important;
	object-fit: cover;
	width: 64px;
}

.admin-package-screen .admin-save-feedback {
	margin-bottom: 12px;
	padding: 12px 14px;
}

.details-image-preview {
	margin-top: 8px;
}
.details-image-preview img {
	border: 1px solid #ddd;
	border-radius: 4px;
	margin-bottom: 8px;
	max-height: 150px;
	object-fit: cover;
}

@media (max-width: 1199px) {
	.admin-package-screen .admin-package-form-col,
	.admin-package-screen .admin-package-list-col {
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

@media (max-width: 767px) {
	.admin-package-screen .admin-package-form-col,
	.admin-package-screen .admin-package-list-col {
		padding-left: 0;
		padding-right: 0;
	}

	.admin-package-screen .admin-filter-badges {
		gap: 6px !important;
	}
}
</style>
