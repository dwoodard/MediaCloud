<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotCollectionUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collection_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('collection_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('collection_user');
	}

}
