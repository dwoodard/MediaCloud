
module( "Player" );
var video = $('<video id="player-video">');
var menu = $('<div id="player-menu">');

player = new Player({
	video: video[0] ,
	menu: menu[0] ,
	dataURL: "http://localhost:8080/playlists/1/cpa",
	type: "playlists"
});


test( "Player Init", function() {
	ok(player, "player" );
	ok(player, "player" );
	ok(player.menu, 'player.menu');
	ok(player.video, 'player.video');
	ok(player.options.dataURL, "/playlists/1/cpa");
	equal(player.video.id, 'player-video', 'player.video.id');



});






test( "Controllers", function() {
	// player.video.changeVideo('http://localhost:8080/asset/10')
	ok( player, "player");
	ok( player.play(), "play()");
	ok( player.pause(), "pause()");
	ok( player.nextAsset(), "next() video!" );
	ok( player.prevAsset(), "prev() video!" );

});

test( "Menu", function() {

	ok( player.menu, "player menu elment");

	var obj = { foo: "bar" };

	deepEqual( obj, { foo: "bar" }, "Two objects can be the same in value" );

});


module( "Async Tests" );

// test( "notDeepEqual test", function() {
//   var obj = { foo: "bar" };
//   notDeepEqual( obj, { foo: "bla" }, "Different object, same key, different value, not equal" );
// });