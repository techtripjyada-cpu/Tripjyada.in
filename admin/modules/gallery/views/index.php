<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li> 
        <li><a href="javascript:void(0)" ng-click="refresh_albums()">Gallery</a></li>
	</ol>
</div>

<div class="clearfix"></div>
<br>
<div class="col-sm-3">
 <form name="form" id="form" method="post" action="">
 <div id="validation"></div>
 <br>
     <label>Album </label>
     <div class="input-group">
        <select ng-model="x.album_id" name="album_id" class="form-control" ng-focus="refresh_albums()">
            <option style="color: brown;" value="0|0">Default Gallery</option>
            <option ng-repeat="a in albums" value="{{a.album_id}}|{{a.title}} ">{{a.title}}</option>
        </select>
        <div class="input-group-addon warning" data-toggle="modal" data-target="#myModal" style="cursor:pointer">+</div>
     </div>
     
      <div class="clearfix"></div>
       <div class="form-group">
        <label for="title">Image Title</label>
        <input type="text" class="form-control" id="title" name="title" ng-model="x.title" placeholder="Picture name" required>
      </div>
<!--        <div class="form-group"> -->
<!--         <label for="thumb_check">Use Thumb</label> -->
<!--         <input type="checkbox" class="" id="thumb_check" name="thumb_check" ng-model="x.thumb_check" placeholder=" Thumb Picture"> -->
        
<!--       </div> -->
<!--       <div ng-if="x.thumb_check"> -->
<!--       	<div class="form-group"> -->
<!--             <label for="file">Select Thumb Image</label> -->
<!--             <input type="file" id="thumb" name="x.thumb"> -->
            
<!--             </div> -->
      
<!--       </div> -->
      
      <div class="form-group">
        <label for="file">Image</label>
        <input type="file" id="file" name="image" required>
        <p class="help-block" style="font-size:10px">For better user experiences, Upload resized images to load pages faster. (Recommended Size: 720px images) </p>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
          <button type="submit" ng-disabled="form.$invalid" class="btn btn-primary btn-block" id="btnsubmit" ng-click="insert_data()" accesskey="u"><u><b>U</b></u>pload</button>
      </div>
      <br>
      <div id="result" class="pull-left"></div>
      <div class="form-group col-sm-2" id="webprogress" style="display: none">
            <img src="<?=base_url("assets/website/img/f.jpg")?>" class="img-responsive" alt="Image" loading="lazy">
      </div>
 </form>
</div>

<div class="col-sm-9 gallery">
    <div class="input-group custom">
        <div class="input-group-addon info">?</div>
	     <input type="text" class="form-control" ng-model="search_text" placeholder="Search here...">
	</div>
	<div class="col-sm-12">
	           <div class="list-group list-group-horizontal">
	           <a href="javascript:void(0)"ng-click="filter_image(0)"  class="list-group-item">ALL</a>
                <a href="javascript:void(0)" ng-repeat="sort in albums" ng-model="sort.title" ng-click="filter_image(sort.title)" class="list-group-item"> {{sort.title}}</a>
            </div>
    </div>
    <div class="clearfix"></div>
    <hr>
    <div class="col-sm-3 col-xs-4" dir-paginate="x in datadb | filter: search_text | itemsPerPage: 8" style="height:240px"  paginate-id="gallery">
    <div  class="gallery_delete">
        <label style="font-size:10px">{{x.title}}</label>
        <img ng-src="<?=base_url("assets/uploads/gallery/thumb")?>/{{x.image}}" style="height:180px" class="img-responsive" alt="Gallery image" loading="lazy">
        <a href="javascript:void(0)" ng-click="delete_data(x)" class="delete">X</a>
    </div>
    </div>
    <div class="col-sm-12">
        <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?=site_url('app/pagination')?>" paginate-id="gallery"></dir-pagination-controls>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document"  style="width:90%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Album Manager</h4>
      </div>
      <div class="modal-body">
        <?php 
        $this->load->view("album/form")
        ?>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

