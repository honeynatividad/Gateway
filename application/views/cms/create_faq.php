<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
	<script src="<?php echo base_url("resources");?>/js/bootstrap-datepicker.js"></script>
        <div class="panel panel-philcare">
            <div class="panel-heading">
                <div class="pull-right main-title">FAQ</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('msg') ?> </div>
            <?php } ?>
            <!-- start messages -->
                    <table class="table" id="tablemsg">
                        <thead id="msgheader">
                            <tr>
                                <th>
                                    <i class="glyphicon glyphicon-edit"></i> CREATE FAQ
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
            
                    <form method="POST" action="" class="form-horizontal">
                        <input type="hidden" name="agreement_no" value="<?php echo $agreement_no ?>" >
                            
                      
                            <div class="form-group">
                                
                                <div class="col-sm-12">
                                    <textarea cols="50" id="editor1" name="description" rows="20"></textarea>      
                                         <script>
                                //CKEDITOR.replace( 'editor1' );
                                CKEDITOR.replace( 'editor1',
                {
                    //filebrowserBrowseUrl :'http://localhost/memberportal/resources/ck/editor/filemanager/browser/default/browser.html?Connector=http://localhost/memberportal/resources/ck/editor/filemanager/connectors/php/connector.php',
                    //filebrowserImageBrowseUrl : 'http://localhost/memberportal/resources/ck/editor/filemanager/browser/default/browser.html?Type=Image&Connector=http://localhost/memberportal/resources/ck/editor/filemanager/connectors/php/connector.php',
                    //filebrowserFlashBrowseUrl :'http://localhost/memberportal/resources/ck/editor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://localhost/memberportal/resources/ck/editor/filemanager/connectors/php/connector.php',
                    
                    filebrowserUploadUrl  :'http://memberportal2.philcare.com.ph/resources/ck/editor/filemanager/connectors/php/upload.php?Type=File',
		    filebrowserImageUploadUrl : 'http://memberportal2.philcare.com.ph/resources/ck/editor/filemanager/connectors/php/upload.php?Type=Image',
		    filebrowserFlashUploadUrl : 'http://memberportal2.philcare.com.ph/resources/ck/editor/filemanager/connectors/php/upload.php?Type=Flash'
                    
                    //filebrowserUploadUrl  :'http://localhost/memberportal/resources/ck/editor/filemanager/connectors/php/upload.php?Type=File',
		    //filebrowserImageUploadUrl : 'http://localhost/memberportal/resources/ck/editor/filemanager/connectors/php/upload.php?Type=Image',
		    //filebrowserFlashUploadUrl : 'http://localhost/memberportal/resources/ck/editor/filemanager/connectors/php/upload.php?Type=Flash'
                }
             );
                            </script>            
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
    
    </div>		
<script>
$(document).ready(function(){
		$(".msg-back").click(function(){
			location.href="<?php echo base_url("messages");?>";
		});
		$('.datepicker').datepicker()
});


</script>