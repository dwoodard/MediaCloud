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




