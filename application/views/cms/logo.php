<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Logo</div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                   
                </div>
            </div>
            <div class="row">&nbsp;</div>
            
            <?php if ($this->session->flashdata('login_error')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('login_error') ?> </div>
            <?php } ?>
            <div class="row">
                <div id="newsfeedlist" class="newsfeedlistclass">
                    <div class="table-responsive">
                        <table class="table">
                            <th>Logo</th>
                            <th>Agreement No</th>
                            <th>Agreement Name</th>
                            <th>Status</th>
                            <th>Action</th>
                            <?php                             
                            foreach($logos as $logo){
                            ?>
                            <tr>
                                <td>
                                    <a class="articleimge" href="<?php echo base_url("logo");?>">
                                        <img src="<?php echo $logo->image_url ?>">
                                    </a>
                                </td>
                                <td>
                                    <a class="articleimge" href="<?php echo base_url("logo");?>">
                                        <?php echo $logo->agreement_no; ?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $logo->agreement_name ?>
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
                                    <a class="btn btn-default-orange" href="<?php echo base_url("logo/delete/".$logo->logo_id); ?>">Delete</a>
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