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

<div class="container content">

    <div class="col-md-4">
        Rooms
    </div>
    <div class="col-md-8">
        <div id='calendar'></div>
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

