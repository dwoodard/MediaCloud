// manage.js

var Manage = {

	init:function(){
		this.appFolders();
		this.dropzoneInit();
		this.menuEvents();
		this.playListSettings();
		this.flipEvents();

		// console.log(this);
	},
	appFolders:function(){
		// console.log('initAppFolders')

		$('.app-folders-container').appFolders({
			opacity:.5, 								// Opacity of non-selected items
			marginTopAdjust:true, 						// Adjust the margin-top for the folder area based on row selected?
			marginTopBase:0, 							// If margin-top-adjust is "true", the natural margin-top for the area
			marginTopIncrement:0,						// If margin-top-adjust is "true", the absolute value of the increment of margin-top per row
			animationSpeed:200,						// Time (in ms) for transitions
			// URLrewrite:true, 							// Use URL rewriting?
			// URLbase:"/barebones/",						// If URL rewrite is enabled, the URL base of the page where used. Example (include double-quotes):"/services/"
			internalLinkSelector:".jaf-internal a",	// a jQuery selector containing links to content within a jQuery App Folder
			instaSwitch:true
		})

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

		$('.dropdown.keep-open').on({
			"shown.bs.dropdown": function() { $(this).data('closable', false); },
			"click":             function() { $(this).data('closable', true);  },
			"hide.bs.dropdown":  function() { return $(this).data('closable'); }
		});

		$("#search_bar a").on( "click", function(e) {
			setTimeout(function(){
				$("#srch-term")[0].focus();
			}, 0);
		});
	},
	flipEvents:function(){
		$("body").on("click", '.btn-reverse',function(e){
			// $container = $(e.target).closest('.flipbox-container')
			$(".flipbox").flippyReverse();
			e.preventDefault();
		});
	},
	playListSettings:function () {
		$('.nav.nav-tabs a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});


	}
}