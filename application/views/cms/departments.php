<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Feedback Receivers</div>
        </div>
        <div class="panel-body">

            <!-- start articles -->
            <div class="col-sm-5 col-md-6">
				<table class="table">
                	<thead>
                    	<th>DIVISION</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                    </thead>
                    <?php foreach($dept as $d){?>
                	<tr>
                    	<td><?php echo $d->div_name;?></td>
                        <td><?php echo $d->dep_name;?></td>
                        <td><?php echo $d->dep_email;?></td>
                    </tr>
                    <?php }?>
                </table>
            </div>            
    		<!-- end articles -->
            
        </div>
    </div>               
    
    
</div>		
<script>
$(document).ready(function(){

});
</script>