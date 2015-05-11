var calendar;
var lastAddedEvent;
var currentEvent;
$(document).ready(function () {
    calendar = $('#event-calendar');
    calendar.fullCalendar({
        header: {
            left: 'title',
            center: '',
            right: 'today,prev,next'
        },
        allDaySlot: false,
        contentHeight: 500,
        lazyFetching: false,
        defaultDate: moment().format(),
        defaultTimedEventDuration: '00:30:00',
        defaultView: 'agendaWeek',
        editable: false,
        slotEventOverlap: true,
        eventOverlap: false,
        eventLimit: true, // allow "more" link when too many events
        fixedWeekCount: true,
        forceEventDuration: true,
        selectable: true,
        selectHelper: true,
        timezone: 'UTC',
        titleFormat: "[]",
        loading: function (isLoading, view) {
            console.log('loading', isLoading, view.el[0]);
            // $(el).parent().prepend('<div>Block Page</div>')
        },
        select: function (start, end, jsEvent, view) {

            if (!$(".device.active").length) {
                alert("Select A Room First");
                calendar.fullCalendar('unselect');
                return;
            }
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
                lastAddedEvent = calendar.fullCalendar('clientEvents')[calendar.fullCalendar('clientEvents').length - 1];
            }
            calendar.fullCalendar('unselect');
        },
        unselect: function (view, jsEvent) {

            console.log("unselect", lastAddedEvent);

            if (lastAddedEvent) {

                //Add last event to DB
                $.ajax({
                    url: '/v1/capture/event',
                    type: 'POST',
                    data: {
                        "ca_id": $(".device.active").data('ca-id'),
                        "user_id": $('#event-calendar').attr('data-user-id'),
                        "title": lastAddedEvent.title,
                        "location": $(".device.active .location").text(),
                        "start": lastAddedEvent.start.format("YYYY-MM-DD HH:mm:ss"),
                        "end": lastAddedEvent.end.format("YYYY-MM-DD HH:mm:ss")
                    },
                    dataType: 'json',
                    success: function (data) {
                        lastAddedEvent.id = data.id;
                        calendar.fullCalendar('updateEvent', lastAddedEvent);
                        lastAddedEvent = null
                    },
                    error: function (e) {
                        console.log(e.responseText);
                    }
                });

                console.log('unselect', lastAddedEvent._id);

            }
        },
        eventResize: function (event, delta, revertFunc, jsEvent, ui, view) {
            // console.log("eventResize")
            calendar.updateEvent(currentEvent);

        },
        eventResizeStart: function (event, jsEvent, ui, view) {
            // console.log("eventResizeStart");
            currentEvent = event;
        },
        eventResizeStop: function (event, jsEvent, ui, view) {
            // console.log("eventResizeStop");
        },
        eventDrop: function (event, delta, revertFunc, jsEvent, ui, view) {
            //Update event
            // console.log("eventDrop",event);
            currentEvent = event;
            calendar.updateEvent(currentEvent);
        },
        eventClick: function (event, jsEvent, view) {
            jsEvent.stopPropagation();

            // console.log("eventClick", event, jsEvent);

            var deleteEvent = $(jsEvent.target).hasClass("deleteEvent") ? "deleteEvent" : null;
            var editEvent = $(jsEvent.target).hasClass("editEvent") ? "editEvent" : null;

            if (deleteEvent) {

                var con = confirm('Are you Sure?');
                if (con == true) {
                    console.log("deleteEvent action is a go", event._id);

                    //Delete from DB
                    calendar.deleteEvent(event.id);
                    //remove Event from fullcal
                    calendar.fullCalendar('removeEvents', event.id);
                }
            }
            if (editEvent) {
                currentEvent = event;
                console.log('editEvent', jsEvent.target);

                $('#edit-form').attr('data-event-id', event.id);

                // populate data in inputs
                $('#edit-event')
                    .find('#input-title').val(currentEvent.title).end()
                    .find('#input-description').val(currentEvent.description).end();

                // Show View to Edit
                $('#edit-event').modal('show');

            }
        },
        eventAfterAllRender: function (view) {
            console.log('eventAfterAllRender', view);
            $(".addedEvent").append("<i class='editEvent fa icon-edit'></i> <i class='deleteEvent fa icon-trash'></i>");
        },
        eventRender: function (event, element) {
            if (event.user_id == calendar.data('user-id') || calendar.data('has-admin')) {
                console.log("eventRender", event);
                event.editable = true;
                event.className.push('addedEvent', 'myEvent');
                event.backgroundColor = '#007100';
                $('#calendar').fullCalendar('updateEvent', event);
                element.addClass('addedEvent').append("<i class='editEvent fa icon-edit'></i> <i class='deleteEvent fa icon-trash'></i>");
            }
        }
    });
    calendar.deleteEvent = function (id) {
        $.ajax({
            type: 'POST',
            url: '/v1/capture/event/' + id,
            data: {
                "id": id,
                _method: 'DELETE'
            },
            dataType: 'json',
            success: function (data) {
                calendar.fullCalendar('updateEvent', lastAddedEvent);
                lastAddedEvent = null
            },
            error: function (e) {
                console.log(e.responseText);
            }
        });
    };
    calendar.updateEvent = function (currentEvent) {
        $.ajax({
            type: 'POST',
            url: '/v1/capture/event/' + currentEvent.id,
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
            success: function (data) {
                calendar.fullCalendar('updateEvent', currentEvent);
            },
            error: function (e) {
                console.log(e.responseText);
            }
        });
    };
    $("#edit-update-event").click(function () {


        currentEvent.title = $("#input-title").val();
        currentEvent.description = $("#input-description").val();

        //Update event
        console.log(currentEvent);
        calendar.updateEvent(currentEvent);

        calendar.fullCalendar('updateEvent', currentEvent);

        $('#edit-event').modal('hide');
    })
});