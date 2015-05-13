@extends('backend/layouts/admin')

@section('content')


{{Breadcrumbs::render('editAsset')}}
<div class="page-header">
    <h1>Edit Asset
        <div class="pull-right">
            <a href="{{ route('assets') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
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


<form method="POST" action="{{url('admin/assets/'.$asset->id.'/edit')}}" class="form-horizontal" >
    {{Form::token()}}
    <div class="tab-content">
    <div class="tab-pane active" id="tab-general">
        <div class="form-body">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label col-md-3">Title</label>
                     <div class="col-md-9">
                        <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
                        {{ Form::text('title', $asset->title,  array('class' => 'form-control')) }}
                        <!-- <span class="help-block">Give your Asset a title</span> -->
                    </div>
                </div>
            </div>
            <!--/span-->
            <div class="col-md-6">
              <div class="form-group">
                 <label class="control-label col-md-3">Description</label>
                 <div class="col-md-9">
                     {{ Form::text('description', $asset->description,  array('class' => 'form-control')) }}
                     <!-- <span class="help-block">Describe your Asset</span> -->
                 </div>
             </div>
         </div>
         <!--/span-->
     </div>
     <!--/row-->
     <div class="row">
       <div class="col-md-6">
          <div class="form-group">
             <label class="control-label col-md-3">File path</label>
             <div class="col-md-9">
                <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
                {{ Form::text('filepath', $asset->filepath,  array('class' => 'form-control')) }}
                <!-- <span class="help-block">This is inline help</span> -->
            </div>
        </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
         <label class="control-label col-md-3">File name</label>
         <div class="col-md-9">
            <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
            {{ Form::text('filename', $asset->filename,  array('class' => 'form-control')) }}
            <!-- <span class="help-block">This is inline help</span> -->
        </div>
    </div>
</div>
</div>
<div class="row">
   <div class="col-md-6">
      <div class="form-group">
         <label class="control-label col-md-3">Transcoded URL</label>
         <div class="col-md-9">
            <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
            {{ Form::text('transcoded_url', $asset->transcoded_url,  array('class' => 'form-control')) }}
            <!-- <span class="help-block">This is inline help</span> -->
        </div>
    </div>
</div>
<div class="col-md-6">
  <div class="form-group">
     <label class="control-label col-md-3">Thumbnail URL</label>
     <div class="col-md-9">
        <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
        {{ Form::text('thumbnail_url', $asset->thumbnail_url,  array('class' => 'form-control')) }}
        <!-- <span class="help-block">This is inline help</span> -->
    </div>
</div>
</div>
</div>

<div class="row">
   <div class="col-md-6">
      <div class="form-group">
         <label class="control-label col-md-3">URL</label>
         <div class="col-md-9">
            <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
            {{ Form::text('url', $asset->url,  array('class' => 'form-control')) }}
            <!-- <span class="help-block">This is inline help</span> -->
        </div>
    </div>
</div>
<div class="col-md-6">
  <div class="form-group">
     <label class="control-label col-md-3">Type</label>
     <div class="col-md-9">
        <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
        {{ Form::text('type', $asset->type,  array('class' => 'form-control')) }}
        <!-- <span class="help-block">This is inline help</span> -->
    </div>
</div>
</div>
</div>
<div class="row">
   <div class="col-md-6">
      <div class="form-group">
         <label class="control-label col-md-3">Status</label>
         <div class="col-md-9">
            <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
            {{ Form::text('status', $asset->status,  array('class' => 'form-control')) }}
            <!-- <span class="help-block">This is inline help</span> -->
        </div>
    </div>
</div>
<div class="col-md-6">
  <div class="form-group">
     <label class="control-label col-md-3">Tags</label>
     <div class="col-md-9">
        <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
        {{ Form::text('tags', $asset->tags,  array('class' => 'form-control')) }}
        <!-- <span class="help-block">This is inline help</span> -->
    </div>
</div>
</div>
</div>

<div class="row">
   <div class="col-md-6">
      <div class="form-group">
         <label class="control-label col-md-3">Views</label>
         <div class="col-md-9 read-only">
            <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
            {{$asset->views}}
        </div>
    </div>
</div>
<div class="col-md-6">
  <div class="form-group">
     <label class="control-label col-md-3">Last Viewed</label>
     <div class="col-md-9 read-only">
      {{$asset->last_viewed}}
  </div>
</div>
</div>
</div>

<div class="row">
   <div class="col-md-6">
      <div class="form-group">
         <label class="control-label col-md-3">Created At</label>
         <div class="col-md-9 read-only">
            <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
            {{$asset->created_at}}
        </div>
    </div>
</div>
<div class="col-md-6">
  <div class="form-group">
     <label class="control-label col-md-3">Updated At</label>
     <div class="col-md-9 read-only">
        <!-- <input type="text" class="form-control" placeholder="Chee Kin"> -->
        {{$asset->updated_at}}
    </div>
</div>
</div>
</div>
</div>
</div>



        {{ Form::submit('Update', array('class' => 'btn btn-success')) }}


        {{ link_to_route('assets', 'Cancel') }}
    </div>


</div>
</form>




@stop
