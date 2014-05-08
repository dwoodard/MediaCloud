
var Player = (function(opts) {

	function Player(opts) {

		this.options = $.extend({
			video:$("#player-video")[0],
			menu:$("#player-menu")[0],
			type:undefined,
			data:undefined,
			dataURL:undefined, /* /playlists/1/cpa */
		}, opts);

		this.video = this.options.video;
		this.menu = this.options.menu;
		this.data = this.getData(this.options.dataURL);
	};

	Player.prototype.getData = function(url) {
		var that = this;

		var def = $.getJSON(url);
		def.done(function(data) {
			that.data = data;
			console.log(that);
		})
	};

	/*Controls*/
	Player.prototype.play = function() {
		console.log(this)
		this.video.play()
	};
	Player.prototype.pause = function() {
		this.video.pause()
	};
	Player.prototype.changeVideo = function(url) {
		this.video.src = url;
	};
	Player.prototype.nextAsset = function() {
		return 'nextAsset';
	};

	Player.prototype.prevAsset = function() {
		return 'prevAsset';
	};

	return new Player(opts);
});





// var player = new function() {

// 	this.video = "";
// 	this.menu = "";

// 	this.data = "";

// 	this.getData = function() {};
// };


// var Player = (function() {
// 	function Player(playerElm,menuElm) {

// 		this.video = playerElm[0];
// 		this.data = function() {
// 			var re = /(.*)-(\d+)/.exec($(this.video).closest('[data-type]').data('type'))
// 			dataDef = $.getJSON('/'+re[1] +'/'+ re[2] + '/cpa');
// 			return data.promise()
// 		};
// 		this.menu = menuElm;

// 		this.init();
// 	}
// 	Player.prototype.init = function() {

// 		$(data).done(function(e){
// 			console.log(e);
// 		})

// 	};

// 	Player.prototype.video = "";
// 	Player.prototype.menu = "";

// 	Player.prototype.changeVideo = function(url) {
// 		console.log(url);
// 	}

// 	Player.prototype.nextAsset = function() {
// 		return false
// 	}

// 	Player.prototype.prevAsset = function() {
// 		return false
// 	}



// 	return Player;

// })();




// Player.js
// var Player = {
// 	video:"",
// 	Collection: {},
// 	Playlists: {},
// 	media_events: [

// 	],
// 	init: function() {
// 		this.video = document.getElementById("video-player");
// 		console.log(this)
// 	},
// 	videoPlayer: {
// 		//Player Controls
// 		playNext:function() {},
// 		playPrev:function() {},
// 		mute:function() {},
// 		mute:function() {},

// 		//Events
// 		loadstart:function() {},
// 		progress:function() {},
// 		suspend:function() {},
// 		abort:function() {},
// 		error:function() {},
// 		emptied:function() {},
// 		stalled:function() {},
// 		loadedmetadata:function() {},
// 		loadeddata:function() {},
// 		canplay:function() {},
// 		canplaythrough:function() {},
// 		playing:function() {},
// 		waiting:function() {},
// 		seeking:function() {},
// 		seeked:function() {},
// 		ended:function() {},
// 		durationchange:function() {},
// 		timeupdate:function() {},
// 		play:function() {},
// 		pause:function() {},
// 		ratechange:function() {},
// 		resize:function() {},
// 		volumechange:function() {}
// 	}


// }














