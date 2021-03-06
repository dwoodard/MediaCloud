@extends('frontend/layouts/manage')


@section('content')
@include('_partials.subnav-manage')

<div id="app">

	<nav id="collections-list" class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left cbp-spmenu-open">
		<i class="close fa fa-times-circle-o fa-2x"></i>
		<h3>Collections</h3>


		<ul class="toolbar clearfix">
			<li> <a id="btn-new-collection" href="#"><i class="fa fa-plus"></i> New Collection</a></li>
		</ul>

		<div id="newCollection" style="display:none">
			<input id="input-new-collection" type="text" value="Collection Name" class="input-sm">
			<button id="btn-save-new-collection"><i class="fa fa-check"></i> </button>
			<button id="btn-cancel-new-collection"><i class="fa fa-times"></i> </button>
		</div>

		@foreach($user_collections as $user_collection)
		<a class="loadCollection" data-collection-id="{{$user_collection->id}}" href="#">{{$user_collection->name}}</a>
		@endforeach
	</nav>
</div>

<nav id="asset-view" class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
	<div id="asset-view-header"><i class="close fa fa-times-circle-o fa-2x"></i>
		<h3>Player / Assets</h3>
	</div>

	<div id="asset-player"></div>

	<div id="asset-toolbar">
		<button class="share-select btn btn-primary btn-xs " data-toggle="modal" data-target="#assetShare">Share Asset ...</button>
	</div>

	<div id="asset-editor">
		<!-- <input type="text" class="form-control"> -->
		<header>
			<span id="current-asset-id"></span>
			<span id="current-asset-title"></span>
		</header>

		<div class="panel-group" id="accordion">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#tags-tab">
							Tags (<span id="current-tags-total"></span>)
						</a>
					</h4>
				</div>
				<div id="tags-tab" class="panel-collapse collapse in">
					<ul class="panel-body" id="assetTags"> </ul>
				</div>
			</div>

			<div class="panel panel-default">

				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
							Permissions
						</a>
					</h4>
				</div>

				<div id="collapseThree" class="panel-collapse collapse">
					<div class="panel-body">
						<div id="current-asset-permissions-container">
							<div id="permissions-list"></div>
							<a id="current-asset-permissions" class="btn btn-primary" data-type="checklist" data-name="permissions"  data-editable-data="" href="#" >Edit Permissions</a>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>

</nav>

<nav id="browse-view" class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-bottom">
	<div id="browse-view-header"><i class="close fa fa-times-circle-o fa-2x"></i>
		<h3>Browse Assets</h3>
	</div>

	<div id="browse-view-container"></div>

</nav>

<div id="collection-view"></div>

<!-- /app -->

<div class="modal fade " id="assetShare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Share This Asset</h4>
			</div>
			<div class="modal-body">
				<p>Hit <strong>(CTRL/CMD)+C</strong> to copy the link to your clipboard!</p>
				<br>
				<input id="current-asset-direct-link" class="form-control share-select"  type="text" value="">
				<br>
				<p>Embed This Asset on your webpage!</p>
				<br>
				<input id="current-asset-embed-link" class="form-control share-select" type="text" value="">
				<br>
				<i class="fa fa-external-link-square"></i><a id="current-asset-share-preview" href="" target="_blank"> Preview Here</a>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script src="/bower/app-folders/index.js"></script>
<script src="/assets/js/manage.js"></script>
<script src="/bower/tag-it/js/tag-it.min.js"></script>
<script src="/bower/underscore/underscore.js"></script>




<!-- Kaltura Capture Hack -->
	<?php
	/* include Kaltura Client Library*/
	require '../vendor/dwoodard/kaltura/KalturaClient.php';


	/*define constants*/
	define("KALTURA_PARTNER_ID", 1533221);
	define("KALTURA_PARTNER_SERVICE_SECRET", "ccef132ea9f35904042aec252330a080");
	$uiconfId = 16215081;
	$partnerUserId = Sentry::getUser()->email;



	/*prepare KS*/
	$config = new KalturaConfiguration(KALTURA_PARTNER_ID);
	$client = new KalturaClient($config);

	$ks = $client->generateSession(KALTURA_PARTNER_SERVICE_SECRET, $partnerUserId, KalturaSessionType::USER, KALTURA_PARTNER_ID);
	?>


	<script type="text/javascript" src=" https://www.kaltura.com/p/<?php echo KALTURA_PARTNER_ID; ?>/sp/<?php echo KALTURA_PARTNER_ID; ?>/ksr/uiconfId/<?php echo $uiconfId; ?> "></script>
	<script type="text/javascript">
		function removeDescAndTags(objOptions){
			console.log("object before change");
			console.log(objOptions);
			objOptions['kaltura.server'] = 'https://'+window.location.host; /*http needed for hack*/
			objOptions['kaltura.submit.description.enabled'] = false;
			objOptions['kaltura.submit.tags.enabled'] = false;
			objOptions['kaltura.submit.title.enabled'] = false;
			objOptions['kaltura.submit.title.value'] = '<?php echo Sentry::getUser()->username ?>';
			console.log("object after change");
			console.log(objOptions);
			return objOptions;
		}

		/*setting callback to override some kaltura options*/

		kalturaScreenRecord.setModifyKalturaOptionsCallback(removeDescAndTags);
		$("#subnav-btn-capture").click(function(){
			kalturaScreenRecord.startKsr(<?php echo KALTURA_PARTNER_ID;?>, '<?php echo $ks; ?>', false);

		})

		kalturaScreenRecord.startCallBack = function(result) {
			console.log(result);
			$("#subnav-btn-capture").addClass('capture_on')
		}

		kalturaScreenRecord.downloadCallBack = function(percent){
			console.log(percent);
		}

		kalturaScreenRecord.UploadCompleteCallBack = function(entryId) {
			console.log("Kaltura KSR uploadCompleteCallBack: created entry with ID ["+entryId+"]");
			$("#subnav-btn-capture").removeClass('capture_on')
		}



	</script>
	<!-- / Kaltura Capture Hack -->



<script type="text/javascript">
	$(document).ready(function(){
		Manage.init( {{json_encode($collection->id)}}, {{json_encode(Sentry::getUser()->id)}} );
	});
</script>
@stop

@section('style')
<link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.7.1/css/dropzone.css" rel="stylesheet" type="text/css"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.7.1/css/basic.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/manage.css" rel="stylesheet" type="text/css"/>
<link href="/bower/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css"/>
@stop

