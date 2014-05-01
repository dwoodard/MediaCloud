<?php

class TagSeeder extends Seeder {

	public function run()
	{


		// Initialize empty array
		$tags = array(
			array('name' => 'Dumb'),
			array('name' => 'Educational'),
			array('name' => 'Weber'),
			);


		// Insert tags
		Tag::insert($tags);
	}

}
