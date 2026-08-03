<div class="col-sm-5">
    <div class="table_horizontal">
        <div class="input-group custom_addon">
            <div class="input-group-addon" style="box-shadow:none;-webkit-box-shadow:none;"><i class="fa fa-search"></i></div>
            <input type="text" ng-model="search_text" placeholder="Search here...">
        </div>
    </div>
    <div class="table-data">
        <div class="table table-responsive">
        <table class="table table-hover">
            <thead>
                <tr class="active">
                    <th>Title</th>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th style="width:90px">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr dir-paginate="y in datadb | filter: search_text | itemsPerPage: 6">
                    <td>{{y.title}}</td>
                    <td><code style="font-size:12px;background:#fff3e0;color:#e65100;padding:2px 7px;border-radius:3px;border:1px solid #ffe0b2">{{y.code}}</code></td>
                    <td><span style="font-weight:700;color:#2e7d32">{{y.discount_percent}}% off</span></td>
                    <td style="font-size:12px;color:#555">{{y.date || '—'}}</td>
                    <td style="font-size:12px;color:#555">{{y.end_date || 'No expiry'}}</td>
                    <td>
                        <span ng-if="y.status==1" ng-click="toggle_status(y)" title="Active — click to deactivate"
                            style="cursor:pointer;display:inline-block;padding:2px 10px;border-radius:20px;background:#d4edda;color:#155724;font-size:11px;font-weight:700;border:1px solid #c3e6cb">
                            Active
                        </span>
                        <span ng-if="y.status!=1" ng-click="toggle_status(y)" title="Inactive — click to activate"
                            style="cursor:pointer;display:inline-block;padding:2px 10px;border-radius:20px;background:#f8d7da;color:#721c24;font-size:11px;font-weight:700;border:1px solid #f5c6cb">
                            Inactive
                        </span>
                    </td>
                    <td>
                        <a href="javascript:void(0)" ng-click="update_call(y)" title="Edit">
                            <span class="fa fa-pencil fa-lg" style="color:#5bc0de"></span>
                        </a>
                        &nbsp;&nbsp;
                        <a href="javascript:void(0)" ng-click="delete_data(y.id)" title="Delete">
                            <span class="fa fa-trash fa-lg" style="color:#d9534f"></span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    <div class="col-sm-12">
        <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
    </div>
</div>
