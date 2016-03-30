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
           
            <?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('msg') ?> </div>
            <?php } ?>
            <div class="row">
                <div class="well">
                    <div class="row-color">
                        <div class="col-md-12 row-color">List of Forms</div>
                    </div>
                    <div class="col-md-12">
                        <?php foreach($downloads as $dl): ?>
                        <p><a href="<?php echo base_url('resources') ?>/pdf/<?php echo $dl->dl_url ?>"><?php echo $dl->dl_name ?></a> </p>
                        <?php endforeach; ?>
                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>   
</div>