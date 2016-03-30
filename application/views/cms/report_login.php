<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url("resources");?>/css/datepicker.css" rel="stylesheet" />
    <script src="<?php echo base_url("resources");?>/js/bootstrap-datepicker.js"></script>
    <script language="javascript" src="<?php echo base_url('resources/js/calendar.js');?>"></script>
<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Report:Login for <?php echo $agreement ?></div>
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
                    
                        <table id="report" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Cert No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Date Accessed</th>
                                </tr>
                            </thead>
                            
                            <?php                             
                            foreach($login as $l){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $l->user_id ?>
                                </td>
                                <td>
                                    <?php
                                    $check = $this->wslibrary->getMembersInfo($l->user_id);
                                    //print_r($check);
                                    //echo $check->FirstName;
                                    echo $l->first_name;
                                    //$update = $this->model_portal_reports->updateAudit($check->FirstName,$check->LastName,$l->audit_id);
                                    ?>
                                </td>
                                <td>
                                    <?php echo $l->last_name ?>
                                </td>
                                <td>
                                   <?php 
                                   echo $l->created
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
<script>
    $(document).ready(function(){
        
        
        
    });
    
    $.fn.pageMe = function(opts){
    var $this = this,
        defaults = {
            perPage: 7,
            showPrevNext: false,
            hidePageNumbers: false
        },
        settings = $.extend(defaults, opts);
    
    var listElement = $this;
    var perPage = settings.perPage; 
    var children = listElement.children();
    var pager = $('.pager');
    
    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }
    
    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }
    
    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
    }
    
    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;
    }
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
    }
    
    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }
  	pager.children().eq(1).addClass("active");
    
    children.hide();
    children.slice(0, perPage).show();
    
    pager.find('li .page_link').click(function(){
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    });
    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });
    
    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        goTo(goToPage);
    }
     
    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        goTo(goToPage);
    }
    
    function goTo(page){
        var startAt = page * perPage,
            endOn = startAt + perPage;
        
        children.css('display','none').slice(startAt, endOn).show();
        
        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }
        
        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }
        
        pager.data("curr",page);
      	pager.children().removeClass("active");
        pager.children().eq(page+1).addClass("active");
    
    }
};

$(document).ready(function(){
    $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            todayHighlight:'TRUE',
            startDate: '-0d',
            autoclose: true,
        });
  $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:4});
    
});
</script>