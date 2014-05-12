
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
		p.data = p.options.data
		p.init(p.data)

	};

	Player.prototype.init = function(data) {
		console.log(data);
	};
	// function init(data) {
	// 	console.log(data)
	// 	videojsInit()
	// };

	function videojsInit() {
		videojs.Menu = videojs.Button.extend({
			init: function(player, options){
				videojs.Button.call(this, player, options);
				this.on('click', this.onClick);
			}
		});

		videojs.Menu.prototype.onClick = function() {
			$("body").toggleClass('push-menu-open')
		};

		var createMenuButton = function() {
			var props = {
				className: 'vjs-vidMenu-button vjs-control',
				innerHTML: '<div class="vjs-control-content"><span class="vjs-control-text"> ' + ('Menu what is this') + '</span></div>',
				role: 'button',
				'aria-live': 'polite',
				tabIndex: 0
			};
			return videojs.Component.prototype.createEl(null, props);
		};

		var vidMenu;
		videojs.plugin('vidMenu', function() {
			var options = { 'el' : createMenuButton() };
			vidMenu = new videojs.Menu(this, options);
			this.controlBar.el().appendChild(vidMenu.el());
		});

		var vid = videojs("player-video", {
			plugins : { vidMenu : {} }
		});
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