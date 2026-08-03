<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li><a href="javascript:void(0)">Newsletter</a></li>
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
                        <th>Email</th>
						<th>Timestamp</th>
					</tr>
				</thead>
				<tbody>
				<tr dir-paginate="y in datadb | filter: search_text | itemsPerPage: 20" pagination-id="contact">
				        <td>{{y.email}}</td>
						<td>{{y.timestamp}}</td>
 					</tr>
				</tbody>
			</table>
        </div>
        <div class="col-sm-12">
            <dir-pagination-controls boundary-links="true"pagination-id="contact" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
        </div>
   </div>