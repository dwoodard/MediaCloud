<?php
// 2015_04_02_202956_create_events_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('ca_id');
			$table->integer('user_id');
			$table->string('title');
			$table->string('location');
			$table->timestamp('start');
			$table->timestamp('end');
			$table->string('description');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}