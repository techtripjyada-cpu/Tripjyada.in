<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li><a href="javascript:void(0)">blog</a></li>
	</ol>
</div>

<div class="col-sm-12 well">
	<div class="col-sm-6">
		<form name="form1" id="form1" method="post" action=""
			autocomplete="off">
			<input name="b_id" ng-model="x.b_id" hidden>

			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Title</label>
			</div>
			<div class="col-sm-10">
				<input name="title" class="form-control" ng-model="x.title" required>
			</div>

			<div class="clearfix"></div>

			<div class="col-sm-2 ">
				<label>Description</label>
			</div>
			<div class="col-sm-10">

				<summernote config="options" ng-model="x.description"></summernote>
				<textarea name="description" ng-model="x.description" hidden></textarea>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Date</label>
			</div>
			<div class="col-sm-10">
				<input name="date" id="DOB1" class="form-control" ng-model="x.date"
					required>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Time</label>
			</div>
			<div class="col-sm-10">
				<input name="time" class="form-control" ng-model="x.time" required>
			</div>

			<div class="clearfix"></div>


			<div class="col-sm-2 ">
				<label>Author</label>
			</div>
			<div class="col-sm-10">
				<input name="author" class="form-control" ng-model="x.author" required>
			</div>
			<div class="col-sm-2 ">
				<label>Tags/Keywords</label>
			</div>
			<div class="col-sm-10">
				<input name="tags" class="form-control" ng-model="x.tags" required>
			</div>

			<div class="clearfix"></div>
			<!-- <div class="col-sm-2">
				<label>Select Image</label> url? <input type="checkbox"
					ng-model="x.url_type"
					style="width: 20px; height: 20px; border: 0px; shadow: none"
					ng-true-value="'1'" ng-false-value="'0'">
			</div> -->
			<div class="col-sm-4" ng-if="x.url_type!='1'">
				<input type="file" name="image" accept="image/*,.svg,.webp,.jfif,.avif,.heic,.heif,.tif,.tiff,.bmp,.ico">
				  <input ng-model="x.image" name="old_image" hidden>
				<p class="help-block" style="font-size: 12px">Select any image format to
					view on your page.</p>
			</div>
			

		
              
				<div class="col-sm-3" ng-show="x.image">
					<img src="<?=base_url("assets/uploads/blog/thumb")?>/{{x.image}}" class="img-responsive" style="height: 150px;" alt="Blog image" loading="lazy">
				</div>
			
			<div class="clearfix"></div>

			<div class="col-sm-12">
				<div id="webprogress" style="display: none">
					<img src="<?=base_url()?>assets/images/progress/load1.gif" alt="Loading indicator" loading="lazy">
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
