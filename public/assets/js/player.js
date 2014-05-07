//http://www.w3.org/2010/05/video/script.js



// function loadData() {
// 	var dfd = new jQuery.Deferred();


// 	/* Resolve after a random interval*/
// 	setTimeout(function() {
// 		dfd.resolve( "hurray" );
// 	}, Math.floor( 2000 + Math.random() * 2000 ) );

// 	/* Reject after a random interval*/
// 	setTimeout(function() {
// 		dfd.reject( "sorry" );
// 	}, Math.floor( 2500 + Math.random() * 2000 ) );

// 	/* Show a "working..." message every half-second*/
// 	setTimeout(function working() {
// 		if ( dfd.state() === "pending" ) {
// 			/* console.log(dfd);*/
// 			dfd.notify( "working... " );
// 			setTimeout( working, 50 );
// 		}
// 	}, 1 );

// 	/* Return the Promise so caller can't change the Deferred*/
// 	return dfd.promise();
// }

/* Attach a done, fail, and progress handler for the loadData*/
// $.when( loadData() ).then(
// 	function doneFilter ( status, textStatus, jqXHR ) {
// 		console.log(status,textStatus, jqXHR)
// 		alert( status + ", things are going well" );
// 	},
// 	function failFilter ( status, textStatus, jqXHR ) {
// 		alert( status + ", you fail this time" );
// 	},
// 	function progressFilter ( status, textStatus, jqXHR ) {
// 		$( "body" ).append( status );
// 	}
// 	);





var Player;

Player = (function() {
	function Player(playerElm,menuElm) {

		this.video = playerElm[0];
		this.data = function() {
			var re = /(.*)-(\d+)/.exec($(this.video).closest('[data-type]').data('type'))
			data = $.getJSON('/'+re[1] +'/'+ re[2] + '/cpa');
			return data.responseJSON
		};
		this.menu = menuElm;

		this.init();
	}
	Player.prototype.init = function() {

		$.when(this.data()).then( function(data) {
			console.log('done',this.data)
		}, function() {
			console.log('failed')
		} );

	};

	Player.prototype.video = "";
	Player.prototype.menu = "";

	Player.prototype.changeVideo = function(url) {
		console.log(url);
	}

	Player.prototype.nextAsset = function() {
		return false
	}

	Player.prototype.prevAsset = function() {
		return false
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














