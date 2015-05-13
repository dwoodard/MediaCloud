<?php

return [

	'Admin' => [
		[
		'permission' => 'admin',
		'label'      => 'Admin Rights',
		]
	],
	'Manage' => [
			[
			'permission' => 'manage',
			'label'      => 'Manage Rights',
			],
			[
			'permission' => 'upload',
			'label'      => 'Upload Rights',
			],
		],
	'Terms of Services Agreed' => [
			[
			'permission' => 'tos',
			'label'      => 'Terms of Services',
			],
		],
	'Frontend Admin' => [
		[
		'permission' => 'superuser',
		'label'      => 'Superuser Rights',
		],
	],

	'User' => [
			[
			'permission' => 'UsersController@getIndex',
			'label'      => 'User Index',
			],
			[
			'permission' => 'UsersController@getCreate',
			'label'      => 'User Create',
			],
			[
			'permission' => 'UsersController@postCreate',
			'label'      => 'User Store',
			],
			[
			'permission' => 'UsersController@getEdit',
			'label'      => 'User Show',
			],
			[
			'permission' => 'UsersController@postEdit',
			'label'      => 'User Edit',
			],
			[
			'permission' => 'UsersController@getDelete',
			'label'      => 'User Delete',
			],
			[
			'permission' => 'UsersController@getRestore',
			'label'      => 'User Restore',
			],
		],


	'Capture Agents' => [
			[
			'permission' => 'CaptureController@index',
			'label'      => 'Collections Index',
			],
			[
			'permission' => 'CaptureController@addEvent',
			'label'      => 'Capture Admin Add Event',
			],
			[
			'permission' => 'CaptureController@addCaptureAgent',
			'label'      => 'Add Capture Agent',
			],
			// [
			// 'permission' => 'CaptureController@store',
			// 'label'      => 'Capture Store',
			// ],
			// [
			// 'permission' => 'CaptureController@edit',
			// 'label'      => 'Capture Edit',
			// ],
			// [
			// 'permission' => 'CaptureController@update',
			// 'label'      => 'Capture Update',
			// ],
			// [
			// 'permission' => 'CaptureController@destroy',
			// 'label'      => 'Capture Destroy',
			// ],
		],

	'Collections' => [
			[
			'permission' => 'CollectionsController@index',
			'label'      => 'Collections Index Rights',
			],
			[
			'permission' => 'CollectionsController@create',
			'label'      => 'Collections Create Rights',
			],
			[
			'permission' => 'CollectionsController@store',
			'label'      => 'Collections Store Rights',
			],
			[
			'permission' => 'CollectionsController@edit',
			'label'      => 'Collections Edit Rights',
			],
			[
			'permission' => 'CollectionsController@update',
			'label'      => 'Collections Update Rights',
			],
			[
			'permission' => 'CollectionsController@destroy',
			'label'      => 'Collections Destroy Rights',
			],
		],

	'Playlists' => [
			[
			'permission' => 'PlaylistsController@index',
			'label'      => 'Playlists Index Rights',
			],
			[
			'permission' => 'PlaylistsController@create',
			'label'      => 'Playlists Create Rights',
			],
			[
			'permission' => 'PlaylistsController@store',
			'label'      => 'Playlists Store Rights',
			],
			[
			'permission' => 'PlaylistsController@edit',
			'label'      => 'Playlists Edit Rights',
			],
			[
			'permission' => 'PlaylistsController@update',
			'label'      => 'Playlists Update Rights',
			],
			[
			'permission' => 'PlaylistsController@destroy',
			'label'      => 'Playlists Destroy Rights',
			],
		],

	'Permission' => [
			[
			'permission' => 'PermissionsController@index',
			'label'      => 'Playlists Index Rights',
			],
			[
			'permission' => 'PermissionsController@create',
			'label'      => 'Playlists Create Rights',
			],
			[
			'permission' => 'PermissionsController@store',
			'label'      => 'Playlists Store Rights',
			],
			[
			'permission' => 'PermissionsController@edit',
			'label'      => 'Playlists Edit Rights',
			],
			[
			'permission' => 'PermissionsController@update',
			'label'      => 'Playlists Update Rights',
			],
			[
			'permission' => 'PermissionsController@destroy',
			'label'      => 'Playlists Destroy Rights',
			],
		],

	'Queue' => [
			[
			'permission' => 'QueuesController@index',
			'label'      => 'Queue Rights',
			]
		],

	'History' => [
			[
			'permission' => 'HistoryController@index',
			'label'      => 'History Rights',
			]
		],

	'Admin Asset' => [
			[
			'permission' => 'AssetsController@index',
			'label'      => 'Asset Index',
			],
		[
			'permission' => 'AssetsController@create',
			'label'      => 'Asset Create',
			],
		[
			'permission' => 'AssetsController@store',
			'label'      => 'Asset Store',
			],
		[
			'permission' => 'AssetsController@edit',
			'label'      => 'Asset Show',
			],
		[
			'permission' => 'AssetsController@update',
			'label'      => 'Asset Save',
			],
		[
			'permission' => 'AssetsController@destroy',
			'label'      => 'Asset Delete',
			]
		],
	];




