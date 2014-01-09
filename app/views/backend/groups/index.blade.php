@extends('backend/layouts/admin')

{{-- Web site Title --}}
@section('title')
Group Management ::
@parent
@stop


@section('scripts')
<script>
	$(document).ready(function() {

		$("[id*='delete-']").click(function(e){
			e.preventDefault()
			btn = $(this);
			groupId = /delete-(\d+)/.exec(e.currentTarget.id)[1];
			url = this.baseURI + '/' + groupId + '/delete';
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




{{-- Content --}}
@section('content')

{{Breadcrumbs::render('groups')}}




<div class="page-header">
	<h3>
		Group Management

		<div class="pull-right">
			<a href="{{ route('create/group') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h3>
</div>

{{ $groups->links() }}

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span1">@lang('admin/groups/table.id')</th>
			<th class="span6">@lang('admin/groups/table.name')</th>
			<th class="span2">@lang('admin/groups/table.users')</th>
			<th class="span2">@lang('admin/groups/table.created_at')</th>
			<th class="span2">@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@if ($groups->count() >= 1)
		@foreach ($groups as $group)
		<tr>
			<td>{{ $group->id }}</td>
			<td>{{ $group->name }}</td>
			<td>{{ $group->users()->count() }}</td>
			<td>{{ $group->created_at->diffForHumans() }}</td>
			<td>
				<a href="{{ route('update/group', $group->id) }}" class="btn btn-info">@lang('button.edit')</a>

				
				@if ( ! is_null($group->deleted_at))
				<a href="{{ route('restore/group', $group->id) }}" class="btn btn-mini btn-warning">@lang('button.restore')</a>
				@else
				@if (Sentry::getId() !== $group->id)
				<a href="{{ route('delete/group', $group->id) }}" id="delete-{{$group->id}}" class="btn btn-mini btn-danger">@lang('button.delete')</a>
				@else
				<span class="btn btn-mini btn-danger disabled">@lang('button.delete')</span>
				@endif
				@endif


			</td>
		</tr>
		@endforeach
		@else
		<tr>
			<td colspan="5">No results</td>
		</tr>
		@endif
	</tbody>
</table>

{{ $groups->links() }}
@stop
