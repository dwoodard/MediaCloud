<?php

return [

	'Admin' => [
		[
			'permission' => 'admin',
			'label'      => 'Admin Rights',
			],
		],
	'Global' => [
		[
			'permission' => 'superuser',
			'label'      => 'Super User',
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




