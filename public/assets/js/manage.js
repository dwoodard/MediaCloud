// manage.js

var Manage = {

	init:function(){
		this.initAppFolders();
		this.initEvents();
		// console.log(this);
	},
	initAppFolders:function(){
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
	initEvents:function(){
		// console.log('initEvents');

		this.searchBtn();
		// this.toggleFlip();
		this.playListSettings();
		this.flipEvents();


	},
	searchBtn:function(){

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