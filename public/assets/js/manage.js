// manage.js
var Manage = {
	data: {},
	userId: "",
	init: function (collectionId, userId) {

		this.userId = userId;
		this.dropzoneInit();
		this.menuEvents();
		this.playListSettings();
		this.textEdit();
		this.getCollection(collectionId);
		this.contextMenuInit()
		// this.tagAsset();
	},

	dropzoneInit: function () {
		function doComplete() {
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
					if (file.status == "error") {
						console.log("do error");
					}
				});

				this.on("removed file", function (file, xhr, formData) {
					totalFiles -= 1;
				});
				this.on("complete", function (file) {
					completeFiles += 1;
					if (completeFiles === totalFiles) {
						location.reload();
					}
				});
			}
		};
	},

	loadCollection: function () {
		$('.loadCollection').on("click", function (e) {
			Manage.getCollection($(e.currentTarget).data("collection-id"), e.currentTarget);
		});
		Manage.textEdit();
	},

	menuEvents: function () {

		Manage.loadCollection();
		/*Toggle Navigation*/
		$("#subnav-btn-collections, #subnav-btn-assets, #subnav-btn-browse")
		.on("click", function (e) {

			switch (/subnav-btn-(.*)/.exec(e.currentTarget.id)[1]) {
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
		$("#search_bar a").on("click", function (e) {
			setTimeout(function () {
				$("#srch-term")[0].focus();
			}, 0);
		});
		$(".close").on("click", function (e) {
			var cbp_menu = $(this).closest('.cbp-spmenu')[0]
			switch (cbp_menu.id) {
				case "collections-list":
				$(this).closest(".cbp-spmenu").removeClass("cbp-spmenu-open");
				$("body").removeClass("cbp-spmenu-push-toright");
				break;

				case "asset-view":
				$("#asset-player").html("");
				break;

				case "browse-view":
				break;

				default:
				break;
			}
			$(this).closest(".cbp-spmenu").removeClass("cbp-spmenu-open")

		});

		$("#btn-new-collection").on("click", function (e) {
			$("#newCollection").show().find(':input').focus().select();
		});

		$("#btn-cancel-new-collection").on('click', function (e) {
			$("#input-new-collection").val("New Collection")
			$("#newCollection").hide()
		})


		$("#input-new-collection").keypress(function (e) {
			if (e.which == 13) {
				Manage.submitNewCollection();
			}
		});

		$("#btn-save-new-collection").on('click', function (e) {

			Manage.submitNewCollection();

		})
	},
	submitNewCollection: function () {
		$("#newCollection").hide();
		$.ajax({
			type: "POST",
			url: "manage/collection/add",
			data: {
				name: $("#input-new-collection").val(),
				userId: Manage.userId
			},
			dataType: "json"
		}).done(function (data) {
			$('#collections-list')
			.append('<a class="loadCollection" data-collection-id="' + data.id + '" href="#">' + data.name + '</a>')
			.find('[data-collection-id=' + data.id + ']')
			.bind('click', function (e) {
				Manage.getCollection($(e.currentTarget).data("collection-id"), e.currentTarget);
			})

		});
	},
	getCollection: function (id, elm) {

		$(elm).append(' <i class="fa fa-spinner fa-spin"></i>')

		$.ajax({
			url: "/manage/collections/" + id
		})
		.done(function (data) {
			$("#collection-view").html(data);

			$(elm).find('i.fa-spinner').remove();

			$('.sortable').sortable({
				update: function (event, ui) {
					var data = $(this).sortable('toArray');

					$.each(data, function (i, v) {
						var cpa = /cpa-(\d+)-(\d+)-(\d+)/g.exec(v);
						var type = Number(cpa[2]) == 0 ? "collection" : "playlist";
						data = {
							'collection_id': Number(cpa[1]),
							'playlist_id': Number(cpa[2]),
							'asset_id': cpa[3],
							'type': type,
							'asset_order': i
						};
						$.ajax({
							type: "POST",
							url: "/manage/sort/update",
							data: data,
							dataType: "json"
						})
					})
				}
			});
			Manage.addFolderInit();
			Manage.dragAsset();
			Manage.assetPlayerBtn();
			Manage.addPlaylist();
			Manage.textEdit();
			Manage.contextMenuInit();
			Manage.tagAsset();
		});
	},

	addPlaylist: function () {
		$("#btn-new-playlist").bind("click", function (e) {
			// console.log(e);
			$('[href="#playlists-container"]').trigger('click');
			$("#newPlaylist").show().find(':input').focus().select();
		})

		$("#btn-cancel-new-playlist").on('click', function (e) {
			$("#input-new-playlist").val("Playlist Name")
			$("#newPlaylist").hide()
		});

		$("#btn-save-new-playlist").on('click', function (e) {
			Manage.submitNewPlaylist();
		})

		$("#input-new-playlist").keypress(function (e) {
			if (e.which == 13) {
				Manage.submitNewPlaylist();
			}
		});


	},
	submitNewPlaylist: function () {
		$("#newPlaylist")
		.find("button, input").hide()
		.end()
		.append($('<div> <i class="fa fa-spinner fa-spin"></i> Creating Playlist </div>'))
		var currentCollectionId = $("#current-collection").data("current-collection-id");
		$.ajax({
			type: "POST",
			url: "manage/playlist/add",
			data: {
				name: $("#input-new-playlist").val(),
				collection: currentCollectionId
			},
			dataType: "json"
		}).done(function (data) {

			Manage.getCollection(currentCollectionId);

		});
	},
	assetPlayerBtn: function () {
		$('.asset-player-btn').on("click", function (e) {
			// console.log($(e.currentTarget).closest("[data-asset-id]").data('asset-id'));
			Manage.getAssetPlayer($(e.currentTarget).closest("[data-asset-id]").data('asset-id'))
		});
	},

	getBrowse: function () {

		$.ajax({
			url: "/manage/browse/" + Manage.userId
		})
		.done(function (data) {
			$("#browse-view-container").html(data);
			Manage.assetPlayerBtn();
			Manage.browseDragAsset();
			Manage.textEdit();

		});
	},

	addFolderInit: function () {
		$('.app-folders-container').appFolders({
			opacity: .5, // Opacity of non-selected items
			marginTopAdjust: true, // Adjust the margin-top for the folder area based on row selected?
			marginTopBase: 0, // If margin-top-adjust is "true", the natural margin-top for the area
			marginTopIncrement: 0, // If margin-top-adjust is "true", the absolute value of the increment of margin-top per row
			animationSpeed: 200, // Time (in ms) for transitions
			URLrewrite: true, // Use URL rewriting?
			URLbase: "", // If URL rewrite is enabled, the URL base of the page where used. Example (include double-quotes):"/services/"
			internalLinkSelector: ".jaf-internal a", // a jQuery selector containing links to content within a jQuery App Folder
			instaSwitch: true
		});
	},

	getAssetPlayer: function (id) {

	//Set asset-view current id
	$("#asset-view").data('current-asset-id', id)
	Manage.loadTags()
	$.ajax({
		url: "/player/single/" + id
	}).done(function (data) {
		$("#asset-player").html(data);
		$("#asset-view").addClass("cbp-spmenu-open")

	});
},

playListSettings: function () {
	$('.nav.nav-tabs a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
},

browseDragAsset: function () {
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
		drop: function (e, ui) {
				// console.log($(e.target).find('table'));
				var draggedElm = $(ui)[0].draggable;
				var draggedParent = $(draggedElm[0]).closest('li')[0];
				var table = $(e.target).find('table')[0];
				var cp = /cp-(\d+)-(\d+)/g.exec($(e.target).find('table')[0].id);
				var type = Number(cp[2]) == 0 ? "collection" : "playlist";
				data = {
					'collection_id': Number(cp[1]),
					'playlist_id': Number(cp[2]),
					'asset_id': $($(ui)[0].draggable).closest('[data-asset-id]').data('assetId'),
					type: type
				};
				// console.log(data);
				$.ajax({
					type: "POST",
					url: "manage/asset/add",
					data: data,
					dataType: "json"
				})

				$.ajax({
					url: "/v1/assets/" + data['asset_id'] + "/asset",
					dataType: "json"
				}).done(function (result) {
					// console.log(result);
					$(table).find('tbody')
					.append('<tr id="cpa-' + data['collection_id'] + '-' + data['playlist_id'] + '-' + data['asset_id'] + '"> <td width="7px"><a class="asset-player-btn" data-asset-id="' + data["asset_id"] + '" href="#"><i class="fa fa-play-circle-o"></i></a></td> <td>' + result.title + '</td> <td>' + result.description + '</td> <td></td> </tr>')

					Manage.assetPlayerBtn();

				})

				var unassignedCount = Number($('.unassigned_assets_count.badge').text() - 1)
				$('.unassigned_assets_count').text(unassignedCount)
				if (unassignedCount == 0) {
					$('#unassigned_assets_notify').find('.badge').remove()
				}
				$(draggedParent).remove();
			}
		});
},

textEdit: function () {
	$.fn.editable.defaults.mode = 'inline';
	$('.editable').each(function (i, elm) {

			//vars
			var editableData = $(elm).closest('[data-editable-data]').data('editable-data');
			editableData = /(\w+)-(\d+)/.exec(editableData);
			var cpaType = editableData[1];
			var pkId = editableData[2];

			// console.log(editableData);

			switch (cpaType) {

				case "collection":
				$(elm).editable({
					type: $(elm).data('editable-type'),
					pk: pkId,
					url: 'manage/collection/update'
				})
				break;

				case "playlist":
				$(elm).editable({
					type: $(elm).data('editable-type'),
					pk: pkId,
					url: 'manage/playlist/update'
				})
				break;
				case "asset":
				$(elm).editable({
					type: $(elm).data('editable-type'),
					pk: pkId,
					url: 'manage/asset/update'
				})
				break;

			}
		});
},
cpa:function(elm) {
	var collectionId = $(elm).closest('[data-current-collection-id]').data('current-collection-id');
	var playlistId = Number($(elm).closest('[id^="playlistId-"]').length ? /playlistId-(.*)/.exec($(elm).closest('[id^="playlistId"]')[0].id)[1] : 0);
	var assetId = $(elm).closest('[id^="cpa-"]').length ? Number(/cpa-(\d+)-(\d+)-(\d+)/.exec($(elm).closest('[id^="cpa-"]')[0].id)[3]) : 0;

	type = {
		name: "",
		collectionId: collectionId,
		playlistId: playlistId,
		assetId: assetId
	}

	if (type.assetId) {
		type.name = playlistId == 0 ? "asset" : "playlist_asset"
	} else if (playlistId) {
		type.name = assetId == 0 ? "playlist" : "";
	} else {
		type.name = assetId == 0 && playlistId == 0 ? "collection" : "";
	}
	return type;
},

contextMenuInit: function () {

	$('.context-menu-container.dropdown.keep-open').on({

		"shown.bs.dropdown": function () {
			$('[id^="context-menu-"]').carousel(0).carousel('pause');
			$(this).data('closable', true);
		},

		"click": function (e) {
			if ($(e.target).parent().hasClass('slide-submenu') ||
				$(e.target).hasClass('back')) {
				return $(this).data('closable', false);
		} else {
			return $(this).data('closable', true);
		}
	},
	"hide.bs.dropdown": function () {
		return $(this).data('closable');
	}
});

	$('[id^="context-menu-"]').on('click', function (e) {

		switch (e.toElement.id) {

			case "play":


			switch (Manage.cpa(e.toElement)) {
				case "playlist_asset":
				case "asset":
				Manage.getAssetPlayer(Manage.cpa(e.toElement).assetId)
				break;
			}

			break;
			case "rename":
			break;
			case "add-to":
			break;
			case "publish":
			break;
			case "copy-url":
			break;
			case "delete-item":
			Manage.deleteItem(Manage.cpa(e.toElement), e.toElement);
			break;
		}
	})
},

deleteItem: function (type, elm) {

	console.log('delete ' + type.name + ' start');

	switch (type.name) {
		case "collection":
		var url = "/manage/" + type.name + "/delete/" + type.collectionId;
		break;
		case "playlist":
		var url = "/manage/" + type.name + "/delete/" + type.playlistId;
		break;
		case "playlist_asset":
		var url = "/manage/" + type.name + "/delete/" + type.playlistId + '/' + type.assetId;
		break;
		case "asset":
		var url = "/manage/" + type.name + "/delete/" + type.assetId;
		break;

	}


	$.ajax({
		url: url,
		type: 'DELETE'

	})
	.done(function (data) {
		console.log(data);
		switch (type.name) {
			case "collection":
			case "playlist":
			location.reload();
			break;
			case "playlist_asset":
			$(elm).closest('tr').remove();
			break;
			case "asset":
			$(elm).closest('tr').remove();
			break;
		}

	});
},

loadTags:function() {
	$.ajax({
		type: "GET",
		url: "manage/tags/"+$('#asset-view').data('currentAssetId')
	}).done(function (data) {
		$("#assetTags").tagit('removeAll')
		
		$.each(data, function(i,value) {
			$("#assetTags").tagit('createTag', value)
		})

		// console.log(data,$("#assetTags").tagit("assignedTags"));

	})
},

tagAsset: function (){

	var tags;
	$.ajax({
		type: "GET",
		url: "manage/tags",
	}).done(function(data) {
		tags = data;
	});

	$("#assetTags").tagit({
		// autocomplete: {delay: 0, minLength: 2},
		availableTags: tags,
		fieldName: "name",
		afterTagAdded: function(event, ui) {
			console.log(event,ui);

			$.ajax({
				type: "POST",
				url: "manage/tag/add",
				data: {
					name: ui.tagLabel,
					asset: $(event.target).closest('#asset-view').data('currentAssetId')
				}
			});
		},
		afterTagRemoved: function(event, ui) {
			console.log(event,ui);
			name = ui.tagLabel;
			$.ajax({
				type: "DELETE",
				url: "manage/tag/delete/"+ name +"/"+$(event.target).closest('#asset-view').data('currentAssetId')
			}).done(function(data) {
				console.log(data);
			});
		}
	});



},

}