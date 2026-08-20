<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li><a href="javascript:void(0)">Bookings</a></li>
	</ol>
</div>
<div class="col-sm-12">
    <div class="table_horizontal">
        <div class="booking-toolbar">
    		<div class="input-group custom_addon">
                <div class="input-group-addon" style="box-shadow:none; -webkit-box-shadow:none;"><i class="fa fa-search"></i>
                </div>
    			<input type="text" ng-model="search_text" placeholder="Search here...">
    		</div>
            <div class="booking-filter-group">
                <div class="booking-date-field">
                    <label>From Date</label>
                    <input type="date" ng-model="filters.date_from">
                </div>
                <div class="booking-date-field">
                    <label>To Date</label>
                    <input type="date" ng-model="filters.date_to">
                </div>
                <button type="button" class="btn btn-primary booking-filter-btn" ng-click="applyFilters()">
                    <i class="fa fa-filter"></i> Apply
                </button>
                <button type="button" class="btn btn-default booking-reset-btn" ng-click="resetFilters()">
                    <i class="fa fa-refresh"></i> Reset
                </button>
                <button type="button" class="btn btn-success booking-export-btn" ng-click="exportBookings()">
                    <i class="fa fa-download"></i> Download Excel
                </button>
            </div>
        </div>
	</div>
        <div class="col-sm-12 cards" dir-paginate="y in datadb | filter: search_text | itemsPerPage: 15" pagination-id="booking">
        	<button type="button" class="booking-delete-btn" ng-click="delete_booking(y.id)" title="Delete this lead"><i class="fa fa-trash"></i></button>
        	<div class="row">
        		<div class="col-sm-4">
        			<h5><b>{{y.mfrom}}</b> - <strong>{{y.mto}}</strong></h5>
					<span class="booking-source" ng-if="y.category">{{y.category}}</span>
					<small>{{y.email}}</small>
        		</div>
        		<div class="col-sm-8">
        			<b>{{y.name}}</b> | <a href="tel:{{y.phone}}"><i class="fa fa-phone"></i> {{y.phone}}</a><br>
					<small ng-if="y.date || y.transportation || y.configuration">
						<span ng-if="y.date">Travel: {{y.date}}</span>
						<span ng-if="y.transportation"> • {{y.transportation}}</span>
						<span ng-if="y.configuration"> • {{y.configuration}}</span>
					</small><br ng-if="y.date || y.transportation || y.configuration">
        			<q>{{y.msg}}</q>
        			<small><i class="fa fa-clock-o"></i> {{y.timestamp}}</small>
        		</div>
        	</div>
        </div>
        
        <div class="col-sm-12">
            <dir-pagination-controls boundary-links="true"pagination-id="booking" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
        </div>
   </div>
   <style>
   .cards{position:relative;background-image: linear-gradient(120deg, #fdfbfb 0%, #d2f0ff 100%);margin:5px 0px;padding:10px 40px 10px 10px;
    box-shadow: 1px 2px 8px 0px #dbdbdb;}
   .cards h5{line-height: 1.35;margin:0 0 4px;}
   .cards b{color: #9c7e04}
   .cards h5 b{color: #0082ad}
   .cards q{font-weight:bold}
   .cards h5 strong{color: #00a200}
   .booking-source{display:inline-block;margin:2px 6px 6px 0;padding:2px 7px;border-radius:10px;background:#f58220;color:#fff;font-size:10px;font-weight:700;text-transform:uppercase;}
   .booking-delete-btn{position:absolute;top:8px;right:8px;width:28px;height:28px;line-height:26px;text-align:center;padding:0;border:1px solid #f1b5b5;border-radius:50%;background:#fff;color:#d9534f;cursor:pointer;box-shadow:none;-webkit-box-shadow:none;}
   .booking-delete-btn:hover{background:#d9534f;color:#fff;border-color:#d9534f;}
   #hoeapp-wrapper {background: #ffffff;}
   .booking-toolbar{display:flex;gap:12px;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;}
   .booking-toolbar .custom_addon{flex:1 1 320px;}
   .booking-filter-group{display:flex;gap:10px;align-items:flex-end;flex-wrap:wrap;}
   .booking-date-field{display:flex;flex-direction:column;gap:4px;min-width:150px;}
   .booking-date-field label{margin:0;font-size:12px;color:#666;font-weight:600;}
   .booking-date-field input{height:38px;border:1px solid #d9d9d9;border-radius:4px;padding:6px 10px;background:#fff;}
   .booking-filter-btn,.booking-reset-btn,
   .booking-export-btn{white-space:nowrap;box-shadow:none;-webkit-box-shadow:none;}
   @media(max-width:768px){
    .booking-filter-group{width:100%;}
    .booking-date-field{flex:1 1 100%;}
   }
   </style>
