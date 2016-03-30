<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">ECU List of Request</div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                   
                </div>
            </div>
            <div class="row">&nbsp;</div>
            <?php if ($this->session->flashdata('ecu_error')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('ecu_error') ?> </div>
            <?php } ?>
            
            <div class="row">
                <div id="newsfeedlist" class="newsfeedlistclass">
                    <div class="table-responsive">
                        <table class="table">
                            <th>ECU ID</th>
                            <th>Cert No</th>
                            <th>Type</th>
                            <th>Provider</th>
                            <th>Preferred Schedule</th>
                            <th>Status</th>
                            <th>Action</th>
                            <?php                             
                            foreach($ecus as $ecu){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $ecu->ecu_id ?>
                                </td>
                                <td>
                                    <?php echo $ecu->cert_no ?>
                                </td>
                                <td>
                                    <?php echo $ecu->type_of_appointment ?>
                                </td>
                                <td>
                                    <?php echo $ecu->provider ?>
                                </td>
                                <td>
                                    <?php echo $ecu->preferred_schedule ?>
                                </td>
                                <td>
                                    <?php
                                    if($logo->status==1){
                                        echo 'Active';
                                    }else{
                                        echo 'Not Active';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($logo->status==1){
                                    ?>
                                    <a class="btn btn-danger" href="<?php echo base_url("logo/deactivate/".$logo->logo_id); ?>">Deactivate</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a class="btn btn-primary" href="<?php echo base_url("logo/activate/".$logo->logo_id); ?>">Activate</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-success" href="<?php echo base_url("logo/edit/".$logo->logo_id); ?>">Edit</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div>	
<style>
.articleimge > img {
    /*max-height: 178px;*/
    overflow: hidden;
}
.thumbnail_article > img {
   /* height: 173px;*/
	width:100%;
}
.thumbnail_article .caption > h3 {
    font-size: 15px !important;
}
#left-switch{
	cursor:pointer;	
}
#right-switch{
	cursor:pointer;	
}
</style>