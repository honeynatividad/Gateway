<div class="col-md-9">
    <!--<div class="philcontainer">
    
    </div>		-->	
    
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Temporary Membership Card</div>
        </div>
        <div class="panel-body">
<?php /*?>
            <!-- start articles -->
              <div class="card" id="pcard">
              	<div class="row">
              		<div class="col-md-6">
                    	<span class="btn btn-green" id="btnPrint">PRINT PAGE</span>
              		</div>
              
              		<div class="col-md-6">
                    <img src="<?php echo base_url("resources");?>/img/PhilCare-Logo.png">
              		</div>
              	</div>

              	<div class="row">
              		<div class="col-md-6">
                    	<table>
                        	<tr>
                            	<td><h4>Date Purchased:</h4></td>
                                <td>&nbsp;</td>
                                <td><h4>10-18-14</h4></td>
                            </tr>
                        	<tr>
                            	<td><h4>Validity Date:</h4></td>
                                <td>&nbsp;</td>
                                <td><h4>10-18-14</h4></td>
                            </tr>
                        	<tr>
                            	<td><h4>Voucher:</h4></td>
                                <td>&nbsp;</td>
                                <td><h4>12345667</h4></td>
                            </tr>                                                        
                        </table>
                   		<p>
                   Maecenas eu risus cursus, feugiat mauris lobortis, condimentum eros. Mauris elementum fermentum nulla, 
                   vehicula hendrerit augue maximus eu. Cras ultricies placerat augue. Nam dignissim cursus turpis, sed tincidunt mauris dignissim.
                   		</p>                         
              		</div>
              
              		<div class="col-md-6">
                    <img src="<?php echo base_url("resources");?>/img/temp_id.png">
              		</div>
              	</div>
                                
                
              </div>
    		<!-- end articles -->
            <?php */?>
        </div>
    </div>               
    
    
</div>		
<script>
$(document).ready(function(){
        $("body").on("click","#btnPrint", function () {
            var divContents = $("#pcard").html();
            var printWindow = window.open('', '', 'height=620,width=1080');
            printWindow.document.write('<html><head><title></title>');
			printWindow.document.write('<link href="<?php echo base_url("resources");?>/css/bootstrap.css" rel="stylesheet">');
			printWindow.document.write('<link href="<?php echo base_url("resources");?>/css/style.css" rel="stylesheet">');
            printWindow.document.write('</head><body ><div class="container"><style>#btnPrint{display:none;}</style>');
            printWindow.document.write(divContents);
            printWindow.document.write('</div></body></html>');
            printWindow.document.close();
            printWindow.print();
        });
});
</script>