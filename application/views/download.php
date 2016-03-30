<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Download Forms</div>
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
                    <span class="label badge-feed-green">Latest Downloads</span>					
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
                            <th>Agreement No</th>
                            <th>Name</th>                            
                            <th>Status</th>
                            <th>Action</th>
                            <?php 
                            
                            foreach($downloads as $dl){
                            ?>
                            <tr>
                                <td>
                                    <a class="articleimge" href="<?php echo base_url("download/view/".$dl->dl_id);?>">
                                        <?php echo $dl->agreement_no; ?>
                                    </a>
                                </td>
                                <td>                                    
                                    <?php echo $dl->dl_name ?>
                                </td>                                
                                <td>
                                    <?php
                                    if($dl->status==1){
                                        echo 'Active';
                                    }else{
                                        echo 'Not Active';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($dl->status==1){
                                    ?>
                                    <a class="btn btn-danger" href="<?php echo base_url("downloads/deactivate/".$dl->dl_id); ?>">Deactivate</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a class="btn btn-primary" href="<?php echo base_url("downloads/activate/".$dl->dl_id); ?>">Activate</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-success" href="<?php echo base_url("downloads/edit/".$dl->dl_id); ?>">Edit</a>
                                    <?php 
                                    $ses = $this->session->userdata('logged_in');
                                    if($ses['level']==1){
                                    ?>
                                    <a class="btn btn-default-orange" href="<?php echo base_url("downloads/delete/".$dl->dl_id); ?>">Delete</a>
                                    <?php
                                    }
                                    ?>
                                    
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