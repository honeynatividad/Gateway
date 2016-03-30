<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Messages</div>
        </div>
        <div class="panel-body">
        	<div class="row">
            <!-- start messages -->
            <form action="" method="POST" id="delmsgform">
            <table class="table" id="tablemsg">
            <thead id="msgheader">
            <tr>
              <th><input type="checkbox" id="selectall"></th>
              <th class="hidden-xs">DATE</th>
              <th class="hidden-xs">FROM</th>
              <th>SUBJECT</th>
              <th>
              <span class="btn btn-trash pull-right movetotrash hidden-xs">MOVE TO TRASH <i class="glyphicon glyphicon-trash"></i></span>
              <span class="btn btn-danger pull-right movetotrash visible-xs"> <i class="glyphicon glyphicon-trash"></i></span>
              </th>
            </tr>
            </thead>
            <tbody>
            
            <?php foreach($messages as $msg){?>
            <tr class="coloring <?php if($msg->read_status==0){echo 'unread';}?>" id="margmsg-<?php echo $msg->msg_id;?>">
              <td><input type="checkbox" name="msg_id[]" class="checkitem" value="<?php echo $msg->msg_id;?>">
              </td>
              <td class="hidden-xs"><?php echo date('F d',strtotime($msg->date_created));?></td>
              <td class="hidden-xs">Philcare Inc</td>
              <td>
              <a href="<?php echo base_url('/messages/msg/'.$msg->msg_id);?>"><?php echo $msg->subject;?>
              </a></td>
              <td></td>
            </tr>
            <?php }?>

            
                                    
                        
            </tbody>
            </table>
            </form>
    		<!-- end messages -->
        </div>
    </div>               
   </div>
    
</div>		
<script>
$(document).ready(function(){
	$("body").on("change",".checkitem",function(){
		if(this.checked){
			$("#margmsg-"+$(this).attr("id")).addClass("click");
		}else{
			$("#margmsg-"+$(this).attr("id")).removeClass("click");
		}
	});
	
	$(".movetotrash").click(function(){
		var totals = $("input[name='msg_id[]']:checked").length;
		if(totals>0){
			if(confirm("Are you sure you want to delete selected message(s)?")){
				$("#delmsgform").submit();
			}
		}else{
			alert("No Selected Messages.");	
		}
	});	

	$("body").on("click",".checkitem",function(){
		
		if(this.checked){
			$(this).closest( "tr.coloring" ).addClass( "click" );
		}else{
			$(this).closest( "tr.coloring" ).removeClass( "click" );
		}		
	});	
});
</script>