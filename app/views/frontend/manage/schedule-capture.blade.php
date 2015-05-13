@extends('frontend/layouts/manage')
@section('content')
	<div id="subnav-container" class="navbar navbar-default navbar-fixed-top">
		<div class="container subnav">
			<ul class="">
				<li>
					<a id="subnav-btn-back" href="/manage"> <i class="fa fa-arrow-circle-left"></i> Back</a>
				</li>
			</ul>
		</div>
	</div> {{--/ subnav--}}
	<div id="data" class="container content">
		<div class="row">
			<div id="rooms" class="col-xs-12 col-md-2 ">
				<h3>Rooms</h3>
				<ul>
					@foreach ($captureAgents as $ca)
						<li class="device" data-ca-id="{{$ca->id}}">
							<span class="location">{{$ca->location}}</span>
						</li>
					@endforeach
				</ul>
			</div>{{--rooms--}}
			<div id="event-calendar-container" class="col-xs-12 col-md-10">
				<div id='event-calendar' data-user-id="{{Sentry::getUser()->id}}"
				     data-has-admin="{{Sentry::getUser()->hasPermission('admin')}}"></div>
			</div>{{--event-calendar-container--}}
		</div> {{--row--}}
	</div>{{--data--}}
	<div id="edit-event" class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
								aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Event</h4>
				</div>{{--modal-header--}}
				<div class="modal-body">
					<div class="container-fluid">
						<form id="edit-form" class="form-horizontal" data-event-id="">
							<div class="form-group">
								<label for="input-title" class="col-sm-2 control-label">Title</label>

								<div class="col-sm-10">
									<input type="text" class="form-control" id="input-title" name="input-title"
									       placeholder="Title">
								</div>
							</div> {{--form-group--}}
							<div class="form-group">
								<label for="input-description" class="col-sm-2 control-label">Description</label>

								<div class="col-sm-10">
									<textarea class="form-control" id="input-description"></textarea>
								</div>{{--col-sm-10--}}
							</div> {{--form-group--}}
						</form>{{--edit-form--}}
					</div>{{--container-fluid--}}
				</div>{{--modal-body--}}
				<div class="modal-footer" class="text-left" style="text-align: inherit;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="edit-update-event" type="button" class="btn btn-primary">Save changes</button>
					<button id="edit-delete-event" type="button" class="btn btn-danger pull-right" data-dismiss="modal"
					        aria-label="Close"><i class="fa icon-trash"></i></button>
				</div> {{--modal-footer--}}
			</div>{{--modal-content--}}
		</div>{{--modal-dialog--}}
	</div>
@stop
@section('style')
	<link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
	<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>
	<link href="/bower/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css"/>
	<link href="/_frontend/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<style>
		.content {
			margin-top: 110px;
		}

		#rooms {
		}

		#rooms ul {
			margin: 0;
			padding: 0;
		}

		#rooms h3 {
			font-family: 'Open Sans', sans-serif;
			font-weight: 300 !important;
			font-size: 24px;
			margin-top: 20px;
			margin-bottom: 10px;
			line-height: 1.1;
		}

		#rooms ul li {
			height: 33px;
			list-style-type: none;
			border-bottom: 1px solid #eee;
			line-height: 30px;
			padding-left: 10px;
		}

		#rooms ul li.active {
			background: #428BCA;
			color: white
		}

		#rooms ul li:hover {
			background: #73BBD2;
		}

		#rooms ul li:last-of-type {
			border-bottom: none
		}

		#rooms ul li .location {
			margin-right: 10px
		}

		#rooms ul li .config {
			background: lightblue;
			float: right;
			height: 100%;
			text-align: center;
			width: 25px;
		}

		#rooms ul li .config:hover {
			background: rgb(106, 197, 226);
			color: white;
		}

		#data {

		}

		.addedEvent:hover {
			cursor: move;
		}

		.addedEvent .fa.icon-trash {
			z-index: 999;
			position: absolute;
			top: 3px;
			right: 3px;
			cursor: pointer;
		}

		.addedEvent .fa.icon-edit {
			z-index: 999;
			position: absolute;
			top: 3px;
			right: 17px;
			cursor: pointer;
		}

		#diolog {
			z-index: 999;
		}
	</style>

@stop
@section('scripts')
	<script src="/assets/js/manage.js"></script>
	<script src="/bower/moment/min/moment.min.js"></script>
	<script src="/bower/fullcalendar/dist/fullcalendar.js"></script>
	<script src="/bower/underscore/underscore.js"></script>

	<script>
		$(document).ready(function () {
			// Select Room
			$('#rooms').find('li').on('click', function (e) {
				$(e.currentTarget).parent().find('.active').removeClass('active');
				$(e.currentTarget).addClass('active');

				console.log("rooms li on click", $(e.currentTarget).data('ca-id'));

				room = $('#rooms').find('.active .location').text();

				var events = [];
				var ca_id = Number($(e.currentTarget).data('ca-id'));

				$.get('/extron/events/' + ca_id, function (data) {

					$(data).each(function () {

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
					console.log("data !!");
					console.log(events);

					calendar.fullCalendar('removeEvents');
					calendar.fullCalendar('refetchEvents');
					calendar.fullCalendar('addEventSource', events);

				});

			});
		});
	</script>

	<script src="/assets/js/capture-calendar.js"></script>


@stop

