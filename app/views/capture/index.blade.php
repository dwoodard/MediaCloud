<script type="text/javascript" src="/js/helper.js"></script>
<!--<script type="text/javascript" src="/js/vendor/moment.min.js"></script>-->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js"></script>

<link rel="stylesheet" href="/js/vendor/jquery.countdown/jquery.countdown.css"/>
<script type="text/javascript" src="/js/vendor/jquery.countdown/jquery.countdown.js"></script>




<script type="text/javascript">
$(document).ready(function(){
    var device;
    var seconds = 0;
    var countdown = '';


    //Rooms
    $("#rooms").change(function () {
        if($(this).val() == "") $(this).addClass("empty");
        else $(this).removeClass("empty")
    });

    $("#rooms-record-now, #rooms-schedule-rec").change(function(e){
        console.log(e.currentTarget.id);

        $.ajax({
            type: "GET",
            url: BASE + '/capture/devices/'+$(this).val(),
            success: function(data){
                device = data = data[0];

                var drivers = JSON.parse(data.drivers);
                var $deviceTable = $('#'+e.currentTarget.id).closest('.tab-pane').find('#devices-table tbody');

                var html = '';
                $deviceTable.html(html); //reset table

                $.each(Object.keys(drivers),function(key,value){
                    var devices = drivers[value];

                    html += '<tr>\
                                <td> <input type="checkbox" checked> </td>\
                                <td>'+devices.alias+'</td>\
                            </tr>';
                });

                $deviceTable.append(html)

                //Show Preview
                $("#captureVideo").attr('src', 'http://'+device.ip_address+'/live/stream/combined');

            }
        });



    })

    //Set Seconds for Duration of Video
    $("#inputHours,#inputMinutes").change(function(){
        hoursToSec = $("#inputHours").val() * 60 * 60;
        minsToSec = $("#inputMinutes").val() * 60;
        seconds = hoursToSec + minsToSec;

        countdown = (new Date).clearTime()
            .addSeconds(seconds)
            .toString('HH:mm:ss');


        $('.countdown').text(countdown);
    })

    //Reset functions
    function refreshMonitor(delay){
        delay = typeof delay !== 'undefined' ? delay : 1000;
        alertify.log('Refeshing Monitor')
        setTimeout(function(){
            $("#captureVideo").attr('src', $("#captureVideo").attr('src'));
        }, delay);

    }
    function resetPreview(delay){
        delay = typeof delay !== 'undefined' ? delay : 1000;
        setTimeout(function(){
            $("#btn-preview-rec-now").text(' Preview').removeClass('btn-danger')
            refreshMonitor(3000)
            $('#btn-rec-now').removeAttr("disabled");
        }, delay)
    }
    function resetRecordNow(delay){
        delay = typeof delay !== 'undefined' ? delay : 1000;
        setTimeout(function(){
            $("#btn-rec-now").text(' Record Now').removeClass('btn-danger')
            refreshMonitor(3000)
            $('#btn-preview-rec-now').removeAttr("disabled");
        }, delay)
    }

    //Refresh Button
    $("#btn-refresh-rec-now").click(function(e){
        e.preventDefault();
        refreshMonitor();
    })


    //Preview
    $("#btn-preview-rec-now").click(function(e){
        e.preventDefault();
        if($("#btn-rec-now").hasClass('btn-danger')){
            alertify.error('Is recording can not preview')
            return;
        }

        // Make sure vars are there
        if($("#rooms-record-now").val() == ""){
            alertify.alert('Please select a room');
            return
        }

        //Is Preview/Stop Preview
        if(!$(this).hasClass('btn-danger')){ //Preview

            // Toggle Color and Text
            $(this).text(' Stop Preview').addClass('btn-danger')

            alertify.success('Preview Started')
            resetPreview(30000);

            $.ajax({
                type: "POST",
                url: 'http://'+device.ip_address,
                data: '{"action":"preview"}',
                dataType: "text",
                success: function(data){
                    data = JSON.parse(data);
                    console.log('Data: ',data.status, data.status == "success");

                    if(data.status == "success"){
                        refreshMonitor();
                    }

                    console.log("Preview: " + e.currentTarget.id);
                }
            });
        }
        else{ //Stop Preview
            console.log("Kill It!");

            $.ajax({
                type: "POST",
                url: 'http://'+device.ip_address,
                data: '{"action":"kill"}',
                dataType: "text",
                success: function(data){
                    data = JSON.parse(data);
                    alertify.success('Preview Stopped')
                    if(data.status == "success"){
                        // Set timer and countdown
                        resetPreview()
                    }
                }
            });
            refreshMonitor(5000);

        }

    })

    //Record Now
    $("#btn-rec-now").click(function(e){
        e.preventDefault();

        //Is preview going? if so don't record
        if($("#btn-preview-rec-now").hasClass('btn-danger')){
            alertify.error('Is currently in a preview. "Stop Preview" if you wish to record')
            return;
        }

        //Is Record Now/Stop Recording
        if(!$(this).hasClass('btn-danger')){ //Record Now

            if(seconds == 0){
                alertify.alert("Duration Must be longer than 0");
                return
            }

            if($("#rooms-record-now").val() == ""){
                alertify.alert('Please select a room');
                return
            }



            $(this).text(' Stop Recording').removeClass('btn-success').addClass('btn-danger');
            $('#btn-preview-rec-now').attr("disabled", "disabled");

            // Create Capture record
            $.ajax({
                type:"POST",
                url:BASE+"/capture",
                data:{
                    duration: seconds
                },
                success:function(data){
                    $data = JSON.parse(data);
                    //What is the captureId?

                    console.log($data,$data.captureId, $data.duration);
                    //After you Create capture job, send job to capture agent
                    $.ajax({
                        type: "POST",
                        url: 'http://'+device.ip_address,
                        data: '{"action": "record","duration": '+ seconds +',"captureId": '+$data.captureId+'}',
                        dataType: "text",
                        success: function(data){
                            data = JSON.parse(data);
                            console.log(data);


                            refreshMonitor(2000)
                            

                            if(data.status == "success"){

                                //delay the Timer to better match the Video
                                setTimeout(function(){
                                    $('.countdown').countdown({
                                        until: seconds,
                                        compact: true,
                                        description: '',
                                        expiryUrl:BASE+'/media/manager',
                                        significant: 3,
                                        format:'HMS',
                                        layout:'{hnn}{sep}{mnn}{sep}{snn}'
                                    });
                                }, 5000);

                                alertify.success('Recording Started')
//                                console.log(data.status);
                            }

                            $(this).removeClass('btn-success')
                            $(this).addClass('btn-danger')
                            $(this).text('Stop Recording')

                        }
                    })
                }
            })
        }
        else{ //Stop Recording

            $('.countdown').countdown('destroy').text(countdown)

            $(this).text(' Record Now').removeClass('btn-danger').addClass('btn-success');
            $('#btn-preview-rec-now').removeAttr("disabled");

            $
            $.ajax({
                type: "POST",
                url: 'http://'+device.ip_address,
                data: '{"action": "kill", "captureId": "'+$data.captureId+'"}',
                dataType: "text",
                success: function(data){
                    data = JSON.parse(data);
                    $(this).text(' Stop Recording').removeClass('btn-danger');

                    console.log('Recording Killed', data)





                    // Kill Capture record by id
                    $(this).removeClass('btn-danger').addClass('btn-success').text('Record Now')

                }

            })
            alertify.error('Recording Stopped')
            refreshMonitor(5000);
        }
    });

    //Help section
    $('#btn-help, #btn-help-close').click(function(){
        $('#helpContainer').toggle('fast');
    })


//    $("#btn-schedule-rec").click(function(e){
//        e.preventDefault();
//
//        alert("Schedule recording")
//    })




})
</script>

<style type="text/css">
    select option { color: black; }
    .empty { color: gray; }
</style>


<div class="container-fluid">
    <div class="container">
        <div id="helpContainer" class="well hide">
            <div>
                <button id="btn-help-close" class="btn pull-right"> Close</button>
            </div>
            <h4>What is Capture? How do I use it?</h4>
            <div style="height: 320px;width: 480px">
                Help video goes here
            </div>




        </div>

        <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#record-now" data-toggle="tab">Record Now</a></li>
<!--                    <li class=""><a href="#schedule-recording" data-toggle="tab">Schedule Recording</a></li>-->
                    <li class="pull-right"><a href="#" id="btn-help"><i class="icon-question-sign"></i> Help </a></li>
                </ul>
        <div id="myTabContent" class="tab-content">

        <div class="tab-pane fade active in" id="record-now">

            <div class="row" >
                <!--Left-->
                <div class="span3">
                    <h4>Duration of Video</h4>

                    <div class="row">
                        <div class="span1"><label for="inputHours">Hours</label> <input id="inputHours" type="number" class="input-mini"/></div>
                        <div class="span1"><label for="inputMinutes">Minutes</label> <input id="inputMinutes" type="number" class="input-mini"/></div>
                    </div>
                    <h4>Select Room</h4>
                    <select name="" id="rooms-record-now">
                        <option value="" selected="selected">Select Your Room</option>
                        @foreach ($capture_agents as $capture_agent)
                        <option value="{{ $capture_agent->id }}">{{ $capture_agent->room_name }}: {{$capture_agent->host_name}}</option>
                        @endforeach
                    </select>

<!--                    <h4>Available Devices</h4>-->
<!--                    <table id="devices-table" class="table table-bordered">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th scope="col">Record</th>-->
<!--                            <th scope="col">Devices</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!---->
<!--                        </tbody>-->
<!--                    </table>-->




                </div>

                <!--Right-->
                <div class="span8 offset1">
                       <div class="row" style="background: #f5f5f5;padding: 30px 0">
                           <div class="span8">
                               <div class="row">
                                   <div class="span3">
                                       <a id="btn-refresh-rec-now" href="" class="btn btn-mini pull-left"><i class="icon-refresh btn- "></i></a>
                                       <a id="btn-preview-rec-now" href="" class="btn btn-large pull-left"><i class="icon-facetime-video "></i> Preview</a>
                                   </div>
                                   <div class="span3"><h2><span class="countdown">00:00:00</span></h2></div>
                                   <div class="offset1 span2" style="margin-left: 0px;"><button id="btn-rec-now" type="button" class="btn-large btn-success"><i class="icon-facetime-video icon-white"></i> Record Now</button></div>
                               </div>
                           </div>
                           <br>
                           <div class="span8">
                               <div style="height: 400px; margin: 0 0 0 -30px;">
                                   <iframe id="captureVideo" src="" frameborder="0" width="100%" height="100%"></iframe>
                               </div>




                           </div>
                        </div>
                </div>

            </div>


        </div>
        <!-- End Tab-->

        <!--
      <div class="tab-pane fade" id="schedule-recording">

          <div class="row" >

              <div class="span3">

                  <h4>Select Your Class to record</h4>
                  <p>Selecting a class will record as a series</p>
                  <div class="row">
                      <div class="span12">
                          <select name="" id="">
                              {{-- @foreach  ($schedules as $schedule) --}}
                              <option value="">{{--$schedule->SUBJECT --}}:{{--$schedule->COURSE_NUMBER --}} - {{-- $schedule->SIRASGN_TERM_CODE --}}</option>
                              {{-- @endforeach --}}
                          </select>
                      </div>
                  </div>


                  <h4>Select Room</h4>
                  <select name="" id="rooms-schedule-rec">
                      <option value="" selected="selected">Select Your Room</option>
                      @foreach ($capture_agents as $capture_agent)
                      <option value="{{ $capture_agent->id }}">{{ $capture_agent->room_name }}: {{$capture_agent->host_name}}</option>
                      @endforeach
                  </select>
                  <h4>Available Devices</h4>

                  <table id="devices-table" class="table table-bordered">
                      <thead>
                      <tr>
                          <th scope="col">Record</th>
                          <th scope="col">Devices</th>
                      </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>

              </div>


              <div class="span8 offset1">
                  <div class="row" style="background: #f5f5f5;padding: 30px 0">

                      <div class="span8">
                          <div style="height: 400px; margin-bottom: 10px">

                          </div>
                          <button id="btn-schedule-rec" type="button" class="btn-large btn-success pull-right"><i class="icon-calendar icon-white"></i> Schedule Recording</button>
                          <a id="btn-preview-schedule" href="" class="btn btn-large">Preview</a>
                      </div>
                  </div>
              </div>

          </div>








      </div>
      -->
        </div>
    </div>
</div>
