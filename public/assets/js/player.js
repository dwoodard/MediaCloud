//http://www.w3.org/2010/05/video/script.js

var Player;

Player = (function() {
	function Player(playerElm,menuElm) {
		this.video = playerElm[0];
		this.menu = menuElm;

	}

	Player.prototype.video = "";
	Player.prototype.menu = "";

	Player.prototype.changeVideo = function(url) {
		console.log(url);
	}

	Player.prototype.nextAsset = function() {
		return 1
	}

	Player.prototype.prevAsset = function() {
		return 1
	}



	return Player;

})();




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














