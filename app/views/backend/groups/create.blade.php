@extends('backend/layouts/admin')

{{-- Web site Title --}}
@section('title')
Create a Group ::
@parent
@stop






{{-- Content --}}
@section('content')

{{Breadcrumbs::render('createGroups')}}


<div class="page-header">
	<h3>
		Create a New Group

		<div class="pull-right">
			<a href="{{ route('groups') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h3>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	<li><a href="#tab-permissions" data-toggle="tab">Permissions</a></li>
</ul>

<form class="form-horizontal" method="POST" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<div class="row">
				
				<!-- Name -->
				<div class="col-md-6 form-group control-group {{ $errors->has('name') ? 'error' : '' }}">
					<label class="control-label pull-left" for="name">Name</label>
					<div class="controls col-md-9">
						<input class="form-control" type="text" name="name" id="name" value="{{ Input::old('name') }}" />
						{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
			</div>
		</div>

		<!-- Tab Permissions -->
		<div class="tab-pane" id="tab-permissions">
			<div class="control-group">
				<div class="controls">

					@foreach ($permissions as $area => $permissions)
					<fieldset>
						<legend>{{ $area }}</legend>

						@foreach ($permissions as $permission)
						<div class="control-group">
							<label class="control-group">{{ $permission['label'] }}</label>

							<div class="radio inline">
								<label for="{{ $permission['permission'] }}_allow" onclick="">
									<input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}>
									Allow
								</label>
							</div>

							<div class="radio inline">
								<label for="{{ $permission['permission'] }}_deny" onclick="">
									<input type="radio" value="0" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($selectedPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
									Deny
								</label>
							</div>
						</div>
						@endforeach

					</fieldset>
					@endforeach

				</div>
			</div>
		</div>
	</div>

	<!-- Form Actions -->
	<div class="control-group row">
		<div class="controls col-md-6">
			<button type="submit" class="btn btn-success">Create Group</button>
			<a class="btn btn-link" href="{{ route('groups') }}">Cancel</a>

		</div>
	</div>
</form>
@stop
