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
            
            
            <div class="row">
                <div id="newsfeedlist" class="newsfeedlistclass">
                    <div class="table-responsive">
                        <table class="table">
                            <th>Id</th>
                            <th>Title</th>
                            <th>Agreement No</th>
                            <th>Status</th>
                            <th>Action</th>
                            <?php                             
                            foreach($guidebooks as $guidebook){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $guidebook->guidebook_id ?>
                                </td>
                                <td>
                                    <?php echo $guidebook->title ?>
                                </td>
                                <td>
                                    <?php echo $guidebook->agreement_no ?>
                                </td>
                                <td>
                                    <?php
                                    if($guidebook->status==1){
                                        echo 'Active';
                                    }else{
                                        echo 'Not Active';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($guidebook->status==1){
                                    ?>
                                    <a class="btn btn-danger" href="<?php echo base_url("guidebook/deactivate/".$guidebook->guidebook_id); ?>">Deactivate</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a class="btn btn-primary" href="<?php echo base_url("guidebook/activate/".$guidebook->guidebook_id); ?>">Activate</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-success" href="<?php echo base_url("guidebook/edit/".$guidebook->guidebook_id); ?>">Edit</a>
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