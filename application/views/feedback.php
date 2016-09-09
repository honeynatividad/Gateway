<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    <?php $user = $this->session->userdata('logged_in');?>
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Online Helpdesk</div>
        </div>
        <div class="panel-body">

            <!-- start articles -->
                <form role="form" class="form-horizontal" action="" method="post">
                
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9 feedinfo">
                          <h1><?php echo $user['fullname'];?></h1>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="category" name="category" id="category" data-settings='{"cutOff":10}'>
                                <option value="">---- Select Category ----</option>
                                <option value="Card Availability">Card Availability</option>
                                <option value="Benefit Plan">Benefit Plan</option>
                                <?php if($agreement == "PC10889" || $agreeement == "PC10917" || $agreement == "PC10939"): ?>
                                <option value="Co-Pay Facilities">Co-Pay Facilities</option>
                                <?php endif; ?>
                                <option value="Availment Process">Availment Process</option>
                                <option value="Provider Network, including Dental Clinics">Provider Network, including Dental Clinics</option>
                                <option value="Accreditation Requests and Status">Accreditation Requests and Status</option>
                                <option value="Reimbursement Claims">Reimbursement Claims</option>
                                <?php if($agreement == "PC10889" || $agreeement == "PC10917" || $agreement == "PC10939"): ?>
                                <option value="Gcash-related">Gcash-related</option>                                
                                <?php endif; ?>
                                
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Feedback</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="comment" class="form-control fcntrl" rows="10" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10 mobilecenter">
                            <button class="btn btn-green" type="submit" name="submit">SUBMIT</button>
                        <!--  <button class="btn btn-red" type="button" id="clearbtn">CLEAR</button>-->
                        </div>
                    </div>
                    <div class="form-group ">
                        
                    </div>  
                </form>
                <div class="loaderphil" id="thisanchor">
                    <div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div>
                </div>
                <div class="col-sm-12">
                            
                            
                                <p>
                                    PhilCare’s business hours is from Monday to Friday, 8am-5pm. Should you have further concerns, you may reach us through our Call Center Hotline: (02) 462-1800 or SMS (0918)887.2273 and 0908)887.2273
                                </p>                    
                            
                        </div>
                
    		<!-- end articles -->
            
        </div>
    </div>               
    
    
</div>		
<script>
$(document).ready(function(){
    
    
	$(".feedchange").bootstrapSwitch();

	$('.feedchange').on('switchChange.bootstrapSwitch', function (event, state) {
		var thisData = $(this).attr('data-checkbox');
		 	if(thisData==1){
				
				$(this).attr('data-checkbox',2);
				$("#left-switch").css('color','#168246');
				$("#right-switch").css('color','#cecfd1');

			}else if(thisData==2){
				
				$(this).attr('data-checkbox',1);
				$("#left-switch").css('color','#cecfd1');
				$("#right-switch").css('color','#168246');
			}

	});
	
	$("#clearbtn").click(function(){
		$("input").val('');
		$("textarea").val('');
	});
	
});
</script>