<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li><a href="javascript:void(0)">Contacts</a></li>
	</ol>
</div>
 <div class="col-sm-12">
    <div class="table_horizontal">
		<div class="input-group custom_addon">
            <div class="input-group-addon"  style="box-shadow:none; -webkit-box-shadow:none;"><i class="fa fa-search"></i></div>
				<input type="text" ng-model="search_text" placeholder="Search here...">
			</div>
		</div>
		<div class="table-data">
			<table class="table table-hover">
				<thead>
					<tr class="active">
						<th>Name</th>
						<th>Phone</th>
                        <th>Email</th>
						<th>Category</th>
                        <th>Message</th>
						<th>Timestamp</th>
					</tr>
				</thead>
				<tbody>
				<tr dir-paginate="y in datadb | filter: search_text | itemsPerPage: 20" pagination-id="contact">
				        <td>{{y.name}}</td>
				        <td>{{y.phone}}</td>
				        <td>{{y.email}}</td>
				        <td>{{y.category}}</td>
				        <td>{{y.message}}</td>
						<td>{{y.timestamp}}</td>
 					</tr>
				</tbody>
			</table>
        </div>
        <div class="col-sm-12">
            <dir-pagination-controls boundary-links="true"pagination-id="contact" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
        </div>
   </div>