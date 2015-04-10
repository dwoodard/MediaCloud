<?php

/*
* APP Bindings
*/

// use Illuminate\Queue\BeanstalkdQueue;

App::bind('AssetRepository', 'Asset');


// Route::post('/test', array('uses' => 'ManageController@collection_delete'));


Route::get('/test', function () {
    // return CaptureAgent::all();
    return CalendarEvent::all();
});

Route::get('/test-ca', function () {

    $ca = new CaptureAgent;
    $ca->ip          = '1.2.3.4';
    $ca->location    = 'LP-203';
    $ca->save();

});

Route::get('/test-ce', function () {

    $ce = new CalendarEvent;
    $ce->ca_id = '1.2.3.4';
    $ce->user_id = '12';
    $ce->location = '12';
    $ce->startDate = Carbon::now();
    $ce->endDate = Carbon::now()->addMinute(1);
    $ce->save();

    return CalendarEvent::all();
});

Route::get('/test2', function () {
    $dt = Carbon::now()->setTimezone('America/Denver');
    $dt->tz('America/Toronto');
    var_dump($dt);
});

Route::get('/ca/LP-203.ics', function () {
    // echo $dt = Carbon::now();
    // var_dump($dt->year(1975)->month(5)->day(21)->hour(22)->minute(32)->second(5)->toDateTimeString());
    // var_dump($dt->setDate(1975, 5, 21)->setTime(22, 32, 5)->toDateTimeString());
    // dd(Carbon::now('America/Denver'));
    // dd(Carbon::now()->tzName);
    // dd(new Carbon('first day of January 2008', 'America/denver'));

    // dd(Carbon::now()->subMinutes(2));
    // dd(Carbon::createFromTime(14, 0, 0, 'america/denver'));
    // $tomorrow = Carbon::now()->addDay();

    $vCalendar = new \Eluceo\iCal\Component\Calendar(URL::to('/'));

// Create Event
    $vEvent = new \Eluceo\iCal\Component\Event();


// Add Info
    $vEvent
    ->setDtStart(new \DateTime())
    ->setDtEnd(new \DateTime())
    ->setorganizer(Sentry::getUser()->username)
    // ->setNoTime(true)
    ->setSummary('Title');
// Add event to calendar
    $vCalendar->addComponent($vEvent);

// header('Content-Type: text/calendar; charset=utf-8');
// header('Content-Disposition: attachment; filename="LP-203.ics"');

    echo $vCalendar->render();

//     var_dump($vCalendar);
// var_dump($vEvent);




// printf("%s", Carbon::now()->toDateTimeString());

// echo "<br>";
// function dateToCal($timestamp) {
//     return date('Ymd\THis\Z', $timestamp);
// }
// echo dateToCal(time());

// function escapeString($string) {
//     return preg_replace('/([\,;])/','\\\$1', $string);
// }

    // echo date('Ymd\THis\Z');
});


/*
|--------------------------------------------------------------------------
| Testing Routes
|--------------------------------------------------------------------------
|*/

Route::get('/qunit', function () {
    return View::make('test.qunit');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/
Route::group(array('before' => 'admin-auth|permissions', 'prefix' => 'admin'), function () {

    # Assets Management
    Route::group(array('prefix' => 'assets'), function () {
        Route::get('/', array('as' => 'assets', 'uses' => 'AssetsController@index'));
        Route::get('upload', array('as' => 'asset.upload', 'uses' => 'AssetsController@create'));
        Route::post('upload', array('as' => 'asset.store', 'uses' => 'AssetsController@store'));
        //show
        Route::get('{assetId}/edit', array('as' => 'asset.edit', 'uses' => 'AssetsController@edit'));
        Route::post('{assetId}/edit', array('as' => 'asset.update', 'uses' => 'AssetsController@update')); //POST /admin/assets/{assetId}/edit
        Route::delete('{assetId}/delete', array('as' => 'asset.delete', 'uses' => 'AssetsController@destroy'));
    });

    # Capture Management
    Route::group(array('prefix' => 'capture'), function () {
        Route::get('/', array('as' => 'capture', 'uses' => 'CaptureController@index'));
        // Route::get('upload', array('as' => 'capture.upload', 'uses' => 'CaptureController@create'));
        Route::post('add-event', array('as' => 'capture.addEvent', 'uses' => 'CaptureController@addEvent'));
        Route::post('add-capture-agent', array('as' => 'capture.addCaptureAgent', 'uses' => 'CaptureController@addCaptureAgent'));
        // Route::delete('upload', array('as' => 'capture.deleteEvent', 'uses' => 'CaptureController@deleteEvent'));
        // Route::post('upload', array('as' => 'capture.store', 'uses' => 'CaptureController@store'));
        // Route::get('{captureId}/edit', array('as' => 'capture.edit', 'uses' => 'CaptureController@edit'));
        // Route::post('{captureId}/edit', array('as' => 'capture.update', 'uses' => 'CaptureController@update')); //POST /admin/captures/{captureId}/edit
        // Route::delete('{captureId}/delete', array('as' => 'capture.delete', 'uses' => 'CaptureController@destroy'));
    });

    # User Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/', array('as' => 'users', 'uses' => 'UsersController@getIndex'));
        Route::get('create', array('as' => 'create/user', 'uses' => 'UsersController@getCreate'));
        Route::post('create', 'UsersController@postCreate');
        Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'UsersController@getEdit'));
        Route::post('{userId}/edit', 'UsersController@postEdit');
        Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'UsersController@getDelete'));
        Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'UsersController@getRestore'));
    });

    # Group Management
    Route::group(array('prefix' => 'groups'), function () {
        Route::get('/', array('as' => 'groups', 'uses' => 'GroupsController@getIndex'));
        Route::get('create', array('as' => 'create/group', 'uses' => 'GroupsController@getCreate'));
        Route::post('create', 'GroupsController@postCreate');
        Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'GroupsController@getEdit'));
        Route::post('{groupId}/edit', 'GroupsController@postEdit');
        Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'GroupsController@getDelete'));
        Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'GroupsController@getRestore'));
    });

    # Playlists Management
    Route::group(array('prefix' => 'playlists'), function () {
        Route::get('/', array('as' => 'playlists', 'uses' => 'PlaylistsController@index'));
        Route::get('create', array('as' => 'playlist.create', 'uses' => 'PlaylistsController@create'));
        Route::post('create', array('as' => 'playlist.store', 'uses' => 'PlaylistsController@store')); //show
        Route::get('{playlistId}/edit', array('as' => 'playlist.edit', 'uses' => 'PlaylistsController@edit'));
        Route::post('{playlistId}/edit', array('as' => 'playlist.update', 'uses' => 'PlaylistsController@update')); //POST /admin/Playlists/{playlistId}/edit
        Route::delete('{playlistId}/delete', array('as' => 'playlist.delete', 'uses' => 'PlaylistsController@destroy'));
    });


# Collections Management
    Route::group(array('prefix' => 'collections'), function () {
        Route::get('/', array('as' => 'collections', 'uses' => 'CollectionsController@index'));
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
    Route::get('collections', array('as' => 'collections', 'uses' => 'CollectionsController@index'));
    // Route::get('playlists', array('as' => 'playlists', 'uses' => 'PlaylistsController@index'));
    Route::get('queue', array('as' => 'queue', 'uses' => 'QueuesController@index'));
    Route::get('history', array('as' => 'history', 'uses' => 'HistoryController@index'));
    Route::get('reports', array('as' => 'reports', 'uses' => 'ReportsController@index'));
    Route::get('help', array('as' => 'help', function () { return View::make("backend.pages.help"); }));
});


/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'auth'), function () {

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

Route::get('help', function () { return View::make('frontend.pages.help'); });
Route::get('faq', function () { return View::make('frontend.pages.faq'); });
Route::get('privacy', function () { return View::make('frontend.pages.privacy-policy'); });
Route::get('terms', function () { return View::make('frontend.pages.terms-of-service'); });
Route::get('about-us', function () { return View::make('frontend.pages.about-us'); });

Route::get('contact-us', array('as' => 'contact-us', 'uses' => 'ContactUsController@getIndex'));
Route::post('contact-us', 'ContactUsController@postIndex');


# Capture
Route::post('kaltura/{token}/{entryId}', array('as' => 'kaltura', 'uses' => 'CaptureController@kaltura'));
Route::group(array('prefix' => 'capture'), function () {
    Route::get('/', array('as' => 'asset', 'uses' => 'CaptureController@index'));
    Route::post('/job/{token}/{entryId}', array('as' => 'kaltura', 'uses' => 'CaptureController@job'));
});

# Media Player
Route::group(array('prefix' => 'player'), function () {
    Route::get('asset/{id}', array('as' => 'asset', 'uses' => 'PlayerController@asset'));
    Route::get('playlist/{id}', array('as' => 'playlist', 'uses' => 'PlayerController@playlist'));
    Route::get('collection/{id}', array('as' => 'collection', 'uses' => 'PlayerController@collection'));

});


#Asset File
Route::group(array('prefix' => 'asset'), function () {
    Route::get('{id}/{item?}', array('as' => 'asset.file', 'uses' => 'AssetsController@file'));
});

#Collections
Route::group(array('prefix' => 'collections'), function () {
    // Route::get('/{id?}', array('as' => 'collection.index', 'uses' => 'CollectionsController@index'));
    Route::get('/{id?}/{cpa?}', array('as' => 'collection.index', 'uses' => 'CollectionsController@index'));
    Route::post('store', array('as' => 'collection.store', 'uses' => 'CollectionsController@store'));
    Route::post('add', array('as' => 'collection.store', 'uses' => 'CollectionsController@store'));

});
#Playlists
Route::group(array('prefix' => 'playlists'), function () {
    // Route::get('/{id?}', array('as' => 'collection.index', 'uses' => 'CollectionsController@index'));
    Route::get('/{id?}/{cpa?}', array('as' => 'collection.index', 'uses' => 'PlaylistsController@index'));
    // Route::post('store', array('as' => 'collection.store', 'uses' => 'CollectionsController@store'));
    // Route::post('add', array('as' => 'collection.store', 'uses' => 'CollectionsController@store'));

});


# Media Manager
//'before' => 'cas-login',
Route::group(array('before' => 'cas-login', 'prefix' => 'manage'), function () {
    Route::get('/', array('as' => 'manage', 'uses' => 'ManageController@index'));
    Route::get('collections/{id?}', array('as' => 'manage.collections', 'uses' => 'ManageController@collection'));
    Route::get('playlists/{collection_id}/{playlist_id}', array('as' => 'manage.playlists', 'uses' => 'ManageController@playlist'));
    Route::get('browse/{id?}', array('as' => 'manage.browse', 'uses' => 'ManageController@browse'));
    Route::get('schedule-capture', array('as' => 'manage.schedule-capture', 'uses' => 'ManageController@scheduleCapture'));
    Route::get('files', array('as' => 'manage.browse', 'uses' => 'ManageController@files'));
    Route::post('upload', array('as' => 'manage.store', 'uses' => 'ManageController@store'));

    Route::get('data/user_assets', array('uses' => 'ManageController@user_assets'));

    Route::get('context-menu/{type?}', array('as' => 'manage.store', 'uses' => 'ManageController@context_menu'));

    Route::post('sort/update', array('before' => 'cas-auth', 'uses' => 'ManageController@update_order_by_type'));


    Route::get('tags/{id?}', array('uses' => 'ManageController@tags'));
    Route::post('tag/add', array('uses' => 'ManageController@tag_add'));
    Route::delete('tag/delete/{tagName}/{assetId}', array('uses' => 'ManageController@tag_delete'));

    Route::post('collection/add', array('before' => 'cas-auth', 'uses' => 'ManageController@collection_add'));
    Route::post('playlist/add', array('before' => 'cas-auth', 'uses' => 'ManageController@playlist_add'));
    Route::post('asset/add', array('before' => 'cas-auth', 'uses' => 'ManageController@asset_add'));

    Route::post('collection/update', array('before' => 'cas-auth', 'uses' => 'ManageController@collection_update'));
    Route::post('playlist/update', array('before' => 'cas-auth', 'uses' => 'ManageController@playlist_update'));
    Route::post('asset/update', array('before' => 'cas-auth', 'uses' => 'ManageController@asset_update'));

    Route::delete('collection/delete/{id}', array('before' => 'cas-auth', 'uses' => 'ManageController@collection_delete'));
    Route::delete('playlist/delete/{id}', array('before' => 'cas-auth', 'uses' => 'ManageController@playlist_delete'));
    Route::delete('playlist_asset/delete/{playlistId}/{assetId}', array('before' => 'cas-auth', 'uses' => 'ManageController@playlist_asset_delete'));
    Route::delete('asset/delete/{id}', array('before' => 'cas-auth', 'uses' => 'ManageController@asset_delete'));

    Route::delete('asset/destroy/{id}', array('before' => 'cas-auth', 'uses' => 'AssetsController@destroy'));

});


Route::get('/', array('as' => 'home', function () {
    if (file_exists(base_path() . '/app/config/database.php')) {
        return View::make('home');
    } else {

        return Redirect::route('install');
    }
}));

Route::get('/install', array('as' => 'install', function () {
    echo "Install Me!";
}));

//Run Laravel Commands after Setup
Route::post('/app/install', array('as' => 'app/install', function () {
    $result = Artisan::call('app:install');
    if ($result == 0) {
        echo '{"status" : "success"}';
    } else {
        echo '{"status" : "error"}';
    }
}));


Route::get('login', array('before' => 'cas-login', function () {
    return Redirect::to('/');
}));

Route::get('logout', array('before' => 'cas-logout', function () {
    return Redirect::to('/');
}));


Route::group(array('prefix' => 'v1'), function () {
    //cas-auth
    //admin-auth

    /*
     * Admin Apis
     */
    Route::get('users/{id?}', array('before' => 'admin-auth', 'uses' => 'Controllers\Api\V1\ApiController@users'));
    Route::post('user/tos', array('uses' => 'Controllers\Api\V1\ApiController@tos'));

    /*
     * cas-auth Apis
     */
    Route::get('assets/{id?}/{token?}', array('before' => 'cas-auth', 'uses' => 'Controllers\Api\V1\ApiController@assets'));
    Route::get('collection/{id?}/{token?}', array('before' => 'cas-auth', 'uses' => 'Controllers\Api\V1\ApiController@collection'));
    // Route::get('cpa/{id}', array('before' => 'cas-auth', 'uses' => 'Controllers\Api\V1\ApiController@cpa'));
    Route::get('test', array('before' => 'cas-auth', 'uses' => 'Controllers\Api\V1\ApiController@test'));
});
