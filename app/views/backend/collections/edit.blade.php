@extends('backend/layouts/admin')

@section('content')



<div class="page-header">    
    <h1>Edit Collection
        <div class="pull-right">
            <a href="{{ route('collections') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
        </div>
    </h1>
</div>


@if ($errors->any())
<ul>
  {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif

<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
    <li><a href="#tab-permissions" data-toggle="tab">Permissions</a></li>
</ul>


<form method="POST" action="{{url('admin/assets/'.$collection->id.'/edit')}}" class="form-horizontal" >
    {{Form::token()}}
    <div class="tab-content">
    <div class="tab-pane active" id="tab-general">
        <div class="form-body">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label col-md-3">Title</label>
                     <div class="col-md-9">
                        {{ Form::text('title', $collection->name,  array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6">
              <div class="form-group">
                 <label class="control-label col-md-3">Description</label>
                 <div class="col-md-9">
                     {{ Form::text('description', $collection->description,  array('class' => 'form-control')) }}
                 </div>
             </div>
         </div>
         <!--/span-->
     </div>
     <!--/row-->
<div class="row">
   <div class="col-md-6">
      <div class="form-group">
         <label class="control-label col-md-3">Created At</label>
         <div class="col-md-9 read-only">
            <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
            {{$collection->created_at}}
        </div>
    </div>
</div>
<div class="col-md-6">
  <div class="form-group">
     <label class="control-label col-md-3">Updated At</label>
     <div class="col-md-9 read-only">
        <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
        {{$collection->updated_at}}                       
    </div>
</div>
</div>
</div>
</div>
</div>



        {{ Form::submit('Update', array('class' => 'btn btn-success')) }}


        {{ link_to_route('collections', 'Cancel') }}
    </div>    


</div>
</form>




@stop
