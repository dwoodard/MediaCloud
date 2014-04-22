<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetPlaylistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asset_playlist', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asset_id')->unsigned()->index();
			$table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
			$table->integer('playlist_id')->unsigned()->index();
			$table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('cascade');
			$table->integer('asset_order');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('asset_playlist');
	}

}
