@extends('backend/layouts/admin')

@section('content')

{{Breadcrumbs::render('capture')}}


<h1>Capture Agents (Extron)</h1>


<!-- $capture_agents -->
<!-- URL::route('admin.capture.agents.add') -->

<div class="col-xs-12">
	<a id="btnAddCapture" href="#addCapture" class="btn btn-primary" data-toggle="collapse" data-parent="#addCapture" >
		<i class="fa fa-plus"></i>
		Add Capture Agents</a>

		<div class="collapse" id="addCapture">
			<div class="well">
				<form id="form-add-capture-agent" class="form-horizontal" method="POST" action="{{URL::route('capture.addCaptureAgent')}}">
					<div class="col-sm-11 col-sm-offset-1">
						<h3>Add Capture Agent</h3>
					</div>
					<div class="form-group">
						<label for="captureIP" class="col-sm-2 control-label">IP Address</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="captureIP" name="captureIP" placeholder="0.0.0.0"
							pattern="^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$" required>
						</div>
					</div>
					<div class="form-group">
						<label for="captureLocation" class="col-sm-2 control-label">Location</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="captureLocation" name="captureLocation" placeholder="LP-203"
							required>
							<span>Name the location after the room</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button id="submit-capture-agent-btn" type="submit" class="btn btn-default">Add Capture Agent</button>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>


	<div id="data" class="conatiner">
		<div class="row">

			<div id="rooms" class="col-xs-12 col-md-2 ">
				<h3>Rooms</h3>
				<ul>
					@foreach ($captureAgents as $ca)
					<li class="device" data-ca-id="{{$ca->id}}">
						<span class="location">{{$ca->location}}</span>
						<a class="config" target="_blank" href="http://{{$ca->ip}}/www"> <i class="fa fa-cog"></i> </a>
						<span></span>
					</li>
					@endforeach
				</ul>
			</div>

			<div id="event-calendar-container" class="col-xs-12 col-md-10">
				<div id="event-calendar" data-user-id="{{Sentry::getUser()->id}}"></div>
			</div>

		</div>
	</div>







	<div id="edit-event" class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Event</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">

						<form id="edit-form" class="form-horizontal" data-event-id="">
							<div class="form-group">
								<label for="input-title" class="col-sm-2 control-label">Title</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="input-title" name="input-title" placeholder="Title">
								</div>
							</div>
							<div class="form-group">
								<label for="input-description" class="col-sm-2 control-label">Description</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="input-description"></textarea>
								</div>
							</div>
						</form>



					</div>
				</div>
				<div class="modal-footer" class="text-left" style="  text-align: inherit;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="edit-update-event" type="button" class="btn btn-primary">Save changes</button>
					<button id="edit-delete-event" type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close"><i class="fa icon-trash"></i></button>
				</div>

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->










@stop





@section('css')
<link href="/bower/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css"/>

<style>
	#rooms{}
	#rooms ul{
		margin: 0;
		padding:0;
	}

	#rooms ul li{
		height: 33px;
		list-style-type: none;
		border-bottom: 1px solid #eee;
		line-height: 30px;
		padding-left: 10px;
	}
	#rooms ul li.active{
		background: #428BCA;
		color: white
	}
	#rooms ul li:hover{
		background: #73BBD2;
	}
	#rooms ul li:last-of-type{
		border-bottom: none
	}
	#rooms ul li .location{
		margin-right: 10px
	}
	#rooms ul li .config{
		background: lightblue;
		float: right;
		height: 100%;
		text-align: center;
		width:25px;
	}
	#rooms ul li .config:hover{
		background: rgb(106, 197, 226);
		color:white;
	}

	#data{
		margin-top: 20px;
	}
	.addedEvent:hover{
		cursor: move;
	}
	.addedEvent .fa.icon-trash{
		z-index: 999;
		position: absolute;
		top: 3px;
		right: 3px;
		cursor: pointer;
	}
	.addedEvent .fa.icon-edit{
		z-index: 999;
		position: absolute;
		top: 3px;
		right: 17px;
		cursor: pointer;
	}
	#dialog{
		z-index: 999;

	}
</style>
@stop

@section('scripts')
<script src="/assets/js/manage.js"></script>
<script src="/bower/moment/min/moment.min.js"></script>
<script src="/bower/fullcalendar/dist/fullcalendar.js"></script>
<script src="/bower/underscore/underscore.js"></script>


<script type="text/javascript">
	var calendar;
	var lastAddedEvent;
	var currentEvent;

	$(document).ready(function() {

		calendar = $('#event-calendar');
			// Select Room
			$('#rooms li').on('click', function(e){
				$(e.currentTarget).parent().find('.active').removeClass('active')
				$(e.currentTarget).addClass('active')

				console.log("rooms li on click",$(e.currentTarget).data('ca-id'))

				room = $('#rooms').find('.active .location').text();

				var events = [];
				var ca_id = Number($(e.currentTarget).data('ca-id'));

				$.get('/extron/events/'+ca_id, function(data) {

					$(data).each(function() {

						events.push({
							id: Number($(this).attr('id')),
							ca_id: ca_id,
							user_id: $(this).attr('user_id'),
							title: $(this).attr('title'),
							location: $(this).attr('location').replace(/\s{2,}/ig, ""),
							start: $(this).attr('start'),
							end: $(this).attr('end'),
							description: $(this).attr('description')
						});

					});


					calendar.fullCalendar('removeEvents');
					calendar.fullCalendar('refetchEvents');
					calendar.fullCalendar('addEventSource', events)

				});

			});

			// Submit Form
			$('#form-add-capture-agent').submit(function(e) {
				e.preventDefault();

				var ip = $("#captureIP").val(),
				location = $("#captureLocation").val(),
				form = $("#form-add-capture-agent"),
				url = form.attr('action'),
				method = form.attr('method')
				console.log(ip, location, form, url, method);

				$.ajax({
					method: method,
					url: url,
					data: {
						ip: ip,
						location: location
					}
				})
				.success(function(data) {
					data = $.parseJSON(data);

					var newCA = '<li class="device" data-ca-id="' + data.id + '">'
					newCA += '<span class="location">' + data.location + '</span>'
					newCA += '<a class="config" target="_blank" href="' + data.ip + '/www"> <i class="fa fa-cog"></i> </a>'
					newCA += '</li>';

					$('#btnAddCapture').trigger('click')
					$("#rooms ul").append(newCA);
				});
			});


			calendar.fullCalendar({
				header: {
					left: 'title',
					center: '',
					right: 'today,prev,next'
				},
				allDaySlot: false,
				contentHeight: 600,
				lazyFetching: false,
				defaultDate: moment().format(),
				defaultTimedEventDuration: '00:30:00',
				defaultView: 'agendaWeek',
				editable: false,
				eventLimit: true, // allow "more" link when too many events
				eventOverlap :false,
				forceEventDuration: true,
				selectable: true,
				selectHelper: true,
				timezone: 'UTC',
				titleFormat: "[]",
				loading: function(isLoading, view){
					console.log('loading', isLoading, view.el[0]);
					// $(el).parent().prepend('<div>Block Page</div>')
				},
				select: function(start, end, jsEvent, view) {

					if (!$(".device.active").length) {
						alert("Select A Room First");
						calendar.fullCalendar('unselect');
						return;
					};

					console.log("select", start, end, jsEvent, view);

					var title = prompt('Event Title:');
					var eventData;

					if (title) {
						eventData = {
							title: title,
							start: start,
							end: end,
							editable: true,
							className: ['addedEvent'],
							backgroundColor: '#007100'
						};

						calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
						lastAddedEvent = calendar.fullCalendar('clientEvents')[calendar.fullCalendar('clientEvents').length-1];
					}
					calendar.fullCalendar('unselect');
				},
				unselect:function(view, jsEvent){

					console.log("unselect", lastAddedEvent);

					if (lastAddedEvent) {

						//Add last event to DB
						$.ajax({
							url: '/capture/event',
							type: 'POST',
							data: {
								"ca_id": $(".device.active").data('ca-id'),
								"user_id": calendar.data('user-id'),
								"title": lastAddedEvent.title,
								"location": $(".device.active .location").text(),
								"start": lastAddedEvent.start.format("YYYY-MM-DD HH:mm:ss"),
								"end": lastAddedEvent.end.format("YYYY-MM-DD HH:mm:ss")
							},
							dataType: 'json',
							success: function(data){
								lastAddedEvent.id = data.id;
								$('#calendar').fullCalendar('updateEvent',lastAddedEvent);
								lastAddedEvent = null
							},
							error: function(e){
								console.log(e.responseText);
							}
						});

						console.log('unselect',lastAddedEvent._id);

					};

				},
				eventResize:function(event, delta, revertFunc, jsEvent, ui, view){
					// console.log("eventResize")
					calendar.updateEvent(currentEvent);

				},
				eventResizeStop:function( event, jsEvent, ui, view ) {
					// console.log("eventResizeStop");
				},
				eventResizeStart:function( event, jsEvent, ui, view ) {
					// console.log("eventResizeStart");
					currentEvent = event;
				},
				eventDrop:function( event, delta, revertFunc, jsEvent, ui, view ) {
					//Update event
					// console.log("eventDrop",event);
					currentEvent = event;
					calendar.updateEvent(currentEvent);

				},

				// eventAfterRender: function(event, element){
				// 	console.log("eventAfterRender", event);
				// },
				// eventDestroy: function(event, element, view){
				// 	console.log("eventDestroy", event, element, view);
				// },
				eventClick: function(event, jsEvent, view ) {
					jsEvent.stopPropagation();

					// console.log("eventClick", event, jsEvent);

					var deleteEvent = $(jsEvent.target).hasClass("deleteEvent") ? "deleteEvent" : null;
					var editEvent = $(jsEvent.target).hasClass("editEvent") ? "editEvent" : null;

					if (deleteEvent) {

						var con  = confirm('Are you Sure?');
						if (con == true) {
							console.log("deleteEvent action is a go", event._id);

							//Delete from DB
							calendar.deleteEvent(event.id)

							//remove Event from fullcal
							calendar.fullCalendar('removeEvents', event.id);
						};
					};

					if (editEvent) {
						currentEvent = event;
						console.log('editEvent', jsEvent.target)

						$('#edit-form').attr('data-event-id', event.id)

						// populate data in inputs
						$('#edit-event')
						.find('#input-title').val(currentEvent.title).end()
						.find('#input-description').val(currentEvent.description).end()

						// Show View to Edit
						$('#edit-event').modal('show');

					};

				},
				eventAfterAllRender: function(view) {
					// console.log('eventAfterAllRender', view);
					$(".addedEvent").append("<i class='editEvent fa icon-edit'></i> <i class='deleteEvent fa icon-trash'></i>");
				},
				eventRender: function(event, element){
					console.log("eventRender", event)


					if(event.user_id == calendar.data('user-id')){

						event.editable = true;
						event.className.push('addedEvent', 'myEvent');
						event.backgroundColor = '#007100';

						$('#calendar').fullCalendar('updateEvent', event);

						element.addClass('addedEvent').append("<i class='editEvent fa icon-edit'></i> <i class='deleteEvent fa icon-trash'></i>");
					}


				}
			});

calendar.deleteEvent = function(id){
	$.ajax({
		type: 'POST',
		url: '/capture/event/'+ id,
		data: {
			"id": id,
			_method: 'DELETE'
		},
		dataType: 'json',
		success: function(data){
			$('#calendar').fullCalendar('updateEvent',lastAddedEvent);
			lastAddedEvent = null
		},
		error: function(e){
			console.log(e.responseText);
		}
	});
}


calendar.updateEvent = function(currentEvent){
	$.ajax({
		type: 'POST',
		url: '/capture/event/'+ currentEvent.id,
		data: {
			"user_id": currentEvent.user_id,
			"ca_id": $(".device.active").data('ca-id'),
			"title": currentEvent.title,
			"location": $(".device.active .location").text(),
			"start": currentEvent.start.format("YYYY-MM-DD HH:mm:ss"),
			"end": currentEvent.end.format("YYYY-MM-DD HH:mm:ss"),
			"description": currentEvent.description,
			_method: 'PUT'
		},
		dataType: 'json',
		success: function(data){
			$('#calendar').fullCalendar('updateEvent', currentEvent);
		},
		error: function(e){
			console.log(e.responseText);
		}
	});
}


$("#edit-update-event").click(function(){


	currentEvent.title = $("#input-title").val();
	currentEvent.description = $("#input-description").val();

	//Update event
	console.log(currentEvent);
	calendar.updateEvent(currentEvent);

	calendar.fullCalendar('updateEvent',currentEvent);

	$('#edit-event').modal('hide');
})

});

</script>
@stop