@extends('backend/layouts/admin')
@section('content')
	{{--	{{Breadcrumbs::render('capture')}}--}}


	<div class="col-xs-12">
		{{--<h1>Capture Agents (Extron)</h1>--}}
		<a id="btnAddCapture" href="#addCapture" class="btn btn-primary" data-toggle="collapse"
		   data-parent="#addCapture">
			<i class="fa fa-plus"></i>
			Add Capture Agents</a>


		<div class="collapse" id="addCapture">
			<div class="well">
				<form id="form-add-capture-agent" class="form-horizontal" method="POST"
				      action="{{URL::route('capture.addCaptureAgent')}}">
					<div class="col-sm-11 col-sm-offset-1">
						<h3>Add Capture Agent</h3>
					</div>
					<div class="form-group">
						<label for="captureIP" class="col-sm-2 control-label">IP Address</label>

						<div class="col-sm-3">
							<input type="text" class="form-control" id="captureIP" name="captureIP"
							       placeholder="0.0.0.0"
							       pattern="^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$" required>
						</div>
					</div>
					<div class="form-group">
						<label for="captureLocation" class="col-sm-2 control-label">Location</label>

						<div class="col-sm-3">
							<input type="text" class="form-control" id="captureLocation" name="captureLocation"
							       placeholder="LP-203"
							       required>
							<span>Name the location after the room</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button id="submit-capture-agent-btn" type="submit" class="btn btn-default">Add Capture
								Agent
							</button>
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
							<a class="config" target="_blank" href="http://{{$ca->ip}}/www"> <i class="fa fa-cog"></i>
							</a>
							<span></span>
						</li>
					@endforeach
				</ul>
				<h3>Impersonate</h3>
				<div class="lookUpUser">
					<label for="owner">User: </label>
					<label for="owner" id="userId"></label>
					<input id="owner" type="text" class="typeahead">
				</div>
			</div>

			<div id="event-calendar-container" class="col-xs-12 col-md-10">
				<div id='event-calendar' data-user-id="{{Sentry::getUser()->id}}"
				     data-has-admin="{{Sentry::getUser()->hasPermission('admin')}}"></div>
			</div>

		</div>
	</div>
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
				<div class="modal-footer" class="text-left" style="  text-align: inherit;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="edit-update-event" type="button" class="btn btn-primary">Save changes</button>
					<button id="edit-delete-event" type="button" class="btn btn-danger pull-right" data-dismiss="modal"
					        aria-label="Close"><i class="fa icon-trash"></i></button>
				</div> {{--modal-footer--}}
			</div>
			{{--modal-content--}}<!-- /.modal-content -->
		</div>{{--modal-dialog--}}
	</div>
@stop
@section('css')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
	<link href="/bower/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css"/>
	<style>
		#rooms {
		}

		#rooms ul {
			margin: 0;
			padding: 0;
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
			margin-top: 20px;
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

	<script src="/assets/js/capture-calendar.js"></script>

	<script>
		$(document).ready(function () {
			Manage.userId = {{Sentry::getUser()->id}};
			// Submit Form
			$('#form-add-capture-agent').submit(function (e) {
				e.preventDefault();
				var ip = $("#captureIP").val(),
						location = $("#captureLocation").val(),
						form = $("#form-add-capture-agent"),
						url = form.attr('action'),
						method = form.attr('method');
				console.log(ip, location, form, url, method);

				$.ajax({
					method: method,
					url: url,
					data: {
						ip: ip,
						location: location
					}
				})
						.success(function (data) {
							data = $.parseJSON(data);

							var newCA = '<li class="device" data-ca-id="' + data.id + '">';
							newCA += '<span class="location">' + data.location + '</span>';
							newCA += '<a class="config" target="_blank" href="' + data.ip + '/www"> <i class="fa fa-cog"></i> </a>';
							newCA += '</li>';

							$('#btnAddCapture').trigger('click');
							$("#rooms ul").append(newCA);
						});
			});
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


					calendar.fullCalendar('removeEvents');
					calendar.fullCalendar('refetchEvents');
					calendar.fullCalendar('addEventSource', events)

				});

			});

			$('.typeahead').autocomplete({
				source: function (request, response) {
					$.ajax({
						url: "/v1/users",
						data: {search: request.term, fields: 'username,id'},
						dataType: "json",
						success: function (data) {
							response($.map(data, function (item) {
								return {
									id: item.id,
									username: item.username,
									label: item.id + ": " + item.username,
									value: item.username
								}
							}));
						}
					});
				},
				select: function (event, ui) {
					console.log(event, ui);
					$("#userId").text(ui.item.id);
					$('#event-calendar').attr('data-user-id', ui.item.id)
				}
			});

			function updateUserId(){
				if($("#owner").val().length == 0){
					console.log
					$("#userId").text(Manage.userId);
					$('#event-calendar').attr('data-user-id', Manage.userId)
				}else{
//					$("#userId").text();
//					$('#event-calendar').attr('data-user-id', Manage.userId)
				}
			}

			$('#owner')
					.keypress(function (e) {
						var code = e.keyCode || e.which;
						if (code == 13) { //Enter keycode
							e.preventDefault();
							updateUserId();
						}
					})
					.on('focus, blur', function (e, i) {
						console.log(e, this, $(this));
						updateUserId();

					})
		});
	</script>


@stop