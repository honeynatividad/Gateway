
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<div class="col-md-9">
    <div id='calendar'></div>
</div>

<div id="fullCalModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
					<h4 id="modalTitle" class="modal-title"></h4>
				</div>
				<div id="modalBody" class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button>
				</div>
			</div>
		</div>
	</div>
		
<link href='<?php echo base_url('download'); ?>/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url('download') ?>/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo base_url('download') ?>/fullcalendar/lib/moment.min.js'></script>

<script src='<?php echo base_url('download') ?>/fullcalendar/fullcalendar.min.js'></script>

    
<script>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			// DAFFY FOR GAFE TUTORIAL Shared Calendar 
			// PUT THE URL TO YOUR SHARED GOOGLE CALENDAR XML FEED BETWEEN THESE SINGLE QUOTES
			// AND MAKE SURE TO USE https INSTEAD OF PLAIN OLD http

			events: [{
            title: 'Main Event',
            description: 'Something blah blah',
            url: 'http://www.mikesmithdev.com',
            start: moment().add(3, 'h'),
            end: moment().add(5, 'h'),
            color: '#ff0000',
            allDay: false
        }, {
            title: 'Event 2',
            start: moment().add(9, 'h'),
            end: moment().add(10, 'h'),
            description: 'Something Else blah blah',
            url: 'http://www.mikesmithdev.com'
        }, {
            title: 'Other Event',
            start: moment().add(6, 'h'),
            end: moment().add(8, 'h'),
            description: 'Something Else blah blah blah blah',
            url: 'http://www.mikesmithdev.com',
            color: '#00cc00',
            allDay: false
        }],
				
			eventClick: function(event, jsEvent, view) {
				$('#modalTitle').html(event.title);
				$('#modalBody').html(event.description);
				$('#eventUrl').attr('href',event.url);
				$('#fullCalModal').modal();
				return false;
			},
			
			/*eventMouseover: function(event, jsEvent, view) {
				$('#modalTitle').html(event.title);
				$('#modalBody').html(event.description);
				$('#eventUrl').attr('href',event.url);
				$('#fullCalModal').modal();
			},*/
			
			
			loading: function(bool) {
				if (bool) {
					$('#loading').show();
				}else{
					$('#loading').hide();
				}
			}
		});
		
	});

</script>