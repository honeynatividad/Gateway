<?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('msg') ?> </div>
            <?php } ?>
            
<?php

        if(isset($_GET['month'])){
            $month = (int) $_GET['month'];
        }else{
            $month = date('m');
        }
        
        if(isset($_GET['year'])){
            $year = (int)$_GET['year'];
        }else{
            $year = date('Y');
        }
        
       // print_r($events);
        //$month = (int) ($_GET['month'] ? $_GET['month'] : date('m'));
        //$year = (int)  ($_GET['year'] ? $_GET['year'] : date('Y'));

        /* select month control */
        $select_month_control = '<select name="month" id="month">';
        for($x = 1; $x <= 12; $x++) {
            $select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
        }
        $select_month_control.= '</select>';
//        $fid="<input type='hidden' name='id' id='submitted' value='".$id."'/>";
        /* select year control */
        $year_range = 7;
        $select_year_control = '<select name="year" id="year">';
        for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
            $select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
        }
        $select_year_control.= '</select>';

        /* "next month" control */
        $next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control">Next Month &gt;&gt;</a>';

        /* "previous month" control */
        $previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'" class="control">&lt;&lt; 	Previous Month</a>';


        /* bringing the controls together */
        $controls = '<form method="get">'.$select_month_control.$select_year_control.'&nbsp;<input type="submit" name="submit" value="Go" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$previous_month_link.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$next_month_link.' </form>';

        /* get all events for the given month */
        //$events = array();
        $query ="";
        
        echo '<div class="col-md-9">';
        echo '<h2 style="float:left; padding-right:30px;">'.date('F',mktime(0,0,0,$month,1,$year)).' '.$year.'</h2>';
        echo '<div style="float:left;">'.$controls.'</div>';
        echo '<div style="clear:both;"></div>';
        
        echo draw_calendar($month,$year,$events);
        echo '<br /><br />';
        echo '</div>';