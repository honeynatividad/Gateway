<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
	
        <div class="panel panel-philcare">
            <div class="panel-heading">
                <div class="pull-right main-title">Guide Book</div>
            </div>
            <div class="panel-body">
                <div class="row">
            <!-- start messages -->
                    <table class="table" id="tablemsg">
                        <thead id="msgheader">
                            <tr>
                                <th>
                                    <i class="glyphicon glyphicon-edit"></i> ADD guide book
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
                                    <input type="text" name="title" value="" class="form-control fcntrl" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Upload File</label>
                                <div class="col-sm-10">
                                    <input type="file" name="fileToUpload" value="" class="form-control fcntrl" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Agreement No</label>
                                <div class="col-sm-10">
                                    <select class="form-control col-sm-10" id="sel1" name="agreement_no">
                                        <?php foreach($logo as $l): ?>
                                        <option value="<?php echo $l->agreement_no ?>"><?php echo $l->agreement_no ?> - <?php echo $l->username ?></option>
                                        <?php endforeach; ?>
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