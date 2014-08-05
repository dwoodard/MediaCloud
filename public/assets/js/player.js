var Player = {
    init: function (player,opts) {
        this.options = $.extend({
            menu:$("#player-menu")[0],
            type:undefined,
            data:undefined
        }, opts);

        /*Player*/
        this.video = player;
        this.menu = this.options.menu;
        this.type = this.options.type;
        this.data = this.options.data;

        /*Menu*/
        this.videoLinks = $(".video_play");
        this.downloadLinks = $(".download_asset");

        /*Settings*/
        this.playrateSlider = $( "#playrate-slider" );
        this.playrateReset = $("#video_playrate_reset");

        this.bindEvents();
    },
    bindEvents: function () {
        /*Menu*/
        this.videoLinks.on('click', this.videoLinksHandler);
        this.downloadLinks.on('click', this.downloadLinksHandler);

        /*Player*/

        $(Player.video.el()).ready(this.loadFirstVidOfData)
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
                console.log(ui.value/100);
                Player.video.F.playbackRate = (ui.value/100)
            },
            slide: function( event, ui ) {
                /* console.log(event,ui);*/
                $("#video_playrate_val").html(ui.value/100)
                console.log(ui.value/100);
                Player.video.F.playbackRate =(ui.value/100)
            }
        });
    },

    loadFirstVidOfData: function() {
            // console.log("loadFirstVid", Player.data);

            switch(Player.type){
                case "collections":
                if (Player.data.playlists.length) {
                    Player.loadVideo(Player.data.playlists[0].assets[0].id)
                }
                else if(Player.data.assets.length){
                    Player.loadVideo(Player.data.assets[0].id)

                };
                break;
                case "playlists":
                Player.loadVideo(Player.data.assets[0].alphaID)
                break;
            }
        },
        videoLinksHandler:function(event) {
            assetId = event.currentTarget.dataset.assetId;
            Player.loadVideo(assetId);
        },
        downloadLinksHandler:function(event) {
            event.preventDefault();
            id = $(this).closest(".row").find('[data-asset-id]').data('asset-id');
            window.open(window.location.origin + '/asset/' + id + "/download", '_blank');
        },
        loadVideo: function (assetId) {
            url = window.location.origin+"/asset/"+assetId;
            this.changeVideo(url);
        },
        changeVideo:function(url) {
            Player.video.src(url);
            // Player.video.play();
        }
    };