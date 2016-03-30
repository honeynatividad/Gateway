<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Forms</div>
        </div>
        <div class="panel-body">
        	<div class="row">
            <!-- start content -->
            	<div class="pull-right">
                	<span class="btn btn-green" id="newdlbtns" href="#" data-toggle="modal" data-target="#newdlform">
                    <i class="glyphicon glyphicon-plus"></i>
                    Add New
                    </div>
                </div>
                <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Download Link</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($dlforms as $dl){?>
                        <tr id="dl-<?php echo $dl->dl_id;?>">
                          <td><?php echo $dl->dl_id;?></td>
                          <td><?php echo $dl->dl_name;?></td>
                          <td><a href="<?php echo $dl->dl_url;?>">Download</a></td>
                          <td>
 						  <a href="#" title="" class="btn btn-circle editdl" data-placement="top" data-toggle="tooltip" data-original-title="Edit" id="<?php echo $dl->dl_id;?>">
                          <i class="glyphicon glyphicon-edit"></i>
                          </a>
 						  <a href="#" title="" class="btn btn-circle deletedl" data-placement="top" data-toggle="tooltip" data-original-title="Delete" id="<?php echo $dl->dl_id;?>">
                          <i class="glyphicon glyphicon-trash"></i>
                          </a>                         
                          </td>
                        </tr>
						<?php }?>
                      </tbody>
                    </table>         
            
            
    		<!-- end content -->
        </div>
    </div>               
   </div>
    
</div>		
<script>
$(document).ready(function(){
	$(".msg-back").click(function(){
		location.href="<?php echo base_url("messages");?>";
	});
	
	$("body").on("click",".editdl",function(){
		var thisId = $(this).attr("id");
		$("#dl_id").val(thisId);
		$.post("<?php echo base_url("admin/getdldata");?>",{dl_id:thisId},function(data){
			var obj = JSON.parse(data); 
			$("#dlname").val(obj.dname);
			$("#dlurl").val(obj.durl);
			$("#newdlform").modal("show");
		});
		
	});
	
	$("body").on("click",".deletedl",function(){
		var thisId = $(this).attr("id");
		if(confirm("Are you sure?")){
			$.post("<?php echo base_url("admin/deletedl");?>",{dl_id:thisId},function(data){
				$("#dl-"+thisId).remove();
			});		
		}
	});
	
	$("#newdlbtns").click(function(){
		$("#dl_id").val(0);
	});
});
</script>




<!-- Modal -->
<div class="modal fade" id="newdlform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="badge badge-red">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel">New Download Form</h3>
      </div>
      <div class="modal-body ">
      
      <div class="row">
      <div class="col-md-12">
      
             <form class="form-horizontal" role="form" action="" method="POST">

              <div class="form-group">
                <label for="" class="col-sm-3 control-label">Form Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="dl_name" id="dlname" required>
                </div>      
              </div>

              <div class="form-group">
                <label for="" class="col-sm-3 control-label">Download Link</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="dl_url" id="dlurl" required>
                </div>      
              </div>              

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="hidden" name="dl_id" id="dl_id" value="0">
                  <button type="submit" class="btn btn-green" name="newdlbtn">SAVE</button>
                  <button type="button" class="btn btn-red" data-dismiss="modal">CANCEL</button>
                </div>
              </div>
            </form>
 		</div>
        </div>
        
      </div>

    </div>
  </div>
</div>