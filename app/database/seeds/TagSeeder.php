<?php

class TagSeeder extends Seeder {

	public function run()
	{
		// Common data
		// $common = array(
		// 	'user_id' => 1,
		// 	'content' => file_get_contents(__DIR__ . '/post-content.txt'),
		// );

		// Initialize empty array
		$tags = array();

		// Blog post 1
		$tags[] =  array(
			'name'      => 'Dumb',
		);

		// Blog post 2
		$tags[] = array(
			'name'      => 'Educational',
		);

		// Blog post 3
		$tags[] =  array(
			'name'      => 'Weber',
		);

		// Delete all tags
		// DB::table('tags')->truncate();

		// Insert tags
		Tag::insert($tags);
	}

}
