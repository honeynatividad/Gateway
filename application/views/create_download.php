<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
	
        <div class="panel panel-philcare">
            <div class="panel-heading">
                <div class="pull-right main-title">Downloadable Form</div>
            </div>
            <div class="panel-body">
                <div class="row">
            <!-- start messages -->
                    <table class="table" id="tablemsg">
                        <thead id="msgheader">
                            <tr>
                                <th>
                                    <i class="glyphicon glyphicon-edit"></i> ADD form
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                    <?php echo $this->session->userdata('upload_error'); ?>
                    <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
                        <div class="col-sm-10 col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="dl_name" value="" class="form-control fcntrl" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Upload File</label>
                                <div class="col-sm-10">
                                    <input type="file" name="fileToUpload" value="" class="form-control fcntrl" required="required">
                                </div>
                            </div>
                            <input type="hidden" name="agreement_no" value="<?php echo $agreement_no ?>">
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" name="submitnews" value="SAVE" class="btn btn-green">
                                </div>
                            </div>
                        </div>
                    </form>           
            
            
    		<!-- end messages -->
                </div>
            </div>               
        </div>
    <?php $this->session->unset_userdata("upload_error"); ?>
    </div>		
<script>
$(document).ready(function(){
		$(".msg-back").click(function(){
			location.href="<?php echo base_url("messages");?>";
		});
		$('.datepicker').datepicker()
});
</script>