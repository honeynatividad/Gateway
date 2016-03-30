<?php

$cMonth = $cMonth1;
$cYear = $cYear1;
//print_r($calendar);
foreach($calendar as $c){
    $originalDate = (string)$c->Requestdate;
    $newDate = date("Y-m-d", strtotime($originalDate));
    
    $events[$newDate]["APEType"] = (string)$c->APEType;
    $events[$newDate]["RequestStatus"] = (string)$c->RequestStatus;
    $events[$newDate]["ProviderAddress"] = (string)$c->ProviderAddress;
    $events[$newDate]["ProviderContact"] = (string)$c->ProviderContact;
    $events[$newDate]["ProviderName"] = (string)$c->ProviderName;
    $events[$newDate]["RequestDate"] = $originalDate;
}


// calculate next and prev month and year used for next / prev month navigation links and store them in respective variables
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = intval($cMonth)-1;
$next_month = intval($cMonth)+1;

// if current month is December or January month navigation links have to be updated to point to next / prev years
if ($cMonth == 12 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
} elseif ($cMonth == 1 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}

if ($prev_month<10) $prev_month = '0'.$prev_month;
if ($next_month<10) $next_month = '0'.$next_month;
//jay new 
$minus_1 = date("F Y",strtotime($cYear."-".$cMonth."-01 -1 month"));
$plus_1 = date("F Y",strtotime($cYear."-".$cMonth."-01 1 month"));

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class="row" id="calrow">
    <div class="col-md-9">	
        <table class="table" id="">
            <thead id="msgheader">
                <tr>
                    <th>
                        <div class="pull-left h5">
                            <a href="javascript:LoadMonth('<?php echo $prev_month; ?>', '<?php echo $prev_year; ?>')">
                                <i class="glyphicon glyphicon-circle-arrow-left"></i>&nbsp; 
                                <?php 
                                      //echo strtoupper(date("F Y",strtotime($cYear."-".$prev_month."-01")));
                                    echo strtoupper($minus_1);
                                ?>
                            </a>
                        </div>
                    </th>
                    <th class="center h3"><?php echo strtoupper(date("F Y",strtotime($cYear."-".$cMonth."-01"))); ?></th>
                    <th>
                        <div class="pull-right h5">
                            <a href="javascript:LoadMonth('<?php echo $next_month; ?>', '<?php echo $next_year; ?>')">
                            <?php 
                                               //echo strtoupper(date("F Y",strtotime($cYear."-".$next_month."-01"))); 
                                echo strtoupper($plus_1); 
                            ?>&nbsp;
                                <i class="glyphicon glyphicon-circle-arrow-right">
                                </i>
                            </a>
                        </div>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="col-md-3 visible-md visible-lg">
        <table class="table" id="">
            <thead id="msgheader">
                <tr>            
                    <th class="center h3 evnt">Schedule</th>            
                </tr>
            </thead>
        </table>
    </div>    
</div>
<div class="row">
    <div class="col-md-9">
        <table width="100%">
            <tr>
                <td class="wDays">S</td>
                <td class="wDays">M</td>
                <td class="wDays">T</td>
                <td class="wDays">W</td>
                <td class="wDays">T</td>
                <td class="wDays">F</td>
                <td class="wDays">S</td>
      
            </tr>
        <?php 
            $first_day_timestamp = mktime(0,0,0,$cMonth,1,$cYear); // time stamp for first day of the month used to calculate 
            $maxday = date("t",$first_day_timestamp); // number of days in current month
            $thismonth = getdate($first_day_timestamp); // find out which day of the week the first date of the month is
            $startday = $thismonth['wday'] - 0; // 0 is for Sunday and as we want week to start on Mon we subtract 1

            for ($i=0; $i<($maxday+$startday); $i++) {
	
                if (($i % 7) == 0 ) echo "<tr>";
	
                if ($i < $startday) { echo "<td>&nbsp;</td>"; continue; };
	
                $current_day = $i - $startday + 1;
                if ($current_day<10) $current_day = '0'.$current_day;

// set css class name based on number of events for that day
                if (isset($events[$cYear."-".$cMonth."-".$current_day])<>'') {
                    
                    $css='withevent';
                    $click = "onclick=\"LoadEvents('".$cYear."-".$cMonth."-".$current_day."')\"";
                    $jay = "<div class='circle_red product'><a href='#'data-toggle='modal' data-target='#myModal' >". $current_day . "</a></div>";
                    ?>
            
            <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Oline Scuedule Appointment</h4>
      </div>
      <div class="modal-body">
        <span><?php echo date('M',strtotime($events[$cYear."-".$cMonth."-".$current_day]["RequestDate"]));?></span>
        <h4><?php echo date('d',strtotime($events[$cYear."-".$cMonth."-".$current_day]["RequestDate"]));?></h4>
        <p>Type: <?php echo $events[$cYear."-".$cMonth."-".$current_day]['APEType'] ?></p>
        <p>Status: <?php echo $events[$cYear."-".$cMonth."-".$current_day]['RequestStatus'] ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
            <div class="product-highlight" id="shoes">
            <div class="row">
<ul class="list-group cal-event">
    
  
    <li class="list-group-item">
        <div class="datetext">
        <span><?php echo date('M',strtotime($events[$cYear."-".$cMonth."-".$current_day]["RequestDate"]));?></span>
        <h4><?php echo date('d',strtotime($events[$cYear."-".$cMonth."-".$current_day]['RequestDate']));?></h4>
        </div>
        <span><?php 
        $prov = $events[$cYear."-".$cMonth."-".$current_day]["APEType"];
        echo (string)$prov;?></span> 
        <p>tt<?php $events[$cYear."-".$cMonth."-".$current_day]["RequestStatus"] ?></p>
    </li>  
  
</ul>
</div>
            </div>
            <?php
                } else {
                    $css='noevent'; 		
                    $click = '';
                    $jay = $current_day;
                }
	
                echo "<td class='".$css."'".$click.">".$jay."</td>";
	
                if (($i % 7) == 6 ) echo "</tr>";
            }
        ?> 
        </table>
    </div>
    <div class="col-md-3" id="Events">
    
    </div>
</div>
<!-- Modal -->

</div>


<script>
$(document).ready(function() {

  $('.product-highlight').hide();
  
  $('a[href$=shoes').click(function() {
    $('#shoes').show();
  });

  // add this line...
  $(window.location.hash).show();


  
});
</script>