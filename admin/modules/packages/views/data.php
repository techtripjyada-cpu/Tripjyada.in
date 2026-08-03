<div class="col-sm-7 admin-package-list-col">
	<div class="table_horizontal" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
		<div class="input-group custom_addon" style="flex:1;min-width:160px;">
			<div class="input-group-addon" style="box-shadow:none;-webkit-box-shadow:none;"><i class="fa fa-search"></i></div>
			<input type="text" ng-model="search_text" placeholder="Search here...">
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
	<div style="margin:6px 0 8px;display:flex;flex-wrap:wrap;gap:4px;">
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
					<th>Icons</th>
					<th>Days</th>
					<th>Price / Display</th>
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
					<td>
						<span ng-if="y.amenity_icons">
							<img ng-repeat="icon in y.amenity_icons.split(',')" ng-if="icon" ng-src="<?=base_url()?>assets/uploads/packages/icons/{{icon}}" style="height: 24px;width: 24px;object-fit: contain;margin-right: 4px" alt="Amenity icon" loading="lazy">
						</span>
						<i ng-if="!y.amenity_icons">-</i>
					</td>
					<td>{{y.days}}</td>
					<td>
						<span ng-if="y.price_on_request == '1'" style="color:#e05500;font-weight:600;font-size:12px">Price On Request</span>
						<span ng-if="y.price_on_request != '1' && y.category == 'group-tour'">&#8377;{{y.price}}</span>
						<span ng-if="y.price_on_request != '1' && y.category != 'group-tour'" style="color:#888;font-size:12px">On Request <span style="color:#ccc">({{y.price}})</span></span>
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
					<td colspan="8" class="text-center text-muted" style="padding:20px;">
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
