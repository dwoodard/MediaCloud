@extends('backend/layouts/admin')

@section('content')
{{Breadcrumbs::render('queue')}}





<iframe src="/beanstalkd/public/index.php" frameborder="0" width="100%" height="700px"></iframe>



@stop