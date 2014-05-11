
var Player = (function(opts) {

	function Player(opts) {
		var p = this
		p.options = $.extend({
			video:$("#player-video")[0],
			menu:$("#player-menu")[0],
			type:undefined,
			data:undefined,
		}, opts);

		p.video = p.options.video;
		p.menu = p.options.menu;
		p.type = p.options.type;
	};

	Player.prototype.loadVideo = function() {
		console.log("loadVideo", this);
		player.data
	};


	/*Controls*/
	Player.prototype.play = function() {
		console.log(this);
		this.video.play();
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