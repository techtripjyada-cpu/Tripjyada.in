<div class="col-sm-7">
	<div class="table_horizontal">
		<div class="input-group custom_addon">
			<div class="input-group-addon" style="box-shadow:none; -webkit-box-shadow:none;"><i class="fa fa-search"></i></div>
			<input type="text" ng-model="search_text" placeholder="Search here...">
		</div>
	</div>
	<div class="table-data">
		<table class="table table-hover">
			<thead>
				<tr class="active">
					<th>State</th>
					<th>City</th>
					<th>Title</th>
					<!-- <th>City content</th> -->
					<th>Phone</th>
					<th>Phone2</th>
					<th>Whatsapp</th>
					<th>Status</th>
					<th>Image</th>
					<th style="width:85px">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr dir-paginate="y in datadb | filter: search_text | itemsPerPage: 10">
					<th>{{y.state}}</th>
					<th>{{y.city}}</th>
					<td>{{y.title}}</td>
					<!-- <th>{{y.content}}</th> -->
					<td>{{y.phone}}</td>
					<td>{{y.phone2}}</td>
					<td>{{y.Whatsapp}}</td>
					<td>
						<div style="height:25px;width:25px;border-radius:50%;background:red" ng-if="y.status=='0'"></div>
						<div style="height:25px;width:25px;border-radius:50%;background:green" ng-if="y.status=='1'"></div>
					</td>

					<div class="col-sm-3" ng-show="x.image">
						<td class="img-responsive">
							<img ng-if="y.image" ng-src="<?= base_url() ?>files/citybanner/{{y.image}}" style="height: 50px" alt="City banner image" loading="lazy">
							<i ng-if="!y.image">-</i>
						</td>
					</div>

					<td>
						<a href="javascript:void(0)" ng-click="update_call(y)" data-toggle="modal" data-target=".bs-example-modal-sm">
							<span class="fa fa-pencil fa-2x"></span></a>
						&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" style="color:red" ng-click="delete_data(y.c_id)">
							<span class="fa fa-trash fa-2x"></span></a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-sm-12">
		<dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
	</div>
</div>