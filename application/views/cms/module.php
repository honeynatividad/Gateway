<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Modules</div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                   
                </div>
            </div>
            <div class="row">&nbsp;</div>
            
            <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-danger"> <?= $this->session->flashdata('success') ?> </div>
                    <?php } ?>
            <div class="row">
                <div id="newsfeedlist" class="newsfeedlistclass">
                    <div class="table-responsive">
                        <table class="table">
                            <th>Agreement No</th>
                            <th>Newsfeed</th>
                            <th>Provider</th>
                            <th>ECU</th>
                            <th>Reimbursement</th>
                            <th>HRA</th>
                            <th>Status</th>
                            <th>Action</th>
                            <?php    
                            
                            foreach($modules as $module){
                            ?>
                            <tr>
                                <td><?php echo $module->agreement_no ?></td>
                                <td>
                                    <?php
                                    if($module->newsfeed==1){
                                        echo 'Yes';
                                    }else{
                                        echo 'No';
                                    }
                                    ?>
                                    
                                </td>
                                <td>
                                    <?php
                                    if($module->provider==1){
                                        echo 'Yes';
                                    }else{
                                        echo 'No';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($module->ecu==1){
                                        echo 'Yes';
                                    }else{
                                        echo 'No';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($module->reimbursement==1){
                                        echo 'Yes';
                                    }else{
                                        echo 'No';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($module->hra == 1){
                                        echo 'Yes';
                                    }else{
                                        echo 'No';
                                    }
                                    ?>

                                </td>
                                <td>
                                    <?php
                                    if($module->status==1){
                                        echo 'Active';
                                    }else{
                                        echo 'Not Active';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($module->status==1){
                                    ?>
                                    <a class="btn btn-danger" href="<?php echo base_url("module/deactivate/".$module->module_id); ?>">Deactivate</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a class="btn btn-primary" href="<?php echo base_url("module/activate/".$module->module_id); ?>">Activate</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-success" href="<?php echo base_url("module/edit/".$module->module_id); ?>">Edit</a>
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