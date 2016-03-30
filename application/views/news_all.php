
<div id="newsfeedlist" class="newsfeedlistclass">
    <?php 
    $break = ".";
    $pad = "...";
    $limit = 50;
    foreach($newsfeed as $news){
    ?>
    <div class="row phildivider" id="">
        <div class="col-xs-12 col-sm-4 col-md-3"> 
            <a class="articleimge thumbnail_article2" href="<?php echo base_url("home/news/".$news->news_id);?>">
                <?php echo $news->title; ?>
            </a>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8">
            <p> <?php 
            $text = $news->description;

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
            <a href="<?php echo base_url("home/news/".$news->news_id);?>" class="art-readmore">
                <i class="glyphicon glyphicon-circle-arrow-right"></i>
            <span>Read More</span>
        </div>
    </div>
    <?php } ?>
</div>