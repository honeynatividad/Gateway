<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Feedback</div>
        </div>
        <div class="panel-body">
        	<div class="row">
            <!-- start messages -->
            <form action="" method="POST" id="delmsgform">
            <table class="table" id="tablemsg">
            <thead id="msgheader">
            <tr>
              <th><input type="checkbox" id="selectall"></th>
              <th>DATE</th>
              <th>FROM</th>
              <th>SUBJECT</th>
              <th>
              <span class="btn btn-trash pull-right movetotrash">MOVE TO TRASH 
              <i class="glyphicon glyphicon-trash"></i>
              </span>
              </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            
            <?php foreach($feedback as $fbs){?>
            <tr class="coloring" id="margfbs-<?php echo $fbs->fbs_id;?>">
              <td>
              <input type="checkbox" name="fbs_id[]" class="checkitem" value="<?php echo $fbs->fbs_id;?>">
              </td>
              <td><?php echo date('F d',strtotime($fbs->date_created));?></td>
              <td><?php echo $fbs->fname." ".$fbs->lname;?></td>
              <td>
              <a href="<?php echo base_url('admin/feedbyid/'.$fbs->fbs_id);?>"><?php echo $fbs->subject;?></a>
              </td>
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
			$("#margfbs-"+$(this).attr("id")).addClass("click");
		}else{
			$("#margfbs-"+$(this).attr("id")).removeClass("click");
		}
	});
	
	$(".movetotrash").click(function(){
		var totals = $("input[name='fbs_id[]']:checked").length;
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