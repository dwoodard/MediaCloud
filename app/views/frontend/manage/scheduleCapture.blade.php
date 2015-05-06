@extends('frontend/layouts/manage')


@section('content')

<!-- subnav -->
<div id="subnav-container" class="navbar navbar-default navbar-fixed-top">
    <div class="container subnav">

        <ul class="nav nav-pills pull-left">
            <li>
                <a id="subnav-btn-back" href="/manage"> <i class="fa fa-arrow-circle-left"></i> Back</a>
            </li>
        </ul>
    </div>
</div>
<!-- / subnav -->

<div id="data" class="container content">
    <div class="row">
        <div id="rooms" class="col-xs-12 col-md-2 ">
                    <h3>Rooms</h3>
                    <ul>
                        @foreach ($captureAgents as $ca)
                        <li class="device" data-ca-id="{{$ca->id}}">
                            <span class="location">{{$ca->location}}</span>
                            <!--<a class="config" target="_blank" href="http://{{$ca->ip}}/www"> </a>-->
                            <span></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
        <div id="event-calendar-container" class="col-xs-12 col-md-10">
            <div id='event-calendar' data-user-id="{{Sentry::getUser()->id}}"></div><!--  data-user-id="{{Sentry::getUser()->id}}" -->
        </div>
    </div>
</div>

@stop





@section('style')
<link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>
<!--<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.7.1/css/dropzone.css" rel="stylesheet" type="text/css"/>-->
<!--<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.7.1/css/basic.css" rel="stylesheet" type="text/css"/>-->

<!--<link href="/bower/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css"/>-->
<!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.10/alertify.core.css">-->
<!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/alertify.js/0.3.10/alertify.default.css">-->
<!--<link href="/bower/dynatable/jquery.dynatable.css" rel="stylesheet" type="text/css"/>-->
<link href="/bower/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css"/>

<style>
    .content{
        margin-top: 110px;
    }
    #rooms{}
    #rooms ul{
        margin: 0;
        padding:0;
    }

    #rooms h3{
        font-family: 'Open Sans', sans-serif;
        font-weight: 300 !important;
        font-size: 24px;
        margin-top: 20px;
        margin-bottom: 10px;
        line-height: 1.1;
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
                    console.log("data !!");
                    console.log(events);

                    calendar.fullCalendar('removeEvents');
                    calendar.fullCalendar('refetchEvents');
                    calendar.fullCalendar('addEventSource', events);

                });

            });

        $('#event-calendar').fullCalendar({
            header: {
                    left: 'title',
                    center: '',
                    right: 'today,prev,next'
                },
            

            //businessHours:true,
            //start: '8:00', // a start time (10am in this example)
            //end: '18:00', // an end time (6pm in this example)

            allDaySlot: false,
            contentHeight: 600,
            defaultView: 'agendaWeek',
            defaultDate: moment().format(),
            defaultTimedEventDuration: '00:30:00',
            editable: false,
            lazyFetching: false,
            slotEventOverlap: true,
            eventOverlap :false,
            fixedWeekCount: true,
            forceEventDuration: true,
            selectable: true,
            selectHelper: true,
            timezone: 'UTC',
            titleFormat: "[]",
            loading: function(isLoading, view){
                    console.log('loading', isLoading, view.el[0]);
                    // $(el).parent().prepend('<div>Block Page</div>')
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
            select: function(start, end) {

                    if (!$(".device.active").length) {
                        alert("Select A Room First");
                        calendar.fullCalendar('unselect');
                        return;
                    };

                   // console.log("select", start, end, jsEvent, view);

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
                /*
                var title = prompt('Event Title:');
                var eventData;
                if (title) {
                    eventData = {
                        title: title,
                        start: start,
                        end: end
                    };
                    $('#event-calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                }
                $('#event-calendar').fullCalendar('unselect');
                */
            },
            eventAfterAllRender: function(view) {
                     //console.log('eventAfterAllRender', view);
                    $(".addedEvent").append("<i class='editEvent fa icon-edit'></i> <i class='deleteEvent fa icon-trash'></i>");
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
            selectOverlap: function(event) {
                return event.rendering === 'background';
            },
            eventRender: function(event, element){
                    
                    
                    if(event.user_id == calendar.data('user-id')){
                        console.log("eventRender", event);
                        
                        event.editable = true;
                        event.className.push('addedEvent', 'myEvent');
                        event.backgroundColor = '#007100';
                        element.addClass('addedEvent').append("<i class='editEvent fa icon-edit'></i> <i class='deleteEvent fa icon-trash'></i>");
                        /*
                        $('#event-calendar').fullCalendar('updateEvent', event);

                        
                        */
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
            $('#event-calendar').fullCalendar('updateEvent',lastAddedEvent);
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
            $('#event-calendar').fullCalendar('updateEvent', currentEvent);
        },
        error: function(e){
            console.log(e.responseText);
        }
    });
}

    });


</script>
@stop

