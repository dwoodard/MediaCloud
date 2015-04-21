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
				<div id="event-calendar"></div>
			</div>

		</div>
	</div>
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
			background: #58ADC9;
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
		.addedEvent .fa.icon-remove-sign{
			z-index: 999;
			position: absolute;
			top: 3px;
			right: 3px;
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


	<script type="text/javascript">

		$(document).ready(function() {

			var calendar = $('#event-calendar');
			// Select Room
			$('#rooms li').on('click', function(e){
				$(e.currentTarget).parent().find('.active').removeClass('active')
				$(e.currentTarget).addClass('active')
				console.log($(e.currentTarget).data('ca-id'))


				calendar.fullCalendar({
					viewRender: function(view, element){
						titleFormat: [$('#rooms').find('.active .location').text()];
					}
				});

				// Load Calendar
				// Ajax Calender data
				// $.ajax({
				// 	url:url
				// })
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

			// $(".deleteEvent").live('click', function(e){
			// 	console.log("deleteEvent",e)
			// 	console.log( $( this ).text());
			// })


			calendar.fullCalendar({
				events: "/extron/events/1",
				header: {
					left: 'title',
					center: '',
					right: 'today,prev,next'
				},
				titleFormat: '[]',
				views: {
					agendaFourDay: {
						type: 'agenda',
						duration: { days: 4 },
						buttonText: '4 day'
					}
				},
				eventOverlap :false,
				defaultView: 'agendaWeek',
				defaultDate: moment().format(),
				selectable: true,
				selectHelper: true,
				select: function(start, end, jsEvent, view) {

					var title = prompt('Event Title:');
					var eventData;

					// console.log("select",start, end, jsEvent, view);
					// console.log("end select");

					if (title) {
						eventData = {
							title: title,
							start: start,
							end: end,
							editable: true,
							className: 'addedEvent',
							// rendering: 'inverse-background',
							backgroundColor: '#007100',
							start: start,
							start: start
						};
						calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
					}
					calendar.fullCalendar('unselect');
				},
				unselect:function(view, jsEvent ){
					// console.log('unselect',view,jsEvent);
				},
				editable: false,
				eventLimit: true, // allow "more" link when too many events
				eventClick: function(event, jsEvent, view ) {
					jsEvent.stopPropagation();
					console.log("eventClick", event, jsEvent);

					var start  = start.format("DD/MM/YYYY HH:mm:ss");
					var end = end.format("DD/MM/YYYY HH:mm:ss");

					var ms = moment(end,"DD/MM/YYYY HH:mm:ss").diff(moment(start,"DD/MM/YYYY HH:mm:ss"));
					var d = moment.duration(ms);
					var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm:ss");

					//if over an hour in milliseconds color red
					var color = d._milliseconds <= 3600000 ? '#007100' : '#FF3333';



					var deleteEvent = $(jsEvent.target).hasClass("deleteEvent") ? "deleteEvent" : null;


					if (deleteEvent) {
							console.log("deleteEvent action is a go");
					};
				},
				eventAfterAllRender: function(view) {
					console.log('eventAfterAllRender', view);
					$(".addedEvent").append( "<i class='deleteEvent fa icon-remove-sign'></i>" );
				}
});


});

</script>
@stop