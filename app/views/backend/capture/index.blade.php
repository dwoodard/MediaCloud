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
        }
        #rooms ul li.active{
            background: #e1e1e1;
        }
        #rooms ul li:hover{
            background: #fafafa;
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
    </style>
    @stop

    @section('scripts')
    <script src="/assets/js/manage.js"></script>
    <script src="/bower/moment/min/moment.min.js"></script>
    <script src="/bower/fullcalendar/dist/fullcalendar.js"></script>


    <script type="text/javascript">

        $(document).ready(function() {

            // Select Room
            $('#rooms li').click(function(e){

                console.log($(e.currentTarget).data('ca-id'))

                // Load Calendar
                // Ajax Calender data
            })



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




$('#event-calendar').fullCalendar({
    header: {
        left: 'prev,next',
        center: 'title',
        right: 'today, month,agendaWeek'
    },
    minTime: "6:00:00",
    maxTime: "20:00:00",
    views: {
        agendaFourDay: {
            type: 'agenda',
            duration: { days: 4 },
            buttonText: '4 day'
        }
    },
    defaultView: 'agendaWeek',

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
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    events: [{
        title: 'All Day Event',
        start: '2015-04-10',

    }]
});


});

</script>
@stop