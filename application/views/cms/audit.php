<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">News Feed</div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <!--
                    <div class="embed-responsive embed-responsive-16by9">
                        <?php
                       // foreach($get_video as $video){
                        ?>
                        <iframe class="embed-responsive-item" src="//<?php //echo $video->title ?>"></iframe>
                        <?php
                     //   }
                        ?>
                        
                    </div>
                    !-->
                </div>
            </div>
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="col-md-8">
                    <span class="label badge-feed-green">Audit Trail</span>					
                </div>
                
                <div class="col-md-4">
                    <div class="feed-sp-button">
                        <span class="glyphicon glyphicon-th-list" id="left-switch" title="List View"></span>
               	   <!-- <input type="checkbox" value="1" name="my-checkbox" data-checkbox="2" class="feedchange"> -->
                	<span class="glyphicon glyphicon-th-large" id="right-switch" title="Grid View"></span>
                    </div>     
                </div>
            </div>
            <?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('msg') ?> </div>
            <?php } ?>
            <div class="row">
                <div id="newsfeedlist" class="newsfeedlistclass">
                    <div class="table-responsive">
                        <table class="table">
                            <th>ID</th>
                            <th>User</th>
                            <th>Page Name</th>
                            <th>Action Name</th>
                            <th>Status</th>
                            <th>Action</th>
                            <?php 
                            
                            foreach($audits as $audit){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $audit->audit_id; ?>
                                </td>
                                <td>
                                    <p>
                                        <?php 
                                        
                                        ?>
                                    </p>
                                    <a href="<?php echo base_url("home/news/".$news->news_id);?>" class="art-readmore">
                                    <i class="glyphicon glyphicon-circle-arrow-right"></i>
                                    <span>Read More</span>
                                </td>
                                <td><?php echo $news->agreement_no ?></td>
                                <td>
                                    <?php
                                    if($news->status==1){
                                        echo 'Active';
                                    }else{
                                        echo 'Not Active';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($news->status==1){
                                    ?>
                                    <a class="btn btn-danger" href="<?php echo base_url("news/deactivate/".$news->news_id); ?>">Deactivate</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a class="btn btn-primary" href="<?php echo base_url("news/activate/".$news->news_id); ?>">Activate</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-success" href="<?php echo base_url("news/edit/".$news->news_id); ?>">Edit</a>
                                    <a class="btn btn-default-orange" href="<?php echo base_url("news/news_delete/".$news->news_id); ?>">Delete</a>
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