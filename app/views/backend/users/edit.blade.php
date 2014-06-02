@extends('backend/layouts/admin')

{{-- Page title --}}
@section('title')
User Update ::
@parent
@stop

{{-- Page content --}}
@section('content')

{{Breadcrumbs::render('editUsers')}}


<div class="page-header">
	<h1>
		User Update

		<div class="pull-right">
			<a href="{{ route('users') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> Back</a>
		</div>
	</h1>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	<li><a href="#tab-permissions" data-toggle="tab">Permissions</a></li>
</ul>



<form method="POST"  class="form-horizontal" >

	<!-- CSRF Token -->
	{{Form::token()}}

	<!-- Tabs Content -->
	<div class="tab-content">

		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<div class="form-body">
				<div class="row">
					<div class="col-md-6">
						<!-- First Name -->
						<div class="form-group control-group {{ $errors->has('first_name') ? 'error' : '' }} ">
							<label class="control-label col-md-3">First Name</label>
							<div class="col-md-9">
								<input class="form-control" type="text" name="first_name" id="first_name" value="{{ Input::old('first_name', $user->first_name) }} " />
								{{ $errors->first('first_name', '<span class="help-inline">:message</span>') }}
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group control-group {{ $errors->has('last_name') ? 'error' : '' }}  ">
							<label class="control-label col-md-3">Last Name</label>
							<div class="col-md-9">
								<input type="text" class="form-control"  name="last_name" id="last_name" value="{{ Input::old('last_name', $user->last_name) }}" >
								{{ $errors->first('last_name', '<span class="help-inline">:message</span>') }}
							</div>
						</div>
					</div>
				</div><!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group control-group {{ $errors->has('email') ? 'error' : '' }}">
							<label class="control-label col-md-3">Email</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="email" id="email" value="{{ Input::old('email', $user->email) }}">
								{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
							</div>
						</div>
					</div>
				</div><!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group control-group {{ $errors->has('password') ? 'error' : '' }}">
							<label class="control-label col-md-3">Password</label>
							<div class="col-md-9">
								<input type="password" name="password" id="password" value="" class="form-control" >
								{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group control-group {{ $errors->has('password_confirm') ? 'error' : '' }}">
							<label class="control-label col-md-3">Confirm Password</label>
							<div class="col-md-9">
								<input class="form-control" type="password" name="password_confirm" id="password_confirm" value="">
								{{ $errors->first('password_confirm', '<span class="help-inline">:message</span>') }}
							</div>
						</div>
					</div>
				</div><!--/row-->
			</div><!--/form-body-->
			<div class="row">
				<div class="control-group col-md-6  {{ $errors->has('groups') ? 'error' : '' }}">
					<legend>Groups</legend>
					<div class="controls">
						<select class="" name="groups[]" id="groups[]" >
							@foreach ($groups as $group)
							<option value="{{ $group->id }}"{{ (array_key_exists($group->id, $userGroups) ? ' selected="selected"' : '') }}>{{ $group->name }}</option>
							@endforeach
						</select>

						<span class="help-block">
							Select a group to assign to the user, remember that a user takes on the permissions of the group they are assigned.
						</span>
					</div>
				</div>
				<div class="control-group col-md-6 {{ $errors->has('activated') ? 'error' : '' }}" style="margin-bottom:80px;">
					<legend>User Activated</legend>
					<div class="controls">
						<select{{ ($user->id === Sentry::getId() ? ' disabled="disabled"' : '') }} name="activated" id="activated">
						<option value="1"{{ ($user->isActivated() ? ' selected="selected"' : '') }}>@lang('general.yes')</option>
						<option value="0"{{ ( ! $user->isActivated() ? ' selected="selected"' : '') }}>@lang('general.no')</option>
					</select>
					{{ $errors->first('activated', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
			<div class="row">


			</div>
		</div>
	</div>
	<!-- Permissions tab -->
	<div class="tab-pane" id="tab-permissions">
		<div class="controls">
			<div class="row">
				@foreach ($permissions as $area => $permissions)
				<fieldset class="col-md-4">
					<legend>{{ $area }}</legend>

					@foreach ($permissions as $permission)
					<div class="control-group" >
						<label style="width:100px">{{ $permission['label'] }}</label>

						<div class="radio inline" >
							<label for="{{ $permission['permission'] }}_allow" onclick="">
								<input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($userPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}>
								Allow
							</label>
						</div>

						<div class="radio inline" >
							<label for="{{ $permission['permission'] }}_deny" onclick="">
								<input type="radio" value="-1" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($userPermissions, $permission['permission']) === -1 ? ' checked="checked"' : '') }}>
								Deny
							</label>
						</div>

						@if ($permission['can_inherit'])
						<div class="radio inline" >
							<label for="{{ $permission['permission'] }}_inherit" onclick="">
								<input type="radio" value="0" id="{{ $permission['permission'] }}_inherit" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($userPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
								Inherit
							</label>
						</div>
						@endif
					</div>
					@endforeach

				</fieldset>
				@endforeach
			</div><!-- ./row -->
		</div>
	</div>
</div>

<!-- Form Actions -->
<div class="control-group">
	<div class="controls">


		<button type="submit" class="btn btn-success">Update User</button>
		<a class="btn btn-link" href="{{ route('users') }}">Cancel</a>
	</div>
</div>
</form>
@stop
