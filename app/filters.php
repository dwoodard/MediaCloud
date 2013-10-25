<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth.admin', function()
{
	// Check if the user is logged in
	if ( ! Sentry::check())
	{
		return Redirect::route('admin.login');
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| Admin authentication filter.
|--------------------------------------------------------------------------
|
| This filter does the same as the 'auth' filter but it checks if the user
| has 'admin' privileges.
|
*/

Route::filter('admin-auth', function()
{
	// Check if the user is logged in
	if ( ! Sentry::check())
	{
		// Store the current uri in the session
		Session::put('loginRedirect', Request::url());

		// Redirect to the login page
		return Redirect::route('signin');
	}

	// Check if the user has access to the admin page
	if ( ! Sentry::getUser()->hasAccess('admin'))
	{
		// Show the insufficient permissions page
		return App::abort(403);
	}
});


Route::filter('cas-login', function(){
	if(App::environment() == "local"){
		Session::flash('error', "Not Secure with HTTPS!");

		$user = '';
		try {
			$user = (array) DB::table('users')->where('username', 'admin')->first();
		} catch (Exception $e) {

			Session::flash('error', $e->getMessage());
		}

		if ($user && isset($user['id'])) {
			$data = array(
				'id' => $user['id'], 
				'email' => $user['email'], 
				'password' => 'admin', 
				);
			$user = Sentry::authenticate($data, false);
			var_dump(Sentry::check());

			// Auth::loginUsingId($user->id);
			// var_dump(Auth::check());
			// var_dump(Auth::user()->id);
			Session::flash('info', "Logged in admin for testing");
		} else {
			Session::flash('info', "No Users in database");
		}
	}

	if(App::environment() == "dev"){
		var_dump(App::environment());
	}

	if(App::environment() == "production"){
		var_dump(App::environment());
	}


	$cas = Config::get('cas');
	phpCAS::client($cas['version'], $cas['cas_host'], $cas['cas_port'], $cas['cas_context']);
	phpCAS::setNoCasServerValidation();
	// phpCAS::setCasServerCACert($cas['cas_server_ca_cert_path']);
	phpCAS::forceAuthentication();


	$cas_data=phpCAS::getAttributes();

	var_dump($cas_data['email']);

	if (count(User::where('username', '=', phpCAS::getUser())->first()) == 0) {

		$user = Sentry::getUserProvider()->create(
			array(
				'email'    => $cas_data['email'],
				'username' => phpCAS::getUser(),
				));

	}

	// $user = DB::table('users')->where('username', phpCAS::getUser())->first();
	// Auth::loginUsingId($user->id);

 //    return Redirect::to('/');
});


Route::filter('cas-logout', function () {
	Sentry::logout();
	return Redirect::to('/');

    //Is server HTTPS? if not: test on Dev; if is precede as normal;
	// if (empty($_SERVER['HTTPS'])) {
	// 	$secure_connection = false;
	// } else {
	// 	$secure_connection = !!$_SERVER['HTTPS'] !== 'off';
	// }

    //If it is not Show Error
	// if ($secure_connection || $_SERVER['SERVER_PORT'] == 443) {
	// 	echo $secure_connection . ' ' . $_SERVER['SERVER_PORT'];
	// } else {
	// 	Session::flash('error', "Not Secure with HTTPS!");
	// 	Auth::logout();
	// 	return Redirect::to('/');
	// }

	$cas = Config::get('cas');
	phpCAS::client($cas['version'], $cas['cas_host'], $cas['cas_port'], $cas['cas_context']);
	phpCAS::setNoCasServerValidation();
	// phpCAS::setCasServerCACert($cas['cas_server_ca_cert_path']);
	phpCAS::forceAuthentication();
	phpCAS::logout(array('service' => URL::to('/')));
});


/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
