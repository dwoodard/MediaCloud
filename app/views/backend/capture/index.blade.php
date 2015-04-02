@extends('backend/layouts/admin')

@section('content')

{{Breadcrumbs::render('capture')}}


<h1>Capture Agents (Extron)</h1>


<!-- $capture_agents -->
<!-- URL::route('admin.capture.agents.add') -->


<a href="#addCapture" class="btn btn-primary" data-toggle="collapse" data-parent="#addCapture" >
    <i class="fa fa-plus"></i>
    Add Capture Agents</a>

    <div class="collapse" id="addCapture">
        <div class="well">
            <form class="form-horizontal">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3>Add Capture Agent</h3>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="captureName" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="captureIp" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="captureIp" name="captureIp" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Add Capture Agent</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <div id="data" class="conatiner">
        <div class="row">

            <div id="rooms" class="col-xs-12 col-lg-4 ">
                <ul>
                    <li class="device">
                        <span>Room Name</span>
                        <span>Config</span>
                        <span></span>
                    </li>
                </ul>
            </div>

            <div class="col-md-8">
                <div id="calendar"></div>
            </div>

        </div>
    </div>
    @stop





    @section('css')
    <link href="/bower/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css"/>

    <style>
        #data{
            margin-top: 70px;
        }
    </style>
    @stop

    @section('scripts')
    <script src="/assets/js/manage.js"></script>
    <script src="/bower/moment/min/moment.min.js"></script>
    <script src="/bower/fullcalendar/dist/fullcalendar.js"></script>


    <script type="text/javascript">

        $(document).ready(function() {

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: [
                {
                    title  : 'event1',
                    start  : moment().hour(12.8),
                    end    : moment().hour(13.8)
                },
                {
                    title  : 'event2',
                    start  : moment().hour(9),
                    end    : moment().hour(12)
                },
                {
                    title  : 'event3',
                    start  : moment().hour(14),
                    allDay : false // will make the time show
                }
                ],



                businessHours:true,
            start: '8:00', // a start time (10am in this example)
            end: '18:00', // an end time (6pm in this example)
            defaultView: 'agendaWeek',
            editable: true,
            slotEventOverlap: true,
            fixedWeekCount: true,
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                var title = prompt('Event Title:');
                var eventData;
                if (title) {
                    eventData = {
                        title: title,
                        start: start,
                        end: end
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                }
                $('#calendar').fullCalendar('unselect');
            },

            unselectAuto:true,
            selectOverlap: function(event) {
                return event.rendering === 'background';
            },
            dayClick: function(e) {
                console.log(e);
            }
        });



});

</script>
@stop