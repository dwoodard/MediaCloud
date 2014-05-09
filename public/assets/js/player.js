
var Player = (function(opts) {

	function Player(opts) {
		var p = this
		p.options = $.extend({
			video:$("#player-video")[0],
			menu:$("#player-menu")[0],
			type:undefined,
			dataURL:undefined, /* /playlists/1/cpa */
		}, opts);


		p.video = p.options.video;
		p.menu = p.options.menu;
		p.type = p.options.type;
		p.deferreds = {};
		p.data = p.getData(p.options.dataURL);

		p.deferreds.defGetData.progress(function(data) {
			console.log("progress", data);
		})

		p.deferreds.defGetData.done(function(data) {
			p.data = data;
			p.init();
		})

		p.init = function  () {
			p.setMenuView();
			p.loadVideo();
		}

	};

	Player.prototype.setMenuView = function() {
		console.log("setMenuView",this.type, this);
	};

	Player.prototype.loadVideo = function() {
		console.log("loadVideo", this);
		player.data
	};

	Player.prototype.getData = function(url) {
		var that = this;

		this.deferreds.defGetData = $.getJSON(url);
		that.deferreds.defGetData.progress(function(data) {
			console.log('progress', data)
		});
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
	Player.prototype.playNext = function() {
		return 'playNext';
	};

	Player.prototype.playPrev = function() {
		return 'playPrev';
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














