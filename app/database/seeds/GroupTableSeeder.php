<?php

class GroupTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('group')->truncate();

		Sentry::getGroupProvider()->create(
			array(
				'name'        => 'Faculty',
				'permissions' => array(
					'users' => 1,
					'upload' => 1,
					'manage' => 1,
					'capture' => 1
					)
				)
			);

		Sentry::getGroupProvider()->create(
			array(
				'name'        => 'Staff',
				'permissions' => array(
					'users' => 1,
					'upload' => 1,
					'manage' => 1
					)
				)
			);

		Sentry::getGroupProvider()->create(
			array(
				'name'        => 'Student',
				'permissions' => array(
					'users' => 1,
					)
				)
			);

		Sentry::getGroupProvider()->create(
			array(
				'name'        => 'Guest',
				'permissions' => array(
					'users' => 1
					)
				)
			);

		// Uncomment the below to run the seeder
		// DB::table('group')->insert($group);
	}

}
