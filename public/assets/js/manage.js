// manage.js

var Manage = {
	data:{},
	userId:"",
	init:function(data, userId){
		this.data = data;
		this.userId = userId;
		this.dropzoneInit();
		this.menuEvents();
		this.playListSettings();

		this.getCollection(this.data[0].id)

		// console.log(this);
	},
	dropzoneInit:function  () {
		function doComplete(){
			console.log('all complete')
		}

		var myDropzone;
		Dropzone.options.filedrop = {
			maxFilesize: 2048,
			addRemoveLinks: true,
			init: function () {

				myDropzone = this;

				var totalFiles = 0,
				completeFiles = 0;

				this.on("sending", function (file, xhr, formData) {
					formData.append("userId", $("#userId").val());
					console.log('sending', xhr)
				});
				this.on("addedfile", function (file, xhr, formData) {
					totalFiles += 1;
				});

				this.on("error", function (file) {
					if(file.status == "error"){
						console.log("do something");
					}
				});

				this.on("removed file", function (file, xhr, formData) {
					totalFiles -= 1;
				});
				this.on("complete", function (file) {
					completeFiles += 1;
					if (completeFiles === totalFiles) {
						doComplete();
					}
				});
			}
		};
	},
	menuEvents: function(){

		$('.loadCollection').on("click",function(e) {
			Manage.getCollection($(e.currentTarget).data("collection-id"), e.currentTarget);
		});

		$('.dropdown.keep-open').on({
			"shown.bs.dropdown": function() { $(this).data('closable', false); },
			"click":             function() { $(this).data('closable', true);  },
			"hide.bs.dropdown":  function() { return $(this).data('closable'); }
		});


		// Toggle Navigation
		$("#subnav-btn-collections, #subnav-btn-assets, #subnav-btn-browse")
		.on("click",function(e) {

			switch(/subnav-btn-(.*)/.exec(e.currentTarget.id)[1]){
				case "collections":
				$("#collections-list").toggleClass('cbp-spmenu-open')
				$("body").toggleClass('cbp-spmenu-push-toright')
				break;
				case "assets":
				$("#asset-view").toggleClass('cbp-spmenu-open')
				break;
				case "browse":
				$("#browse-view").toggleClass('cbp-spmenu-open');
				Manage.getBrowse();
				break;


			}
		})


		$("#search_bar a").on( "click", function(e) {
			setTimeout(function(){
				$("#srch-term")[0].focus();
			}, 0);
		});


		$(".close").on("click", function(e) {

			var cbp_menu = $(this).closest('.cbp-spmenu')[0]

			if (cbp_menu.id == "collections-list") {
				$(this).closest(".cbp-spmenu").removeClass("cbp-spmenu-open")
				$("body").removeClass('cbp-spmenu-push-toright')
			}else{
				$(this).closest(".cbp-spmenu").removeClass("cbp-spmenu-open")
			}

		});

		$("#btn-new-collection").on("click", function(e) {
			$(".newCollection").show().find(':input').focus().select()
		});

		$("#btn-save-new-collection").on('click',function(e) {
			console.log('save new collection');
			var data = {
				name: $("#input-new-collection").val(),
				userId: userId
			}
			$.ajax({
				type: "POST",
				url:"collections",
				data: data,
				dataType: "json"
			}).done(function(data) {

				console.log(data);
			});

		})



	},

	getCollection:function(id, elm) {

		$(elm).append(' <i class="fa fa-spinner fa-spin"></i>')

		$.ajax({
			url: "/manage/collections/"+id
		})
		.done(function(data) {
			$("#collection-view").html(data);

			$(elm).find('i.fa-spinner').remove();

			$('.sortable').sortable({
				update: function (event, ui) {
					var data = $(this).sortable('toArray');
					// console.log(event, ui, data);
					console.log($(this));



					$.each(data, function(i,v){
						// console.log(i,v)
						var cpa = /cpa-(\d+)-(\d+)-(\d+)/g.exec(v),
						data = {
							'collection_id':cpa[1],
							'playlist_id':cpa[2],
							'asset_id':cpa[3],
							'asset_order':i
						};

						console.log(data);
						$.ajax({
							type: "POST",
							url:"/cpa/update",
							data: data,
							dataType: "json"
						}).done(function(data) {

							console.log(data);
						});

					})
				}
			});
			Manage.addFolderInit();
			Manage.dragAsset();
			Manage.assetPlayerBtn();

		});

	},

	assetPlayerBtn: function(){
		$('.asset-player-btn').on("click",function(e) {
			console.log($(e.currentTarget).closest("[data-asset-id]").data('asset-id'));
			Manage.getAssetPlayer($(e.currentTarget).closest("[data-asset-id]").data('asset-id'))
		});
	},

	getBrowse: function(){

		$.ajax({
			url: "/manage/browse/"+Manage.userId
		})
		.done(function(data) {
			$("#browse-view-container").html(data);
			Manage.assetPlayerBtn();
			Manage.browseDragAsset();
		});

	},

	addFolderInit: function() {
		$('.app-folders-container').appFolders({
				opacity:.5,                                 // Opacity of non-selected items
				marginTopAdjust:true,                       // Adjust the margin-top for the folder area based on row selected?
				marginTopBase:0,                            // If margin-top-adjust is "true", the natural margin-top for the area
				marginTopIncrement:0,                       // If margin-top-adjust is "true", the absolute value of the increment of margin-top per row
				animationSpeed:200,                     // Time (in ms) for transitions
				URLrewrite:true,                             // Use URL rewriting?
				URLbase:"",                       // If URL rewrite is enabled, the URL base of the page where used. Example (include double-quotes):"/services/"
				internalLinkSelector:".jaf-internal a", // a jQuery selector containing links to content within a jQuery App Folder
				instaSwitch:true
			});
	},
	getAssetPlayer:function(id) {
		$.ajax({
			url: "/player/single/"+id
		}).done(function(data) {
			$("#asset-player").html(data);
			$("#asset-view").addClass("cbp-spmenu-open")

		});

	},

	playListSettings:function () {
		$('.nav.nav-tabs a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});

	},
	browseDragAsset: function() {
		$(".draggable-asset").draggable({
			revert: "invalid"
		});
	},
	dragAsset: function () {


		$(".draggable-asset").draggable({
			revert: "invalid"
		});


		$('.folderContent, #assets-container').droppable({
			accept: ".draggable-asset",
			activeClass: "drag-to",
			hoverClass: "drag-to-hover",
			drop: function( e, ui ) {
				console.log($(e.target).find('table'));
				var draggedElm = $(ui)[0].draggable;
				var draggedParent = $(draggedElm[0]).closest('li')[0]
				var table = $(e.target).find('table')[0]
				var cp = /cp-(\d+)-(\d+)/g.exec($(e.target).find('table')[0].id),
				data = {
					'collection_id':Number(cp[1]),
					'playlist_id':Number(cp[2]),
					'asset_id':$($(ui)[0].draggable).closest('[data-asset-id]').data('assetId')
				};

				$.ajax({
					type: "POST",
					url:"/cpa/add",
					data: data,
					dataType: "json"
				}).done(function(data) {
					console.log("/v1/assets/"+data['asset_id']+"/asset")


				});

				$.ajax({
					url: "/v1/assets/"+data['asset_id']+"/asset",
					dataType: "json"
				}).done(function(result){
					console.log(result);
					$(table).find('tbody').append('<tr id="cpa-'+data['collection_id']+'-'+data['playlist_id']+'-'+data['asset_id']+'"> <td width="7px"><a class="asset-player-btn" data-asset-id="'+data["asset_id"]+'" href="#"><i class="fa fa-play-circle-o"></i></a></td> <td>'+result.title+'</td> <td>'+result.description+'</td> </tr>')

					Manage.assetPlayerBtn();

				})

				$(draggedParent).remove();
			}
		});
}

}
