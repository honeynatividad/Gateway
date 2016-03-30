<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">FAQ</div>
        </div>
        <div class="panel-body">
            <?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('msg') ?> </div>
            <?php } ?>
            <!-- start articles -->
             <div class="row">
                <div id="newsfeedlist" class="newsfeedlistclass">
                    <div class="table-responsive">
                        <table class="table">
                            <th>Title</th>
                            <th>Content</th>
                            <th>Agreement No</th>
                            <th>Status</th>
                            <th>Action</th>
                            <?php 
                            $break = ".";
                            $pad = "...";
                            $limit = 50;
                            
                            foreach($page_content as $page){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $page->title ?>
                                </td>
                                <td>
                                    <p>
                                        <?php 
                                        $text = $page->content;

                                        if(strlen($text) <= $limit){
                                            echo strip_tags($text);
                                        }else if(false !== ($breakpoint = strpos($text, $break, $limit))) {
                                            if($breakpoint < strlen($text) - 1) {
                                                $text = substr($text, 0, $breakpoint) . $pad;
                                            }
                                            echo strip_tags($text);
                                        }
                                        ?>
                                    </p>
                                    <a href="<?php echo base_url("faq/faq_view/".$page->faq_id);?>" class="art-readmore">
                                    <i class="glyphicon glyphicon-circle-arrow-right"></i>
                                    <span>Read More</span>
                                </td>
                                <td><?php echo $page->agreement_no ?></td>
                                <td>
                                    <?php
                                    if($page->status==1){
                                        echo 'Active';
                                    }else{
                                        echo 'Not Active';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($page->status==1){
                                    ?>
                                    <a class="btn btn-danger" href="<?php echo base_url("faq/deactivate/".$page->faq_id); ?>">Deactivate</a>
                                    <?php
                                    }else{
                                    ?>
                                    <a class="btn btn-primary" href="<?php echo base_url("faq/activate/".$page->faq_id); ?>">Activate</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="btn btn-success" href="<?php echo base_url("faq/admin_edit/".$page->faq_id); ?>">Edit</a>
                                    <a class="btn btn-default-orange" href="<?php echo base_url("faq/delete/".$page->faq_id); ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            
                        </table>
                    </div>
                </div>
            </div>
    		<!-- end articles -->
            
        </div>
    </div>               
    
    
</div>		
<script>
$(document).ready(function(){

});
</script>