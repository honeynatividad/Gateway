<div class="col-md-9">
    <?php
    $session_data = $this->session->userdata('logged_in');
    $prepaid = $session_data['prepaid'];


    ?>
    <!--<div class="philcontainer">
    </div>		-->	
<style>
    label {
    font-size: 12px;
    }
    .dpdtls{cursor:pointer;}
</style>

<div class="panel panel-philcare">
    <div class="panel-heading">
        <div class="pull-right main-info">Member Information</div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <div class="row">
                        <div class="col-md-4">Certificate No:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Member Name:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Agreement Name:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Principal:</div>
                        <div class="col-md-8"></div>
                    </div>
                     <div class="row">
                        <div class="col-md-4">Agreement No:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Member Type:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Contract:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Rank:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Contract Period:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Birthday:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Age:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Benefit Option:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Account Type:</div>
                        <div class="col-md-8"></div>
                    </div>                    
                </div>
            </div>            
        </div>        
    </div>
</div>

<div class="panel panel-philcare">
    <div class="panel-heading">
        <div class="pull-right main-info">Diagnosis</div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <div class="row">
                        <div class="col-md-4">Initial Diagnosis:</div>
                        <div class="col-md-8"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">Quoted:</div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">Billed:</div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">Philhealth:</div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">Covered:</div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">Net Amount:</div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">Co-Pay Amount:</div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-philcare">
    <div class="panel-heading">
        <div class="pull-right main-info">Claim Information</div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    
                    <div class="row">
                        <div class="col-md-4">Case No:</div>
                        <div class="col-md-4">Status:</div>
                        <div class="col-md-4">Create Date:</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Provider</div>
                        <div class="col-md-8"></div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">Nature</div>
                        <div class="col-md-6">Created By</div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">Processed By:</div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">Date Availed:</div>
                        <div class="col-md-6">Date Discharged:</div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">Batch No</div>
                        <div class="col-md-8"></div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">Complaints</div>
                        <div class="col-md-8"></div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
              
    
    
</div>		
<script>
$(document).ready(function(){	
	$("#editadd").click(function(){
		$("#editprofmodal").modal("show");
	});
	
	$("#editother").click(function(){
		$("#editotherinfomodal").modal("show");
	});	
	$("body").on("click",".dpdtls",function(){
		var thisId = $(this).attr("id");
		$("#dfendentsmodal").modal("show");
		$("#replacealldpdnts").html('<div class="col-md-2"><div class="row"><img src="<?php echo base_url("resources/img/ajax-loader.gif");?>"></div></div>');
		$.post("<?php echo base_url("account/getdefendesntsinfo");?>",{cert:thisId},function(data){
			$("#replacealldpdnts").html(data);
			
		});
		
	});
});
</script>