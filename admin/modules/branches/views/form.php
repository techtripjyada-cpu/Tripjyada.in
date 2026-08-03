<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li><a href="javascript:void(0)">Branches</a></li>
	</ol>
</div>

<div class="col-sm-12 well">
	<div class="col-sm-5">
		<form name="form1" id="form1" method="post" action=""
			autocomplete="off">
			<input name="b_id" ng-model="x.b_id" hidden>

			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>City</label>
			</div>
			<div class="col-sm-10">
				<input name="city" class="form-control" ng-model="x.city" required autofocus ng-keyup='urlgenerator()'>
			</div>
			
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Latitude</label>
			</div>
			<div class="col-sm-10">
				<input name="latitude" class="form-control" ng-model="x.latitude" required>
			</div>
			
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Longitude</label>
			</div>
			<div class="col-sm-10">
				<input name="longitude" class="form-control" ng-model="x.longitude" required>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>URL</label>
			</div>
			<div class="col-sm-10">
				<input name="url" class="form-control" ng-model="x.url" required readonly>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Name</label>
			</div>
			<div class="col-sm-10">
				<input name="name" class="form-control" ng-model="x.name" >
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>State</label>
			</div>
			<div class="col-sm-10">
				<select name="state" class="form-control" ng-model="x.state">
					<option value=''>--Select--</option>
					<option value="andhra-pradesh">Andhra Pradesh</option>
					<option value="andaman-and-nicobar-islands">Andaman and Nicobar Islands</option>
					<option value="arunachal-pradesh">Arunachal Pradesh</option>
					<option value="assam">Assam</option>
					<option value="bihar">Bihar</option>
					<option value="chandigarh">Chandigarh</option>
					<option value="chhattisgarh">Chhattisgarh</option>
					<option value="dadar-and-nagar-haveli">Dadar and Nagar Haveli</option>
					<option value="daman-and-diu">Daman and Diu</option>
					<option value="delhi">Delhi</option>
					<option value="lakshadweep">Lakshadweep</option>
					<option value="puducherry">Puducherry</option>
					<option value="goa">Goa</option>
					<option value="gujarat">Gujarat</option>
					<option value="haryana">Haryana</option>
					<option value="himachal-pradesh">Himachal Pradesh</option>
					<option value="jammu-and-kashmir">Jammu and Kashmir</option>
					<option value="hharkhand">Jharkhand</option>
					<option value="karnataka">Karnataka</option>
					<option value="kerala">Kerala</option>
					<option value="madhya-pradesh">Madhya Pradesh</option>
					<option value="maharashtra">Maharashtra</option>
					<option value="manipur">Manipur</option>
					<option value="meghalaya">Meghalaya</option>
					<option value="mizoram">Mizoram</option>
					<option value="nagaland">Nagaland</option>
					<option value="odisha">Odisha</option>
					<option value="punjab">Punjab</option>
					<option value="rajasthan">Rajasthan</option>
					<option value="sikkim">Sikkim</option>
					<option value="tamil-nadu">Tamil Nadu</option>
					<option value="telangana">Telangana</option>
					<option value="tripura">Tripura</option>
					<option value="uttar-pradesh">Uttar Pradesh</option>
					<option value="uttarakhand">Uttarakhand</option>
					<option value="west-bengal">West Bengal</option>
				</select>
			</div>

			<div class="clearfix"></div>

			<div class="col-sm-2 ">
				<label>Address</label>
			</div>
			<div class="col-sm-10">
				<textarea name="address" class="form-control" ng-model="x.address" ></textarea>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Phone</label>
			</div>
			<div class="col-sm-10">
			<input name="phone" class="form-control" ng-model="x.phone">
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Email</label>
			</div>
			<div class="col-sm-10">
				<input name="email" class="form-control" ng-model="x.email" >
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-5 ">
				<label class="checkarea">Show Our Company Details to users</label>
			</div>
			<div class="col-sm-2">
				<input type ="checkbox" class="form-check" name="info" ng-model="x.info" ng-true-value="'1'" ng-false-value="'0'">
				<span class="checkmark"></span>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-5 ">
				<label class="checkarea">Status</label>
			</div>
			<div class="col-sm-2">
				<input type ="checkbox" class="form-check" name="status" ng-model="x.status" ng-true-value="'1'" ng-false-value="'0'">
				<span class="checkmark"></span>
			</div>


			<div class="clearfix"></div>
			<div class="col-sm-4">
				<input type="file" name="image" id="image">
				  <input ng-model="x.image" name="old_image" hidden>
				<p class="help-block" style="font-size: 12px">Select any picture to
					view on your branch.</p>
			</div>
              
				<div class="col-sm-3" ng-show="x.image">
					<img src="<?=base_url("assets/uploads/branches")?>/{{x.image}}" class="img-responsive" style="height: 150px;" alt="Branch image" loading="lazy">
				</div>
			
			<div class="clearfix"></div>

			<div class="col-sm-12">
				<div id="webprogress" style="display: none">
					<img src="<?=base_url()?>/assets/images/progress/load1.gif" alt="Loading indicator" loading="lazy">
				</div>
				<button type="submit" id="submitbtn" accesskey="s"
					ng-click="save_data(x)" class="btn btn-info"
					ng-disabled="form1.$invalid">
					<u><b>S</b></u>ave
				</button>
				<a class="btn btn-default" accesskey="c" ng-click="filter_new()"><u><b>C</b></u>lear</a>
				<br>
				<br>
			</div>
		</form>
	</div>
               
  <?php include 'data.php';?>
   
</div>
<style>
	.form-check{
	display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px double #fff;
    border-radius: 4px;
}

</style>