 <div class="heading">
    <ol class="breadcrumb">
      <li><a href="#/">Dashboard</a></li> 
      <li><a href="javascript:void(0)">Reviews</a></li>
    </ol>
</div>

<div class="col-sm-12 well">
    <div class="table-responsive">
		<div class="input-group custom_addon">
            <div class="input-group-addon"  style="box-shadow:none; -webkit-box-shadow:none;"><i class="fa fa-search"></i></div>
				<input type="text" ng-model="search_text" placeholder="Search here...">
			</div>
		</div>
		<div class="table-data">
			<table class="table table-hover">
				<thead>
					<tr class="active">
						<th>Review ID</th>
						<th>User</th>
						<th>Email</th>
						<th>Rating</th>
						<th>Comment</th>
						<th>Posted on</th>
						<th>Status</th>
						<th style="width:100px">Timestamp</th>
						<th style="width:85px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr dir-paginate="y in datadb | filter: search_text | itemsPerPage: 10" >
						<td>{{y.r_id}}</td>
						<td>{{y.unm}}</td>
						<td>{{y.email}}</td>
						<td ng-if="y.rt>3" class='success'>{{y.rt}}/5</td>
						<td ng-if="y.rt==3" class='warning'>{{y.rt}}/5</td>
						<td ng-if="y.rt<3" class='danger'>{{y.rt}}/5</td>
						<td>{{y.cmt}} <img style="width:100px;height:100px;" ng-if="y.img" ng-src="<?=base_url('assets/uploads/reviewimg/thumb')?>/{{y.img}}" alt="Review image" loading="lazy"></td>
						<td>{{y.pd}}</td>
						<td>
						  <div style="height:25px;width:25px;border-radius:50%;background:red" ng-if="y.st=='0'"></div>
	            		  <div style="height:25px;width:25px;border-radius:50%;background:green" ng-if="y.st=='1'"></div>
						</td>
						<td>{{y.tm}}</td>
						<td>
						  <select ng-model='y.st' ng-change='update(y.r_id,y.st)'>
						      <option value='0'>Hide</option>
						      <option value='1'>Show</option>
						  </select>
						</td>
					</tr>
				</tbody>
			</table>
        </div>
        <div class="col-sm-12">
            <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
        </div>
   </div>