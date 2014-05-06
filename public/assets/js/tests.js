

/*
|***************
| Player
|****************
*/

module( "Player" );

var video = $('<video id="video-player">');
var player = new Player(video)

test( "Does Player Init", function() {
	ok(player, "Passed!" );
	ok(player.data, 'Has player.data');
	ok(player.video, 'Has player.video');
	equal(player.video.id, 'video-player', 'Has player.video.id');
});

test( "Controllers", function() {

	ok( player.nextAsset(), "next video!" );
	ok( player.prevAsset(), "prev video!" );

});

test( "Menu", function() {

	ok( player.menu, "Menu" );

});



/*
|***************
| Other
|****************
*/
module( "Other" );

// test( "propEqual test", function() {
//   function Foo( x, y, z ) {
//     this.x = x;
//     this.y = y;
//     this.z = z;
//   }
//   Foo.prototype.doA = function () {};
//   Foo.prototype.doB = function () {};
//   Foo.prototype.bar = 'prototype';

//   var foo = new Foo( 1, "2", [] );
//   var bar = {
//     x : 1,
//     y : "2",
//     z : []
//   };
//   propEqual( foo, bar, "Strictly the same properties without comparing objects constructors." );
// });



// test( "a test", 2, function() {
//   function calc( x, operation ) {
//     return operation( x );
//   }

//   var result = calc( 2, function( x ) {
//     ok( true, "calc() calls operation function" );
//     return x * x;
//   });

//   equal( result, 4, "2 squared equals 4" );
// });


/*
|***************
| async tests
|****************
*/


// asyncTest( "asynchronous test: one second later!", function() {
//   expect( 1 );

//   setTimeout(function() {
//     ok( true, "Passed and ready to resume!" );
//     start();
//   }, 1000);
// });