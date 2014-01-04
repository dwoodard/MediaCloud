@extends('admin._layouts.default')

@section('main')

<h1>Capture</h1>


<h2>List all capture devices</h2> <a href="{{URL::route('admin.capture.agents.add')}}">Add Capture Agents</a>


<table summary="" class="table table-striped" id="">
    <tbody>
    @foreach ($capture_agents as $capture_agent)
    <tr>
        <td>{{ $capture_agent->room_name }}</td>
        <td>{{$capture_agent->ip_address}}</td>
        <td>{{$capture_agent->mac_address}}</td>
        <td>{{$capture_agent->host_name}}</td>
        <td> <button class="btn btn-primary">Edit</button> <button class="btn btn-danger">Delete</button></td>

    </tr>
    @endforeach

    </tbody>
</table>





@stop