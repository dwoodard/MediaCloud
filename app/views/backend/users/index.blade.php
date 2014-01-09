@extends('backend/layouts/admin')

{{-- Page title --}}
@section('title')
User Management ::
@parent
@stop

@section('scripts')
<script>
	$(document).ready(function() {

		$("[id*='delete-']").click(function(e){
			e.preventDefault()
			btn = $(this);
			userId = /delete-(\d+)/.exec(e.currentTarget.id)[1];
			url = this.baseURI + '/' + userId + '/delete';
			console.log(url);
		// confirm dialog
		alertify.confirm("Whooo are you Sure?! Once it's gone, it ain't comin' back!", function (e) {
			if (e) {
				$.ajax({
					url: url,
					success: function(data) {
						data = $.parseJSON(data);
						console.log(data);
						if(data.result == "success"){
							$(btn).closest('tr').hide('slow');

						}
					}
				});
			} 
		});

		})
	});
</script>
@stop


{{-- Page content --}}
@section('content')

{{Breadcrumbs::render('users')}}

<div class="page-header">
	<h1>
		User Management

		<div class="pull-right">
			<a href="{{ route('create/user') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h1>
</div>

<a class="btn btn-medium" href="{{ URL::to('admin/users?withTrashed=true') }}">Include Deleted Users</a>
<a class="btn btn-medium" href="{{ URL::to('admin/users?onlyTrashed=true') }}">Include Only Deleted Users</a>

{{ $users->links() }}



<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span1">@lang('admin/users/table.id')</th>
			<th class="span2">@lang('admin/users/table.first_name')</th>
			<th class="span2">@lang('admin/users/table.last_name')</th>
			<th class="span2">@lang('admin/users/table.email')</th>
			<th class="span3">@lang('admin/users/table.group')</th>
			<th class="span2">@lang('admin/users/table.activated')</th>
			<th class="span2">@lang('admin/users/table.created_at')</th>
			<th class="span2">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
		
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ $user->first_name }}</td>
			<td>{{ $user->last_name }}</td>
			<td>{{ $user->email }}</td>
			<td>
				
			</td>
			<td>@lang('general.' . ($user->isActivated() ? 'yes' : 'no'))</td>
			<td>{{ $user->created_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/user', $user->id) }}" class="btn btn-info">@lang('button.edit')</a>

				@if ( ! is_null($user->deleted_at))
				<a href="{{ route('restore/user', $user->id) }}" class="btn btn-mini btn-warning">@lang('button.restore')</a>
				@else
				@if (Sentry::getId() !== $user->id)
				<a href="{{ route('delete/user', $user->id) }}" id="delete-{{$user->id}}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
				@else
				<span class="btn btn-mini btn-danger disabled">@lang('button.delete')</span>
				@endif
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $users->links() }}
@stop
