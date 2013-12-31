<?php



/*
* APP Bindings
*/

use Illuminate\Queue\BeanstalkdQueue;

App::bind('AssetRepository', 'Asset');



Route::get('/test', function(){

	// return Asset::orderBy('id', 'desc')->paginate(2);
	Queue::push('DoSomethingIntensive', array('asset_id' => 1));
	// BeanstalkdQueue::push('DoSomethingIntensive', array('asset_id' => 1));

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




	# Dashboard
	Route::get('/', array('as' => 'admin', 'uses' => 'DashboardController@getIndex'));


	Route::get('settings', array('as' => 'settings', 'uses' => 'SettingsController@getIndex'));
	Route::get('collections', array('as' => 'collections', 'uses' => 'CollectionsController@getIndex'));
	Route::get('playlists', array('as' => 'playlists', 'uses' => 'PlaylistsController@getIndex'));
	Route::get('queues', array('as' => 'queues', 'uses' => 'QueuesController@index'));
	Route::get('history', array('as' => 'history', 'uses' => 'HistoryController@index'));
	Route::get('capture', array('as' => 'capture', 'uses' => 'CaptureController@index'));
	Route::get('reports', array('as' => 'reports', 'uses' => 'ReportsController@index'));
	
	Route::get('help', array('as' => 'help', function() {return View::make("backend.pages.help"); }));
});



#Frontend Static Pages
Route::get('faq', array('as' => 'faq', function() {return View::make("frontend.faq"); }));
Route::get('privacy-policy', array('as' => 'privacy-policy', function() {return View::make("frontend.pages.privacy-policy"); }));
Route::get('terms-of-services', array('as' => 'terms-of-services', function() {return View::make("frontend.pages.terms-of-services"); }));




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

// Route::get('blog/{postSlug}', array('as' => 'view-post', 'uses' => 'BlogController@getView'));
// Route::post('blog/{postSlug}', 'BlogController@postView');
	
	# Media Manager
	Route::get('manage', array('as' => 'manage', 'uses' => 'ManageController@index'));



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
    Route::get('assets/{id?}', array('before' => 'cas-auth', 'uses' => 'Controllers\Api\V1\ApiController@assets'));

    /*
     * cas-auth Apis
     */
    Route::get('cpa/{id}', array('before' => 'cas-auth', 'uses' => 'Controllers\Api\V1\ApiController@cpa'));



    /*
     *
     */
    Route::get('test', array('uses' => 'Controllers\Api\V1\ApiController@test'));
});
