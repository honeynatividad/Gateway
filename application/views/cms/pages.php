<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Pages</div>
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
                            <th>Page Id</th>
                            <th>Page Name</th>
                            <th>Has Sub Page</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Action</th>
                            <?php    
                            
                            foreach($pages as $page){
                            ?>
                            <tr>
                                <td>
                                    <a class="articleimge" href="<?php echo base_url("pages");?>">
                                        <?php echo $page->page_id ?>
                                    </a>
                                </td>
                                <td><?php echo $page->page_name ?></td>
                                <td>
                                    <?php 
                                    if($page->has_sub!=0){
                                        echo 'Yes';
                                    }else{
                                        echo 'No';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $page->page_level; ?>
                                </td>
                                <td>
                                    <?php
                                    if($page->active_stat==1){
                                        echo 'Active';
                                    }else{
                                        echo 'Not Active';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($page->active_stat==1){
                                    ?>
                                    <a class="btn btn-danger" href="<?php echo base_url("pages/deactivate/".$page->page_id); ?>">Deactivate</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a class="btn btn-primary" href="<?php echo base_url("pages/activate/".$page->page_id); ?>">Activate</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-success" href="<?php echo base_url("pages/edit/".$page->page_id); ?>">Edit</a>
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