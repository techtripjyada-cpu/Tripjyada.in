<div class="heading">
    <ol class="breadcrumb">
      <li><a href="#/">Dashboard</a></li>
      <li><a href="javascript:void(0)">Offers / Coupons</a></li>
    </ol>
</div>

<div class="col-sm-12 well">
     <div class="col-sm-7">
         <form name="form1" id="form1" method="post" action="" autocomplete="off">
         	<input name="id" ng-model="x.id" hidden>
            <input type="hidden" name="package_ids" id="package_ids_field">

       	    <div class="col-sm-3">
                <label>Offer Title</label>
            </div>
            <div class="col-sm-9">
            	<input type="text" name="title" ng-model="x.title" class="form-control" placeholder="e.g. Summer Special">
            </div>
            <div class="clearfix" style="margin-bottom:10px"></div>

            <div class="col-sm-3">
                <label>Coupon Code</label>
            </div>
            <div class="col-sm-9">
            	<input type="text" name="code" ng-model="x.code" class="form-control" placeholder="e.g. SUMMER20" style="text-transform:uppercase">
            </div>
            <div class="clearfix" style="margin-bottom:10px"></div>

            <div class="col-sm-3">
                <label>Discount %</label>
            </div>
            <div class="col-sm-9">
            	<input type="number" name="discount_percent" ng-model="x.discount_percent" class="form-control" min="1" max="100" placeholder="e.g. 15  (means 15% off)">
            </div>
            <div class="clearfix" style="margin-bottom:10px"></div>

            <div class="col-sm-3">
                <label>Offer Start Date</label>
            </div>
            <div class="col-sm-9">
            	<input name="date" id="DOB1" ng-model="x.date" class="form-control" placeholder="YYYY-MM-DD">
            </div>
            <div class="clearfix" style="margin-bottom:10px"></div>

            <div class="col-sm-3">
                <label>Offer End Date</label>
            </div>
            <div class="col-sm-9">
            	<input name="end_date" id="DOB2" ng-model="x.end_date" class="form-control" placeholder="YYYY-MM-DD">
            </div>
            <div class="clearfix" style="margin-bottom:10px"></div>

            <div class="col-sm-3">
                <label>Applicable Packages</label>
            </div>
            <div class="col-sm-9">
                <p class="help-block" style="margin:0 0 8px;font-size:12px;color:#888">
                    <i class="fa fa-info-circle"></i> Leave all unchecked to apply this coupon to <strong>all packages</strong>
                </p>
                <div style="max-height:180px;overflow-y:auto;border:1px solid #ddd;border-radius:4px;padding:8px 12px;background:#fafafa">
                    <div ng-if="!packages.length" style="color:#aaa;font-size:12px">Loading packages…</div>
                    <div ng-repeat="pkg in packages" style="margin-bottom:6px">
                        <label style="font-weight:normal;cursor:pointer;margin:0">
                            <input type="checkbox" ng-model="selectedPackages[pkg.p_id]" style="margin-right:6px">
                            {{pkg.title}}
                        </label>
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-bottom:10px"></div>

         	<div class="col-sm-3"></div>
            <div class="col-sm-9" style="margin-top:14px">
                <div id="webprogress" style="display: none">
                    <img src="<?=base_url()?>/assets/images/progress/load1.gif" alt="Loading" loading="lazy">
                </div>
               <button type="button" id="submitbtn" accesskey="s" ng-click="save_data(x)" class="btn btn-info"><u><b>S</b></u>ave</button>
               <a class="btn btn-default" accesskey="c" ng-click="filter_new()"><u><b>C</b></u>lear</a>
               <br><br>
            </div>

        </form>
    </div>
  <?php include 'data.php';?>
</div>
