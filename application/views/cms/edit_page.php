<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
	<script src="<?php echo base_url("resources");?>/js/bootstrap-datepicker.js"></script>
        <div class="panel panel-philcare">
            <div class="panel-heading">
                <div class="pull-right main-title">Page</div>
            </div>
            <div class="panel-body">
                <div class="row">
            <!-- start messages -->
                    <table class="table" id="tablemsg">
                        <thead id="msgheader">
                            <tr>
                                <th>
                                    <i class="glyphicon glyphicon-edit"></i> Edit Page
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
            
                    <form method="POST" action="" class="form-horizontal">
                        <?php foreach($result as $r): ?>
                        <div class="col-sm-10 col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Page Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="page_name" value="<?php echo $r->page_name ?>" class="form-control fcntrl" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Page Level</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="sel1" name="page_level">
                                        <option value="<?php echo $r->page_level ?>"><?php echo $r->page_level ?></option>
                                        <?php
                                        if($r->page_level==1){
                                            echo '<option value="2">2</option>';
                                        }else{
                                            echo '<option value="1">1</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                            </div>
                            
                            
                                                 
                            <div class="form-group">
                                <label class="col-sm-2 control-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" name="submitnews" value="SAVE" class="btn btn-green">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </form>           
            
            
    		<!-- end messages -->
                </div>
            </div>               
        </div>
    
    </div>		
<script>
$(document).ready(function(){
		$(".msg-back").click(function(){
			location.href="<?php echo base_url("messages");?>";
		});
		$('.datepicker').datepicker()
});


</script>