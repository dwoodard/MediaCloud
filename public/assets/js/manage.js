/* manage.js*/
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
				completeFiles = 0,
				filesProgress = 0;

				this.on("sending", function (file, xhr, formData) {
					formData.append("userId", $("#userId").val());
					console.log('sending', xhr)
				});
				this.on("addedfile", function (file, xhr, formData) {
					totalFiles += 1;
				});

				this.on('uploadprogress', function (file, progress) {
					var progressTotals = _.map(_.pluck(myDropzone.files, 'upload'),function(i){return i.progress})
					var progressTotal = 0;

					$.each(progressTotals, function() {

						progressTotal += this;
					})
					filesProgress = progressTotal/progressTotals.length
					console.log('progress', progressTotal/progressTotals.length);
					$(".progress-bar-status").css('width', (filesProgress) + "%")
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
					// $(".progress-bar-status").css('width', "0%")
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

	shareSelect: function  () {
		$(".share-select").on("click", function (e) {

			if ($(e.currentTarget).data("target")){
				var input = $($($(e.currentTarget).data("target"))[0]).find("[id$=direct-link]")

				setTimeout(function() {
					input.focus().select()
				},1000)
			};

			if ($(e.currentTarget).is("input")) {
				var input = $(e.currentTarget)
				input.focus().select()
				// console.log('ive been clicked');
			};
		});
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
				$('.active-asset').removeClass('active-asset');
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
		}).done(function (data) {
			$("#collection-view").html(data);

			$(elm).find('i.fa-spinner').remove();

			$('.sortable').sortable({
				update: function (event, ui) {
					var data = $(this).sortable('toArray');
					dataArray=[]
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
						dataArray.push(data)
					})

					// console.log(JSON.stringify(dataArray));

					$.ajax({
						type: "POST",
						url: "/manage/sort/update",
						data: {
							"sorts": dataArray
						},
						dataType: "json",
						statusCode: {
							200: function(data) {
								console.log(data);
							}
						}
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
			Manage.shareSelect();
		});
},

addPlaylist: function () {
	$("#btn-new-playlist").bind("click", function (e) {
		/* console.log(e);*/
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


		$('.active-asset').removeClass('active-asset')
		$(e.currentTarget).closest("tr").addClass('active-asset')

		Manage.setCurrentAssetView($(e.currentTarget).closest("[data-asset-id]").data('asset-id'))

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
		opacity: .5,
		marginTopAdjust: true,
		marginTopBase: 0,
		marginTopIncrement: 0,
		animationSpeed: 200,
		URLrewrite: true,
		URLbase: "",
		internalLinkSelector: ".jaf-internal a",
		instaSwitch: true
	});
},

setCurrentAssetView: function (id) {


	$.ajax({
		url: "/v1/assets/" + id + "/asset"
	}).done(function (data) {
		Manage.data = data;
		$("#asset-view").data('current-asset-id', id)

		$("#current-asset-id").html(id)
		$("#current-asset-title").html(data.title)
		$("#current-asset-direct-link").val(window.location.origin + "/player/asset/"+ id)
		$("#current-asset-embed-link").val("<iframe width='800px' height='600px' src='"+window.location.origin + "/player/asset/" + id + " frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>")
		$("#current-asset-share-preview").attr("href", "/player/asset/"+id)


		/* textEdit() */
		$('#current-asset-can-download').data("editable-data", "asset-"+id)
		$('#current-asset-public').data("editable-data", "asset-"+id)


		/* permissions */
		var permissions = JSON.parse(Manage.data.permissions);
		var keys = _.keys(permissions);
		var source = [];
		for (var i = 0; i < keys.length; i++) {
			source.push({"value":i, "text": keys[i], "can":permissions[keys[i]]})
		};

		var value =_.map(_.filter(source, function(item){ return item.can; }), function(i){return i.value })



		$('#current-asset-permissions').editable({
			type:'checklist',
			pk: id,
			value: value,
			placement: 'left',
			source: source,
			display: function(value, sourceData) {
				var $el = $('#permissions-list'),
				checked, html = '';
				if(!value) {
					$el.empty();
					return;
				}

				checked = $.grep(sourceData, function(o){
					return $.grep(value, function(v){
						return v == o.value;
					}).length;
				});

				$.each(checked, function(i, v) {
					html+= '<li>'+$.fn.editableutils.escape(v.text)+'</li>';
				});
				if(html) html = '<ul>'+html+'</ul>';
				$el.html(html);
			},
			url: function(params) {
				var oldParamsValue = _.map(params.value, function(i){return parseInt(i)})


				newParams = {};

				for (var i = 0; i < source.length; i++) {
					console.log("FOR", oldParamsValue, source[i].value)
					newParams[source[i].text] = _.contains(oldParamsValue, source[i].value) ? 1 : 0
				};

				params.value = JSON.stringify(newParams)
				console.log("URL PARAMS",source, oldParamsValue, params);


				$.ajax({
					url: 'manage/asset/update',
					type: "POST",
					data: params
				})
			}
		});


$('#current-asset-permissions').on('submit', function(e, params) {
	console.log('Saved value: ' + params.newValue);
});




/* $("#current-asset-can-download").prop('checked', permissions.can_download); */
/* $("#current-asset-public").prop('checked', permissions.public); */

Manage.loadTags();
Manage.shareSelect();

$("#asset-player").html('<i class="fa fa-spinner fa-spin fa-5x"></i>')

$.ajax({
	url: "/player/asset/" + id
}).done(function (data) {
	$("#asset-player").html(data);
	$("#asset-view").addClass("cbp-spmenu-open")
});
})
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
			/* console.log($(e.target).find('table'));*/
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
				/* console.log(result);*/

				$(table).find('tbody')
				.append('<tr id="cpa-' + data['collection_id'] + '-' + data['playlist_id'] + '-' + data['asset_id'] + '"> <td width="7px"><a class="asset-player-btn" data-asset-id="' + data["asset_id"] + '" href="#"><i class="fa fa-play-circle-o"></i></a></td> <td>' + result.title + '</td> <td>' + result.description + '</td> <td></td> </tr>')

				Manage.assetPlayerBtn();
			})

			var unassignedCount = Number($('.unassigned_assets_count.badge').text() - 1)

			$('.unassigned_assets_count').text(unassignedCount);

			if (unassignedCount == 0) {
				$('#unassigned_assets_notify').find('.badge').remove();
			}

			$(draggedParent).remove();
		}
	});
},

textEdit: function () {
	$.fn.editable.defaults.mode = 'inline';
	$('.editable').each(function (i, elm) {

		/*vars*/
		var editableData = $(elm).closest('[data-editable-data]').data('editable-data');
		editableData = /(\w+)-(\d+)/.exec(editableData);
		var cpaType = editableData[1];
		var pkId = editableData[2];

		/* console.log(editableData);*/

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

cpa: function (elm) {
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

			if ($(e.target).parent().hasClass('slide-submenu') || $(e.target).hasClass('back')) {
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



			switch (Manage.cpa(e.toElement).name) {
				case "playlist_asset":
				case "asset":
				console.log('play', Manage.cpa(e.toElement).name, Manage.cpa(e.toElement).assetId)
				Manage.setCurrentAssetView(Manage.cpa(e.toElement).assetId)
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

loadTags: function () {
	$(".tagit-choice").remove();



	$.ajax({
		type: "GET",
		url: "manage/tags/" + $('#asset-view').data('current-asset-id')
	}).done(function (data) {

		$('#current-tags-total').html(data.length)
		$.each(data, function (i, value) {
			$("#assetTags").tagit('createTag', value)
		})

		/* console.log(data,$("#assetTags").tagit("assignedTags"));*/

	})
},

tagAsset: function () {


	var tags;
	$.ajax({
		type: "GET",
		url: "/manage/tags",
	}).done(function (data) {
		tags = data;
		$("#assetTags").tagit({
			autocomplete: {
				delay: 0,
				minLength: 2
			},
			showAutocompleteOnFocus: true,
			tagSource: tags,
			fieldName: "name",
			afterTagAdded: function (event, ui) {
				$.ajax({
					type: "POST",
					url: "manage/tag/add",
					data: {
						name: ui.tagLabel,
						asset: $(event.target).closest('#asset-view').data('current-asset-id')
					}
				}).done(function (data) {
					// console.log(data);
					// console.log(event, ui);



				});
			},
			afterTagRemoved: function (event, ui) {
				// console.log(event, ui);
				name = ui.tagLabel;
				$.ajax({
					type: "DELETE",
					url: "manage/tag/delete/" + name + "/" + $(event.target).closest('#asset-view').data('current-asset-id')
				}).done(function (data) {
					// console.log(data);

				});
			}
		});




	});


},


}