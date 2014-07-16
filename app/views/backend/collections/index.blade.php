@extends('backend/layouts/admin')

@section('scripts')

<script>
    $(document).ready(function () {

        $("[id*='delete-']").click(function (e) {
            e.preventDefault();
            btn = $(this);
            url = this.action;
            // confirm dialog
            alertify.confirm("Whooo are you Sure?! Once it's gone, it ain't comin' back!", function (e) {
                if (e) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function (data) {
                            data = $.parseJSON(data);
                            console.log(data);
                            if (data.result == "success") {
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


@section('content')
{{Breadcrumbs::render('collections')}}

<div class="page-header">

    <h1>All Collections

        <div class="pull-right">
            <a href="{{ URL::route('collection.create') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Add Collection</a>
        </div>
    </h1>
</div>

@if (count($collections) >= 1)
<div class="pull-right">
</div>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Date Created</th>
        <th>Edit</th>
        <th>Delete</th>

    </tr>
    </thead>
    <tbody>
    @foreach ($collections as $collection)
    <tr>
        <td>{{{ $collection->name}}}</td>
        <td>{{{ $collection->description}}}</td>
        <td>{{{ $collection->created_at}}}</td>
        <td>{{ link_to_route('collection.edit', 'Edit', array($collection->id), array('class' => 'btn btn-info')) }}</td>
        <td>
            <form id="delete-{{ $collection->id}}" method="POST" action="{{action('CollectionsController@destroy',$collection->id )}}" accept-charset="UTF-8">
                <input type="hidden" name="_method" value="DELETE"/>
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>


@else
There are no Collections
@endif

@stop
