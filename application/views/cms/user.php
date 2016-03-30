<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Users</div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                   
                </div>
            </div>
            <div class="row">&nbsp;</div>
            
            <?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('msg') ?> </div>
            <?php } ?>
            <div class="row">
                <div id="newsfeedlist" class="newsfeedlistclass">
                    <div class="table-responsive">
                        <table class="table">
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Agreement No</th>
                            <th>HRA</th>
                            <th>Member</th>
                            <th>Status</th>
                            <th>Action</th>
                            <?php                             
                            foreach($users as $user){
                            ?>
                            <tr>
                                <td>
                                    <a class="articleimge" href="<?php echo base_url("user");?>">
                                        <?php echo $user->user_id ?>
                                    </a>
                                </td>
                                <td>
                                    <a class="articleimge" href="<?php echo base_url("user");?>">
                                        <?php echo $user->username; ?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $user->agreement_no ?>
                                </td>
                                <td>
                                    <?php
                                    if($user->hra==1){
                                        echo 'Yes';
                                    }else{
                                        echo 'No';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($user->member==1){
                                        echo 'Yes';
                                    }else{
                                        echo 'No';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($user->is_activated==1){
                                        echo 'Active';
                                    }else{
                                        echo 'Not Active';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($user->is_activated==1){
                                    ?>
                                    <a class="btn btn-danger" href="<?php echo base_url("user/deactivate/".$user->user_id); ?>">Deactivate</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a class="btn btn-primary" href="<?php echo base_url("user/activate/".$user->user_id); ?>">Activate</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-success" href="<?php echo base_url("user/edit/".$user->user_id); ?>">Edit</a>
                                    <a class="btn btn-default-orange" href="<?php echo base_url("user/delete/".$user->user_id); ?>">Delete</a>
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