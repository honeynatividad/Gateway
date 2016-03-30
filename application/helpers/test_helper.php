<?php // test_helper.php
if(!defined('BASEPATH')) exit('No direct script access allowed');

    function draw_calendar($month,$year,$events){
        
	/* draw table */
        $calendar = '<div class="row">';
            $calendar.= '<div class="col-md-10">';
                $calendar.= '<table class="table" id="">';
                $headings = array('Sun','Mon','Tue','Wed','Thur','Fri','Sat');
                $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';
                
	//$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();
        $getMonth = date('m', mktime(0, 0, 0, $month, 10));
        //echo $getMonth;
	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;
            
	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $calendar.= '<td class="calendar-day"><div style="position:relative;height:100px;">';
			/* add in the day number */
            $calendar.= '<div class="day-number">'.$list_day.'</div>';
			
            $event_day = $year.'-'.$month.'-'.$list_day;
            
            if($list_day<10){
                $list_day='0'.$list_day;
            }
            //echo $month;
            //if($month<10){
            //    $event_day ='0'.$month.'/'.$list_day.'/'.$year;
            //}else{
                $event_day =$getMonth.'/'.$list_day.'/'.$year;
            //}
            
                        
            foreach($events as $event){
                            //echo '<pre>';
                            //echo $event_day;
                            //echo $event->Requestdate;
                            //echo '</pre>';
                if(trim((string)$event->Requestdate) == trim((string)$event_day)){
                    $status = trim((string)$event->RequestStatus);
                    if($status=="PENDING"){
                        $calendar.= '<div class="event_red"><a href="#" data-toggle="modal" data-target="#myModal" >'.$event->RequestStatus.'</a></div>';
                    }elseif($status=="APPROVED"){
                        $calendar.= '<div class="event_green">'.$event->RequestStatus.'</div>';
                    }
                    $calendar.= '<div id="myModal" class="modal fade" role="dialog">';
                    $calendar.= '<div class="modal-dialog">';

    
                    $calendar.= '<div class="modal-content">';
                    $calendar.= '<div class="modal-header">';
                    $calendar.= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                    $calendar.= '<h4 class="modal-title">Oline Scuedule Appointment</h4>';
                    $calendar.= '</div>';
                    $calendar.= '<div class="modal-body">';
                    $calendar.= '<span>Date: '.date("M/d",strtotime($event->Requestdate)).'</span>';                            
                    $calendar.='<p>Type: '.$event->APEType .'</p>';
                    $calendar.= '<p>Status: '.$event->RequestStatus.'</p>';
                    $calendar.= '<p>Provider Name: '.$event->ProviderName.'</p>';
                    $calendar.= '</div>';
                    $calendar.= '<div class="modal-footer">';
                    $calendar.= '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                    $calendar.= '</div>';
                    $calendar.= '</div>';

                    $calendar.= '</div>';
                                
                }else {
                    $calendar.= str_repeat('<p>&nbsp;</p>',2);
                }
                            
                            
            }
                     
			
		$calendar.= '</div></td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';
	

	/* end the table */
	$calendar.= '</table>';

            $calendar.= '</div>';
            $calendar.='<div class="col-md-2">';
            foreach($events as $event){
                $calendar.='<div class="schedule">';
                $calendar.='<h1> Requested Date: '.$event->Requestdate.'</h1>';
                $calendar.='<p>Status: '.$event->RequestStatus.'</p>';
                $calendar.='<p>Type: '.$event->APEType.'</p>';
                $calendar.='<p>Provider Name:'.$event->ProviderName.'</p>';
                $calendar.='</div>';
            }
            
            $calendar.='</div>';
        $calendar.= '</div>';
	/** DEBUG **/
	$calendar = str_replace('</td>','</td>'."\n",$calendar);
	$calendar = str_replace('</tr>','</tr>'."\n",$calendar);
	
	/* all done, return result */
	return $calendar;
}