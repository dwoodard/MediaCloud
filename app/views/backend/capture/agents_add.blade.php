@extends('admin._layouts.default')

@section('main')

<script type="text/javascript" src="/js/vendor/json3.min.js"></script>
<script type="text/javascript">
    var $data;
    $(document).ready(function(){
        $("#btnSync").click(function(e){
            e.preventDefault();
            console.log($("#inputIpAddress").val())

            var $url = $("#inputIpAddress").val();

            $.ajax({
                type: "POST",
                url: "http://"+$url,
                data: '{"action":"getInfo"}',
                success: function(data){
                    var data = JSON.parse(data);
//                       console.log(data)
                    $("#results").show();
                    $("#hostname").html(data.hostname);
                    $("#inputHostname").val(data.hostname);
                    $("#inputMAC").val(data.mac);
                    $("#inputVersion").val(data.version);

                    console.log(data.drivers);
                    $data = data;
                    for(item in data.drivers){
                        console.log(item);
                        $list = "<li>"+item+" <input data-driver='"+item+"' type='text'></li>"
                        $("#drivers").append($list);
                    }

                }

            });

        })


        $("#btn-submit").click(function(e){
            e.preventDefault();
            $inputs = $("#drivers").find("input");




            for(var i=0;i<$inputs.length;i++){
                $data.drivers[$inputs[i].dataset.driver].alias = $($inputs[i]).val();
                console.log($inputs[i].dataset.driver, $($inputs[i]).val());
                console.log('')


            }

            var drivers = $data.drivers;

            console.log(drivers, JSON.stringify(drivers));
            $("#inputDrivers").val(JSON.stringify(drivers));

            $(this).off('click').trigger('click');
        })
    })
</script>


<h1>Add Capture Agent </h1>

<div class="container">
    <hr>
    <div class="row">
        <div class="well span12">
            <p>If the Capture Agent is setup, Type in the IP address and try to Sync up the data.</p>
        </div>
    </div>


    <div class="row">
        {{ Form::open(array('url' => 'admin/capture/agents/add')) }}

        <div class="span3">
            <div class="control-group">
                <label class="control-label" for="inputRoomName">Room Name *</label>
                <div class="controls">
                    <input type="text" id="inputRoomName" name="inputRoomName" placeholder="Enter Room Name">
                    <span class="help-block">Enter a Helpful Name to Identify the Room the capture agent is in.</span>
                </div>
            </div>
        </div>
        <div class="span5">
            <div class="control-group">
                <label class="control-label" for="inputIpAddress">IP Address *</label>
                <div class="controls">
                    <input type="text" id="inputIpAddress" name="inputIpAddress" placeholder="Enter IP Address"> <button id="btnSync" class="btn btn-success"><i class="icon-refresh"></i> sync</button>
                </div>
            </div>
        </div>



    </div>

<hr>
    <div id="results" class="row hide" >
        <h3 id="hostname"></h3>

        <div class="span3">
            <div class="control-group">
                <label class="control-label" for="inputMAC"><abbr title="Media Access Control">MAC</abbr> Address</label>

                <div class="controls">
                    <input type="text" id="inputMAC"  name="inputMAC" placeholder="Enter MAC Address">
                    <span class="help-block">For Enter MAC Address for Redundancy Checks.</span>
                </div>
            </div>

        </div>

        <div class="span3">
            <div class="control-group">
                <label class="control-label" for="inputHostname">Hostname</label>
                <div class="controls">
                    <input type="text" id="inputHostname" name="inputHostname" placeholder="Enter Hostname">
                </div>
            </div>

        </div>

        <div class="span3">
            <div class="control-group">
                <label class="control-label" for="inputVersion">Version</label>
                <div class="controls">
                    <input type="text" id="inputVersion" name="inputVersion" placeholder="Enter Hostname">
                </div>
            </div>

        </div>

         <br>

        <div class="span12">
            <h3>Devices</h3>
            <input type="hidden" id="inputDrivers" name="inputDrivers">
            <div id="devices" class="span3">
                <ul id="drivers"></ul>
            </div>


        </div>

    </div>

</div>



<div class="row">
    <div class="control-group">
        <div class="controls">
            <button id="btn-submit" type="submit" class="btn btn-primary">Add Capture Agent</button>
        </div>
    </div>
</div>


{{ Form::close() }}

</div>
@stop