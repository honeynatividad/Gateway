<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">FAQ</div>
        </div>
        <div class="panel-body">
           
            <div class='newsfeedlist'>
                <?php 
                
                foreach($faq as $f){
                ?>
                
                
                    
                    <div class="col-md-12">
                        <h4 class=""><?php echo $f->title; ?></h4>
                        <p> <?php 
                            $text = $f->content;
                    
                            
                                echo $text;
                            
                            ?>
                        </p>
                        
                    </div>
                
                
               
                <?php } ?>
                
               
                
            </div>
            <!-- start articles -->
            
    		<!-- end articles -->
        </div>
    </div>               
    
    
</div>	