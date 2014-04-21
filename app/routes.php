<?php

/*
* APP Bindings
*/

// use Illuminate\Queue\BeanstalkdQueue;

App::bind('AssetRepository', 'Asset');



Route::get('/test', function(){

	return Asset::unassigned(1);
	// $collection = Collection::find(1);
	// return $collection->playlists;
	// return $collection;


	// $user = User::find(Sentry::getUser()->id);
	// $user->collections;
	// $user->playlists;
	// $user->assets;
	// return $user;

});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/
Route::group(array('before' => 'admin-auth|permissions','prefix' => 'admin'), function()
{

	# Assets Management
	Route::group(array('prefix' => 'assets'), function()
	{
		Route::get('/', array('as' => 'assets','uses' => 'AssetsController@index'));
		Route::get('upload', array('as' => 'asset.upload', 'uses' => 'AssetsController@create'));
		Route::post('upload', array('as' => 'asset.store', 'uses' => 'AssetsController@store'));
        //show
		Route::get('{assetId}/edit', array('as' => 'asset.edit', 'uses' => 'AssetsController@edit'));
		Route::post('{assetId}/edit', array('as' => 'asset.update', 'uses' => 'AssetsController@update')); //POST /admin/assets/{assetId}/edit
		Route::delete('{assetId}/delete', array('as' => 'asset.delete', 'uses' => 'AssetsController@destroy'));
	});

	# User Management
	Route::group(array('prefix' => 'users'), function()
	{
		Route::get('/', array('as' => 'users', 'uses' => 'UsersController@getIndex'));
		Route::get('create', array('as' => 'create/user', 'uses' => 'UsersController@getCreate'));
		Route::post('create', 'UsersController@postCreate');
		Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'UsersController@getEdit'));
		Route::post('{userId}/edit', 'UsersController@postEdit');
		Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'UsersController@getDelete'));
		Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'UsersController@getRestore'));
	});

	# Group Management
	Route::group(array('prefix' => 'groups'), function()
	{
		Route::get('/', array('as' => 'groups', 'uses' => 'GroupsController@getIndex'));
		Route::get('create', array('as' => 'create/group', 'uses' => 'GroupsController@getCreate'));
		Route::post('create', 'GroupsController@postCreate');
		Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'GroupsController@getEdit'));
		Route::post('{groupId}/edit', 'GroupsController@postEdit');
		Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'GroupsController@getDelete'));
		Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'GroupsController@getRestore'));
	});

	# Playlists Management
	Route::group(array('prefix' => 'playlists'), function()
	{
		Route::get('/', array('as' => 'playlists','uses' => 'PlaylistsController@index'));
		Route::get('create', array('as' => 'playlist.create', 'uses' => 'PlaylistsController@create'));
		Route::post('create', array('as' => 'playlist.store', 'uses' => 'PlaylistsController@store'));
        //show
		Route::get('{playlistId}/edit', array('as' => 'playlist.edit', 'uses' => 'PlaylistsController@edit'));
		Route::post('{playlistId}/edit', array('as' => 'playlist.update', 'uses' => 'PlaylistsController@update')); //POST /admin/Playlists/{playlistId}/edit
		Route::delete('{playlistId}/delete', array('as' => 'playlist.delete', 'uses' => 'PlaylistsController@destroy'));
	});


# Collections Management
	Route::group(array('prefix' => 'collections'), function()
	{
		Route::get('/', array('as' => 'collections','uses' => 'CollectionsController@index'));
		Route::get('create', array('as' => 'collection.create', 'uses' => 'CollectionsController@create'));
		Route::post('create', array('as' => 'collection.store', 'uses' => 'CollectionsController@store'));
		// Route::post('create', 'CollectionsController@store');
        //show
		Route::get('{collectionId}/edit', array('as' => 'collection.edit', 'uses' => 'CollectionsController@edit'));
		Route::post('{collectionId}/edit', array('as' => 'collection.update', 'uses' => 'CollectionsController@update')); //POST /admin/Collections/{collectionId}/edit
		Route::delete('{collectionId}/delete', array('as' => 'collection.delete', 'uses' => 'CollectionsController@destroy'));
	});

	# Dashboard
	Route::get('/', array('as' => 'admin', 'uses' => 'DashboardController@getIndex'));


	Route::get('settings', array('as' => 'settings', 'uses' => 'SettingsController@getIndex'));
	Route::get('collections', array('as' => 'collections', 'uses' => 'CollectionsController@getIndex'));
	Route::get('playlists', array('as' => 'playlists', 'uses' => 'PlaylistsController@getIndex'));
	Route::get('queue', array('as' => 'queue', 'uses' => 'QueuesController@index'));
	Route::get('history', array('as' => 'history', 'uses' => 'HistoryController@index'));
	Route::get('capture', array('as' => 'capture', 'uses' => 'CaptureController@index'));
	Route::get('reports', array('as' => 'reports', 'uses' => 'ReportsController@index'));
	Route::get('help', array('as' => 'help', function() {return View::make("backend.pages.help"); }));
});





/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'auth'), function()
{

	# Login
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');

	# Register
	Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
	Route::post('signup', 'AuthController@postSignup');

	# Account Activation
	Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

	# Forgot Password
	Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
	Route::post('forgot-password', 'AuthController@postForgotPassword');

	# Forgot Password Confirmation
	Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

});




# Frontend Static Pages

Route::get('help', function(){ return View::make('frontend.pages.help');});
Route::get('faq', function(){ return View::make('frontend.pages.faq');});
Route::get('privacy', function(){ return View::make('frontend.pages.privacy-policy');});
Route::get('terms', function(){ return View::make('frontend.pages.terms-of-service');});
Route::get('about-us', function(){return View::make('frontend.pages.about-us');});

Route::get('contact-us', array('as' => 'contact-us', 'uses' => 'ContactUsController@getIndex'));
Route::post('contact-us', 'ContactUsController@postIndex');





# Capture
Route::get('capture', array('as' => 'single', 'uses' => 'CaptureController@index'));


# Media Player
Route::group(array('prefix' => 'player'), function()
{
	Route::get('single/{id}', array('as' => 'single', 'uses' => 'PlayerController@single'));
	Route::get('playlist/{id}', array('as' => 'playlist', 'uses' => 'PlayerController@playlist'));
	Route::get('collection/{id}', array('as' => 'collection', 'uses' => 'PlayerController@collection'));

});


#Asset File
Route::group(array('prefix' => 'asset'), function()
{
	Route::get('{id}/{item?}', array('as' => 'asset.file', 'uses' => 'AssetsController@file'));
});

#Collections
Route::group(array('prefix' => 'collections'), function()
{
	Route::get('/{id?}', array('as' => 'collection.index', 'uses' => 'CollectionsController@index'));
	Route::post('store', array('as' => 'collection.store', 'uses' => 'CollectionsController@store'));
	Route::post('add', array('as' => 'collection.store', 'uses' => 'CollectionsController@store'));

});

// #CollectionsPlaylistAsset
// Route::group(array('before' => 'cas-login', 'prefix' => 'cpa'), function()
// {
// 	Route::get('/', array('before' => 'cas-auth', 'uses' => 'CollectionPlaylistAssetController@index'));
// 	Route::get('/{id}', array('before' => 'cas-auth', 'uses' => 'CollectionPlaylistAssetController@show'));
// 	Route::post('/update', array('before' => 'cas-auth', 'uses' => 'CollectionPlaylistAssetController@update_order_by_cpa'));
// 	Route::post('/add', array('before' => 'cas-auth', 'uses' => 'CollectionPlaylistAssetController@add'));

// });





# Media Manager
// 'before' => 'cas-login',
Route::group(array( 'prefix' => 'manage'), function()
{
	Route::get('/', array('as' => 'manage', 'uses' => 'ManageController@index'));
	Route::get('collections/{id?}', array('as' => 'manage.collections', 'uses' => 'ManageController@collection'));
	Route::get('playlists/{collection_id}/{playlist_id}', array('as' => 'manage.playlists', 'uses' => 'ManageController@playlist'));
	Route::get('browse/{id?}', array('as' => 'manage.browse', 'uses' => 'ManageController@browse'));
	Route::post('upload', array('as' => 'manage.store', 'uses' => 'ManageController@store'));
	
	Route::get('context-menu/{type?}', array('as' => 'manage.store', 'uses' => 'ManageController@context_menu'));

	Route::post('collection/add', array('before' => 'cas-auth', 'uses' => 'ManageController@collection_add'));
	Route::post('playlist/add', array('before' => 'cas-auth', 'uses' => 'ManageController@playlist_add'));
	Route::post('asset/add', array('before' => 'cas-auth', 'uses' => 'ManageController@asset_add'));

	Route::post('collection/update', array('before' => 'cas-auth', 'uses' => 'ManageController@collection_update'));
	Route::post('playlist/update', array('before' => 'cas-auth', 'uses' => 'ManageController@playlist_update'));
	Route::post('asset/update', array('before' => 'cas-auth', 'uses' => 'ManageController@asset_update'));

	Route::post('collection/delete', array('before' => 'cas-auth', 'uses' => 'ManageController@collection_delete'));
	Route::post('playlist/delete', array('before' => 'cas-auth', 'uses' => 'ManageController@playlist_delete'));
	Route::post('asset/delete', array('before' => 'cas-auth', 'uses' => 'ManageController@asset_delete'));
});





Route::get('/', array('as' => 'home', function(){
	if(file_exists(base_path() . '/app/config/database.php')) {
		return View::make('home');
	} else {

		return Redirect::route('install');
	}
}));

Route::get('/install', array( 'as' => 'install', function() {
	echo "Install Me!";
}));

//Run Laravel Commands after Setup
Route::post('/app/install', array( 'as' => 'app/install', function() {
	$result =  Artisan::call('app:install');
	if ($result == 0 ) {
		echo '{"status" : "success"}';
	} else {
		echo '{"status" : "error"}';
	}
}));


Route::get('login', array('before' => 'cas-login', function()
{
	return Redirect::to('/');
}));

Route::get('logout', array('before' => 'cas-logout', function()
{
	return Redirect::to('/');
}));



Route::group(array('prefix' => 'v1'), function()
{
    //cas-auth
    //admin-auth

    /*
     * Admin Apis
     */
    Route::get('users/{id?}', array('before' => 'admin-auth', 'uses' => 'Controllers\Api\V1\ApiController@users'));
    Route::post('user/tos', array('uses' => 'Controllers\Api\V1\ApiController@tos'));
    Route::get('assets/{id?}/{token?}', array('before' => 'cas-auth', 'uses' => 'Controllers\Api\V1\ApiController@assets'));

    /*
     * cas-auth Apis
     */
    Route::get('cpa/{id}', array('before' => 'cas-auth', 'uses' => 'Controllers\Api\V1\ApiController@cpa'));


    /*
     *
     */
    Route::get('test', array('uses' => 'Controllers\Api\V1\ApiController@test'));
    Route::get('vstest', array('uses' => 'Controllers\Api\V1\ApiController@test'));
});
