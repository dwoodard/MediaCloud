@extends('backend/layouts/admin')
@section('content')
<div class="page-header">
	<h1>
		Create Collections

		<div class="pull-right">
			<a href="{{ route('assets') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h1>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <div class="lookUpUser">
                <label class="control-label col-md-3">Owner</label>
                <input id="owner" type="text" class="typeahead">
                <input id="userId" type="hidden">
                <button  class="btn-getUserInfo btn btn-success">Get Owner ID</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">

    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div id="uploads-area" class="hide">
            <form id="filedrop" method="post" action="/admin/assets/upload" class="dropzone" enctype="multipart/form-data">
                <div class="fallback">
                    <input name="files[]" type="file" multiple=""/>
                </div>
            </form>
		</div>
    </div>
</div>
@stop
