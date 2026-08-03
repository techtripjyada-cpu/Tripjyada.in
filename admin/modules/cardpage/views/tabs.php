<style>
.cp-bar{display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap;margin-bottom:22px;}
.cp-bar .form-group{margin-bottom:0;min-width:200px;}
.cp-section-title{font-size:15px;font-weight:700;color:#344054;padding-bottom:10px;border-bottom:2px solid #f0f2f5;margin-bottom:18px;}
.cp-status{display:inline-block;padding:2px 9px;border-radius:999px;font-size:11px;font-weight:700;}
.cp-on{background:#dcfce7;color:#16a34a;}
.cp-off{background:#f3f4f6;color:#9ca3af;}
.day-row{border:1px solid #e5e7eb;border-radius:8px;padding:12px;margin-bottom:10px;background:#fafafa;}
</style>

<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li>Tab Content</li>
	</ol>
</div>

<div class="col-sm-12 well">

	<div class="cp-bar">
		<div class="form-group">
			<label>Page</label>
			<select ng-model="current_slug" ng-change="load_tabs()" class="form-control">
				<option value="all">All Packages (Default)</option>
				<option value="group-tour">Group Tour</option>
				<option value="family-tour">Family Tour</option>
				<option value="honeymoon-tour">Honeymoon Tour</option>
				<option value="luxury-tour">Luxury Tour</option>
			</select>
		</div>
		<button class="btn btn-primary" ng-click="new_tab()" data-toggle="modal" data-target="#cpTabModal">
			<i class="fa fa-plus"></i> Add Tab
		</button>
	</div>

	<div class="cp-section-title">Itinerary Tabs &mdash; <small class="text-muted">{{current_slug}}</small></div>

	<div class="table-data">
		<table class="table table-hover">
			<thead>
				<tr class="active">
					<th>#</th>
					<th>Days</th>
					<th>Title</th>
					<th>Days in Itinerary</th>
					<th>Sort</th>
					<th>Status</th>
					<th style="width:90px">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="tab in tabs | itemsPerPage:10">
					<td>{{$index+1}}</td>
					<td><strong>{{tab.days_label}}</strong></td>
					<td>{{tab.tab_title}}</td>
					<td>{{day_count(tab.day_data)}} days</td>
					<td>{{tab.sort_order}}</td>
					<td>
						<span class="cp-status cp-on" ng-if="tab.active=='1'||tab.active==1">Active</span>
						<span class="cp-status cp-off" ng-if="tab.active!='1'&&tab.active!=1">Off</span>
					</td>
					<td>
						<a href="javascript:void(0)" ng-click="edit_tab(tab)" data-toggle="modal" data-target="#cpTabModal">
							<span class="fa fa-pencil fa-2x"></span>
						</a>
						&nbsp;&nbsp;
						<a href="javascript:void(0)" style="color:red" ng-click="delete_tab(tab.id)">
							<span class="fa fa-trash fa-2x"></span>
						</a>
					</td>
				</tr>
				<tr ng-if="tabs.length==0">
					<td colspan="7" style="text-align:center;color:#aaa;padding:28px;">No tabs for this page. Click <strong>Add Tab</strong> to create one.</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div style="margin-top:10px;">
		<dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
	</div>

</div>

<!-- Tab Modal -->
<div class="modal fade" id="cpTabModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title">{{tab_form.id ? 'Edit Tab' : 'Add New Tab'}}</h4>
			</div>
			<div class="modal-body" style="max-height:72vh;overflow-y:auto;">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Days Label <small class="text-muted">(e.g. "5 Days")</small></label>
							<input type="text" ng-model="tab_form.days_label" class="form-control" placeholder="5 Days">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Tab Title</label>
							<input type="text" ng-model="tab_form.tab_title" class="form-control" placeholder="Bhutan Highlights Tour">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Hero Image URL</label>
					<input type="text" ng-model="tab_form.hero_image" class="form-control" placeholder="https://example.com/image.jpg or /assets/images/...">
					<img ng-if="tab_form.hero_image" ng-src="{{tab_form.hero_image}}" style="margin-top:8px;max-height:110px;border-radius:6px;border:1px solid #e5e7eb;" alt="Preview">
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Itinerary Heading</label>
							<input type="text" ng-model="tab_form.itinerary_heading" class="form-control" placeholder="5 Days Bhutan Tour Itinerary">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Itinerary Subheading</label>
							<input type="text" ng-model="tab_form.itinerary_subheading" class="form-control" placeholder="Explore the land of happiness...">
						</div>
					</div>
				</div>

				<hr style="margin:14px 0;">
				<label>Day-by-Day Itinerary</label>

				<div class="day-row" ng-repeat="d in days_array track by $index">
					<div class="row">
						<div class="col-xs-3">
							<input type="text" ng-model="d.day" class="form-control input-sm" placeholder="Day 1">
						</div>
						<div class="col-xs-8">
							<input type="text" ng-model="d.title" class="form-control input-sm" placeholder="Day title">
						</div>
						<div class="col-xs-1" style="padding-left:0;">
							<button type="button" class="btn btn-danger btn-sm" ng-click="remove_day($index)" title="Remove">
								<i class="fa fa-times"></i>
							</button>
						</div>
					</div>
					<textarea ng-model="d.desc" class="form-control input-sm" rows="2" placeholder="Day description..." style="margin-top:8px;"></textarea>
				</div>

				<div ng-if="days_array.length==0" style="color:#aaa;font-size:13px;margin-bottom:10px;">No days added yet.</div>
				<button type="button" class="btn btn-default btn-sm" ng-click="add_day()">
					<i class="fa fa-plus"></i> Add Day
				</button>

				<hr style="margin:14px 0;">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Sort Order</label>
							<input type="number" ng-model="tab_form.sort_order" class="form-control" placeholder="0">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="form-group" style="margin-top:27px;">
							<label>
								<input type="checkbox" ng-model="tab_form.active" ng-true-value="1" ng-false-value="0"> Active (show on frontend)
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" ng-click="save_tab()">
					<i class="fa fa-save"></i> Save Tab
				</button>
			</div>
		</div>
	</div>
</div>
