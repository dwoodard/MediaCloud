@extends('backend/layouts/admin')


@section('scripts')
<!-- <script src="//cdn.jsdelivr.net/typeahead.js/0.9.3/typeahead.min.js" type="text/javascript"></script> -->

<script src="/assets/js/dropzone.js"></script>

<script>

    $( document ).ready(function( $ ) {
        $('.typeahead').autocomplete({
            source: function(request, response){


                $.ajax({
                    url: "/v1/users",
                    data: {search: request.term, fields:'username,id'},
                    dataType: "json",
                    success: function( data ) {
                        response( $.map( data, function( item ) {
                            return {
                                id:item.id,
                                username:item.username,
                                label: item.id+": "+item.username ,
                                value: item.username,

                            }
                        }));
                    },

                });
            },
            select: function(event,ui){
                console.log(event,ui);
                $("#userId").val(ui.item.id);
            }
        });

        function showForm(){
            $(".btn-getUserInfo").text("got it");
            $("#collections-form").removeClass('hide');

        }



        $('#owner').focus()
        .keypress(function(e){
            var code = e.keyCode || e.which;
            if(code == 13) { //Enter keycode
                e.preventDefault();
                showForm();
            }
        })
        .on('focus', function(){
                $(".btn-getUserInfo").text("Get Owner ID");
                $(this).val('');
                $("#collections-form").addClass('hide');

                myDropzone.removeAllFiles();

            })

        $(".btn-getUserInfo").click(function(e){
            e.preventDefault();
            showForm();
        })

        function doComplete(){
            console.log('all complete')
        }

        









    });
 </script>
@stop




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


<div id="collections-form" class="hide">
<form class="form-horizontal" method="post" action="" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <!-- Tabs Content -->
    <div class="tab-content">
        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- First Name -->
                        <div class="form-group control-group {{ $errors->has('name') ? 'error' : '' }} ">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="name" id="name" value="{{ Input::old('name') }} " />
                                {{ $errors->first('name', '<span class="help-inline">:message</span>') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group control-group {{ $errors->has('description') ? 'error' : '' }}  ">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="description" id="description" value="{{ Input::old('description') }}" >
                                {{ $errors->first('description', '<span class="help-inline">:message</span>') }}
                            </div>
                        </div>
                    </div>             
                </div><!--/row-->
               
              
            </div><!--/form-body-->
           
        </div>


        <!-- Permissions tab -->
        <div class="tab-pane" id="tab-permissions">
            <div class="control-group">
                <div class="controls">


                </div>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="control-group">
        <div class="controls">

            <button type="submit" class="btn btn-success">Create Collection</button>
            <a class="btn btn-link" href="{{ route('users') }}">Cancel</a>
        </div>
    </div>
</form>
@stop
</div>
