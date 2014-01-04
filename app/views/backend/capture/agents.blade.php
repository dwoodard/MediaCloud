@extends('admin._layouts.default')

@section('main')

<h1>Capture Agents</h1>

<a href="{{URL::route('admin.capture.agents.add')}}">Add Capture Agents</a>

@stop