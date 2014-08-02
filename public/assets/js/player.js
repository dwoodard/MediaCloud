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
		p.init(p.data,p.type)

		$(p.video).on('click',function(e) {
			// console.log('click video', this, e)

			if (this.paused) {
				this.play()
			}
			else{
				this.pause()
			};
		})

	};

	Player.prototype.init = function(data,type) {
		videojsInit();
		menuInit();


		/*load first*/
		console.log(type);


		switch(type){
			case "collections":
				if (this.data.playlists.length) {
					this.loadVideo(this.data.playlists[0].assets[0].id)
				}
				else if(this.data.assets.length){
					this.loadVideo(this.data.assets[0].id)

				};
			break

			case "playlists":
				this.loadVideo(this.data.assets[0].alphaID)
			break

			default:
			break;
		}




	};

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

	function menuInit() {
		/*Player*/
		$(".video_play").on("click", function(e) {
			e.preventDefault();
			console.log(this,$(this).data('asset-id'))
			player.loadVideo($(this).data('asset-id'))
		});

		$(".download_asset").on("click", function(e) {
			e.preventDefault();
			id = $(this).closest(".row").find('[data-asset-id]').data('asset-id');
			window.open(window.location.origin + '/asset/' + id + "/download", '_blank');
		});


		/*Settings*/
		$( "#video_playrate_reset").on("click",function(e) {
			e.preventDefault()
			$("#playrate-slider").slider({value:100})
			$("#video_playrate_val").html(1);
		})

		$( "#playrate-slider" ).slider({
			min:50,
			max:300,
			value: 100,
			step: 10,
			change: function( event, ui ) {
				player.playbackRate(ui.value/100)
			},
			slide: function( event, ui ) {
				/* console.log(event,ui);*/
				$("#video_playrate_val").html(ui.value/100)
				player.playbackRate(ui.value/100)
			}
		});



	};

	Player.prototype.loadVideo = function(assetId) {
		this.changeVideo( window.location.origin+"/asset/"+assetId );
	}


	/*Controls*/
	Player.prototype.play = function() {
		this.video.play();
	};
	Player.prototype.playbackRate = function(val) {
		player.video.playbackRate = val
	};

	Player.prototype.pause = function() {
		this.video.pause()
	};

	Player.prototype.changeVideo = function (url) {
		console.log(url);
		this.video.src = url;
		this.video.play();
	};

	Player.prototype.playNext = function() {
		return 'playNext';
	};

	Player.prototype.playPrev = function() {
		return 'playPrev';
	};

	/* Event*/
	Player.prototype.onEnd = function() {
		/*do on video end stuff*/
	};
	Player.prototype.onStart = function() {
		/*do on video start stuff*/
	};



	function checkNested(obj) {
		var args = Array.prototype.slice.call(arguments),
		obj = args.shift();

		for (var i = 0; i < args.length; i++) {
			if (!obj || !obj.hasOwnProperty(args[i])) {
				return false;
			}
			obj = obj[args[i]];
		}
		return true;
	}


	return new Player(opts);
});

