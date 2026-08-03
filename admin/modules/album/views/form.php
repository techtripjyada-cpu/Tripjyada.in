<div class="col-sm-12 well" ng-controller="ctrl_album">
     <div class="col-sm-6">
         <form name="form2" id="form2" ng-submit="save_data(x)">
        
            <input type="text" name="id" ng-model="x.album_id" hidden>
            <div id="validation2"></div>
            <div class="col-lg-12">
              <div class="form-group">
                <label for="exampleInputEmail1">Album Title</label>
                <input ng-model="x.title" name="title" class="form-control" autofocus placeholder="Enter Album Title" required>
              </div>
            </div>
           
            <div class="clearfix"></div>
            <div class="col-lg-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Enter description about the Album Below</i></label>
                    <summernote config="options" ng-model="x.description"></summernote>
                   <textarea name="description" ng-model="x.description" hidden></textarea>
                  </div>
            </div>
            <div class="clearfix"></div>
            
            <div id="result2" class="pull-left"></div>
            <br>
            <div class="pull-right"> 
            <div id="webprogress2" style="display: none">
                <img src="<?=base_url("assets/images/progress/ajax-loader9.gif")?>" alt="Loading indicator" loading="lazy">
            </div>
               <button type="submit" id="submitbtn2" accesskey="s" class="btn btn-info" ng-disabled="form2.$invalid"><u><b>S</b></u>ave Album</button>
               <a class="btn btn-default" accesskey="c" ng-click="filter_new()"><u><b>C</b></u>ancel</a> 
            </div>
        </form>
    </div>
    <?php 
    include 'data.php';
    ?>
</div>